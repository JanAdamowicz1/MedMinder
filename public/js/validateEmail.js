const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    // Ustawia opóźnienie 1 sekundę przed wykonaniem walidacji
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
