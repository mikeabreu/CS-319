<?php # Script 8.6 - view_users.php #2
require_once "../includes/initialize.php";
if (!$session->is_logged_in) {
    redirect_to("login.php");
}
if (!$sesssion->is_admin()) {
    redirect_to("index.php");
}

// This page lets a user change their password.

$page_title = 'View all users';
include(TEMPLATE_PATH . DS . 'header.php');

// Page header:
echo '<h1>Registered Users</h1>';

$users = User::find_all();

echo "<ul>";
foreach ($users as $user) {
    echo "<li>Full name: " . $user->first_name . " " . $user->last_name . "</li>";
}
echo "</ul>";

include(TEMPLATE_PATH . DS . 'footer.php');
?>
