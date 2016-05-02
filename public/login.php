<?php
require_once '../includes/initialize.php';
if ($session->is_logged_in()) { redirect_to("index.php"); }

$page_title = 'Sign In';
$valign = true;
$message = "";

if (isset($_POST['submitted'])) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        # Attempt Login
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        # Check database to see if username/password exist.
        $found_user = User::authenticate($username, $password);

        # Actions
        if ($found_user) {
            # Success
            $session->login($found_user);
            // redirect_to("index.php");
        }
        else {
            # Failure
            $message = "Username/password combination was not found.";
        }
    }
}

include(TEMPLATE_PATH . DS . 'header.php');

// Formatter Options
$options["card"] = true;
$options["card_color"] = 'red';
$options["card_color_extra"] = 'lighten-3';
$options["col"] = 's8 offset-s2';
?>

    <div class="row">

        <?php
        // Print any error messages, if they exist:
        if (!empty($message)) {
            $output_msg  = '<strong>Error signing in.</strong><br />The following error(s) occurred:<br />';
            $output_msg .= '<p>'.$message.'</p>';
            $output_msg .= '<p>Please try again.</p>';
            echo $Formatter->format($output_msg, $options);
        }
        ?>

        <div class="row center-align">
            <h4>Sign in</h4>
        </div>

        <form action="login.php" method="post" class="" role="form">
            <div class="row center-align">
                <div class="input-field col s8 offset-s2 l6 offset-l3">
                    <input type="text" class="" placeholder="Email address" required autofocus name="username"
                           value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" data-error="wrong"
                           data-success="success">
                </div>
                <div class="input-field col s8 offset-s2 l6 offset-l3">
                    <input type="password" class="" placeholder="Password" required name="pass" data-error="wrong"
                           data-success="success">
                </div>
                <div class="input-field col s8 offset-s2 l6 offset-l3">
                    <p>
                        <input type="checkbox" id="rememberme"/>
                        <label for="rememberme">Remember Me</label>
                    </p>
                    <br/>
                </div>
                <div class="input-field col s8 offset-s2 l6 offset-l3">
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                    <input type="hidden" name="submitted" value="TRUE"/>
                    <a class="btn waves-effect waves-light blue" href="register.php">Register</a>
                </div>
            </div>
        </form>

    </div>


<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
