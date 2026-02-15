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
<?php ob_start(); ?>

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

        /* Payment Methods Redesign */
        .payment-methods {
            margin-top: 2.5rem;
        }

        .payment-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
        }

        .payment-card.active {
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
        }

        .payment-option-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem;
            background: #f8fafc;
            cursor: pointer;
            width: 100%;
            margin: 0;
            font-weight: 600;
            color: #0f172a;
        }

        .payment-card.active .payment-option-header {
             background: #eff6ff;
        }

        .payment-radio {
            margin-right: 1rem;
            accent-color: #0f172a;
            width: 1.2rem;
            height: 1.2rem;
        }

        .payment-title {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .payment-logo-small {
            height: 24px;
            object-fit: contain;
        }

        /* Payment Details */
        .payment-details {
            display: none;
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            background: #fff;
            animation: slideDown 0.3s ease-out;
        }

        .payment-card.active .payment-details {
            display: block;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Culqi Info */
        .culqi-info {
            color: #64748b;
            font-size: 0.95rem;
        }

        .culqi-header {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .logo-culqi {
            height: 28px;
        }

        .payment-icons-row {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .payment-icons-row img {
            height: 24px;
            object-fit: contain;
        }

        .culqi-text {
            line-height: 1.6;
        }
        
        .culqi-text strong {
            color: #334155;
        }

        /* PayPal Info */
        .paypal-info {
            text-align: center;
        }

        .btn-paypal-custom {
            background-color: #0070ba;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            border: none;
            width: 100%;
            max-width: 400px;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .btn-paypal-custom:hover {
            background-color: #005ea6;
        }

        .paypal-help-text {
            font-size: 0.9rem;
            color: #64748b;
        }

        .paypal-help-text a {
            color: #0070ba;
            text-decoration: underline;
        }

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
<?php
$extra_head = ob_get_clean();
include 'includes/head_global.php';
?>
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
                    <h3 class="form-label" style="font-size: 1.2rem; margin-bottom: 1.5rem;">Método de pago</h3>
                    
                    <!-- Option 1: Culqi (Credit/Debit Card) -->
                    <div class="payment-card active" id="card-culqi">
                        <label class="payment-option-header" for="radio-culqi">
                            <div style="display: flex; align-items: center;">
                                <input type="radio" name="payment_method" value="culqi" id="radio-culqi" class="payment-radio" checked>
                                <span class="payment-title">Pagar con Culqi</span>
                            </div>
                            <img src="img/pagos/logo-culqi.webp" alt="Culqi" class="payment-logo-small">
                        </label>
                        
                        <div class="payment-details">
                            <div class="culqi-info">
                                <div class="culqi-header">
                                    <img src="img/pagos/logo-culqi.webp" alt="Culqi" class="logo-culqi">
                                    <div class="payment-icons-row">
                                        <img src="img/pagos/checkout-visa.webp" alt="Visa">
                                        <img src="img/pagos/checkout-master-card.webp" alt="Mastercard">
                                        <img src="img/pagos/checkout-american-express.webp" alt="Amex">
                                        <img src="img/pagos/checkout-yape.webp" alt="Yape">
                                        <img src="img/pagos/checkout-pago-efectivo.webp" alt="PagoEfectivo">
                                    </div>
                                </div>
                                <p class="culqi-text">
                                    Acepta pagos con <strong>tarjetas de débito y crédito, Yape, Cuotéalo BCP y PagoEfectivo</strong> (billeteras móviles, agentes y bodegas).
                                </p>
                                <button type="button" class="submit-btn" id="btn-pay" style="margin-top: 1.5rem;">Realizar el pedido</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Option 2: PayPal -->
                    <div class="payment-card" id="card-paypal">
                        <label class="payment-option-header" for="radio-paypal">
                            <div style="display: flex; align-items: center;">
                                <input type="radio" name="payment_method" value="paypal" id="radio-paypal" class="payment-radio">
                                <span class="payment-title">Pagar con PayPal</span>
                            </div>
                            <img src="img/pagos/logo-paypal.webp" alt="PayPal" class="payment-logo-small">
                        </label>
                        
                        <div class="payment-details">
                            <div class="paypal-info">
                                 <div id="paypal-button-container"></div>
                                 <p class="paypal-help-text">
                                    ¿Tienes alguna duda? Visita nuestra <a href="#">página de Ayuda</a> o <a href="#">contáctanos</a>.
                                 </p>
                            </div>
                        </div>
                    </div>
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
            
            <div style="margin-top: 2rem; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px; text-align: center;">
                <p style="font-size: 0.95rem; margin-bottom: 0.5rem;"><i class="fas fa-graduation-cap" style="color: var(--gold); margin-right: 0.5rem;"></i> Acceso inmediato al <strong>Aula Virtual</strong></p>
                <p style="font-size: 0.8rem; opacity: 0.8;">Material descargable y certificado incluido.</p>
            </div>

            <p style="margin-top: 1rem; font-size: 0.8rem; opacity: 0.8; text-align: center;">
                <i class="fas fa-lock"></i> Pago 100% Seguro y Encriptado
            </p>
        </div>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Include Culqi v4 -->
<script src="https://checkout.culqi.com/js/v4"></script>
<!-- Include PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AVf4TOUm4EqG1saRNJmTR6eFB4hfrSTw6J6HSoiM8nDW9LO91D15rnA2Yv5s0X0jRQb-FODSdpRIVbfm&currency=USD"></script>

<script>
    // Configuración de Culqi
    Culqi.publicKey = 'pk_test_bWJ7Jseex6l7hISc';
    
    // Configuración del botón de pago
    const btnPay = document.getElementById('btn-pay');
    const form = document.getElementById('checkout-form');
    const paypalContainer = document.getElementById('paypal-button-container');

    // Function to toggle buttons based on selection
    // Function to toggle buttons based on selection
    function togglePaymentButtons(method) {
        // Logic handled by CSS .payment-card.active .payment-details
        // When PayPal is selected, Culqi card is not active -> details hidden -> btnPay hidden
        // When Culqi is selected, Culqi card is active -> details shown -> btnPay shown
    }

    // Handle Radio Button Styling & Visibility
    const paymentCards = document.querySelectorAll('.payment-card');
    
    paymentCards.forEach(card => {
        const header = card.querySelector('.payment-option-header');
        const radio = card.querySelector('input[type="radio"]');

        header.addEventListener('click', function(e) {
            // Remove active class from all
            paymentCards.forEach(c => c.classList.remove('active'));
            // Add active class to current
            card.classList.add('active');
            
            // Toggle Logic
            togglePaymentButtons(radio.value);
        });
    });

    // Also listen for change events on the radios directly
    const radios = document.querySelectorAll('input[name="payment_method"]');
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if(this.checked) {
                const targetCard = this.closest('.payment-card');
                paymentCards.forEach(c => c.classList.remove('active'));
                if(targetCard) targetCard.classList.add('active');
                
                // Toggle Logic
                togglePaymentButtons(this.value);
            }
        });
    });

    // Initial check
    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    if(checkedRadio) {
        togglePaymentButtons(checkedRadio.value);
    }

    // PayPal Button Rendering
    paypal.Buttons({
        fundingSource: paypal.FUNDING.PAYPAL, // Show only PayPal button
        style: {
            layout: 'vertical',
            color:  'blue',
            shape:  'rect',
            label:  'paypal'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '350.00', // Fixed amount as requested
                        currency_code: 'USD'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                alert('Pago Exitoso con PayPal! ID: ' + details.id + '\nEstado: ' + details.status);
                // Here you would redirect to a success page
                // window.location.href = "gracias.php?order_id=" + details.id;
            });
        }
    }).render('#paypal-button-container');


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
                amount: <?php echo $amount_culqi; ?> 
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
        } 
        // Note: PayPal button handles its own click, so this block activates only for Culqi
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
