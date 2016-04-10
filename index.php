<?php # Script 3.4 - index.php
include_once('includes/functions/session.php');
include_once('includes/functions/functions.php');
confirm_logged_in();

$page_title = 'Welcome to this Site!';
include_once('includes/templates/header.php');
?>

<div class="row">

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="page-header">
                <h1 class="center-align">Go Game Go (G3)</h1>
            </div>
            <div class="well">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet
                    non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel
                    scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non
                    commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla
                    sed consectetur.</p>
            </div>
        </div>
    </div>

</div>

<?php
include_once('includes/templates/footer.php');
?>