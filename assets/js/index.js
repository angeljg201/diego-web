document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-contacto");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const btnSubmit = document.getElementById("btn-submit");
        const mensajeExito = document.getElementById("mensaje-exito");
        const originalText = btnSubmit.innerText || btnSubmit.textContent;

        // Cambiar el estado del botón mientras se envía
        btnSubmit.innerText = "ENVIANDO...";
        btnSubmit.disabled = true;

        const url = "https://script.google.com/macros/s/AKfycbx_HeZiMNWhA-5M-NraBfvCS9IAB-uTjMqo7XZ4l0DoO1Fl-ONj8gPvWCGKZa7T0G1A/exec";
        const formData = new FormData(form);

        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Mostrar mensaje de éxito
                mensajeExito.style.display = "block";
                
                // Limpiar formulario y restaurar botón
                form.reset();
                btnSubmit.innerText = originalText;
                btnSubmit.disabled = false;

                // Ocultar mensaje de éxito tras 5 segundos
                setTimeout(() => {
                    mensajeExito.style.display = "none";
                }, 5000);
            } else {
                throw new Error("Respuesta de red incorrecta");
            }
        })
        .catch(error => {
            console.error("Error al enviar formulario:", error);
            
            // Mostrar texto de error y restaurar después
            btnSubmit.innerText = "ERROR - INTENTA DE NUEVO";
            
            setTimeout(() => {
                btnSubmit.innerText = originalText;
                btnSubmit.disabled = false;
            }, 3000);
        });
    });
});
