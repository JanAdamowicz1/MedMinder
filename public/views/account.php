<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_account.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>ACCOUNT</title>
</head>
<body>
<div class="common-container">
    <div class="displayer">
        <a href="homePage">
            <i class="fa-solid fa-xmark"></i>
        </a>
        <h1>Your account</h1>
        <div class="picture">
            <img src="public/uploads/<?= $user->getImage() ?>">
        </div>
        <form action="changePhoto" ENCTYPE="multipart/form-data" method="POST">
            <input type="file" name="file">
            <button class="button" type="submit">Change photo</button>
        </form>
        <h1>Email</h1>
        <h2><?= $user->getEmail() ?></h2>
        <h1>Username</h1>
        <h2><?= $user->getUsername() ?></h2>
        <h1>Name</h1>
        <?php if (!empty($user->getFirstname()) || !empty($user->getLastname())): ?>
            <h2><?= htmlspecialchars($user->getFirstname()) . " " . htmlspecialchars($user->getLastname()) ?></h2>
        <?php else: ?>
            <h2>Not provided</h2>
        <?php endif; ?>
        <div class="forms_container">
            <div class="input_container">
                <form action="changeUsername" method="POST">
                    <input type="text" name="username" placeholder=" Username">
                    <button class="button" type="submit">Change username</button>
                </form>
            </div>
            <div class="input_container">
                <form action="changeName" method="POST">
                    <input type="text" name="firstname" placeholder=" First name">
                    <input type="text" name="lastname" placeholder=" Last name">
                    <button class="button" type="submit">Change name</button>
                </form>
            </div>
        </div>
        <div class="text">
            <?php
            if(isset($messages)){
                foreach($messages as $message) {
                    echo $message;
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
