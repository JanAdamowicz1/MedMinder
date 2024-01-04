<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/style_addCustomMed.css">
        <script src="https://kit.fontawesome.com/c630670396.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="./public/js/CorrectInputs.js"></script>
        <title>ADD MED</title>
    </head>
    <body>
        <div class="add_custom_med_container">
            <div class="displayer">
                <a href="homePage">
                    <i class="fa-solid fa-xmark"></i></i>
                </a>
                <h1>Add custom medication</h1>
                <form action="addCustomMed" method="POST">
                    <p>Name*</p>
                    <input name="medicationName" type="text" placeholder=" Name">
                    <p>Form</p>
                    <input name="form" type="text" placeholder=" Form">
                    <p>Dose (mg)</p>
                    <input name="dose" type="text" placeholder=" Dose (mg)">
                    <div class="buttons_container">
                        <button type="submit" class="button">Next</button>
                    </div>
                </form>
                <p>* required field</p>
            </div>
        </div>
    </body>
</html>