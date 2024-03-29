document.addEventListener('DOMContentLoaded', (event) => {
    let currentDate = new Date();
    // Zachowaj oryginalną datę (dzisiejszą) do porównań
    const originalDate = new Date();

    const displayDateElement = document.getElementById('displayDate');
    const todayText = document.getElementById('todayText');
    const yesterdayButton = document.getElementById('yesterday');
    const tomorrowButton = document.getElementById('tomorrow');
    const todayButton = document.getElementById('todayButton');
    const usersMedicationContainer = document.querySelector(".med_list");


    // Funkcja do pobierania leków użytkownika dla wybranego dnia
    function fetchMedicationsForSelectedDay() {
        const displayDateElement = document.querySelector('#displayDate');
        const fullDateText = displayDateElement.textContent;
        const dayOfWeek = fullDateText.split(',')[0];

        const data = {dayOfWeek: dayOfWeek};
        console.log("Wybrany dzień tygodnia:", data);

        // Wywołanie API do pobrania leków
        fetch("/showUsersMedicationsToCurrentDay", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            console.log("Odpowiedź serwera:", response);
            return response.json();
        }).then(function (userMedications) {
            console.log("Przetworzone leki:", userMedications);
            usersMedicationContainer.innerHTML = "";
            loadUserMedications(userMedications)
        });
    }

    // Funkcja do ładowania leków użytkownika na stronę
    function loadUserMedications(userMedications) {
        console.log("Otrzymane leki:", userMedications);
        userMedications.forEach(userMedication => {
            console.log(userMedication);
            createUserMedication(userMedication);
        });
    }

    // Funkcja do tworzenia pojedynczego elementu leku
    function createUserMedication(userMedication) {
        const template = document.querySelector("#usermedications_template");

        const clone = template.content.cloneNode(true);
        const medicationname = clone.querySelector("#medicationName");
        medicationname.innerText = userMedication.medicationname;
        const dosesperintake = clone.querySelector("#dosesPerIntake");
        dosesperintake.innerHTML = userMedication.dosesperintake;
        const dose = clone.querySelector("#dose");
        dose.innerHTML = userMedication.dose;
        const form = clone.querySelector("#form");
        form.innerText = userMedication.form;
        const timeOfDay = clone.querySelector(".fa-clock").nextSibling;
        if (timeOfDay) {
            const timeString = userMedication.timeofday;
            const timeParts = timeString.split(':');
            const formattedTime = `${timeParts[0]}:${timeParts[1]}`;
            timeOfDay.nodeValue = ' ' + formattedTime;
        }

        usersMedicationContainer.appendChild(clone);
    }

    // Funkcja do aktualizacji wyświetlanej daty
    function updateDisplayDate() {
        const options = { weekday: 'long', month: 'long', day: 'numeric' };
        displayDateElement.textContent = currentDate.toLocaleDateString('en-US', options);

        // Pokaż/Ukryj tekst "Today"
        todayText.style.visibility = isToday() ? 'visible' : 'hidden';

        // Ukryj przycisk "Yesterday", jeśli jest dzisiaj
        yesterdayButton.style.visibility = isToday() ? 'hidden' : 'visible';
    }

    // Funkcja sprawdzająca, czy wyświetlana data to dzisiejsza data
    function isToday() {
        return currentDate.toDateString() === originalDate.toDateString();
    }

    // Dodaj zdarzenie kliknięcia dla przycisku "Today"
    todayButton.addEventListener('click', () => {
        currentDate = new Date(originalDate); // Ustaw dzisiejszą datę
        updateDisplayDate();
        fetchMedicationsForSelectedDay();
    });

    // Dodaj zdarzenie kliknięcia dla przycisku "Yesterday"
    yesterdayButton.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() - 1);
        updateDisplayDate();
        fetchMedicationsForSelectedDay();
    });

    // Dodaj zdarzenie kliknięcia dla przycisku "Tomorrow"
    tomorrowButton.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() + 1);
        updateDisplayDate();
        fetchMedicationsForSelectedDay();
    });

    document.addEventListener('dateSelected', (event) => {
        let newDate = event.detail;
        currentDate.setFullYear(newDate.getFullYear(), newDate.getMonth(), newDate.getDate());
        updateDisplayDate();
        fetchMedicationsForSelectedDay();
    });

    // Ustaw początkową datę
    updateDisplayDate();
    fetchMedicationsForSelectedDay();
});