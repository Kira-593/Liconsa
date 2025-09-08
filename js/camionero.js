document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('CodigoP');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 5) {
            this.value = this.value.slice(0, 5); // Limita a 5 dígitos
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('nt');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10); // Limita a 5 dígitos
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('DNI');
    
    codigoInput.addEventListener('input', function () {
        if (this.value.length > 9) {
            this.value = this.value.slice(0, 9); // Limita a 5 dígitos
        }
    });
});