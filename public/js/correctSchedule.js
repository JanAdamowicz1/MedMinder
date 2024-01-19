document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // Sprawdzenie, czy "Number of doses per intake" jest liczbą całkowitą i zawiera tylko cyfry
        const dosesPerIntakeInput = document.querySelector('input[name="dosesperintake"]');
        if (dosesPerIntakeInput) {
            const dosesPerIntakeValue = dosesPerIntakeInput.value;
            const dosesPerIntakeIsOnlyDigits = /^\d+$/.test(dosesPerIntakeValue);

            if (!dosesPerIntakeValue || !dosesPerIntakeIsOnlyDigits) {
                event.preventDefault();
                alert('Number of doses per intake must be an integer.');
                return;
            }
        }

        // Sprawdzenie, czy "Time of intake" został podany
        const intakeTimeInput = document.querySelector('input[name="intake_time"]');
        if (intakeTimeInput && !intakeTimeInput.value) {
            event.preventDefault();
            alert('Please specify the time of intake.');
            return;
        }
    });
});