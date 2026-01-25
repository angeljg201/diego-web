<?php
// Diego Ayasca - Landing Page "Antigravity Style"
require_once __DIR__ . '/data/cursos.php';

// Base Path Definition
$base_path = '';
$nav_prefix = '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diego Ayasca | Potencia tu carrera profesional</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section (Background Image) -->
        <section id="inicio" class="hero-section">
            <div class="hero-overlay-mobile"></div>
            <div class="container hero-container">
                <div class="hero-content slide-in-bottom">
                    <h1>Domina la Gestión de Proyectos y <span class="highlight">Metodologías Ágiles</span></h1>
                    <p>Aprende con un enfoque práctico y profesional. Certificaciones reconocidas, metodologías ágiles e investigación académica para impulsar tu carrera.</p>
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

                <div class="cursos-grid">
                    <?php foreach ($cursos as $curso): ?>
                        <article class="curso-card glass-card hidden-fade">
                            <div class="card-image">
                                <img src="<?php echo $curso['imagen']; ?>" alt="<?php echo $curso['titulo']; ?>">
                                <div class="card-overlay"></div>
                            </div>
                            <div class="card-content">
                                <h3><?php echo $curso['titulo']; ?></h3>
                                <p><?php echo $curso['descripcion']; ?></p>
                                <div class="card-footer">
                                    <span class="price"><?php echo $curso['precio']; ?></span>
                                    <a href="<?php echo $curso['link']; ?>" class="btn btn-sm btn-outline">Inscribirme</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
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

        <!-- Contacto Section -->
        <section id="contacto" class="contact-section">
            <div class="container">
                <div class="section-header hidden-fade">
                    <h2 class="section-title">Ponte en <span class="highlight">Contacto</span></h2>
                </div>
                
                <div class="contact-wrapper glass-panel hidden-fade">
                    <form action="#" method="POST" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" required placeholder="tu@email.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" rows="5" required placeholder="¿En qué puedo ayudarte?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
    <script src="js/script.js"></script>
</body>
</html>
