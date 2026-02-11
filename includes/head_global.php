<?php
/**
 * Global Head Section
 * Modularized for consistency across all pages.
 * 
 * Usage:
 * $page_title = 'Custom Title'; (Optional)
 * $page_desc = 'Custom Description'; (Optional)
 * include 'includes/head_global.php';
 */

// Default Values
$default_title = 'Diego Ayasca | Gestión de Proyectos, Agilidad e Investigación';
$default_desc = 'Impulsa tu carrera profesional con cursos de Gestión de Proyectos (PMP, CAPM), Metodologías Ágiles (Scrum, Kanban) e Investigación Académica. Aprende con Diego Ayasca.';
$default_image = 'https://diegoayasca.com/img/banner-inicio-diego-ayasca.png';
$default_url = 'https://diegoayasca.com/';

// Logic to set values if not provided by the parent page
$meta_title = isset($page_title) ? $page_title : $default_title;
$meta_desc = isset($page_description) ? $page_description : $default_desc;
$meta_image = isset($page_image) ? $page_image : $default_image;
$meta_url = isset($page_url) ? $page_url : $default_url;
$meta_type = isset($og_type) ? $og_type : 'website';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Google Analytics (GA4) -->
    <!-- 
        PASTE GA4 CODE HERE 
        (script tag from Google) 
    -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $meta_title; ?></title>
    <meta name="description" content="<?php echo $meta_desc; ?>">
    <link rel="canonical" href="<?php echo $meta_url; ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo $meta_type; ?>">
    <meta property="og:url" content="<?php echo $meta_url; ?>">
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:image" content="<?php echo $meta_image; ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo isset($base_path) ? $base_path : '/'; ?>img/logo.png" type="image/png">
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS (Root-Relative Path) -->
    <link rel="stylesheet" href="<?php echo isset($base_path) ? $base_path : '/'; ?>css/style.css">

    <?php if (isset($extra_head)) echo $extra_head; ?>
</head>
