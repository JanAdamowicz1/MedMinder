<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_adminPanel.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>ADMIN PANEL</title>
</head>
<body>
<div class="admin_panel_container">
    <div class="displayer">
        <a href="homePage">
            <i class="fa-solid fa-xmark"></i></i>
        </a>
        <h1>Admin panel</h1>
        <h2>Add medication to database</h2>
        <form action="addMedToDatabase" method="POST">
            <div class="input_container">
                <select name="category" id="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category->getCategoryid()); ?>">
                            <?php echo htmlspecialchars($category->getCategoryname()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="medicationName" id="medicationName" placeholder=" Medication name">
            </div>
            <button type="submit" class="button">Add</button>
        </form>
        <div class="text">
            <?php
            if (isset($messages)){
                foreach ($messages as $message){
                    echo $message;
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
