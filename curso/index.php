<?php
// Diego Ayasca - Course Detail Page
require_once '../data/cursos_detalle.php';

// Get slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$curso = isset($cursos_detalle[$slug]) ? $cursos_detalle[$slug] : null;

// If course not found, redirect to home or show error (simple handling for now)
if (!$curso) {
    // For demo purposes, we fallback to the first course if slug is empty or invalid, 
    // or you could redirect: header("Location: index.php"); exit;
    // Let's default to 'gestion-proyectos' for better UX if accessed directly
    // Let's default to 'gestion-proyectos' for better UX if accessed directly
    $curso = $cursos_detalle['gestion-proyectos'];
}

// Base Path Definition for Subdirectory
$base_path = '../'; 
$nav_prefix = '../index.php'; // On subpages, links go back to home
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $curso['titulo']; ?> | Diego Ayasca</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Course Hero Section -->
        <section class="course-hero" style="background-image: url('../<?php echo $curso['imagen']; ?>');">
            <div class="hero-overlay"></div>
            <div class="container course-hero-container">
                <div class="course-hero-content slide-in-bottom">
                    <span class="badge-accent">Curso Online</span>
                    <h1><?php echo $curso['titulo']; ?></h1>
                    <p class="hero-subtitle"><?php echo $curso['subtitulo']; ?></p>
                    
                    <ul class="hero-benefits-list">
                        <?php foreach($curso['beneficios'] as $beneficio): ?>
                            <li><i class="fas fa-check-circle text-gold"></i> <?php echo $beneficio; ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="hero-actions">
                         <!-- Removed primary CTA here as it is now in the card, but kept "Ver Temario" and maybe a secondary "Más Info" if desired, 
                              but sticking to plan: "Floating Purchase Card... containing... Buy Now". 
                              I will keep "Ver Temario" button here. -->
                        <a href="#temario" class="btn btn-outline-light btn-lg pill-btn">Ver Temario <i class="fas fa-arrow-down"></i></a>
                    </div>
                </div>
                
                <!-- Pricing Card Moved to Sidebar -->
                <div class="course-hero-card hidden-fade" style="display: none;"></div>
            </div>
        </section>

        <!-- Course Info Bar Moved -->

        <!-- Description & Learning -->
        <section class="course-details section-padding">
            <div class="container">
                <div class="details-grid">
                    <!-- Left Content -->
                    <div class="details-content">
                        <!-- Info Bar Inline -->
                        <div class="info-inline-container hidden-fade">
                            <div class="info-inline-item">
                                <div class="icon-circle"><i class="fas fa-clock"></i></div>
                                <div>
                                    <span class="info-label">DURACIÓN</span>
                                    <span class="info-val"><?php echo $curso['info']['duracion']; ?></span>
                                </div>
                            </div>
                            <div class="info-inline-item">
                                <div class="icon-circle"><i class="fas fa-video"></i></div>
                                <div>
                                    <span class="info-label">MODALIDAD</span>
                                    <span class="info-val"><?php echo $curso['info']['modalidad']; ?></span>
                                </div>
                            </div>
                            <div class="info-inline-item">
                                <div class="icon-circle"><i class="fas fa-laptop-code"></i></div>
                                <div>
                                    <span class="info-label">ACCESO</span>
                                    <span class="info-val">Aula Virtual 24/7</span>
                                </div>
                            </div>
                        </div>
                        <div class="content-block hidden-fade">
                            <h2>Descripción del <span class="highlight-text">Curso</span></h2>
                            <div class="rich-text">
                                <?php echo $curso['descripcion_larga']; ?>
                            </div>
                        </div>

                        <div class="content-block hidden-fade" id="aprenderas">
                            <h3>¿Qué aprenderás?</h3>
                            <div class="learning-grid">
                                <?php foreach($curso['aprenderas'] as $punto): ?>
                                    <div class="learning-item">
                                        <i class="fas fa-check"></i>
                                        <p><?php echo $punto; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Syllabus Accordion -->
                        <div class="content-block hidden-fade" id="temario">
                            <h3>Plan de <span class="highlight-text">Estudios</span></h3>
                            <div class="accordion-wrapper">
                                <?php foreach($curso['temario'] as $index => $modulo): ?>
                                    <div class="accordion-item">
                                        <button class="accordion-header">
                                            <span class="module-title"><?php echo $modulo['modulo']; ?></span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="accordion-content">
                                            <ul>
                                                <?php foreach($modulo['lecciones'] as $leccion): ?>
                                                    <li><i class="fas fa-play-circle"></i> <?php echo $leccion; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- FAQ -->
                        <div class="content-block hidden-fade">
                            <h3>Preguntas <span class="highlight-text">Frecuentes</span></h3>
                             <div class="accordion-wrapper">
                                <?php foreach($curso['faq'] as $faq): ?>
                                    <div class="accordion-item">
                                        <button class="accordion-header">
                                            <span class="module-title"><?php echo $faq['q']; ?></span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="accordion-content">
                                            <p><?php echo $faq['a']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Instructor Section Moved Inside -->
                        <div class="content-block hidden-fade" id="instructor">
                             <h3>Conoce a tu <span class="highlight-text">Instructor</span></h3>
                             <div class="instructor-card-inner">
                                <div class="inst-inner-grid">
                                    <div class="inst-img-wrapper">
                                        <img src="../<?php echo $curso['instructor']['foto']; ?>" alt="<?php echo $curso['instructor']['nombre']; ?>">
                                    </div>
                                    <div class="inst-content-wrapper">
                                        <h4><?php echo $curso['instructor']['nombre']; ?></h4>
                                        <p class="inst-title"><?php echo $curso['instructor']['titulo_inst']; ?></p>
                                        <p class="inst-bio"><?php echo $curso['instructor']['bio']; ?></p>
                                        
                                        <div class="inst-stats-mini">
                                             <span><i class="fas fa-user-graduate"></i> +5k Alumnos</span>
                                             <span><i class="fas fa-star"></i> 10+ Años Exp.</span>
                                        </div>
                                        
                                        <div class="inst-socials">
                                            <!-- Optional socials if data existed, or static for now -->
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                            <a href="#"><i class="fas fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>

                    </div>

                    <!-- Sidebar / Right Content -->
                    <div class="details-sidebar">
                        <div class="sticky-sidebar hidden-fade">
                            <!-- Pricing Card Moved Here -->
                            <div class="pricing-card glass-card" id="precio">
                                <div class="price-header">
                                    <span class="price-label">Oferta Especial</span>
                                    <div class="price-container">
                                        <span class="old-price"><?php echo $curso['precio']; ?></span>
                                        <span class="current-price"><?php echo $curso['precio_oferta']; ?></span>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <ul class="price-features">
                                        <li><i class="fas fa-check text-green"></i> Acceso inmediato</li>
                                        <li><i class="fas fa-check text-green"></i> Certificado incluido</li>
                                        <li><i class="fas fa-check text-green"></i> Recursos descargables</li>
                                        <li><i class="fas fa-check text-green"></i> Garantía de 7 días</li>
                                    </ul>
                                    <a href="#" class="btn btn-primary btn-block btn-lg">¡Inscribirme Ahora!</a>
                                    <p class="guarantee-text"><i class="fas fa-shield-alt"></i> Compra 100% Segura</p>
                                </div>
                            </div>

                            <!-- Instructor Mini Profile Removed as requested -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Instructor Section removed from here (moved up) -->
        <!-- CTA Section removed as requested -->

    </main>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../js/script.js"></script>
</body>
</html>
