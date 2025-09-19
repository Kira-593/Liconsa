document.addEventListener('DOMContentLoaded', function() {
    const insumos = document.getElementById('Cantidad_insumos');
    const productos = document.getElementById('ProductosT');
    const controles = document.getElementById('ControlesD');
    const materiales = document.getElementById('MaterialesA');
    const total = document.getElementById('Total');

    function actualizarTotal() {
        const valorInsumos = parseFloat(insumos.value) || 0;
        const valorProductos = parseFloat(productos.value) || 0;
        const valorControles = parseFloat(controles.value) || 0;
        const valorMateriales = parseFloat(materiales.value) || 0;
        total.value = valorInsumos + valorProductos + valorControles + valorMateriales;
    }

    insumos.addEventListener('input', actualizarTotal);
    productos.addEventListener('input', actualizarTotal);
    controles.addEventListener('input', actualizarTotal);
    materiales.addEventListener('input', actualizarTotal);
});