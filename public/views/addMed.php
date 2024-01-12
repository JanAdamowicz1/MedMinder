<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_addMed.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/correctInputs.js"></script>
    <script type="text/javascript" src="./public/js/dynamicMedications.js" defer></script>
    <title>ADD MED</title>
</head>
<body>
<div class="add_med_container">
    <div class="displayer">
        <a href="homePage">
            <i class="fa-solid fa-xmark"></i></i>
        </a>
        <h1>What medication would you like to add?</h1>
        <form action="addMed" method="POST">
            <p>Category</p>
            <select name="category" id="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category->getCategoryname()); ?>">
                        <?php echo htmlspecialchars($category->getCategoryname()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p>Name</p>
            <select name="medicationName" id="medication">
                <?php foreach ($medications as $medication): ?>
                    <option value="<?php echo htmlspecialchars($medication->getMedicationname()); ?>" id="medication_option">
                        <?php echo htmlspecialchars($medication->getMedicationname()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p>Form</p>
            <input type="text" name="form" placeholder=" Form">
            <p>Dose (mg)</p>
            <input type="text" name="dose" placeholder=" Dose (mg)">
            <div class="buttons_container">
                <button type="submit" class="button">Next</button>
            </div>
        </form>
        <div class="buttons_container">
            <p>Can't find your medication?</p>
            <a href="addCustomMed">
                <button type="button" class="button">Add custom medication</button>
            </a>
        </div>
    </div>
</div>
</body>

<template id="med_template">
    <option id="medication_option">
        value
    </option>
</template>
</html>