<?php
// gracias.php
$page_title = "Pago Exitoso | Diego Ayasca";
$base_path = '../';
require_once __DIR__ . '/../data/cursos_detalle.php';

$course_slug = isset($_GET['course']) ? htmlspecialchars($_GET['course']) : '';
$charge_id = isset($_GET['charge_id']) ? htmlspecialchars($_GET['charge_id']) : '';

// Obtener detalles del curso
$selected_course = isset($cursos_detalle[$course_slug]) ? $cursos_detalle[$course_slug] : null;

if (!$selected_course) {
    // Si no hay curso válido, redirigir al inicio
    header("Location: ../index.php");
    exit;
}

$course_title = $selected_course['titulo'];
$course_price = $selected_course['precio']; // ej. S/ 350.00
$nav_prefix = '../index.php'; // Para asegurar navegación a index desde subpáginas

ob_start();
?>
    <style>
        /* Override Header Styles for Gracias Page */
        .main-header {
            background-color: #ffffff !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0 !important;
            position: fixed !important; 
            width: 100%;
            z-index: 100;
        }

        .main-nav a {
            color: #1e293b !important;
            font-weight: 600;
        }

        .main-nav a:hover,
        .main-nav a.active {
            color: var(--secondary) !important;
        }

        .logo {
            color: #111827 !important;
        }
        
        .logo-default { display: none !important; }
        .logo-scrolled { display: block !important; opacity: 1 !important; }

        .mobile-toggle { color: #1e293b !important; }
        
        .success-section {
            padding: 160px 0 100px;
            min-height: 80vh;
            background-color: #F8FAFC;
        }
        .success-card {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .success-icon-wrapper {
            width: 80px;
            height: 80px;
            background-color: #d1fae5;
            color: #059669;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 24px;
        }
        .success-title {
            font-size: 2rem;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .success-text {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 32px;
        }
        .purchase-details {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            text-align: left;
            margin-bottom: 32px;
            border: 1px dashed #cbd5e1;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .detail-row:first-child {
            padding-top: 0;
        }
        .detail-label {
            color: #475569;
            font-weight: 500;
        }
        .detail-value {
            color: #0f172a;
            font-weight: 700;
            font-size: 1.05rem;
            text-align: right;
            max-width: 60%;
        }
        .btn-continue {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        .btn-continue:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            color: white;
        }
    </style>
<?php
$extra_head = ob_get_clean();
include '../includes/head_global.php';
?>
<body>

<?php include '../includes/header.php'; ?>

<main>
    <section class="success-section">
        <div class="container">
            <div class="success-card">
                <div class="success-icon-wrapper">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="success-title">¡Compra Exitosa!</h1>
                <p class="success-text">Hemos procesado tu pago correctamente. Aquí están los detalles de tu transacción.</p>
                
                <div class="purchase-details">
                    <div class="detail-row">
                        <span class="detail-label">ID Transacción</span>
                        <span class="detail-value"><?php echo $charge_id; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Curso</span>
                        <span class="detail-value"><?php echo $course_title; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Monto Pagado</span>
                        <span class="detail-value"><?php echo htmlspecialchars($course_price); ?></span>
                    </div>
                </div>

                <a href="../index.php" class="btn-continue">Ir al Inicio</a>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>

</body>
</html>
