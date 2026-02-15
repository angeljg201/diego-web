<?php
// Admin Panel for Countdown Timer
$json_file = 'data.json';
$upload_dir = '../img/uploads/';

// Initialize default values
$data = [
    'title' => 'Curso de Preparación para el Examen PMP®',
    'fecha_lanzamiento' => date('Y-m-d H:i:s'),
    'background_url' => 'img/cursos/curso_pmp.jpeg'
];

// Load existing data
if (file_exists($json_file)) {
    $json_content = file_get_contents($json_file);
    $data = array_merge($data, json_decode($json_content, true));
}

$message = '';

    // Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['title'] = $_POST['title'] ?? '';
    
    // Convert datetime-local format (T) to DB format (space)
    $fecha_raw = $_POST['fecha_lanzamiento'] ?? '';
    $data['fecha_lanzamiento'] = str_replace('T', ' ', $fecha_raw) . ':00'; // Append seconds if missing

    // Handle File Upload
    if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['background_image']['tmp_name'];
        $file_name = basename($_FILES['background_image']['name']);
        
        // Sanitize filename
        $file_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file_name);
        
        $target_dir = '../img/uploads/';
        $target_file = $target_dir . $file_name;
        
        // Ensure upload directory exists
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                 $message = '<div class="alert alert-danger">Error: No se pudo crear el directorio de subida.</div>';
            }
        }
        
        if (empty($message)) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                // Store relative path for frontend use (force forward slashes)
                $data['background_url'] = 'img/uploads/' . $file_name;
            } else {
                $message = '<div class="alert alert-danger">Error al mover la imagen subida. Verifique permisos.</div>';
            }
        }
    }

    // Save Data
    if (file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        $message = '<div class="alert alert-success">Configuración guardada correctamente.</div>';
    } else {
        $message = '<div class="alert alert-danger">Error al guardar la configuración.</div>';
    }
}

// Format date for datetime-local input (needs T)
$date_for_input = date('Y-m-d\TH:i', strtotime($data['fecha_lanzamiento']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Countdown</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .admin-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 3rem;
        }
        .preview-img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <h2 class="text-center mb-4">Configurar Lanzamiento</h2>
                    <?php echo $message; ?>
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título del Evento/Curso</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_lanzamiento" class="form-label">Fecha y Hora de Lanzamiento</label>
                            <input type="datetime-local" class="form-control" id="fecha_lanzamiento" name="fecha_lanzamiento" value="<?php echo htmlspecialchars($date_for_input); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="background_image" class="form-label">Imagen de Fondo (Opcional)</label>
                            <input type="file" class="form-control" id="background_image" name="background_image" accept="image/*">
                            <?php if (!empty($data['background_url'])): ?>
                                <div class="mt-2">
                                    <p class="mb-1">Imagen Actual:</p>
                                    <img src="../<?php echo $data['background_url']; ?>" alt="Preview" class="preview-img">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Guardar Cambios</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="../index.php" target="_blank" class="text-decoration-none">Ver Sitio Web <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
