<?php
    session_start();
    require "includes/authentication.php";
    set_not_authenticated();
    header('Location: index.php');
?>