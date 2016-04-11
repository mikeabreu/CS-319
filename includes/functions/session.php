<?php
session_start();
$user_name = "CS-319";
$is_admin = false;
$logged_in = false;

if (isset($_SESSION['user_id'])) {
	$logged_in = true;
	$_SESSION["user_name"] = $user_name = 'Hello ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];


	if (isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 1) {
		$is_admin = true;
	}
}

?>