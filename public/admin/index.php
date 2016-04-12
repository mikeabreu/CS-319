<?php
// Include constants, classes and functions
require_once "../../includes/initialize.php";
// Check if user is logged in
if (!$session->is_logged_in()) {
    redirect_to("../login.php");
}

// Header
include_layout_template(LIB_PATH.DS.'templates'.DS.'header.php');

