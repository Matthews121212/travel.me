<?php
session_start();
require "includes/authentication.php";
if (is_authenticated()) {
    set_not_authenticated();
    header('Location: index.php');
}
