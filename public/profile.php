<?php
require_once "../includes/initialize.php";
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

$page_title = 'Profile';
$admin_view = $session->is_admin();
include(TEMPLATE_PATH . DS . 'header.php');

?>

<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Profile Page</h1>
            <div class="center-align">
                <?php if ($admin_view) { ?>
                    <p><a href="view_users.php">View all users</a></p>
                    <p><a href="password.php">Change your password</a></p>
                <?php } else { ?>
                    <a href="password.php">Change your password</a>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
