<?php
require_once "../includes/initialize.php";

$session->logout();

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
$valign = true;
include(TEMPLATE_PATH . DS . 'header.php');

// Print a customized message:
$html  = "<h1>Logged Out!</h1>";
$html .= "<p>You are now logged out!</p>";
$html .= "<a class='btn waves-effect waves-light green' href='login.php'>Login</a>";
$options["center"] = true;
$options["valign"] = true;
echo $Formatter->format($html, $options);

?>


<?php include(TEMPLATE_PATH . DS . 'footer.php'); ?>


