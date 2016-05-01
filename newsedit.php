<?php
include('includes/functions/session.php');
include('includes/functions/functions.php');
confirm_logged_in();

$page_title = 'News';
$valign = true;
include('includes/templates/header.php');
include('includes/helpers/Formatter.php');
$options["center"] = true;
$options["valign"] = true;

require_once('includes/functions/mysqli_connect.php'); // Connect to the db.

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

    $errors = array(); // Initialize an error array.

    // Check for a message:
    if (empty($_POST['msg_in_news_id'])) {
        $errors[] = 'You forgot to select the news content of today.';
    } else {
        $msgnews = mysqli_real_escape_string($dbc, trim($_POST['msg_in_news_id']));
    }

    if (empty($errors)) { // If everything's OK.
        $t = ($_POST['msg_in_news_id']);


        // Make the query:
        $q = "SELECT news_id, headline_in_news_id, data_time FROM News ORDER BY news_id DESC";
        $r = @mysqli_query($dbc, $q); // Run the query.
        if ($r) { // If it ran OK.

            // Print a message:
            //$name = $_POST["first_name"] . " " . $_POST["last_name"];
            $output_msg = '<h4>Thank you for posting this weeks news'.$name.'!</h4>
            <!--<p>You are now registered!</p><p><br /></p><a class="btn waves-effect waves-light blue" href="login.php">Login</a>';
            echo $Formatter->format($output_msg, $options);

        } else { // If it did not run OK.

            // Public message:
            $output_msg = '<h4>System Error</h4><p class="error">Something is wrong. We apologize for any inconvenience.</p><a class="btn waves-effect waves-light blue" href="news.php">Register</a>';
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
        //include('includes/templates/footer.php');
        //exit();

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

//$types = array();

?>





<div class="row valign">

        <div class="page-header">
            <div class="row center-align">
                <?php if (isset($logged_in) && $logged_in) { ?>
                    <li><a class="<?php echo X_TEXT_COLOR . " " . X_TEXT_SHADE;?>" href="newsadmincreate.php">Create a Post</a></li>
                    <li><a class="<?php echo X_TEXT_COLOR . " " . X_TEXT_SHADE;?>" href="newsedit.php">Edit/Delete a Post</a></li>
                    <li><a class="<?php echo X_TEXT_COLOR . " " . X_TEXT_SHADE;?>" href="news.php">Read News</a></li>
                <?php } else { // Start else?>
                    <li><a class="<?php echo X_TEXT_COLOR . " " . X_TEXT_SHADE;?>" href="login.php">Login</a></li>
                    <li><a class="<?php echo X_TEXT_COLOR . " " . X_TEXT_SHADE;?>" href="register.php">Register</a></li>
                <?php } // End if..else ?>
            <h4>News - Select a Post to Edit</h4>
        </div>
        </div>

    <form class="form" role="form" action="newsedit.php" method="post">

        <div class="row">
            <div class="input-field col s2 offset-s2 l6 offset-l3 ">
                <?php
                $dbc = mysqli_connect('localhost','cs319','cs319','cs319');
                if(!$dbc){
                    die("Cannot connect:" . mysqli_error());
                }
                mysqli_select_db($dbc,"cs319");
                // Make the query:
                $q1 = "SELECT news_id, headline_in_news_id, data_time FROM News ORDER BY news_id DESC";
                $result = mysqli_query($dbc, $q1); // Run the query.
                echo "<table border=1>
                    <tr>
                    <th>News_ID</th>
                    <th>Subject</th>
                    <th>Date & Time</th>
                    </tr>";

                while ($row = mysqli_fetch_array($result)) {

                    echo "<tr>";
                        echo "<td>" . $row['news_id'] . "</td>";
                        echo "<td>" . $row['headline_in_news_id'] . "</td>";
                        echo "<td>" . $row['data_time'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";


                mysqli_close($dbc);

                ?>

            </div>
        </div>

        <!--<div class="row center-align">
            <div class="input-field col s2 offset-s2 l6 offset-l3">
                <button type="submit" name="submit" class="btn waves-effect waves-light green">Submit
                    <!--<i class="material-icons right">send</i>
                </button>
                <input type="hidden" name="submitted" value="TRUE"/>
            </div>
        </div>
        -->
    </form>

</div>



<?php
include('includes/templates/footer.php');
?>