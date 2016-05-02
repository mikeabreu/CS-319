<?php # Script 8.6 - view_users.php #2
require_once "../includes/initialize.php";
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}
if (!$session->is_admin()) {
    redirect_to("index.php");
}

// This page lets a user change their password.
$page_title = 'View all users';
include(TEMPLATE_PATH . DS . 'header.php');
?>

<div class="center-align">
    <h1>Registered Users</h1>
</div>

<div class="row">
    <div class="col s10 offset-s1">
<?php
$users = User::find_all();

echo "<ul class=\"collection\">";
foreach ($users as $user) {
    echo "<li class=\"collection-item\">Username: " . $user->username . "</li>";
}
echo "</ul>";
?>
    </div>
</div>

<?php include(TEMPLATE_PATH . DS . 'footer.php'); ?>
