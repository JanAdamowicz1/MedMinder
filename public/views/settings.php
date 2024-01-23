<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_settingsPage.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>SETTINGS</title>
</head>
<body>
<div class="common-container">
    <div class="displayer">
        <a href="homePage">
            <i class="fa-solid fa-xmark"></i></i>
        </a>
        <h1>Settings</h1>
        <h2>Notifications</h2>
        <form action="changeNotificationSetting" method="post">
            <div class="checkbox_container">
                <p>Enable Notifications:</p>
                <input type="checkbox" name="notifications" class="checkbox" <?php echo $userNotificationsEnabled ? 'checked' : ''; ?>>
            </div>
            <button class="button" type="submit">Save</button>
        </form>
    </div>
</div>
</body>
</html>