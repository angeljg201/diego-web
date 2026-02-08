<?php
// checkout.php
$page_title = "Finalizar Compra | Diego Ayasca";
$base_path = './'; 
require_once __DIR__ . '/data/cursos_detalle.php'; // Include data to potentially use it

// Check if course is passed
$course_slug = isset($_GET['course']) ? $_GET['course'] : 'gestion-proyectos-ms-project';
$selected_course = isset($cursos_detalle[$course_slug]) ? $cursos_detalle[$course_slug] : $cursos_detalle['gestion-proyectos-ms-project'];

// Dynamic Data Extraction
$course_title = $selected_course['titulo'];
$course_price_display = $selected_course['precio']; // "S/ 350.00"

// Parse price for Culqi (remove 'S/ ', remove commas, multiply by 100)
$price_numeric = floatval(str_replace(',', '', str_replace('S/ ', '', $course_price_display)));
$amount_culqi = intval($price_numeric * 100);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra | Diego Ayasca</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Checkout Page Specific Styles */
        body {
            background-color: #F8FAFC;
        }

        /* Override Header Styles for Checkout Page */
        .main-header {
            background-color: #ffffff !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0 !important;
            position: relative !important; /* Make it static/relative flow or keep fixed if desired, but user asked for "header solo de la pagina de pago" */
            /* Keeping fixed usually better for UX, but let's stick to the look requested: clean white header */
            position: fixed !important; 
        }

        .main-nav a {
            color: #1e293b !important; /* Dark text */
            font-weight: 600;
        }

        .main-nav a:hover,
        .main-nav a.active {
            color: var(--secondary) !important; /* Gold hover */
        }

        /* Force Logo Colors */
        .logo {
            color: #111827 !important; /* Dark text logo */
        }
        
        .logo-default {
            display: none !important;
        }
        
        .logo-scrolled {
            display: block !important;
            opacity: 1 !important;
        }

        /* Mobile Toggle Color */
        .mobile-toggle {
            color: #1e293b !important;
        }


        .checkout-section {
            padding: 120px 0 80px; /* Adjust top padding for fixed header */
            min-height: 80vh;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 3rem;
            align-items: start;
        }

        /* Left Column: Form & Payment */
        .checkout-form-col {
            background: #fff;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .section-title-checkout {
            font-size: 1.8rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            color: #1e293b;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: var(--font-main);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 41, 59, 0.1);
        }

        /* Payment Methods */
        .payment-methods {
            margin-top: 2.5rem;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option:hover {
            border-color: var(--primary);
            background-color: #f8fafc;
        }

        .payment-option.selected {
            border-color: var(--primary);
            background-color: #f1f5f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .payment-radio {
            margin-right: 1rem;
            accent-color: var(--primary);
            transform: scale(1.2);
        }

        .payment-label {
            flex-grow: 1;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .payment-icons {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .fa-cc-paypal { color: #003087; }
        .fa-credit-card { color: #1e293b; }

        /* Right Column: Order Summary (Sticky) */
        .checkout-summary-col {
            position: sticky;
            top: 100px; /* Adjust based on header height */
            background: var(--primary);
            color: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(30, 41, 59, 0.15);
        }

        .summary-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 1rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        
        .order-item-title {
            color: rgba(255,255,255,0.9);
            width: 70%;
        }

        .order-item-price {
            font-weight: 600;
            color: var(--gold);
        }

        .order-total {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            display: flex;
            justify-content: space-between;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--gold);
            color: var(--primary);
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 2rem;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.15);
            background: #f59e0b;
        }
        
        /* Responsive */
        @media (max-width: 900px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
            
            .checkout-summary-col {
                position: static;
                order: -1; /* Show summary first on mobile usually, or keep bottom */
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="checkout-section">
    <div class="container checkout-grid">
        
        <!-- Left Column: Form Details -->
        <div class="checkout-form-col">
            <h2 class="section-title-checkout">Detalles de facturación</h2>
            
            <form id="checkout-form">
                <div class="form-group">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" id="nombres" class="form-control" placeholder="Ingresa tus nombres" required>
                </div>
                
                <div class="form-group">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" id="apellidos" class="form-control" placeholder="Ingresa tus apellidos" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email" class="form-control" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="payment-methods">
                    <h3 class="form-label" style="font-size: 1.2rem; margin-bottom: 1rem;">Método de pago</h3>
                    
                    <label class="payment-option selected" id="option-culqi">
                        <input type="radio" name="payment_method" value="culqi" class="payment-radio" checked>
                        <span class="payment-label">
                            Tarjeta de Débito/Crédito
                            <span class="payment-icons"><i class="fas fa-credit-card"></i></span>
                        </span>
                    </label>
                    
                    <label class="payment-option" id="option-paypal">
                        <input type="radio" name="payment_method" value="paypal" class="payment-radio">
                        <span class="payment-label">
                            PayPal
                            <span class="payment-icons"><i class="fab fa-cc-paypal"></i></span>
                        </span>
                    </label>
                </div>
            </form>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="checkout-summary-col">
            <h3 class="summary-title">Tu pedido</h3>
            
            <div class="order-item">
                <span class="order-item-title">Curso: <?php echo $course_title; ?></span>
                <span class="order-item-price"><?php echo $course_price_display; ?></span>
            </div>
            
            <div class="order-item">
                <span class="order-item-title">Subtotal</span>
                <span class="order-item-price"><?php echo $course_price_display; ?></span>
            </div>
            
            <div class="order-total">
                <span>Total</span>
                <span><?php echo $course_price_display; ?></span>
            </div>
            
            <button type="button" class="submit-btn" id="btn-pay">Realizar el pedido</button>
            <p style="margin-top: 1rem; font-size: 0.8rem; opacity: 0.8; text-align: center;">
                <i class="fas fa-lock"></i> Pago 100% Seguro y Encriptado
            </p>
        </div>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Include Culqi v4 -->
<script src="https://checkout.culqi.com/js/v4"></script>

<script>
    // Configuración de Culqi
    Culqi.publicKey = 'pk_test_bWJ7Jseex6l7hISc';
    
    // Configuración del botón de pago
    const btnPay = document.getElementById('btn-pay');
    const form = document.getElementById('checkout-form');
    
    // Handle Radio Button Styling
    const paymentOptions = document.querySelectorAll('.payment-option');
    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Reset styles
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            // Add style to clicked
            this.classList.add('selected');
            // Check the radio input inside
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
        });
    });

    btnPay.addEventListener('click', function(e) {
        e.preventDefault();
        
        // 1. Validar formulario
        const nombres = document.getElementById('nombres').value.trim();
        const apellidos = document.getElementById('apellidos').value.trim();
        const email = document.getElementById('email').value.trim();
        
        if (!nombres || !apellidos || !email) {
            alert('Por favor, completa todos los campos del formulario.');
            return;
        }

        if (!validateEmail(email)) {
            alert('Por favor, ingresa un correo electrónico válido.');
            return;
        }
        
        // 2. Verificar método de pago
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (paymentMethod === 'culqi') {
            // Configurar settings de Culqi antes de abrir
            Culqi.settings({
                title: 'Diego Ayasca - Cursos',
                currency: 'PEN',
                description: 'Curso: <?php echo addslashes($course_title); ?>',
                amount: <?php echo $amount_culqi; ?> // Dynamic Amount
            });

            // Opciones de personalización visual de Culqi
            Culqi.options({
                style: {
                    logo: 'https://diegoayasca.com/img/logo.png',
                    maincolor: '#1e293b',
                    buttontext: '#ffffff',
                    maintext: '#4a4a4a',
                    desctext: '#4a4a4a'
                }
            });

            Culqi.open();
        } else {
            alert('La integración con PayPal estará disponible pronto.');
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // 3. Callback de Culqi
    function culqi() {
        if (Culqi.token) { 
            // ¡Objeto Token creado exitosamente!
            const token = Culqi.token.id;
            
            console.log('Token creado: ', token);
            alert('Token generado exitosamente: ' + token + '\\nPara procesar el cargo necesitas enviar este token a tu backend.');
            
        } else { 
            // ¡Hubo algún problema!
            console.log(Culqi.error);
            alert(Culqi.error.user_message);
        }
    };
</script>

</body>
</html>
