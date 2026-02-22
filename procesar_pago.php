<?php
// procesar_pago.php
header('Content-Type: application/json');

// 1. Cargar Variables de Entorno (Llave Privada)
$env_file = __DIR__ . '/.env';
$env_vars = file_exists($env_file) ? parse_ini_file($env_file) : [];
$SECRET_KEY = isset($env_vars['CULQI_PRIVATE_KEY']) ? $env_vars['CULQI_PRIVATE_KEY'] : '';

if (empty($SECRET_KEY)) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor: Llave secreta no configurada.']);
    exit;
}

// 2. Obtener el Payload JSON enviado por el JS (checkout.php)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Petición inválida, no se recibió JSON válido.']);
    exit;
}

// 3. Extraer Datos del Cliente y Token
$token = $data['token'] ?? '';
$email = $data['email'] ?? '';
$nombres = $data['nombres'] ?? '';
$apellidos = $data['apellidos'] ?? '';
$amount = isset($data['amount']) ? (int)$data['amount'] : 0;
$currency_code = 'PEN';

// Validación básica
if (empty($token) || empty($email) || empty($amount)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios para procesar el pago (token, email o monto).']);
    exit;
}

// 4. Construir Payload para la API de Cargos de Culqi
$payload = [
    "amount" => $amount,
    "currency_code" => $currency_code,
    "email" => $email,
    "source_id" => $token, // El token (tok_test_...) que nos dio el checkout JS
    "description" => 'Compra de curso - ' . trim("$nombres $apellidos"),
    "antifraud_details" => [
        "first_name" => $nombres,
        "last_name" => $apellidos,
        "email" => $email,
        "phone" => "999999999" // opcional pero recomendable
    ]
];

// 5. Iniciar petición cURL para crear el cargo
$ch = curl_init('https://api.culqi.com/v2/charges');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $SECRET_KEY
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 6. Manejar la respuesta del banco/Culqi
$json_response = json_decode($response, true);

// 201 significa "Creado exitosamente" para la API de V2 charges
if ($http_code === 201) {
    echo json_encode([
        'success'   => true,
        'charge_id' => $json_response['id'], // El id real del cargo ej. chr_test_xxyz
        'details'   => 'El cargo se procesó exitosamente a la tarjeta.',
        'order_id'  => $json_response['id'] // Para mantener compatibilidad con tu JS actual que alerta data.order_id
    ]);
} else {
    // Si la tarjeta fue declinada, no tiene fondos, etc..
    $error_message = 'El pago no pudo ser procesado o la tarjeta fue declinada.';
    
    // Captura el mensaje exacto de Culqi para dárselo al usuario
    if (isset($json_response['user_message'])) {
        $error_message = $json_response['user_message'];
    } elseif (isset($json_response['merchant_message'])) {
        $error_message = $json_response['merchant_message'];
    }
    
    echo json_encode([
        'success' => false,
        'message' => $error_message,
        'debug'   => $json_response
    ]);
}
?>
