<?php
include('includes/functions/session.php');
include('includes/functions/functions.php');
confirm_logged_in();

$page_title = 'Support';
include('includes/templates/header.php');

?>

<div class="row">

    <div class="row">
        <form action="" method="post">
            Entry <input type="text" entry="news1"><br />
            <input type="submit" value="SUBMIT">
        </form>
    </div>
</div>

<?php
include('includes/templates/footer.php');
?>
