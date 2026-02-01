<?php
// Diego Ayasca - Política de Privacidad
// Base Path Definition - Adjust as necessary if in subdirectory, but usually root for this file
$base_path = '../';
$nav_prefix = '../';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad | Diego Ayasca</title>
    <link rel="icon" href="../img/logo.png" type="image/png">
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .policy-section {
            padding: 140px 0 80px; /* Clear fixed header */
            background-color: var(--bg-body);
        }
        .policy-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--border-light);
        }
        .policy-header {
            text-align: center;
            margin-bottom: 3rem;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 2rem;
        }
        .policy-header h1 {
            font-size: 2.5rem;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        .policy-header p.subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
        }
        .policy-content h2 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .policy-content p, .policy-content li {
            font-size: 1rem;
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 1rem;
        }
        .policy-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .last-update {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-light);
            font-size: 0.9rem;
            color: var(--text-muted);
            font-style: italic;
        }

        /* Force Dark Header for this page */
        .main-header {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 0.8rem 0; /* Match scrolled padding */
        }
        .main-header .logo {
            color: #111827;
        }
        .logo-default { display: none; }
        .logo-scrolled { display: block; opacity: 1; }
        .main-nav a {
            color: #1F2937;
        }
        .main-nav a:hover {
            color: var(--secondary); /* Gold */
        }
        .mobile-toggle {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <section class="policy-section">
            <div class="container">
                <div class="policy-container">
                    <div class="policy-header">
                        <h1>Políticas de Privacidad</h1>
                        <p class="subtitle">Transparencia y seguridad en el manejo de tu información.</p>
                    </div>

                    <div class="policy-content">
                        <h2>1. Introducción</h2>
                        <p>La presente Política de Privacidad establece los términos en que <strong>Diego Ayasca</strong> usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Estamos comprometidos con la seguridad de los datos de nuestros usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento.</p>
                        <p>Esta política cumple con la legislación peruana vigente, específicamente la Ley N.° 29733, Ley de Protección de Datos Personales, y su Reglamento aprobado por decreto Supremo N.° 003-2013-JUS.</p>

                        <h2>2. Responsable del Tratamiento de Datos Personales</h2>
                        <p><strong>Diego Ayasca</strong> es el responsable del tratamiento de los datos personales que usted nos proporcione. Aseguramos que los datos personales se recopilan para fines determinados, explícitos y lícitos, y no se tratarán ulteriormente de manera incompatible con dichos fines.</p>

                        <h2>3. Información que Recopilamos</h2>
                        <p>Nuestro sitio web podrá recoger información personal necesaria para la prestación de nuestros servicios educativos, por ejemplo:</p>
                        <ul>
                            <li><strong>Datos de contacto:</strong> Nombre completo, correo electrónico, número de teléfono.</li>
                            <li><strong>Datos académicos:</strong> Intereses en cursos específicos.</li>
                            <li><strong>Datos de navegación:</strong> Dirección IP, ubicación geográfica aproximada, tipo de navegador (a través de cookies).</li>
                        </ul>

                        <h2>4. Finalidad del Tratamiento</h2>
                        <p>La información recopilada se utiliza para las siguientes finalidades:</p>
                        <ul>
                            <li><strong>Gestión Académica y Administrativa:</strong> Procesar matrículas, inscripciones y brindar información sobre nuestros servicios educativos.</li>
                            <li><strong>Comunicación:</strong> Enviar correos electrónicos periódicos con ofertas especiales, nuevos cursos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio.</li>
                            <li><strong>Mejora del Servicio:</strong> Analizar tendencias para mejorar nuestro sitio web y ofertas educativas.</li>
                        </ul>

                        <h2>5. Carácter Obligatorio o Facultativo</h2>
                        <p>Para acceder a ciertos servicios o solicitar información detallada, es obligatorio proporcionar los datos personales marcados como tales en nuestros formularios. La negativa a suministrarlos supondrá la imposibilidad de prestar el servicio o información solicitada.</p>

                        <h2>6. Tiempo de Conservación</h2>
                        <p>Los datos personales proporcionados se conservarán mientras se mantenga la relación contractual o académica, o durante los años necesarios para cumplir con las obligaciones legales aplicables a las instituciones educativas.</p>

                        <h2>7. Derechos ARCO</h2>
                        <p>Como titular de sus datos personales, usted tiene derecho a acceder, rectificar, cancelar y oponerse al tratamiento de los mismos (Derechos ARCO), así como a revocar su consentimiento.</p>
                        <p>Para ejercer estos derechos, puede dirigir una solicitud a través de nuestra sección de Contacto o enviando un correo electrónico a nuestra dirección institucional, adjuntando una copia de su documento de identidad.</p>

                        <h2>8. Seguridad de la Información</h2>
                        <p><strong>Diego Ayasca</strong> implementa todas las medidas de índole técnica y organizativa necesarias para garantizar la seguridad de sus datos personales y evitar su alteración, pérdida, tratamiento o acceso no autorizado.</p>

                        <h2>9. Uso de Cookies</h2>
                        <p>Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico. Usted puede eliminar las cookies en cualquier momento desde su ordenador o configurar su navegador para declinar las cookies.</p>

                        <h2>10. Actualizaciones de la Política</h2>
                        <p><strong>Diego Ayasca</strong> se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.</p>

                        <div class="last-update">
                            Última actualización: Diciembre 2025
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../js/script.js"></script>
</body>
</html>
