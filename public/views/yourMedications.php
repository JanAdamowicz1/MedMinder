<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_yourMedications.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>YOUR MEDICATIONS</title>
</head>
<body>
<div class="common-container">
    <div class="displayer">
        <a href="homePage">
            <i class="fa-solid fa-xmark"></i></i>
        </a>
        <h1>Your medications</h1>
        <div class="med_list">
            <?php foreach ($usersMedications as $pair): ?>
                <?php
                $userMedication = $pair['userMedication'];
                $medicationSchedule = $pair['medicationSchedule'];
                ?>
                <div class="displayer">
                    <div class="med_info">
                        <p id="user_medication_info">
                            <span id="medicationName"><?= $userMedication->getMedicationName(); ?></span>
                            <span id="dosesPerIntakeID"><?= $medicationSchedule->getDosesPerIntake(); ?></span>
                            x
                            <span id="doseID"><?= $userMedication->getDose(); ?></span>
                            mg
                            <span id="formID"><?= $userMedication->getForm(); ?></span>
                        </p>
                        <p id="dayOfWeek"><?= $medicationSchedule->getDayOfWeek();?></p>
                        <p class="time-display">
                            <span><i class="fa-solid fa-clock"></i></span>
                            <span id="timeOfday"><?= $medicationSchedule->getTimeOfDay(); ?></span>
                        </p>
                    </div>
                    <form action="deleteMedication" method="post">
                        <input type="hidden" name="scheduleid" value="<?=$medicationSchedule->getId(); ?>">
                        <input type="hidden" name="usermedicationid" value="<?=$userMedication->getId(); ?>">
                        <button type="submit" class="button">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
