# Guía de Gestión de Cursos - Proyecto Diego Ayasca

¡Hola! Esta guía está diseñada para enseñarte paso a paso cómo modificar o agregar nuevos cursos en la página web. 

El sistema ha sido estructurado para que **no necesites tocar código complejo ni modificar las páginas HTML directamente**. Toda la información de los cursos (textos, precios, imágenes, temario) vive en un solo lugar: el archivo `data/db_cursos.php`.

---

## 📁 1. ¿Dónde se encuentra la información?

El archivo principal que controla todo es:
👉 `data/db_cursos.php` (dentro de la carpeta principal de tu proyecto).

*(Si el proyecto ya está subido a internet en un CPanel o hosting, este archivo lo encontrarás dentro de la carpeta `/data` en tu Administrador de Archivos o accediendo mediante FTP).*

Al abrir este archivo con un editor de texto (como VS Code, Sublime Text o incluso el bloc de notas como último recurso), verás que la información está organizada por "bloques". Cada bloque representa un curso distinto.

---

## ✏️ 2. ¿Cómo modificar un curso existente?

Si deseas cambiar el precio, el título, una imagen o el temario de un curso que ya existe, solo debes buscar el dato correspondiente dentro de su bloque en `db_cursos.php` y cambiar el texto **que está entre comillas simples**.

### ✅ Reglas de oro al editar:
1. **NO borres las comillas simples (`' '`)** que envuelven los textos. Si borras una por accidente, la página mostrará un error.
2. **NO borres las comas (`,`)** que están al final de cada línea de datos.
3. Lo que está a la izquierda de la flecha (`=>`) es el nombre interno del dato (esto NO lo toques), lo que está a la derecha entre comillas es el valor (esto SÍ es lo que puedes editar).

### ✨ Ejemplo de modificación:
Queremos cambiar el precio de la certificación CAPM. Buscamos esto en el archivo:

```php
'precio' => 'S/ 350.00',
```
Si el nuevo precio es 400 soles, lo cambiamos cuidadosamente así:
```php
'precio' => 'S/ 400.00',
```

¡Eso es todo! Al guardar el archivo, el precio se actualizará automáticamente de forma universal en la página de inicio, en la página del detalle del curso, y en los botones de compra.

---

## ➕ 3. ¿Cómo agregar un NUEVO CURSO?

Para agregar un nuevo curso, el método más seguro y rápido es **copiar completamente el bloque de un curso existente y pegarlo debajo**, para luego cambiar sus datos por los del nuevo curso.

Sigue estos 4 pasos:

### Paso 1: Copiar
Busca el inicio de un curso existente, que empieza siempre con su nombre corto o "slug" y un corchete de apertura `[`. En el ejemplo de abajo, el slug es `certificacion-capm`. Copia desde esa línea hasta su llave/corchete de cierre correspondiente `],` que suele estar bastantes líneas más abajo.

```php
  'certificacion-capm' => 
  [ // <--- Inicio del bloque
     // ... toda la información del curso ...
     // ...
     'etiqueta' => 'Curso Oficial',
  ], // <--- Copia hasta aquí, incluyendo la coma.
```

### Paso 2: Pegar
Baja hasta la parte final del archivo. Ubícate **justo antes** del último corchete de cierre con punto y coma del archivo (`];`) que siempre es la ultimísima línea del documento, y pega ahí el bloque que acabas de copiar.

### Paso 3: Modificar el identificador único ("slug")
Lo primero y más crítico que debes cambiar en tu nuevo bloque recién pegado es la primera línea. Este es el identificador único del curso para el sistema y las url de internet (debe ir en minúsculas, sin espacios -usa guiones-, sin ñ y sin tildes).

Cambia esto:
```php
  'certificacion-capm' =>
```
Por algo como esto (ajustado a tu nuevo curso):
```php
  'mi-nuevo-curso-genial' =>
```

### Paso 4: Llenar la información real
Ahora, con calma, ve línea por línea reemplazando la información del bloque copiado por la información real de tu nuevo curso. 

Aquí tienes un desglose de qué significa y para qué sirve cada campo principal:

#### A) Datos de la Página de Inicio (Cards / Tarjetas)
*   **`'mostrar_en_catalogo'`**: Si dice `true`, la tarjeta de este curso se verá en la página de inicio. Si dice `false`, estará oculta (útil si aún estás armando el curso y no quieres que nadie lo vea).
*   **`'titulo_catalogo'`**: El título corto y directo que se lee en la tarjeta de inicio (ej. "Curso de Excel").
*   **`'descripcion'`**: El pequeño párrafo resumen de 2 o 3 líneas de la tarjeta inicial.
*   **`'imagen_catalogo'`**: La ruta a la imagen en miniatura de la tarjeta (ej. `'img/cursos/miniatura1.png'`).
*   **`'lecciones_catalogo'`**, **`'horas'`**, **`'estudiantes'`**: Los datos de los tres iconitos grises debajo del título de la tarjeta en el inicio.
*   **`'etiqueta'`**: El texto del listón o cintillo amarillo superior (Ej: "Más Vendido", "Nuevo").

#### B) Datos de la Página Interna del Detalle del Curso (La Landing Page)
*   **`'titulo'`**: El título grande y detallado al encabezar la página interna.
*   **`'subtitulo'`**: La frase secundaria larga que va debajo del título principal.
*   **`'imagen'`**: La foto grande de cabecera que hace de fondo general (puedes usar la misma del catálogo o una más grande y ancha).
*   **`'descripcion_corta'`** y **`'descripcion_larga'`**: Los textos de la descripción principal. *(Super Tip: En `'descripcion_larga'` puedes usar etiquetas HTML si sabes cómo, como `<p>` para dividir en párrafos, `<ul><li>` para listas, o `<strong>` para destacar en negrita).*
*   **`'beneficios'`**: Una lista de beneficios súper principales cortos (se muestran como viñetas de 'check').
*   **`'aprenderas'`**: La cuadrícula de 4 o 6 cosas específicas que aprenderá el alumno ("¿Qué aprenderás?").
*   **`'info'`**: Aquí va la caja rápida de duración, modalidad, nivel y certificado (responden a la barra informativa de la landing).
*   **`'precio'`** y **`'precio_oferta'`**: Muestran los montos en S/ grandes y vistosos en la tarjeta flotante lateral por donde entran a comprar. Puedes poner el mismo valor numérico a ambos en caso de no haber oferta.

#### C) Temario (Los Módulos desplegables o Acordeones)
El temario funciona como listas dentro de listas. Tienes los Módulos numerados con `0 =>`, `1 =>`, `2 =>` (así los cuenta el sistema informático), y dentro de cada uno, las `'lecciones'`.
*   **`'modulo'`**: Es el título estelar del módulo (Ej: "Módulo 1: Introduciendo la Gestión").
*   **`'lecciones'`**: Reemplaza el texto de cada lección (0, 1, 2...) entre comillas. Si un módulo es más largo, simplemente añade una nueva línea siguiendo la numeración de esa serie:
    ```php
          0 => 'Lección número 1',
          1 => 'Lección número 2',
          2 => 'Lección número 3',
          3 => 'Archivos descargables y Quiz', // <--- Nueva línea!
    ```

#### D) Instructor
En el nodo `'instructor'`, cambia el **`'nombre'`**, su título que sale debajo de este (**`'titulo_inst'`**), una breve reseña bibliográfica (**`'bio'`**) y en **`'foto'`** pon la ruta a su fotografía correspondiente.

---

## 🖼️ 4. Sobre el manejo de Imágenes

Es sumamente importante recordar cómo subir las fotos. Cuando configuras un campo de imagen como este:
`'imagen' => 'img/cursos/mi_nueva_imagen.jpg',`

Le estás diciendo al sistema que busque esa imagen dentro de la estructura de carpetas de tu servidor. 
Debes asegurarte primero de **haber subido** ese archivo de archivo llamado `mi_nueva_imagen.jpg` dentro de la carpeta correspondiente en el proyecto, que normalmente sería aquí:
👉 `Tu-Proyecto/img/cursos/`

*Nota: Intenta que las imágenes estén optimizadas y comprimidas para que la web siempre cargue súper rápido y fluida.*

---

**¡Y listo! 🎉🥳** 
Con tan solo editar líneas de texto en este único archivo `db_cursos.php` y subir tus imágenes, este dinámico sitio web actualizará todo por arte de magia: las tarjetas de venta del inicio, las páginas de aterrizaje individuales, **los enlaces automáticos de tu WhatsApp ya saldrán con el nombre de tu nuevo curso insertado en el primer saludo**, e incluso los botones apuntarán directo al carrito de compras checkout sin necesidad de programar una sola línea de código complejo HTML. ¡Éxitos!
