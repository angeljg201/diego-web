<?php
// Mock Data for Course Details
$cursos_detalle = [
    'gestion-proyectos' => [
        'titulo' => 'Gestión de Proyectos y Metodologías Ágiles',
        'subtitulo' => 'Domina el arte de liderar proyectos exitosos con enfoque tradicional y ágil.',
        'imagen' => 'img/curso_proyectos.png',
        'descripcion_corta' => 'Prepárate para las certificaciones más demandadas y lidera equipos de alto rendimiento.',
        'descripcion_larga' => '<p>Este curso integral está diseñado para profesionales que buscan elevar sus competencias en la gestión de proyectos. A diferencia de otros cursos teóricos, aquí nos enfocamos en la aplicación práctica de normas internacionales (PMBOK 7) y marcos de trabajo ágiles (Scrum, Kanban).</p><p>A lo largo del programa, desarrollarás un proyecto real aplicando herramientas de gestión, control de riesgos y liderazgo de equipos. Al finalizar, estarás listo para afrontar los exámenes de certificación PMP® y CAPM®.</p>',
        'beneficios' => [
            'Doble enfoque: Predictivo (PMBOK) y Ágil (Scrum).',
            'Plantillas editables para gestión de proyectos.',
            'Simulacros de examen tipo certificación.',
            'Asesoría personalizada para tu proyecto final.'
        ],
        'aprenderas' => [
            'Fundamentos de la Dirección de Proyectos (PMBOK 7).',
            'Gestión del Cronograma, Costos y Calidad.',
            'Metodología Scrum: Roles, Eventos y Artefactos.',
            'Gestión de Riesgos e Incertidumbre.',
            'Liderazgo y Habilidades Blandas para Directores.',
            'Herramientas digitales: MS Project, Jira y Trello.'
        ],
        'info' => [
            'duracion' => '8 Semanas',
            'modalidad' => '100% Online (En vivo + Grabado)',
            'nivel' => 'Intermedio - Avanzado',
            'certificado' => 'Sí, a nombre de Diego Ayasca Academy'
        ],
        'temario' => [
            [
                'modulo' => 'Módulo 1: Fundamentos y Enfoque Predictivo',
                'lecciones' => ['Introducción al PMBOK 7', 'Ciclo de vida del proyecto', 'Gestión de Interesados y Alcance']
            ],
            [
                'modulo' => 'Módulo 2: Planificación y Ejecución',
                'lecciones' => ['Gestión del Cronograma y Costos', 'Calidad y Recursos', 'Gestión de las Comunicaciones']
            ],
            [
                'modulo' => 'Módulo 3: Metodologías Ágiles (Scrum)',
                'lecciones' => ['Mindset Ágil vs Tradicional', 'El framework Scrum', 'Planificación y Estimación Ágil']
            ],
            [
                'modulo' => 'Módulo 4: Cierre y Certificación',
                'lecciones' => ['Monitoreo y Control', 'Cierre del Proyecto', 'Taller de preparación para certificación']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP®, Scrum Master & Agile Coach',
            'bio' => 'Consultor senior con más de 10 años gestionando proyectos de tecnología e infraestructura. Ha capacitado a más de 5,000 profesionales en Latinoamérica. Apasionado por transformar la teoría compleja en práctica simple.',
            'foto' => 'img/mi-foto.jpg' // Reusing existing image
        ],
        'precio' => 'S/ 350.00',
        'precio_oferta' => 'S/ 299.00',
        'faq' => [
            ['q' => '¿Necesito experiencia previa?', 'a' => 'No es indispensable, pero se recomienda tener conocimientos básicos de trabajo en equipo o participación en proyectos.'],
            ['q' => '¿Las clases quedan grabadas?', 'a' => 'Sí, tendrás acceso de por vida a las grabaciones a través de nuestra aula virtual.'],
            ['q' => '¿Incluye el examen de certificación oficial?', 'a' => 'El curso incluye preparación y simulacros, pero el examen oficial se paga directamente a las entidades certificadoras (PMI, Scrum.org).']
        ]
    ]
    // Add more courses here if needed
];
?>
