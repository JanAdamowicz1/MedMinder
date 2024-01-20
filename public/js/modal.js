document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById("helpModal");
    var btns = document.querySelectorAll(".button.help");
    var span = document.getElementsByClassName("close")[0];

    btns.forEach(btn => {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});