<?php
include('includes/functions/session.php');
$page_title = 'Sign In';
$errors = "";
$valign = true;

if (isset($_POST['submitted'])) {

    require_once('includes/functions/login_functions.inc.php');
    require_once('includes/functions/mysqli_connect.php');
    list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

    if ($check) { // OK!
        session_save_path('');
        // Set the session data:.
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        $_SESSION['user_type_id'] = $data['user_type_id'];

        // Store the HTTP_USER_AGENT:
        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

        // Redirect:
        $url = absolute_url('index.php');
        header("Location: $url");
        exit();

    } else { // Unsuccessful!
        $errors = $data;
    }

    mysqli_close($dbc);
} // End of the main submit conditional.

include('includes/templates/header.php');
include('includes/helpers/Formatter.php'); // Used to format html content

// Formatter Options
$options["card"] = true;
$options["card_color"] = 'red';
$options["card_color_extra"] = 'lighten-3';
$options["col"] = 's8 offset-s2';
?>

<div class="row">

    <?php
    // Print any error messages, if they exist:
    if (!empty($errors)) {
        $output_msg = '<strong>Error signing in.</strong><br />The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            $output_msg .= " - $msg<br />\n";
        }
        $output_msg .= '</p><p>Please try again.</p>';
        echo $Formatter->format($output_msg, $options);
    }
    ?>

    <div class="row center-align">
        <h4>Sign in</h4>
    </div>

    <form action="login.php" method="post" class="" role="form">
        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="text" class="" placeholder="Email address" required autofocus name="email"
                       value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" data-error="wrong" data-success="success">
            </div>
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="password" class="" placeholder="Password" required name="pass" data-error="wrong" data-success="success">
            </div>
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <p>
                    <input type="checkbox" id="rememberme" />
                    <label for="rememberme">Remember Me</label>
                </p>
                <br />
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
include('includes/templates/footer.php');
?>