<?php # Script 8.5 - register.php #2
include('includes/functions/session.php');

$page_title = 'Register';
$valign = true;
include('includes/templates/header.php');
include('includes/helpers/Formatter.php');
$options["center"] = true;
$options["valign"] = true;

require_once('includes/functions/mysqli_connect.php'); // Connect to the db.

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

    $errors = array(); // Initialize an error array.

    // Check for user type id:
    if (empty($_POST["type_id"])) {
        $errors[] = 'You forgot to select a user type.';
    }

    // Check for a first name:
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    }

    // Check for a last name:
    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Check for a password and match against the confirmed password:
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) { // If everything's OK.
        $t = ($_POST['type_id']);

        // Register the user in the database...

        // Make the query:
        $q = "INSERT INTO users (user_type_id, first_name, last_name, email, pass, registration_date) VALUES ($t, '$fn', '$ln', '$e', SHA1('$p'), NOW() )";
        $r = @mysqli_query($dbc, $q); // Run the query.
        if ($r) { // If it ran OK.

            // Print a message:
            $name = $_POST["first_name"] . " " . $_POST["last_name"];
            $output_msg = '<h4>Thank you, '.$name.'!</h4><p>You are now registered!</p><p><br /></p><a class="btn waves-effect waves-light blue" href="login.php">Login</a>';
            echo $Formatter->format($output_msg, $options);

        } else { // If it did not run OK.

            // Public message:
            $output_msg = '<h4>System Error</h4><p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p><a class="btn waves-effect waves-light blue" href="register.php">Register</a>';
            echo $Formatter->format($output_msg, $options);

            // Debugging message:
            $output_msg = '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
            $options["card"] = true;
            $options["card_color"] = "red";
            $options["card_color_extra"] = "lighten-3";
            echo $Formatter->format($output_msg, $options);
//            unset($options["card"], $options["card_color"], $options["card_color_extra"]);

        } // End of if ($r) IF.

        mysqli_close($dbc); // Close the database connection.

        // Include the footer and quit the script:
        include('includes/templates/footer.php');
        exit();

    } else { // Report the errors.

        $output_msg = '<strong>Error!</strong>';
        $output_msg .= '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            $output_msg .= " - $msg<br />\n";
        }
        $output_msg .= '</p><p>Please try again.</p>';
        $options["center"] = false;
        $options["card"] = true;
        $options["card_color"] = "red";
        $options["card_color_extra"] = "lighten-3";
        $options["col"] = 's8 offset-s2 l6 offset-l3';
        echo $Formatter->format($output_msg, $options);

    } // End of if (empty($errors)) IF.

}

$types = array();

// Make the query:
$q = "SELECT user_type_id, type_name FROM user_types ORDER BY type_name ASC";

$result = mysqli_query($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($result);

if ($num > 0) { // If it ran OK, display the records.

    while ($row = mysqli_fetch_assoc($result)) {
        $types[] = $row;
    }

    mysqli_free_result($result); // Free up the resources.	
}

mysqli_close($dbc); // Close the database connection.
?>
<div class="row valign">

    <div class="row center-align">
        <div class="page-header">
            <h4>Register</h4>
        </div>
    </div>

    <form class="form" role="form" action="register.php" method="post">
        <div class="row">
            <div class="input-field col s8 offset-s2 l6 offset-l3 ">
                <select name="type_id">
                    <option value="" disabled selected>Choose your option</option>
                    <?php
                    foreach ($types as $type) {
                        echo "<option value=\"" . $type['user_type_id'] . "\">" . $type['type_name'] . "</option>\n";
                    }
                    ?>
                </select>
                <label>User Type</label>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="text" class="" required autofocus name="first_name" maxlength="40" placeholder="First Name"
                       value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"/>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="text" class="form-control" required name="last_name" placeholder="Last Name"
                       maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"/>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="text" class="form-control" required name="email" placeholder="Email Address"
                       maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="password" class="form-control" required name="pass1" placeholder="Password"
                       maxlength="20"/>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <input type="password" class="form-control" required name="pass2" placeholder="Confirm Password"
                       maxlength="20"/>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s8 offset-s2 l6 offset-l3">
                <button type="submit" name="submit" class="btn waves-effect waves-light green"/>Register
                    <i class="material-icons right">send</i>
                </button>
                <input type="hidden" name="submitted" value="TRUE"/>
            </div>
        </div>

    </form>

</div>
<?php
include('includes/templates/footer.php');
?>
