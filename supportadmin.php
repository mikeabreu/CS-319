<?php
include('includes/functions/session.php');
$page_title = 'Support';
include('includes/templates/header.php');

?>

<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Support Admin Page</h1>
        </div>
    </div>

</div>
<body>
<div class="container">
    <!-- Page Content goes here -->
    <div class="row">
        <div class="grid-example col s12"><span class="flow-text">I am always full-width (col s12)</span></div>
        <div class="grid-example col s12 m6"><span class="flow-text">I am full-width on mobile (col s12 m6)</span></div>
        <div class="col s12"><p>s12</p></div>
        <!--<div class="col s6 offset-s6"><span class="flow-text">6-columns (offset-by-6)</span></div>-->
        <!--<div class="col s12"><span class="flow-text">This div is 12-columns wide on all screen sizes</span></div>-->
        <!--<div class="col s6 offset-s6"><span class="flow-text">6-columns (offset-by-6)</span></div>-->
    </div>
</div>

</body>

<?php
include('includes/templates/footer.php');
?>
