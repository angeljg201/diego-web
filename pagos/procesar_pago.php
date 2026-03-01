<?php
// procesar_pago.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

// 1. Cargar Variables de Entorno (Llave Privada)
$env_file = __DIR__ . '/../.env';
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

    // =========================================================================
    // INICIO ENVÍO DE CORREO AUTOMATIZADO CON PHPMAILER
    // =========================================================================
    try {
        $correo_cliente = $email;  
        $nombre_cliente = trim("$nombres $apellidos");
        
        // Culqi procesa montos en céntimos
        $monto_pagado = number_format($amount / 100, 2); 
        $moneda = 'PEN';

        $mail = new PHPMailer(true);

        // --- Configuración del Servidor SMTP (Hostinger) ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'soporte@diegoayasca.com';
        $mail->Password   = 'cZH4dQpR#arg3Z@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Seguridad SSL
        $mail->Port       = 465;                         // Puerto SSL
        $mail->CharSet    = 'UTF-8';

        // --- Remitente y Destinatario ---
        $mail->setFrom('soporte@diegoayasca.com', 'Academia Diego Ayasca');
        $mail->addAddress($correo_cliente, $nombre_cliente);

        // --- Contenido del Correo ---
        $mail->isHTML(true);
        $mail->Subject = '¡Bienvenido! Detalles de tu compra y accesos al curso.';

        // Plantilla HTML Profesional y Limpia
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; color: #333333; border: 1px solid #e0e0e0; border-radius: 8px;">
            <div style="text-align: center; margin-bottom: 20px;">
                <h2 style="color: #0056b3; margin: 0;">¡Gracias por tu compra, ' . htmlspecialchars($nombre_cliente) . '!</h2>
            </div>
            
            <p style="font-size: 16px; line-height: 1.5;">Tu pago se ha procesado correctamente. Nos emociona que des este gran paso en tu aprendizaje. A continuación, te compartimos los detalles de tu compra y las instrucciones para acceder a tu contenido.</p>
            
            <div style="background-color: #f7f9fc; padding: 15px; border-left: 4px solid #0056b3; border-radius: 4px; margin: 25px 0;">
                <p style="margin: 0; font-size: 16px;"><strong>Monto total pagado:</strong> ' . $moneda . ' ' . $monto_pagado . '</p>
            </div>

            <h3 style="color: #333333; border-bottom: 1px solid #e0e0e0; padding-bottom: 10px;">Instrucciones de acceso a la plataforma</h3>
            
            <p style="font-size: 16px;">Para ingresar y comenzar de inmediato, sigue estos pasos y utiliza las credenciales a continuación:</p>
            
            <ul style="list-style-type: none; padding: 0; font-size: 16px; line-height: 1.8;">
                <li>🌐 <strong>Enlace de la plataforma:</strong> <a href="https://aula.diegoayasca.com/login/index.php" style="color: #0056b3; text-decoration: none; font-weight: bold;">Acceder al Aula Virtual</a></li>
                <li>👤 <strong>Usuario:</strong> alumno</li>
                <li>🔑 <strong>Contraseña:</strong> Prueba.2026</li>
            </ul>

            <div style="margin-top: 30px; text-align: center;">
                <a href="https://aula.diegoayasca.com/login/index.php" style="background-color: #0056b3; color: #ffffff; padding: 12px 24px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block;">Ir a mi curso ahora</a>
            </div>

            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;" />
            
            <p style="font-size: 12px; color: #777777; text-align: center;">
                Si tienes alguna pregunta o inconveniente, simplemente responde a este correo (soporte@diegoayasca.com) y estaremos encantados de ayudarte.
            </p>
        </div>
        ';

        // Enviar correo
        $mail->send();

    } catch (Exception $e) {
        // Silenciamos el error para no afectar el flujo del pago
        error_log("Error al enviar el correo a $correo_cliente: " . $e->getMessage());
    }
    // =========================================================================
    // FIN ENVÍO DE CORREO AUTOMATIZADO CON PHPMAILER
    // =========================================================================

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
