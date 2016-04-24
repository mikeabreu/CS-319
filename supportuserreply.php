<?php
include('includes/functions/session.php');
$page_title = 'Support';
include('includes/templates/header.php');

?>

<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Support Page</h1>
        </div>
    </div>

</div>
<!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->
<style type="text/css">
    .myOtherTable { width:950px;background-color: #d2f4df;border-collapse:collapse;color:#000;font-size:18px; }
    .myOtherTable th { background-color: #43a047;color:white;width:25%;font-variant:small-caps; }
    .myOtherTable td, .myOtherTable th { padding:5px;border:0; }
    .myOtherTable td { font-family:Georgia, Garamond, serif; border-bottom:1px solid #BDB76B;height:110px; }
</style>
<!-- End Styles -->
<table class="myOtherTable">
    <tr>
        <th>Support_ID</th><th>Subject</th><th>Created On</th><th>Updated On</th><th>Reply</th><th>Status</th>
    </tr>
    <tr>
        <td>Support_ID</td><td>Subject(Support_ID)</td><td>News_ID(Creation_Date)</td><td>News_ID(Update_Date)</td><td></td><td>N</td>
    </tr>
    <tr>
        <td>Support_ID</td><td>Subject(Support_ID)</td><td>News_ID(Creation_Date)</td><td>News_ID(Update_Date)</td><td></td><td>IP</td>
    </tr>
    <tr>
        <td>Support_ID</td><td>Subject(Support_ID)</td><td>News_ID(Creation_Date)</td><td>News_ID(Update_Date)</td><td></td><td>C</td>
    </tr>
</table>
<div class="row">
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">. </div>
    <div class="col s1">.</div>
    <div class="col s1"><input type="submit" value="Submit">    </div>
</div>
<h6> N-New / IP-In Progress / C-Complete / D-Duplicate / Di-Discard</h6>
<?php
include('includes/templates/footer.php');
?>
