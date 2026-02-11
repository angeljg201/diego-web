<?php
// crear_orden.php
header('Content-Type: application/json');

// ---------------------------------------------------------
// CONFIGURACIÓN: Llave Secreta DE PRUEBA proporcionada
// ---------------------------------------------------------
$SECRET_KEY = "sk_test_3ZDKfRJsfDAsQdDL"; 
// ---------------------------------------------------------

// Obtener los datos enviados por el frontend (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos JSON válidos']);
    exit;
}

// Datos del cliente (Validar que existan)
$nombres = $data['nombres'] ?? 'Cliente';
$apellidos = $data['apellidos'] ?? 'Demos';
$email = $data['email'] ?? 'test@culqi.com';
$telefono = $data['telefono'] ?? '999999999';
$amount = 35000; // Monto fijo del curso (en céntimos)

// Generar un número de pedido único y corto
$order_number = 'ord-' . time();

// Fecha de expiración (24 horas después)
// Culqi requiere Timestamp (entero)
$expiration_date = time() + (24 * 60 * 60);

// Estructura para la API de Culqi (Orders v2)
$payload = [
    "amount" => $amount,
    "currency_code" => "PEN",
    "description" => "Curso Online",
    "order_number" => $order_number,
    "client_details" => [
        "first_name" => $nombres,
        "last_name" => $apellidos,
        "email" => $email,
        "phone_number" => $telefono
    ],
    "expiration_date" => $expiration_date
];

// Iniciar cURL
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

// Manejar respuesta
$json_response = json_decode($response, true);

if ($http_code === 201) {
    // Éxito: Culqi devuelve el objeto Order
    echo json_encode([
        'success' => true,
        'order_id' => $json_response['id'] // ej. "ord_live_xE4..."
    ]);
} else {
    // Error
    $error_message = 'Error desconocido';
    if (isset($json_response['merchant_message'])) {
        $error_message = $json_response['merchant_message'];
    } elseif (isset($json_response['user_message'])) {
        $error_message = $json_response['user_message'];
    } else {
        $error_message = json_encode($json_response);
    }

    echo json_encode([
        'success' => false,
        'message' => $error_message, // Enviar mensaje real
        'debug' => $json_response
    ]);
}
?>
