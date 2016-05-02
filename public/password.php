<?php # Script 8.7 - password.php
require_once "../includes/initialize.php";
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

// This page lets a user change their password.
$page_title = 'Change Your Password';
include(TEMPLATE_PATH . DS . 'header.php');

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

    $errors = array(); // Initialize an error array.

    // Check for an user:
    if (!$session->is_logged_in()) {
        $errors[] = 'You must be first signed in to change your password.';
    } else {
        $e = $_SESSION['user_id'];
    }

    // Check for the current password:
    if (empty($_POST['password'])) {
        $errors[] = 'You forgot to enter your current password.';
    } else {
        $p = $db->escape_value(trim($_POST['password']));
    }

    // Check for a new password and match
    // against the confirmed password:
    if (!empty($_POST['password1'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            $errors[] = 'Your new password did not match the confirmed password.';
        } else {
            $np = $db->escape_value(trim($_POST['password1']));
        }
    } else {
        $errors[] = 'You forgot to enter your new password.';
    }

    if (empty($errors)) { // If everything's OK.

        $user = User::authenticate($_SESSION['username'], $p);

        if ($user) {
            $user->password = $user->password_encrypt($np);
            User::save($user);
        } else { // If it did not run OK.
            // Public message:
            echo '<h1>System Error</h1>
			<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
        }

        // Include the footer and quit the script (to not show the form).
        include(TEMPLATE_PATH . DS . 'footer.php');
        exit();

    } else { // Invalid email address/password combination.
        echo '<h1>Error!</h1>
		<p class="error">The email address and password do not match those on file.</p>';
    }

} else { // Report the errors.

    // Print any error messages, if they exist:
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">
                        <strong>Error changing password.</strong><br />
                The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p></div>';
    }

} // End of if (empty($errors)) IF.
?>

<div class="row">
    <div class="col s10 offset-s1">
        <form class="" role="form" action="password.php" method="post">
            <h2 class="center-align">Change Your Password</h2>
            <input type="password" class="form-control" placeholder="Current Password" required name="password">
            <input type="password" class="form-control" placeholder="New Password" required name="password1">
            <input type="password" class="form-control" placeholder="New Password" required name="password2">
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Change Password</button>
            <input type="hidden" name="submitted" value="TRUE"/>
        </form>
    </div>
</div>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
