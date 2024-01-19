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
        <script src="./public/js/dynamicSidebar.js"></script>
        <script src="./public/js/changeDate.js"></script>
        <script src="./public/js/calendar.js" defer></script>
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
                    <a href="account">
                        <button class="button"><i class="fa-solid fa-user"></i> Account</button>
                    </a>
                    <a href="settings">
                        <button class="button"><i class="fa-solid fa-cog"></i> Settings</button>
                    </a>
                    <button class="button"><i class="fa-solid fa-question"></i> Help</button>
                    <button class="button"><i class="fa-solid fa-address-card"></i> Contact</button>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="adminPanel">
                        <button class="button"><i class="fa-solid fa-tools"></i> Admin Panel</button>
                    </a>
                    <?php endif; ?>
                    <a href="logout">
                        <button class="button"><i class="fa-solid fa-right-from-bracket"></i></i> Log out</button>
                    </a>
                </div>
            </nav>
            <div class="content">
                <div class="header">
                    <div class="user_info">
                        <div class="user_photo">
                            <?php if (isset($_SESSION['image'])): ?>
                                <img src="public/uploads/<?php echo $_SESSION['image']; ?>">
                            <?php else: ?>
                                <img src="public/assets/user_photo.svg">
                            <?php endif; ?>
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
                    <div class="notifications">
                        <i class="fa-solid fa-bell" onclick="openDesktopNotifications()"></i>
                    </div>
                </div>
                <div id="mySidepanel" class="sidepanel">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="account">
                        <button class="button"><i class="fa-solid fa-user"></i> Account</button>
                    </a>
                    <a href="yourMedications">
                        <button class="button"><i class="fa-solid fa-capsules"></i>Your medications</button>
                    </a>
                    <a href="settings">
                        <button class="button"><i class="fa-solid fa-cog"></i> Settings</button>
                    </a>
                    <button class="button"><i class="fa-solid fa-question"></i> Help</button>
                    <button class="button"><i class="fa-solid fa-address-card"></i> Contact</button>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="adminPanel">
                        <button class="button"><i class="fa-solid fa-tools"></i> Admin Panel</button>
                    </a>
                    <?php endif; ?>
                    <button class="button"><a href="logout"><i class="fa-solid fa-right-from-bracket"></i></i> Log out</a></button>
                </div>
                <div class = "main_content">
                    <div class = "content_left">
                        <div class="buttons_container">
                            <button class="button" id="todayButton">Today</button>
                            <button class="button" onclick="openCalendar()">Calendar</button>
                        </div>
                        <div id="sideCalendar" class="sidepanel">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeCalendar()">&times;</a>
                            <div class="calendar-controls">
                                <button class="button prev-month"><i class="fa-solid fa-arrow-left"></i></button>
                                <span class="calendar-title">November 2023</span>
                                <button class="button next-month"><i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                            <div class="calendar" id="calendar_mobile"></div>
                        </div>
                        <div class="date">
                            <div class="displayer">
                                <p id="todayText">Today</p>
                                <p id="displayDate"><?= date("l, F jS") ?></p>
                            </div>
                        </div>
                        <h4>Your today's plan:</h4>
                        <div class="med_list">
                        </div>
                        <div class="bottom_buttons_container">
                            <button class="button" id="yesterday"><i class="fa-solid fa-arrow-left"></i>Yesterday</button>
                            <button class="button" id="tomorrow">Tomorrow<i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="content_right">
                        <a href="yourMedications">
                            <button class="button"><i class="fa-solid fa-capsules"></i>Your medications</button>
                        </a>
                        <div class="calendar-controls">
                            <button class="button prev-month"><i class="fa-solid fa-arrow-left"></i></button>
                            <span class="calendar-title">November 2023</span>
                            <button class="button next-month"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <div class="calendar" id="calendar_desktop"></div>
                        <a href="addMed">
                            <button class="button"><i class="fa-solid fa-circle-plus"></i>Add medication</button>
                        </a>
                    </div>
                </div>
                <div class="bottom_bar">
                    <a href="account">
                    <div class="account">
                        <i class="fa-solid fa-user"></i>
                        <p>Account</p>
                    </div>
                    </a>
                    <a href="addMed">
                    <div class="add_med">
                        <i class="fa-solid fa-plus"></i>
                        <p>Add medication</p>
                    </div>
                    </a>
                    <div class="notifications" onclick="openMobileNotifications()">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notifications</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="notifications" class="sidepanel">
            <form action="setAllAsRead" method="POST">
                <button class="button" type="submit">Set all as read</button>
            </form>
            <div id="notifications_list">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNotifications()">&times;</a>
                <?php foreach ($notifications as $notification): ?>
                    <div class="displayer">
                        <p id="message" class="<?php echo $notification->isStatus() ? 'state-true': 'state-false'; ?>">
                            <?= $notification->getMessage() ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>


<template id="usermedications_template">
<!--    --><?php
//    $userMedication = $pair['userMedication'];
//    $medicationSchedule = $pair['medicationSchedule'];
//    ?>
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