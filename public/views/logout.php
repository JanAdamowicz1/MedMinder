<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['username']);
unset($_SESSION['image']);
unset($_SESSION['role']);
session_destroy();

header("Location: ../startPage");
exit;
?>
