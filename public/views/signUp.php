<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style_signUp.css">
    <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/validateEmail.js" defer></script>
    <title>SIGN UP</title>
</head>
<body>
    <div class="sign_up_container">
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
                    <p>Sign up</p>
                </div>
                <?php if (empty($_SESSION['user'])) : ?>
                <form class="signup" action="signUp" method="POST">
                    <p>E-mail</p>
                    <input name="email" type="email" placeholder=" E-mail">
                    <p>Password</p>
                    <input name="password" type="password" placeholder=" Password">
                    <p>Confirm password</p>
                    <input name="confirmedPassword" type="password" placeholder=" Confirm password">
                    <div class="text">
                        <?php
                            if (isset($messages)){
                                foreach($messages as $message) {
                                    echo $message;
                                }
                            }
                        ?>
                    </div>
                    <button type="submit" class="button">Sign up</button> 
                    <p class="already_text">Already have an account?
                        <a href="login">
                        <span class="highlight"> Log in</span>
                        </a>
                    </p>
                </form>
                <?php else : ?>
                    <?php
                    header('Location: ../homePage');
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>