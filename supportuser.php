<?php
include('includes/functions/session.php');
$page_title = 'Support';
include('includes/templates/header.php');
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Materialize Scripts -->
<div class="row">

    <div class="row">
        <div class="col s12">
            <h1 class="center-align">Support User Page</h1>
        </div>
    </div>

</div>
<!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->
<style type="text/css">
    .SupportTable { width:950px;background-color: #d2f4df;border-collapse:collapse;color:#000;font-size:18px;class="center-align" }
    .SupportTable th { background-color: #43a047;color:white;width:25%;font-variant:small-caps;class="center-align" }
    .SupportTable td, .myOtherTable th { padding:5px;border:0;class="center-align" }
    .SupportTable td { font-family:Georgia, Garamond, serif; border-bottom:1px solid #BDB76B;height:110px;class="center-align" }
    /*SupportTable tr { font-family:Georgia, Garamond, serif; border-bottom:1px solid #BDB76B;height:110px;class="center-align"*/
</style>
<!-- End Styles -->
<table class="SupportTable">
        <tr>
        <th>Ticket_ID</th>
        <th>Subject</th>
        <th>Created On</th>
        <th>Updated On</th>
        <th>Reply</th>
        <th>Status</th>
        </tr>
</table>
<!--<h6> N-New / IP-In Progress / C-Complete / D-Duplicate / Di-Discard</h6>-->
<script type="text/javascript">
    $(document).ready(function(){
        alert("In javascript! in support user");
    });
    var row =
        "<tr>" +
        "<td>Ticket_ID</td>" +
        "<td>Subject(Support_ID)</td>"  +
        "<td>News_ID(Creation_Date)</td>" +
        "<td>News_ID(Update_Date)</td>" +
        "<td>Reply(Ticket_ID)</td>" +
        "<td>Ticket_Status(Support_ID)</td>"  +
        "</tr>";
    /*for( var i=0; i<json.table.size; i++ )*/
    /*for( var i=0; i<15; i++ ){
        $(".SupportTable tr:last").after(row);

    }*/

    <table id=""

</script>
<?php
include('includes/templates/footer.php');
?>
