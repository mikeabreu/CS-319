<?php if ($session->is_logged_in()) { ?>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="catalog.php">Game Catalog</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="reviews.php">Reviews</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="news.php">News</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="classified_ads.php">Ads</a></li>
<?php } else { // Start else?>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="login.php">Login</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="register.php">Register</a></li>
<?php } // End if..else ?>

<li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="support.php">Support</a></li>

<?php if ($session->is_logged_in()) { ?>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="search.php"><i class="material-icons">search</i></a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="logout.php">Logout</a></li>
    <li><a class="<?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>" href="profile.php">Profile</a></li>
    <li><span class="navtext <?php echo G_TEXT_COLOR . " " . G_TEXT_SHADE;?>"></span></li>
<?php } // End if ?>
