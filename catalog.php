<?php
include('includes/functions/session.php');
include('includes/functions/functions.php');
confirm_logged_in();

$page_title = 'Catalog';
include('includes/templates/header.php');
include('includes/helpers/Formatter.php');
$options["center"] = true;
$options["valign"] = true;

require_once('includes/functions/mysqli_connect.php'); // Connect to the db.

?>

<li><a href="BlackOpsI.php">
<?php echo $ds3; ?></a></li> ?>


<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Game Catalog Page</h1>
        </div>
    </div>

</div>

<nav>
	    <a class="item" href="#num">#</a>
		<a class="item" href="#a-c">A-C</a>
		<a class="item" href="#d-f">D-F</a>
		<a class="item" href="#d-f">H-J</a>
		<a class="item" href="#k-n">K-N</a>
		<a class="item" href="#o-r">O-R</a>
		<a class="item" href="#s-v">S-V</a>
		<a class="item" href="#w-z">W-Z</a>


	</nav>

	<h3 class="games"></h3>
	<ul style="list-style-type:none">
		<h1><li><a href="BlackOpsI.php"></li>Assassian's Creed Unity</a></h1>
		<li><a name="Assassian's Creed Unity" href="http://vignette3.wikia.nocookie.net/assassinscreed/images/0/0b/Assassin%27s_Creed_Unity_Cover.jpg/revision/latest?cb=20140610082722"><img class="aligncenter wp-image-5227 size-full" src="http://vignette3.wikia.nocookie.net/assassinscreed/images/0/0b/Assassin%27s_Creed_Unity_Cover.jpg/revision/latest?cb=20140610082722" alt="2048 open source html5 game" width="150" height="150" /></a></p>
		<p style="text-align: left;">
		<li><a href="">Alien: Isolation</a></li>
		<li><a href="">Afro Samuri 2</a></li>
	</ul>


<?php
include('includes/templates/footer.php');
?>