document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;
    fetch('/../src/controllers/MedicationController.php/getMedicationsByCategory?category_id=' + categoryId)
        .then(response => response.json())
        .then(data => {
            var medicationSelect = document.getElementById('medication');
            medicationSelect.innerHTML = '';
            data.forEach(function(medication) {
                var option = document.createElement('option');
                option.value = medication.medicationid;
                option.textContent = medication.medicationname;
                medicationSelect.appendChild(option);
            });
        });
});