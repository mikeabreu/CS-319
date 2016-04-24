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
        $errors[] = 'You forgot to enter the news content of today.';
    } else {
        $msgnews = mysqli_real_escape_string($dbc, trim($_POST['msg_in_news_id']));
    }

    if (empty($errors)) { // If everything's OK.
        $t = ($_POST['msg_in_news_id']);


        // Make the query:
        $q = "INSERT INTO News (msg_in_news_id) VALUES ($pt, '$gn', '$hl', '$msgnews' )";
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
$q = "SELECT game_type_id, platform_type FROM game_id_name ORDER BY platform_type DESC";

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
                    //Connect to the database again
                $dbc = mysqli_connect('localhost','cs319','cs319','cs319');
                //require_once('includes/functions/mysqli_connect.php');
                //$types = array();
                //Query the database

                // Performing SQL query
                $q1 = "SELECT news_id, headline_in_news_id, data_time FROM News	WHERE 1";
                $result = mysqli_query($dbc, $q1); // Run the query.
                //$data = mysqli_fetch_array($result, MYSQLI_ASSOC);

                //Count the returned rows
                $num = mysqli_num_rows($result);
                if($num > 0) {
                //Turn the results into an array
                    while ($row = mysqli_fetch_row($result)) {

                        //echo "<pre>.$data[news_id]</pre>";

                        $types[] = $row;
                        //$news_id = $row['news_id'];   
                        //$data_time = $row['data_time'];
                        //$headline_in_news_id = $row['headline_in_news_id'];
                        echo "News ID: ".$data['news_id']."\n";
                        echo "Date Created: ".$data['data_time']."\n";
                        echo "Subject: ".$data['headline_in_news_id']."\n";
                    }
                }
                else{
                    echo "No return";
                }

                mysqli_close($dbc); // Close the database connection.

                ?>
                    <form action="show_id">
                        <p>
                            <input name="group1" type="radio" id="test1" />
                            <label for="test1">Red</label>
                        </p>
                        <p>
                            <input name="group1" type="radio" id="test2" />
                            <label for="test2">Yellow</label>
                        </p>
                        <p>
                            <input class="with-gap" name="group1" type="radio" id="test3"  />
                            <label for="test3">Green</label>
                        </p>
                        <p>
                            <input name="group1" type="radio" id="test4" disabled="disabled" />
                            <label for="test4">Brown</label>
                        </p>
                    </form>

                    <?php
                    foreach ($types as $type) {
                        echo "<option value=\"" . $type['platform_type'] . "\">" . $type['platform_type'] . "</option>\n";
                    }
                    ?>
                <br></br>
            </div>
        </div>

        <div class="row center-align">
            <div class="input-field col s2 offset-s2 l6 offset-l3">
                <button type="submit" name="submit" class="btn waves-effect waves-light green">Submit
                    <!--<i class="material-icons right">send</i>-->
                </button>
                <input type="hidden" name="submitted" value="TRUE"/>
            </div>
        </div>

    </form>

</div>



<!--<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>CREATE A POST</th>
        <th></th>
        <th>EDIT/DELETE A POST</th>
        <th></th>
        <th>READ NEWS</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</table>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-yw4l{vertical-align:top}
</style>

<!--<table class="tg">
    <tr>
        <th class="tg-baqh"></th>
        <th class="tg-baqh">CREATE A POST</th>
        <th class="tg-baqh"></th>
        <th class="tg-baqh">EDIT/DELETE A POST</th>
        <th class="tg-baqh"></th>
        <th class="tg-baqh">READ NEWS</th>
        <th class="tg-baqh"></th>
    </tr>
</table>
<br></br>
<div class="container">
<div class="row">
<div class="row">
    <div class="col s12">
<form action="news.php">

    <div class="input-field col s12">
        <select>
            <option value="" disabled selected>Choose the Game Type</option>
            <option value="1">XBox One</option>
            <option value="2">PS4</option>
            <option value="3">PC</option>
        </select>
        <label>Platform Select</label>
        <select>
            <!-- Need to tie this to the game list directly so it shows up automatically
            <option value="" disabled selected>Choose the Game</option>
            <option value="1">Call Of Duty</option>
            <option value="2">Formula One</option>
            <option value="3">FallOut 4</option>
        </select>
        <label>Platform Select</label>
    </div>
    Subject:<br>
    <input type="text" name="headline" value=""><br>
    Post:<br>
    <form action="./news.php">
            <textarea name="msg_in_iD" cols="300" rows="50" style="border:3px solid #F7730E;">
            </textarea>
        <br />
    </form>
    <input type="submit" name="submit" value="submit">
</form>
    </div>
</div>
<br> </br>
</div>

</div>
</div>

<?php
include('includes/templates/footer.php');
?>

