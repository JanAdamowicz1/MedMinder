<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sprawdź, czy sesja jest aktywna
if (empty($_SESSION['user'])) {
    header('Location: ../startPage');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/style_homePage.css">
        <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
        <script src="./public/js/menu.js"></script>
        <script src="./public/js/changeDate.js"></script>
        <title>HOME PAGE</title>
    </head>
    <body>
        <div class="home_page_container">
            <nav class="navbar">
                <div class="logo">
                    <img src="public/assets/eclipse.svg">
                    <img src="public/assets/logo.svg">
                </div>
                <h1>Med<span class="highlight">Minder</span></h1>
                <div class="buttons_container">
                    <button class="button"><i class="fa-solid fa-user"></i> Account</button>
                    <button class="button"><i class="fa-solid fa-calendar"></i> Calendar</button>
                    <button class="button"><i class="fa-solid fa-cog"></i> Settings</button>
                    <button class="button"><i class="fa-solid fa-question"></i> Help</button>
                    <button class="button"><i class="fa-solid fa-address-card"></i> Contact</button>
                    <a href="logout">
                        <button class="button"><i class="fa-solid fa-right-from-bracket"></i></i> Log out</button>
                    </a>
                </div>
            </nav>
            <div class="content">
                <div class="header">
                    <div class="user_info">
                        <div class="user_photo">
                            <img src="public/assets/user_photo.svg">
                        </div>  
                        <div class="user_text">
                            <p>Hello,</p>
                            <?php if (isset($_SESSION['username'])): ?>
                            <p><?= htmlspecialchars($_SESSION['username']) ?>!</p>
                            <?php else: ?>
                                <p>Guest!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="menu_icon">
                        <button class="button" onclick="openNav()"><i class="fa-solid fa-bars"></i></button>
                    </div>
                </div>
                <div id="mySidepanel" class="sidepanel">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <button class="button"><i class="fa-solid fa-user"></i> Account</button>
                    <button class="button"><i class="fa-solid fa-calendar"></i> Calendar</button>
                    <button class="button"><i class="fa-solid fa-cog"></i> Settings</button>
                    <button class="button"><i class="fa-solid fa-question"></i> Help</button>
                    <button class="button"><i class="fa-solid fa-address-card"></i> Contact</button>
                    <button class="button"><a href="logout"><i class="fa-solid fa-right-from-bracket"></i></i> Log out</a></button>

                </div>
                <div class = "main_content">
                    <div class = "content_left">
                        <div class="buttons_container">
                            <button class="button" id="todayButton">Today</button>
                            <button class="button">Calendar</button>
                        </div>
                        <div class="date">
                            <div class="displayer">
                                <p id="todayText">Today</p>
                                <p id="displayDate"><?= date("l, F jS") ?></p>
                            </div>
                        </div>
                        <h4>Your today's plan:</h4>
                        <div class="med_list">
                            <?php foreach ($usersMedications as $pair): ?>
                                <?php
                                $userMedication = $pair['userMedication'];
                                $medicationSchedule = $pair['medicationSchedule'];
                                ?>
                                <div class="displayer">
                                    <div class="left-text">
                                        <p><?= $userMedication->getMedicationName(); ?></p>
                                        <p>
                                            <span id="dosesPerIntakeID"><?= $medicationSchedule->getDosesPerIntake(); ?></span>
                                            x
                                            <span id="doseID"><?= $userMedication->getDose(); ?></span>
                                            mg
                                            <span id="formID"><?= $userMedication->getForm(); ?></span>
                                        </p>
                                    </div>
                                    <div class="right-text">
                                        <p><i class="fa-solid fa-clock"></i> <?= $medicationSchedule->getTimeOfDay(); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="bottom_buttons_container">
                            <button class="button" id="yesterday"><i class="fa-solid fa-arrow-left"></i> Yesterday</button>
                            <button class="button" id="tomorrow">Tomorrow <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="content_right">
                    </div>
                </div>
                <div class="bottom_bar">
                    <div class="account">
                        <i class="fa-solid fa-user"></i>
                        <p>Account</p>
                    </div>
                    <a href="addMed">
                    <div class="add_med">
                        <i class="fa-solid fa-plus"></i>
                        <p>Add medication</p>
                    </div>
                    </a>
                    <div class="notifications">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notifications</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
<template id="usermedications_template">
    <?php
    $userMedication = $pair['userMedication'];
    $medicationSchedule = $pair['medicationSchedule'];
    ?>
    <div class="displayer">
        <div class="left-text">
            <p id="medicationName">medicationName</p>
            <p>
                <span id="dosesPerIntake">dosesPerIntake</span>
                x
                <span id="dose">dose</span>
                mg
                <span id="form">form</span>
            </p>
        </div>
        <div class="right-text">
            <p><i class="fa-solid fa-clock"></i> timeOfDay</p>
        </div>
    </div>
</template>
</html>