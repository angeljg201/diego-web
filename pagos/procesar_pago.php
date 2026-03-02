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
    // INTEGRACIÓN MOODLE: MATRICULACIÓN AUTOMÁTICA
    // =========================================================================
    $moodle_token = '43dff590807f9569f95c95d6b6126b73';
    $moodle_url = 'https://aula.diegoayasca.com/webservice/rest/server.php';
    
    // Configuración para el archivo de log (asegurar permisos de escritura en la carpeta)
    $log_file = __DIR__ . '/moodle_debug.log';
    
    // Función para escribir en el log
    if (!function_exists('writeMoodleLog')) {
        function writeMoodleLog($message, $data = null) {
            global $log_file;
            $timestamp = date("Y-m-d H:i:s");
            $log_entry = "[$timestamp] $message";
            if ($data !== null) {
                $log_entry .= "\nDatos: " . print_r($data, true);
            }
            $log_entry .= "\n----------------------------------------\n";
            file_put_contents($log_file, $log_entry, FILE_APPEND);
        }
    }
    
    // Paso 1: Transformación y validación de datos
    $correo_original = $email;
    $Username_Moodle = strtolower($correo_original);
    
    // Moodle requiere nombres y apellidos, si vienen vacíos de Culqi, usamos un fallback
    $moodle_firstname = trim($nombres) !== '' ? trim($nombres) : 'Alumno';
    $moodle_lastname = trim($apellidos) !== '' ? trim($apellidos) : 'Nuevo';
    
    writeMoodleLog("Iniciando proceso Moodle para: $correo_original");

    $user_exists = false;
    $moodle_user_id = null;
    $generated_password = '';
    
    // Paso 2: Verificación de usuario (core_user_get_users_by_field)
    // Armado manual del payload para evitar problemas con http_build_query
    $get_user_params = "wstoken=" . $moodle_token;
    $get_user_params .= "&wsfunction=core_user_get_users_by_field";
    $get_user_params .= "&moodlewsrestformat=json";
    $get_user_params .= "&field=username";
    $get_user_params .= "&values[0]=" . urlencode($Username_Moodle);
    
    writeMoodleLog("Petición GET USER", $get_user_params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $moodle_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $get_user_params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_get_user = curl_exec($ch);
    
    if(curl_errno($ch)){
        writeMoodleLog("cURL Error (GET USER): " . curl_error($ch));
    }
    curl_close($ch);
    
    writeMoodleLog("Respuesta cruda GET USER:", $response_get_user);
    $check_user = json_decode($response_get_user, true);
    
    // Verificar si la respuesta fue un error de Moodle (Moodle Exception)
    if (is_array($check_user) && isset($check_user['exception'])) {
         writeMoodleLog("ERROR CRÍTICO: Excepción en core_user_get_users_by_field", $check_user);
    } 
    // Si encuentra al usuario, extrae el ID
    elseif (!empty($check_user) && is_array($check_user) && isset($check_user[0]['id'])) {
        $user_exists = true;
        $moodle_user_id = $check_user[0]['id'];
        writeMoodleLog("Usuario existente encontrado. ID de Moodle: $moodle_user_id");
    } else {
        writeMoodleLog("Usuario no encontrado en Moodle. Procediendo a crear.");
    }
    
    // Paso 3: Creación de usuario si no existe (core_user_create_users)
    if (!$user_exists) {
        $chars_lower = 'abcdefghijklmnopqrstuvwxyz';
        $chars_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chars_num = '0123456789';
        $chars_spec = '!@#$%^&*()-_';
        
        $generated_password = 
            $chars_lower[random_int(0, strlen($chars_lower) - 1)] .
            $chars_upper[random_int(0, strlen($chars_upper) - 1)] .
            $chars_num[random_int(0, strlen($chars_num) - 1)] .
            $chars_spec[random_int(0, strlen($chars_spec) - 1)];
            
        $all_chars = $chars_lower . $chars_upper . $chars_num . $chars_spec;
        for ($i = 0; $i < 6; $i++) {
            $generated_password .= $all_chars[random_int(0, strlen($all_chars) - 1)];
        }
        $generated_password = str_shuffle($generated_password);
        
        // Armado MANÍACA Y ESTRICTAMENTE MANUAL del payload para creación de usuario
        // Moodle es hiper-estricto con users[0][username], etc.
        $create_user_params = "wstoken=" . $moodle_token;
        $create_user_params .= "&wsfunction=core_user_create_users";
        $create_user_params .= "&moodlewsrestformat=json";
        
        $create_user_params .= "&users[0][username]=" . urlencode($Username_Moodle);
        $create_user_params .= "&users[0][email]=" . urlencode($correo_original);
        $create_user_params .= "&users[0][firstname]=" . urlencode($moodle_firstname);
        $create_user_params .= "&users[0][lastname]=" . urlencode($moodle_lastname);
        $create_user_params .= "&users[0][password]=" . urlencode($generated_password);
        
        writeMoodleLog("Petición CREATE USER", $create_user_params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $moodle_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $create_user_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_create_user = curl_exec($ch);
        
        if(curl_errno($ch)){
            writeMoodleLog("cURL Error (CREATE USER): " . curl_error($ch));
        }
        curl_close($ch);
        
        writeMoodleLog("Respuesta cruda CREATE USER:", $response_create_user);
        $create_user = json_decode($response_create_user, true);
        
        // Validación ESTRICTA de la respuesta de creación
        if (is_array($create_user) && isset($create_user['exception'])) {
             writeMoodleLog("FATAL ERROR: Moodle ha rechazado la creación del usuario.", $create_user);
             $moodle_user_id = null; // Anulamos el user_id para no matricular fantasmas
             // Aquí podrías decidir si cancelar el pago en Culqi o alertar al admin
        } elseif (!empty($create_user) && is_array($create_user) && isset($create_user[0]['id'])) {
            $moodle_user_id = $create_user[0]['id'];
            writeMoodleLog("Usuario Creado Exitosamente. ID: $moodle_user_id");
        } else {
             writeMoodleLog("Respuesta inesperada en la creación. Revisar payload.", $create_user);
             $moodle_user_id = null;
        }
    }
    
    // Paso 4: Matriculación (enrol_manual_enrol_users)
    // SÓLO SI TENEMOS UN USER ID VÁLIDO (evitamos enrolar fantasmas)
    if ($moodle_user_id) {
        $enrol_params = "wstoken=" . $moodle_token;
        $enrol_params .= "&wsfunction=enrol_manual_enrol_users";
        $enrol_params .= "&moodlewsrestformat=json";
        
        $enrol_params .= "&enrolments[0][roleid]=5";
        $enrol_params .= "&enrolments[0][userid]=" . $moodle_user_id;
        $enrol_params .= "&enrolments[0][courseid]=2";
        
        writeMoodleLog("Petición ENROL USER", $enrol_params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $moodle_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $enrol_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_enrol = curl_exec($ch);
        
        if(curl_errno($ch)){
            writeMoodleLog("cURL Error (ENROL USER): " . curl_error($ch));
        }
        curl_close($ch);
        
        writeMoodleLog("Respuesta cruda ENROL USER:", $response_enrol);
        
        $enrol_result = json_decode($response_enrol, true);
        if (is_array($enrol_result) && isset($enrol_result['exception'])) {
             writeMoodleLog("ERROR al Matricular:", $enrol_result);
        } else {
             writeMoodleLog("Matriculación ejecutada. (Null o Empty usualmente significa éxito en Moodle enrol API).");
        }
    } else {
        writeMoodleLog("Se omitió la matriculación porque no se obtuvo un ID válido de Moodle.");
    }

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

        // Plantilla HTML (Diferenciada según si el usuario es nuevo o ya existía)
        $moodle_login_url = 'https://aula.diegoayasca.com/login/index.php';
        
        $cuerpo_credenciales = '';
        if ($user_exists) {
            $cuerpo_credenciales = '
            <div style="background-color: #e6fced; padding: 15px; border-left: 4px solid #28a745; border-radius: 4px; margin: 25px 0;">
                <p style="margin: 0; font-size: 16px; color: #155724;">
                    <strong>¡Tu nueva compra ha sido agregada a tu cuenta existente!</strong><br><br>
                    Te invitamos a iniciar sesión con tus credenciales habituales para acceder al nuevo contenido.
                </p>
            </div>';
        } else {
            // Solo si Moodle realmente nos dejó crear al usuario y no arrojó excepción, enviamos la clave
            if ($moodle_user_id) {
                $cuerpo_credenciales = '
                <p style="font-size: 16px;">Para ingresar y comenzar de inmediato, sigue estos pasos y utiliza las credenciales a continuación:</p>
                
                <ul style="list-style-type: none; padding: 0; font-size: 16px; line-height: 1.8;">
                    <li>🌐 <strong>Enlace de la plataforma:</strong> <a href="'.$moodle_login_url.'" style="color: #0056b3; text-decoration: none; font-weight: bold;">Acceder al Aula Virtual</a></li>
                    <li>👤 <strong>Usuario:</strong> ' . htmlspecialchars($Username_Moodle) . '</li>
                    <li>🔑 <strong>Contraseña:</strong> ' . htmlspecialchars($generated_password) . '</li>
                </ul>';
            } else {
                // Si hubo un error creando el usuario, les advertimos amablemente
                $cuerpo_credenciales = '
                <div style="background-color: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; border-radius: 4px; margin: 25px 0;">
                    <p style="margin: 0; font-size: 16px; color: #856404;">
                        <strong>Importante:</strong> Tu pago se procesó exitosamente, pero estamos configurando tu acceso temporalmente de forma manual. En breve recibirás un segundo correo con tus credenciales definitivas.
                    </p>
                </div>';
            }
        }

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
            
            ' . $cuerpo_credenciales . '

            <div style="margin-top: 30px; text-align: center;">
                <a href="'.$moodle_login_url.'" style="background-color: #0056b3; color: #ffffff; padding: 12px 24px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block;">Ir a mi curso ahora</a>
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
