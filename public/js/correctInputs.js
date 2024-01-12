document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // Check if elements exist and then get their values
        const categoryElem = document.querySelector('#category');
        const medicationElem = document.querySelector('#medication');
        const medicationNameInput = document.querySelector('input[name="medicationName"]');
        const formInput = document.querySelector('input[name="form"]');
        const doseInput = document.querySelector('input[name="dose"]');

        const category = categoryElem ? categoryElem.value : null;
        const medicationName = medicationElem ? medicationElem.value : medicationNameInput.value;
        const formValue = formInput ? formInput.value : null;
        const doseValue = doseInput ? doseInput.value : null;

        if (!medicationName || !formValue || !doseValue) {
            event.preventDefault();
            alert('Please fill out all fields.');
            return;
        }

        const dose = parseFloat(doseValue);
        if (isNaN(dose) || !Number.isInteger(dose)) {
            event.preventDefault();
            alert('Dose must be an integer.');
            return;
        }
    });
});