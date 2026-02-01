<?php
// Diego Ayasca - Libro de Reclamaciones
// Base Path Definition
$base_path = '../';
$nav_prefix = '../';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Reclamaciones | Diego Ayasca</title>
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
        .claims-section {
            padding: 140px 0 80px;
            background-color: var(--bg-body);
        }
        .claims-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--border-light);
        }
        .claims-header-img {
            text-align: center;
            margin-bottom: 2rem;
        }
        .claims-header-img img {
            max-width: 300px;
            height: auto;
            margin: 0 auto;
        }
        .claims-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary);
        }
        .claims-intro {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-muted);
        }
        
        /* Form Styling to mimics standard Claim Sheet */
        .claim-form {
            border: 1px solid #ccc;
            padding: 2rem;
            border-radius: 4px;
        }
        .form-section-title {
            background-color: #f3f4f6;
            padding: 0.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--secondary);
            font-size: 1.1rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
            font-size: 0.95rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-family: 'Outfit', sans-serif;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }
        .radio-group {
            display: flex;
            gap: 2rem;
            margin-top: 0.5rem;
        }
        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        .claim-footer-info {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #6b7280;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 6px;
        }
        .submit-btn {
            background: var(--secondary);
            color: #111;
            border: none;
            padding: 1rem 2rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        .submit-btn:hover {
            background: #b5952f; /* Darker Gold */
            transform: translateY(-2px);
        }

        /* Force Dark Header for this page */
        .main-header {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 0.8rem 0;
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
            color: var(--secondary);
        }
        .mobile-toggle {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <section class="claims-section">
            <div class="container">
                <div class="claims-container">
                    <div class="claims-header-img">
                        <img src="../img/libro-de-reclamaciones.webp" alt="Libro de Reclamaciones">
                    </div>
                    
                    <h1 class="claims-title">Libro de Reclamaciones Virtual</h1>
                    <p class="claims-intro">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, esta institución cuenta con un Libro de Reclamaciones Virtual a su disposición.</p>

                    <div class="claim-form">
                        <form action="#" method="POST"> <!-- Logic to be implemented or static -->
                            
                            <!-- 1. IDENTIFICACIÓN DEL CONSUMIDOR -->
                            <div class="form-section-title">1. Identificación del Consumidor Reclamante</div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="text" id="fecha" class="form-control" value="<?php echo date('d/m/Y'); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="dni">Nro. Documento (DNI/CE)</label>
                                    <input type="text" id="dni" name="dni" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono / Celular</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="domicilio">Domicilio</label>
                                <input type="text" id="domicilio" name="domicilio" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="apoderado">Padre o Madre (Para menores de edad)</label>
                                <input type="text" id="apoderado" name="apoderado" class="form-control">
                            </div>

                            <!-- 2. IDENTIFICACIÓN DEL BIEN -->
                            <div class="form-section-title">2. Identificación del Bien Contratado</div>
                            
                            <div class="form-group">
                                <label>Tipo de Bien:</label>
                                <div class="radio-group">
                                    <label class="radio-item">
                                        <input type="radio" name="tipo_bien" value="producto" checked> Producto
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="tipo_bien" value="servicio"> Servicio
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion_bien">Descripción del Producto o Servicio</label>
                                <textarea id="descripcion_bien" name="descripcion_bien" class="form-control" rows="2" placeholder="Ej: Curso de Gestión de Proyectos..." required></textarea>
                            </div>

                            <!-- 3. DETALLE DE LA RECLAMACIÓN -->
                            <div class="form-section-title">3. Detalle de la Reclamación y Pedido</div>

                            <div class="form-group">
                                <label>Tipo de Reclamación:</label>
                                <div class="radio-group">
                                    <label class="radio-item">
                                        <input type="radio" name="tipo_reclamo" value="reclamo" checked> Reclamo
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="tipo_reclamo" value="queja"> Queja
                                    </label>
                                </div>
                            </div>

                            <div class="claim-footer-info" style="margin: 0 0 1.5rem 0; font-size: 0.85rem;">
                                <strong>Reclamo:</strong> Disconformidad relacionada a los productos o servicios.<br>
                                <strong>Queja:</strong> Disconformidad no relacionada a los productos o servicios; o, malestar o descontento respecto a la atención al público.
                            </div>

                            <div class="form-group">
                                <label for="detalle_reclamo">Detalle de la Reclamación</label>
                                <textarea id="detalle_reclamo" name="detalle_reclamo" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="pedido">Pedido del Consumidor</label>
                                <textarea id="pedido" name="pedido" class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label class="radio-item" style="align-items: flex-start; gap: 10px;">
                                    <input type="checkbox" required>
                                    <span style="font-size: 0.9rem;">Declaro haber leído y acepto la <a href="politica-privacidad.php" style="color: var(--secondary);">Política de Privacidad</a> y los <a href="terminos-condiciones.php" style="color: var(--secondary);">Términos y Condiciones</a>.</span>
                                </label>
                            </div>

                            <button type="submit" class="submit-btn">Enviar Hoja de Reclamación</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../js/script.js"></script>
</body>
</html>
