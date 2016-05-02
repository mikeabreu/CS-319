<?php
require_once('../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("login.php");
}

$page_title = 'Game Catalog';
include(TEMPLATE_PATH . DS . 'header.php');

?>

<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Game Catalog Page</h1>

        </div>
    </div>

</div>

<?php
include(TEMPLATE_PATH . DS . 'footer.php');
?>
