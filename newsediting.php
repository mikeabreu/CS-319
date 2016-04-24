<?php
include('includes/functions/session.php');
include('includes/functions/functions.php');
confirm_logged_in();

$page_title = 'Support';
include('includes/templates/header.php');

?>
<body>
<table>
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
<div class="container">
<div class="row">
<div class="row">
    <div class="col s12">
        <h5>EDITING A POST</h5>
    </div>

<!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->
<style type="text/css">
.myOtherTable { width:750px;background-color: #d2f4df;border-collapse:collapse;color:#000;font-size:18px; }
.myOtherTable th { background-color: #43a047;color:white;width:50%;font-variant:small-caps; }
.myOtherTable td, .myOtherTable th { padding:5px;border:0; }
.myOtherTable td { font-family:Georgia, Garamond, serif; border-bottom:0px solid #BDB76B;height:110px; }
</style>
<!-- End Styles -->
<table class="myOtherTable">

<tr>
<td><textarea name="Msg_In_ID(News_ID)" cols="200" rows="30" style="border:0px solid #F7730E;">
            </textarea></td>
</tr>
</table>
    <br></br>
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

<br> </br>
</div>

</div>
</div>
</body>
<?php
include('includes/templates/footer.php');
?>

