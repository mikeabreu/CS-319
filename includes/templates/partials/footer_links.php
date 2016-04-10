<?php

// Load constants for color classes
//include('config.php');

?>
<?php if (isset($logged_in) && $logged_in) { ?>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="catalog.php">Game Catalog</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="reviews.php">Reviews</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="news.php">News</a></li>
<?php } else { // Start else?>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="login.php">Login</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="register.php">Register</a></li>
<?php } // End if..else ?>

<li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="support.php">Support</a></li>
