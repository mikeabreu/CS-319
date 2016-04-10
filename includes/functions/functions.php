<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 4/7/2016
 * Time: 12:20 AM
 */

//include("includes/functions/session.php");

function confirm_logged_in() {
    if (!logged_in()) redirect("login.php");
}

function logged_in() {
    return $_SESSION["user_id"];
}

function redirect($url) {
    if (is_string($url))
        header('Location: '.$url);
    exit;
}