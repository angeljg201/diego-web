<?php
// Diego Ayasca - Landing Page "Antigravity Style"
require_once __DIR__ . '/data/cursos.php';

// Base Path Definition
$base_path = '';
$nav_prefix = '';

// Countdown Logic
$json_file = __DIR__ . '/gestion_lanzamiento/data.json';
$fecha_lanzamiento = '';


// Default Values
$title_lanzamiento = 'LANZAMIENTO OFICIAL';
$subtitle_lanzamiento = 'Curso de Preparación para el Examen PMP®';
$bg_lanzamiento = 'img/cursos/curso_pmp.jpeg';

if (file_exists($json_file)) {
    $json_data = file_get_contents($json_file);
    $lanzamiento = json_decode($json_data, true);
    
    if (isset($lanzamiento['fecha_lanzamiento'])) {
        $fecha_lanzamiento = $lanzamiento['fecha_lanzamiento'];
    }
    if (isset($lanzamiento['title'])) {
        $subtitle_lanzamiento = $lanzamiento['title'];
    }
    if (isset($lanzamiento['background_url'])) {
        $bg_lanzamiento = $lanzamiento['background_url'];
    }
}

// Determine background URL
$bg_url_final = (file_exists($bg_lanzamiento) || file_exists(__DIR__ . '/' . $bg_lanzamiento)) ? $bg_lanzamiento : 'img/cursos/curso_pmp.jpeg';

// Countdown Styles (Concert Theme)
$extra_head = '
<style>
/* Countdown Hero */
.countdown-hero {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    background-color: #1a1a1a;
    background-image: url("' . $bg_url_final . '");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    overflow: hidden;
}

.countdown-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.countdown-content {
    position: relative;
    z-index: 2;
    padding: 20px;
    width: 100%;
    max-width: 1200px;
}

.countdown-title {
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 1rem;
    font-weight: 500;
    opacity: 0.9;
}

.countdown-subtitle {
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 700;
    margin-bottom: 3rem;
    line-height: 1.2;
    color: #fff;
}

.countdown-timer {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    font-family: "Outfit", sans-serif;
}

.timer-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 100px;
}

.timer-item .number {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 700;
    line-height: 1;
    color: #fff;
}

.timer-item .label {
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
}

.countdown-cta {
    display: none;
    margin-top: 2rem;
}

.btn-cta-launch {
    background-color: #d4af37; /* Gold */
    color: #000;
    padding: 1rem 2.5rem;
    font-size: 1.2rem;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.btn-cta-launch:hover {
    background-color: #fff;
    color: #d4af37;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
}

@media (max-width: 768px) {
    .countdown-timer {
        gap: 1rem;
    }
    .timer-item {
        min-width: 70px;
    }
    .timer-item .number {
        font-size: 2.5rem;
    }
}
</style>
';
?>

<?php include 'includes/head_global.php'; ?>
<body>



    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section (Background Image) -->
        <section id="inicio" class="hero-section">

            <div class="hero-overlay-mobile"></div>
            <div class="container hero-container">
                <div class="hero-content slide-in-bottom">
                    <h1>Lleva la Gestión de Proyectos al <span class="highlight">Siguiente Nivel</span></h1>
                    <p>Domina metodologías ágiles y predictivas, y conviértete en un agente de cambio en la dirección de proyectos. Aprende a aplicar lo que estudias y genera impacto real en tu organización.</p>
                    <div class="hero-btn-group">
                        <a href="#cursos" class="btn btn-gold btn-lg pill-btn">Ver Cursos &nbsp; <i class="fas fa-arrow-right"></i></a>
                        <a href="#sobre-mi" class="btn btn-outline-light btn-lg pill-btn"><i class="fas fa-play"></i> &nbsp; Conoce al Instructor</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cursos Section -->
        <section id="cursos" class="cursos-section">
            <div class="container">
                <div class="section-header hidden-fade">
                    <h2 class="section-title">Nuestros <span class="highlight">Cursos</span></h2>
                    <p>Domina las habilidades más demandadas en el mercado laboral.</p>
                </div>

                <div class="carousel-wrapper hidden-fade">
                    <button class="carousel-btn prev-btn" aria-label="Anterior"><i class="fas fa-chevron-left"></i></button>
                    
                    <div class="carousel-container">
                        <div class="carousel-track">
                            <?php foreach ($cursos as $curso): ?>
                                <article class="curso-card glass-card">
                                    <div class="card-header">
                                        <div class="card-badge"><?php echo $curso['etiqueta']; ?></div>
                                        <div class="card-image">
                                            <img src="<?php echo $curso['imagen']; ?>" alt="<?php echo $curso['titulo']; ?>">
                                            <div class="card-overlay"></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $curso['titulo']; ?></h3>
                                        <div class="card-meta">
                                            <span><i class="fas fa-book-open"></i> <?php echo $curso['lecciones']; ?></span>
                                            <span><i class="far fa-clock"></i> <?php echo $curso['horas']; ?></span>
                                            <span><i class="fas fa-user-graduate"></i> <?php echo $curso['estudiantes']; ?></span>
                                        </div>
                                        <p class="card-desc"><?php echo $curso['descripcion']; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?php echo $curso['link']; ?>" class="btn btn-block btn-primary">Ver Curso <i class="fas fa-chevron-right"></i></a>
                                        <div class="price-tag"><?php echo $curso['precio']; ?></div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" aria-label="Siguiente"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

    <!-- Countdown Section -->
    <?php if (!empty($fecha_lanzamiento)): ?>
    <section id="lanzamiento" class="countdown-hero">
        <div class="countdown-overlay"></div>
        <div class="countdown-content">
            <h5 class="countdown-title"><?php echo $title_lanzamiento; ?></h5>
            <h1 class="countdown-subtitle"><?php echo $subtitle_lanzamiento; ?></h1>
            
            <div id="countdown-timer" class="countdown-timer">
                <div class="timer-item">
                    <span class="number" id="days">00</span>
                    <span class="label">Días</span>
                </div>
                <div class="timer-item">
                    <span class="number" id="hours">00</span>
                    <span class="label">Horas</span>
                </div>
                <div class="timer-item">
                    <span class="number" id="minutes">00</span>
                    <span class="label">Minutos</span>
                </div>
                <div class="timer-item">
                    <span class="number" id="seconds">00</span>
                    <span class="label">Segundos</span>
                </div>
            </div>

            <div id="countdown-cta" class="countdown-cta">
                <a href="#cursos" class="btn-cta-launch">¡INSCRIPCIONES ABIERTAS! - ACCEDER AHORA</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

        <!-- Sobre Mí Section -->
        <section id="sobre-mi" class="about-section">
            <div class="container">
                <div class="about-grid">
                    <div class="about-text hidden-fade">
                        <h2 class="section-title">Sobre <span class="highlight">Mí</span></h2>
                        <h3>Hola, soy <span class="text-primary">Diego Ayasca</span></h3>
                        <p class="lead">Consultor, Mentor e Instructor apasionado por la transformación educativa.</p>
                        <p>Con más de una década de experiencia liderando proyectos y equipos multidisciplinarios, me dedico a empoderar a profesionales para que alcancen su máximo potencial. Mi enfoque combina la teoría rigurosa con la práctica aplicable, garantizando resultados tangibles.</p>
                        <div class="stats-row">
                            <div class="stat-item glass-mini">
                                <span class="stat-number">+10</span>
                                <span class="stat-label">Años de Exp.</span>
                            </div>
                            <div class="stat-item glass-mini">
                                <span class="stat-number">+5k</span>
                                <span class="stat-label">Alumnos</span>
                            </div>
                        </div>
                    </div>
                    <div class="about-image hidden-fade">
                        <div class="image-wrapper">
                            <div class="image-bg-glow"></div>
                            <img src="img/mi-foto.jpg" alt="Diego Ayasca Foto" class="glass-border-img">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contacto Section -->
        <section id="contacto" class="contact-section">
            <div class="container">
                <!-- Header removed as per request -->
                
                <div class="contact-wrapper glass-panel hidden-fade">
                    <div class="contact-grid">
                        <!-- Left Column: Info -->
                        <div class="contact-info">
                            <h3 class="contact-subtitle">Ponte en contacto <span class="highlight">con nosotros</span></h3>
                            <p class="contact-desc">Estamos aquí para ayudarte. Si tienes dudas sobre nuestros cursos, deseas una capacitación personalizada para tu empresa o buscas asesoría experta, escríbenos.</p>
                            
                            <div class="contact-details">
                                <div class="contact-item">
                                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                                    <div class="info-box">
                                        <span class="label">Envíame un correo</span>
                                        <span class="value">contacto@diegoayasca.com</span>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                                    <div class="info-box">
                                        <span class="label">Llámame</span>
                                        <span class="value">+51 926 949 986</span>
                                    </div>
                                </div>
                            </div>

                            <div class="social-connect">
                                <a href="https://www.facebook.com/profile.php?id=61578180192901" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/diegoayasca" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.tiktok.com/@diegopmp2" target="_blank"><i class="fab fa-tiktok"></i></a>
                                <a href="https://www.linkedin.com/in/diegoayasca/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/channel/UCLRFZlx5SG65cfU1ZA7_K_Q" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>

                        <!-- Right Column: Form -->
                        <div class="contact-form-wrapper">
                            <form action="#" method="POST" class="contact-form">
                                <div class="form-group">
                                    <input type="text" id="nombre" name="nombre" required placeholder="Nombre Completo">
                                </div>
                                <div class="form-group">
                                    <input type="email" id="email" name="email" required placeholder="Correo Electrónico">
                                </div>
                                <div class="form-group">
                                    <textarea id="mensaje" name="mensaje" rows="4" required placeholder="Escribe tu mensaje..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-gold btn-block uppercase-btn">ENVIAR MENSAJE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
    <script src="js/script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const launchDateStr = "<?php echo $fecha_lanzamiento; ?>";
        if (!launchDateStr) return;

        const launchDate = new Date(launchDateStr.replace(/-/g, "/")).getTime(); // Replace for Safari compatibility
        const timerElement = document.getElementById("countdown-timer");
        const ctaElement = document.getElementById("countdown-cta");

        if (!timerElement || !ctaElement) return;

        const countdownTimer = setInterval(function() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            if (distance < 0) {
                clearInterval(countdownTimer);
                timerElement.style.display = "none";
                ctaElement.style.display = "block";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
        }, 1000);
    });
    </script>
</body>
</html>
