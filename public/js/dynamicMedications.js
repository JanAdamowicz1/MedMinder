document.addEventListener('DOMContentLoaded', function() {
    const search = document.querySelector('#category');
    const medicationContainer = document.querySelector("#medication");

    function loadMedicationsForSelectedCategory() {
        const selectedCategory = search.value;
        console.log("Początkowo wybrana kategoria:", selectedCategory);

        const data = {search: selectedCategory};
        console.log("Wysyłanie danych do serwera:", data);

        fetch("/showMedsToCategory", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            console.log("Odpowiedź serwera:", response);
            return response.json();
        }).then(function (medications) {
            console.log("Przetworzone leki:", medications);
            medicationContainer.innerHTML = "";
            loadMedications(medications);
        });
    }

    function loadMedications(medications) {
        console.log("Ładowanie leków:", medications);
        medications.forEach(medication => {
            console.log(medication);
            createMedication(medication);
        });
    }

    function createMedication(medication) {
        console.log("Tworzenie opcji leku:", medication);
        const template = document.querySelector("#med_template");
        const clone = template.content.cloneNode(true);
        const medName = clone.querySelector("#medication_option");
        medName.innerText = medication.medicationname;

        medicationContainer.appendChild(clone);
    }

    // Wywołanie funkcji inicjalizującej po załadowaniu strony
    loadMedicationsForSelectedCategory();

    // Dodanie nasłuchiwacza na zmianę wybranej kategorii
    search.addEventListener("change", function (event) {
        loadMedicationsForSelectedCategory();
    });
});