function limpiarCampos() {
    // Selecciona el formulario
    const formulario = document.querySelector('form');

    // Limpia todos los campos de entrada del formulario
    formulario.reset();

    // Elimina los valores precargados de los inputs
    formulario.querySelectorAll('input[type="text"], input[type="number"], imput[type="textarea"]').forEach(input => {
        input.value = '';
    });
}