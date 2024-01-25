document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById("helpModal");
    var btns = document.querySelectorAll(".button.help");
    var span = document.getElementsByClassName("close")[0];

    btns.forEach(btn => {
        btn.onclick = function() {
            // Wyświetla modal ustawiając jego styl display na 'block'
            modal.style.display = "block";
        }
    });

    // Dodaje zdarzenie onclick do elementu span (przycisk zamykający)
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Dodaje zdarzenie onclick do okna
    window.onclick = function(event) {
        // Sprawdza, czy kliknięto miejsce poza modalem
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});