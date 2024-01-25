<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_dosageSchedule.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/correctSchedule.js"></script>
    <title>DOSAGE SCHEDULE</title>
</head>
<body>
<div class="common-container">
    <div class="displayer">
        <h1>Set dosage schedule</h1>
        <form action="dosageSchedule" method="POST">
            <input type="hidden" name="medicationId" value="<?= htmlspecialchars($userMedication->getId()) ?>">
            <p>Day</p>
            <select name="day" id="day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <p>Number of doses per intake</p>
            <input type="text" name="dosesperintake" placeholder=" Number of doses per intake">
            <p>Time of intake</p>
            <input type="time" name="intake_time" id="intake_time">
            <div class="buttons_container">
                <button type="submit" class="button">Add medication</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
