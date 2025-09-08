document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('ID');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 5) {
            this.value = this.value.slice(0, 5); // Limita a 5 dígitos
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('Peso');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 9) {
            this.value = this.value.slice(0, 9); // Limita a 5 dígitos
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('ID_CA');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 5) {
            this.value = this.value.slice(0, 5); // Limita a 5 dígitos
        }
    });
});