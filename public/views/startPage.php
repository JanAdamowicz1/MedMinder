<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_startPage.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>START PAGE</title>
</head>
<body>
    <div class="common-container">
        <div class="elements">
            <div class="logo">
                <img src="public/assets/eclipse.svg">
                <img src="public/assets/logo.svg">
            </div>
            <div class="text">
                <h1>Welcome to Med<span class="highlight">Minder</span>!</h1>
                <p>Your personal Med Reminder</p>
            </div>
            <div class="buttons_container">
                <?php if (empty($_SESSION['user'])) : ?>
                <a href="signUp">
                    <button class="button">Sign up</button>
                </a>
                <a href="login">
                    <button class="button">Log in</button>
                </a>
                <?php else : ?>
                    <?php
                    header('Location: ../homePage');
                    exit;
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>