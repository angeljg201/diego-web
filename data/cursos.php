<?php
require_once __DIR__ . '/db_cursos.php';

$cursos = [];
foreach ($db_cursos as $slug => $curso) {
    if (isset($curso['mostrar_en_catalogo']) && $curso['mostrar_en_catalogo']) {
        $cursos[] = [
            'titulo' => $curso['titulo_catalogo'],
            'descripcion' => $curso['descripcion'],
            'imagen' => $curso['imagen_catalogo'],
            'precio' => $curso['precio'],
            'link' => 'curso/' . $slug,
            'lecciones' => $curso['lecciones_catalogo'],
            'horas' => $curso['horas'],
            'estudiantes' => $curso['estudiantes'],
            'etiqueta' => $curso['etiqueta']
        ];
    }
}
?>
