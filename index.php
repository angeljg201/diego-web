<?php
// Diego Ayasca - Landing Page "Antigravity Style"
require_once __DIR__ . '/data/cursos.php';

// Base Path Definition
$base_path = '';
$nav_prefix = '';
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
    </main>

    <?php include 'includes/footer.php'; ?>
    
    <script src="js/script.js"></script>
</body>
</html>
