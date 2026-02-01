<?php
// Mock Data for Course Details
$cursos_detalle = [
    'gestion-proyectos' => [ // Keeping as fallback or alias
        'titulo' => 'Gestión de Proyectos y Metodologías Ágiles',
        'subtitulo' => 'Domina el arte de liderar proyectos exitosos con enfoque tradicional y ágil.',
        'imagen' => 'img/cursos/curso_proyectos.png',
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
                'lecciones' => ['Metodología Scrum: Roles, Eventos y Artefactos', 'Planificación y Estimación Ágil']
            ],
            [
                'modulo' => 'Módulo 4: Cierre y Certificación',
                'lecciones' => ['Monitoreo y Control', 'Cierre del Proyecto', 'Taller de preparación para certificación']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 350.00',
        'precio_oferta' => 'S/ 299.00',
        'faq' => [
            ['q' => '¿Necesito experiencia previa?', 'a' => 'No es indispensable, pero se recomienda tener conocimientos básicos de trabajo en equipo o participación en proyectos.'],
            ['q' => '¿Las clases quedan grabadas?', 'a' => 'Sí, tendrás acceso de por vida a las grabaciones a través de nuestra aula virtual.'],
            ['q' => '¿Incluye el examen de certificación oficial?', 'a' => 'El curso incluye preparación y simulacros, pero el examen oficial se paga directamente a las entidades certificadoras (PMI, Scrum.org).']
        ]
    ],
    'metodologias-agiles' => [
        'titulo' => 'Metodologías Ágiles (Scrum & Kanban)',
        'subtitulo' => 'Gestiona equipos de alto rendimiento y entrega valor continuo con marcos de trabajo ágiles.',
        'imagen' => 'img/cursos/curso_agiles.png',
        'descripcion_corta' => 'Domina Scrum, Kanban y Lean para transformar la forma en que trabajas.',
        'descripcion_larga' => '<p>En un entorno VUCA, la agilidad no es una opción, es una necesidad. Este curso te enseñará a implementar Scrum y Kanban desde cero, mejorando la colaboración, transparencia y velocidad de entrega de tus equipos.</p><p>Aprenderás a facilitar eventos efectivos, gestionar backlogs y utilizar métricas ágiles para la mejora continua.</p>',
        'beneficios' => [
            'Certificación Scrum Master (preparación).',
            'Tableros Kanban físicos y digitales (Jira/Trello).',
            'Dinámicas de retrospectiva innovadoras.',
            'Escalado de agilidad en la empresa.'
        ],
        'aprenderas' => [
            'Mindset Ágil vs Tradicional.',
            'Framework Scrum: 3-5-3 (Roles, Eventos, Artefactos).',
            'Método Kanban: Visualización y Flujo.',
            'Historias de Usuario y Criterios de Aceptación.',
            'Estimación Ágil (Planning Poker).',
            'Métricas: Velocidad, Lead Time, Cycle Time.'
        ],
        'info' => [
            'duracion' => '4 Semanas',
            'modalidad' => '100% Online',
            'nivel' => 'Todos los niveles',
            'certificado' => 'Sí, Especialización en Agilidad'
        ],
        'temario' => [
            [
                'modulo' => 'Módulo 1: Introducción a la Agilidad',
                'lecciones' => ['Manifiesto Ágil', 'Valores y Principios', '¿Por qué Agile?']
            ],
            [
                'modulo' => 'Módulo 2: Scrum Framework',
                'lecciones' => ['El Scrum Master y Product Owner', 'Sprints y Eventos', 'Artefactos']
            ],
            [
                'modulo' => 'Módulo 3: Kanban y Lean',
                'lecciones' => ['Principios de Kanban', 'WIP Limits', 'Gestión del Flujo']
            ],
            [
                'modulo' => 'Módulo 4: Ejecución Ágil',
                'lecciones' => ['Simulación de Sprint', 'Herramientas Digitales', 'Examen Final']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 300.00',
        'precio_oferta' => 'S/ 249.00',
        'faq' => [
            ['q' => '¿Es solo para software?', 'a' => 'No, Scrum y Kanban se aplican en marketing, RRHH y cualquier área de gestión.'],
            ['q' => '¿Qué certificación obtengo?', 'a' => 'Recibes un certificado del curso y preparación para PSM I (Scrum.org).']
        ]
    ],
    'investigacion-academica' => [
        'titulo' => 'Investigación Académica y Redacción Científica',
        'subtitulo' => 'Domina las técnicas de redacción, citado y metodología para tesis y artículos científicos.',
        'imagen' => 'img/cursos/curso_investigacion.png',
        'descripcion_corta' => 'Aprende a estructurar, redactar y publicar investigaciones de alto impacto.',
        'descripcion_larga' => '<p>Este curso está diseñado para estudiantes, tesistas e investigadores que desean perfeccionar sus habilidades en la redacción académica. Aprenderás a formular problemas de investigación, estructurar marcos teóricos sólidos y analizar datos con rigor científico.</p><p>Además, profundizaremos en las normas de citación (APA 7ma Edición) y estrategias para publicar en revistas indexadas.</p>',
        'beneficios' => [
            'Dominio de Normas APA 7ma Edición.',
            'Estrategias para elegir y delimitar tu tema de tesis.',
            'Uso de gestores bibliográficos (Mendeley/Zotero).',
            'Plantillas para redacción de artículos científicos.'
        ],
        'aprenderas' => [
            'Estructura de una Tesis y Artículo Científico (IMRD).',
            'Búsqueda avanzada en bases de datos (Scopus, WoS).',
            'Metodología de la Investigación: Enfoques cuanti y cuali.',
            'Redacción académica clara y coherente.',
            'Análisis e interpretación de resultados.',
            'Gestión de referencias bibliográficas.'
        ],
        'info' => [
            'duracion' => '4 Semanas',
            'modalidad' => '100% Online (Clases en Vivo)',
            'nivel' => 'Básico - Intermedio',
            'certificado' => 'Sí, Certificado de Aprobación'
        ],
        'temario' => [
            [
                'modulo' => 'Módulo 1: El Proyecto de Investigación',
                'lecciones' => ['Elección del tema y planteamiento del problema', 'Objetivos e hipótesis', 'Búsqueda bibliográfica efectiva']
            ],
            [
                'modulo' => 'Módulo 2: Marco Teórico y Método',
                'lecciones' => ['Antecedentes y bases teóricas', 'Diseño metodológico', 'Población y muestra']
            ],
            [
                'modulo' => 'Módulo 3: Redacción y Normativa',
                'lecciones' => ['Normas APA 7ma Edición', 'Citas y referencias', 'Evitar el plagio y uso de Turnitin']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 250.00',
        'precio_oferta' => 'S/ 199.00',
        'faq' => [
            ['q' => '¿Sirve para cualquier carrera?', 'a' => 'Sí, los fundamentos de investigación son transversales, aunque se dan ejemplos de diversas áreas.'],
            ['q' => '¿Enseñan estadística?', 'a' => 'Se ven conceptos básicos para la interpretación, pero no es un curso de software estadístico avanzado.']
        ]
    ],
    'liderazgo-equipos-it' => [
        'titulo' => 'Liderazgo de Equipos IT y Habilidades Directivas',
        'subtitulo' => 'Desarrolla habilidades blandas y directivas para liderar equipos tecnológicos con éxito.',
        'imagen' => 'img/cursos/curso_proyectos.png',
        'descripcion_corta' => 'Pasa de ser un líder técnico a un líder de personas inspirador y efectivo.',
        'descripcion_larga' => '<p>En el sector tecnológico, las habilidades técnicas no bastan. Este curso te prepara para los desafíos de gestionar talento humano en entornos IT. Aprenderás a motivar equipos, resolver conflictos, negociar con stakeholders y comunicar visión estratégica.</p><p>Ideal para Tech Leads, Engineering Managers y CTOs en formación.</p>',
        'beneficios' => [
            'Técnicas de comunicación asertiva y feedback.',
            'Gestión de conflictos en equipos remotos.',
            'Mentoring y desarrollo de carrera para tu equipo.',
            'Inteligencia emocional para líderes.'
        ],
        'aprenderas' => [
            'Transición de Dev a Lead.',
            'Delegación efectiva y empoderamiento.',
            'Gestión del desempeño y OKRs.',
            'Contratación y Onboarding en IT.',
            'Cultura de ingeniería y seguridad psicológica.',
            'Gestión del estrés y burnout en equipos.'
        ],
        'info' => [
            'duracion' => '6 Semanas',
            'modalidad' => '100% Online (Taller Práctico)',
            'nivel' => 'Intermedio',
            'certificado' => 'Sí, Certificado de Liderazgo'
        ],
        'temario' => [
            [
                'modulo' => 'Módulo 1: El Rol del Líder Técnico',
                'lecciones' => ['Diferencia entre gestión y liderazgo', 'Estilos de liderazgo', 'Autoliderazgo']
            ],
            [
                'modulo' => 'Módulo 2: Gestión de Personas',
                'lecciones' => ['Reuniones 1:1 efectivas', 'Dar y recibir Feedback', 'Plan de desarrollo individual']
            ],
            [
                'modulo' => 'Módulo 3: Equipos de Alto Rendimiento',
                'lecciones' => ['Seguridad psicológica', 'Gestión de conflictos', 'Comunicación en equipos distribuidos']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 400.00',
        'precio_oferta' => 'S/ 350.00',
        'faq' => [
            ['q' => '¿Es solo para programadores?', 'a' => 'Está enfocado en líderes de tecnología (Devs, QA, UX), pero los principios aplican a cualquier líder de equipos creativos.'],
            ['q' => '¿Incluye sesiones de coaching?', 'a' => 'Incluye prácticas de role-playing en vivo, pero el coaching individual es un servicio aparte.']
        ]
    ],
    'certificacion-capm' => [
        'titulo' => 'Certificación CAPM® - Gestión de Proyectos',
        'subtitulo' => 'Domina los fundamentos de la gestión de proyectos y prepárate para la certificación CAPM del PMI.',
        'imagen' => 'img/cursos/curso_proyectos.png',
        'descripcion_corta' => 'Tu puerta de entrada al mundo de la gestión de proyectos profesional certificada.',
        'descripcion_larga' => '<p>El Certified Associate in Project Management (CAPM)® es una certificación reconocida mundialmente que valida tu comprensión de la terminología y los procesos fundamentales de la gestión eficaz de proyectos. Este curso cubre todo el contenido del ECO (Examination Content Outline) vigente.</p>',
        'beneficios' => [
            'Alineado al PMBOK 7ma Edición.',
            'Simulador de examen con +500 preguntas.',
            'Plan de estudio personalizado.',
            'Certificado de 23 horas de contacto (Requisito PMI).'
        ],
        'aprenderas' => [
            'Fundamentos y conceptos clave de proyectos.',
            'Metodologías Predictivas (Cascada).',
            'Metodologías Ágiles y Adaptativas.',
            'Análisis de Negocio.',
            'Ética y Conducta Profesional.',
            'Tips y estrategias para aprobar el examen.'
        ],
        'info' => [
            'duracion' => '5 Semanas',
            'modalidad' => '100% Online',
            'nivel' => 'Básico - Intermedio',
            'certificado' => 'Sí, Certificado válido para PMI'
        ],
        'temario' => [
            [
                'modulo' => 'Módulo 1: Introducción a la Gestión de Proyectos',
                'lecciones' => ['Conceptos fundamentales', 'Roles y responsabilidades', 'Ciclo de vida']
            ],
            [
                'modulo' => 'Módulo 2: Enfoques Predictivos',
                'lecciones' => ['Planificación', 'Ejecución y Control', 'Cierre']
            ],
            [
                'modulo' => 'Módulo 3: Enfoques Ágiles',
                'lecciones' => ['Manifiesto Ágil', 'Marcos de trabajo (Scrum, Kanban)', 'Prácticas ágiles']
            ],
            [
                'modulo' => 'Módulo 4: Análisis de Negocio',
                'lecciones' => ['Roles de BA', 'Recopilación de requisitos', 'Validación de la solución']
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 350.00',
        'precio_oferta' => 'S/ 299.00',
        'faq' => [
            ['q' => '¿Cuáles son los requisitos para el examen?', 'a' => 'Necesitas diploma de secundaria y 23 horas de educación en gestión de proyectos (que este curso cubre).'],
            ['q' => '¿El precio incluye el examen?', 'a' => 'No, el examen se paga directo al PMI. Este curso es la preparación completa.']
        ]
    ],
    'preparacion-pmp' => [
        'titulo' => 'Curso de preparación para el examen PMP',
        'subtitulo' => 'Impulsa tu carrera profesional con nuestro curso de preparación PMP',
        'imagen' => 'img/cursos/curso_pmp.jpeg',
        'descripcion_corta' => 'Entrenamiento 100 % práctico basado en el ECO, simulacros reales, estrategias de examen y acompañamiento experto.',
        'descripcion_larga' => '<p>Impulsa tu carrera profesional con nuestro curso de preparación PMP: entrenamiento 100 % práctico basado en el ECO (Esquema de Contenido del Examen), simulacros reales, estrategias de examen y acompañamiento experto hasta lograr tu certificación.</p>
        <h3>¿A quién va dirigido este curso?</h3>
        <ul>
            <li>Profesionales que desean certificarse como PMP.</li>
            <li>Directores de proyectos, líderes, ingenieros y consultores con experiencia en proyectos.</li>
            <li>Personas con certificaciones como CAPM o Scrum Master que buscan dar el siguiente paso profesional.</li>
            <li>Profesionales que buscan mejorar su perfil y obtener oportunidades laborales.</li>
        </ul>',
        'beneficios' => [
            'Alineado al ECO vigente.',
            'Simulador tipo examen con más de 300 preguntas.',
            'Certificado de 35 horas de contacto (requisito del PMI).',
            'Acceso virtual: 24/7.'
        ],
        'aprenderas' => [
            'Enfoques predictivo, ágil e híbrido.',
            'Cómo piensa el PMI y cómo responder el examen PMP.',
            'Los dominios del ECO y su aplicación práctica.',
            'Técnicas para resolver preguntas situacionales.',
            'Estrategias para aprobar el examen PMP.'
        ],
        'info' => [
            'duracion' => '6 Semanas',
            'modalidad' => 'Online',
            'nivel' => 'Avanzado',
            'certificado' => 'Sí, 35 horas de contacto'
        ],
        'temario' => [
            [
                'modulo' => 'Lección 1: Contexto empresarial y estrategia del proyecto',
                'lecciones' => [
                    'Fundamentos modernos de la gestión de proyectos',
                    'Enfoques predictivos, ágiles e híbridos',
                    'Alineación de los proyectos con la estrategia',
                    'Gestión del valor y beneficios',
                    'Cultura organizacional y gestión del cambio',
                    'Cumplimiento normativo y regulatorio'
                ]
            ],
            [
                'modulo' => 'Lección 2: Inicio del proyecto y definición del enfoque',
                'lecciones' => [
                    'Identificación y gestión de interesados',
                    'Estrategias de comunicación',
                    'Formación de equipos de alto desempeño',
                    'Construcción de una visión compartida',
                    'Selección del enfoque de gestión'
                ]
            ],
            [
                'modulo' => 'Lección 3: Planificación integral del proyecto',
                'lecciones' => [
                    'Planificación tradicional vs adaptativa',
                    'Definición del alcance y MVP',
                    'Cronograma y estimaciones',
                    'Gestión de recursos y adquisiciones',
                    'Planificación del presupuesto y riesgos',
                    'Integración de planes'
                ]
            ],
            [
                'modulo' => 'Lección 4: Liderazgo y gestión del equipo del proyecto',
                'lecciones' => [
                    'Estilos de liderazgo',
                    'Entornos colaborativos',
                    'Empoderamiento y diversidad',
                    'Seguimiento del desempeño (KPIs)',
                    'Comunicación estratégica',
                    'Gestión de conflictos'
                ]
            ],
            [
                'modulo' => 'Lección 5: Seguimiento, desempeño y mejora continua',
                'lecciones' => [
                    'Mejora continua',
                    'Evaluación del desempeño',
                    'Monitoreo del alcance, cronograma y costos',
                    'Gestión de incidentes y riesgos',
                    'Adaptación a los cambios'
                ]
            ],
            [
                'modulo' => 'Lección 6: Cierre del proyecto y entrega de valor',
                'lecciones' => [
                    'Cierre formal del proyecto',
                    'Validación de entregables',
                    'Lecciones aprendidas',
                    'Seguimiento de beneficios',
                    'Transferencia de conocimiento'
                ]
            ]
        ],
        'instructor' => [
            'nombre' => 'Diego Ayasca',
            'titulo_inst' => 'PMP | CAPM | SMPC | Black Belt',
            'bio' => 'Mi camino en la gestión de proyectos comenzó con Microsoft Project y evolucionó hacia el dominio de los estándares del PMBOK® y las metodologías ágiles como Scrum. Me certifiqué como Scrum Master, CAPM®, PMP® y Black Belt. Hoy, desde la docencia, acompaño a profesionales a liderar proyectos con impacto, enfoque humano y resultados sostenibles.',
            'foto' => 'img/mi-foto.jpg' 
        ],
        'precio' => 'S/ 800.00',
        'precio_oferta' => 'S/ 800.00',
        'faq' => [
            ['q' => '¿Incluye el certificado PMP?', 'a' => 'No, este curso te brinda las 35 horas de contacto requeridas para postular al examen, pero la certificación la otorga el PMI tras aprobar su examen.'],
            ['q' => '¿El simulador es parecido al real?', 'a' => 'Sí, contamos con un banco de preguntas alineadas al ECO vigente para que practiques en condiciones reales.']
        ]
    ]
];
?>
