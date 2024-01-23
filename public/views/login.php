<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_login.css">
    
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <title>LOG IN</title>
</head>
<body>
    <div class="common-container">
        <a href="startPage">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="pill_logo">
            <img src="public/assets/pill.svg">
        </div>
        <div class="elements">
            <div class="logo">
                <img src="public/assets/eclipse.svg">
                <img src="public/assets/logo.svg">
            </div>
            <div class="form_container">
                <div class="text">
                    <p>Log in</p>
                </div>
                <?php if (empty($_SESSION['user'])) : ?>
                <form class="login" action="login" method="POST">
                    <p>E-mail</p>
                    <input name="email" type="text" placeholder=" E-mail">
                    <p>Password</p>
                    <input name="password" type="password" placeholder=" Password">
                    <div class="text">
                        <?php 
                            if (isset($messages)){
                                foreach ($messages as $message){
                                    echo $message;
                                }
                            }
                        ?>
                    </div>
                    <button type="submit" class="button">Log in</button>
                </form>
                <?php else : ?>
                    <?php
                    header('Location: ../homePage');
                    ?>
                <?php endif; ?>
            </div>
            <p class="no_acc_text">Don't have an account?
                <a href="signUp">
                    <span class="highlight"> Sign up</span>
                </a>
            </p>
        </div>
    </div>
</body>
</html>
