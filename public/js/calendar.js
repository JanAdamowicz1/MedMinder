function getDay(date) {
    var day = date.getDay();
    if (day == 0) day = 7;
    return day - 1;
}

function createCalendar(classSelector, year, month) {
    var calendars = document.querySelectorAll(classSelector);
    var mon = month - 1;
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Ustawienie godziny na 0, aby porównać tylko datę

    calendars.forEach(calendar => {
        var d = new Date(year, mon);
        var table = '<table><tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr><tr>';

        for (let i = 0; i < getDay(d); i++) {
            table += '<td class="past"></td>';
        }

        while (d.getMonth() == mon) {
            let day = d.getDate();
            let isPast = d < today; // Sprawdzenie, czy data jest w przeszłości
            table += `<td data-date="${day}" ${isPast ? 'class="past"' : ''}>${day}</td>`;

            if (getDay(d) % 7 == 6) {
                table += '</tr><tr>';
            }

            d.setDate(day + 1);
        }

        if (getDay(d) != 0) {
            for (let i = getDay(d); i < 7; i++) {
                table += '<td class="past"></td>';
            }
        }

        table += '</tr></table>';
        calendar.innerHTML = table;

        // Usunięcie obsługi zdarzenia kliknięcia dla dat w przeszłości
        calendar.querySelectorAll('td[data-date]').forEach(td => {
            let selectedDay = td.getAttribute('data-date');
            let selectedDate = new Date(year, mon, selectedDay);

            if (selectedDate >= today) {
                td.addEventListener('click', function() {
                    currentYear = year;
                    currentMonth = month;
                    document.dispatchEvent(new CustomEvent('dateSelected', { detail: selectedDate }));
                });
            }
        });
    });
}

let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth() + 1;

function updateCalendarTitle(year, month) {
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
    document.querySelectorAll('.calendar-title').forEach(titleElem => {
        titleElem.innerText = `${monthNames[month - 1]} ${year}`;
    });
}

function refreshCalendar() {
    createCalendar(".calendar", currentYear, currentMonth);
    updateCalendarTitle(currentYear, currentMonth);

    const today = new Date();
    const isCurrentMonth = currentYear === today.getFullYear() && currentMonth === today.getMonth() + 1;
    document.querySelectorAll('.prev-month').forEach(button => {
        button.style.visibility = isCurrentMonth ? 'hidden' : 'visible';
    });
}

document.querySelectorAll('.prev-month').forEach(button => {
    button.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        }
        refreshCalendar();
    });
});

document.querySelectorAll('.next-month').forEach(button => {
    button.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        refreshCalendar();
    });
});

window.onload = function() {
    refreshCalendar();
}
