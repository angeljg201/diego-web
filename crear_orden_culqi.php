<?php
// crear_orden_culqi.php
header('Content-Type: application/json');

// 1. Cargar Variables de Entorno
$env_file = __DIR__ . '/.env';
$env_vars = file_exists($env_file) ? parse_ini_file($env_file) : [];
$SECRET_KEY = isset($env_vars['CULQI_PRIVATE_KEY']) ? $env_vars['CULQI_PRIVATE_KEY'] : '';

if (empty($SECRET_KEY)) {
    echo json_encode(['success' => false, 'message' => 'Llave secreta no configurada.']);
    exit;
}

// 2. Recibir Payload JSON del Frontend
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos JSON válidos.']);
    exit;
}

// Validar Datos Esenciales
$nombres = $data['first_name'] ?? '';
$apellidos = $data['last_name'] ?? '';
$email = $data['email'] ?? '';
$amount = isset($data['amount']) ? (int)$data['amount'] : 0;
$currency_code = $data['currency_code'] ?? 'PEN';

if (empty($nombres) || empty($apellidos) || empty($email) || $amount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios para crear la orden.']);
    exit;
}

// 3. Preparar el Payload para el API de Culqi (v2/orders)
// Fecha de expiración: 24 horas a partir de ahora (requerido para PagoEfectivo/Cuotéalo)
$expiration_date = time() + (24 * 60 * 60);

// Número de orden único para el comercio
$order_number = 'order-' . time() . rand(100, 999);

$payload = [
    "amount" => $amount,
    "currency_code" => $currency_code,
    "description" => 'Venta de curso online',
    "order_number" => $order_number,
    "client_details" => [
        "first_name" => $nombres,
        "last_name" => $apellidos,
        "email" => $email,
        "phone_number" => '999999999' // Valor genérico si no se tiene
    ],
    "expiration_date" => $expiration_date
];

// 4. Hacer la petición a Culqi vía cURL
$ch = curl_init('https://api.culqi.com/v2/orders');
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

// 5. Manejar la Respuesta
$json_response = json_decode($response, true);

if ($http_code === 201) {
    // La orden se creó exitosamente, devolvemos el Order ID
    echo json_encode([
        'success'  => true,
        'order_id' => $json_response['id'],
        'order'    => $json_response
    ]);
} else {
    // Error al crear orden
    $error_message = 'Error desconocido al crear la orden en Culqi.';
    if (isset($json_response['user_message'])) {
        $error_message = $json_response['user_message'];
    } elseif (isset($json_response['merchant_message'])) {
        $error_message = $json_response['merchant_message'];
    }
    
    echo json_encode([
        'success' => false,
        'message' => $error_message,
        'details' => $json_response
    ]);
}
?>
