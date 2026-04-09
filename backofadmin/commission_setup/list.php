
<?php
if(isset($_POST['btnSubmit'])){

    $subscription_monthly_amount = $_POST['subscription_monthly_amount'];
    $subscription_yearly_amount = $_POST['subscription_yearly_amount'];
    $sales_commission = $_POST['sales_commission'];

    $sql =  "SELECT * FROM tbl_set_commission";

    $result  = dbQuery($dbConn, $sql);
    if($result){
        $update1="UPDATE tbl_set_commission SET `subscription_monthly_amount` = '$subscription_monthly_amount',`subscription_yearly_amount` = '$subscription_yearly_amount', `sales_commission` = '$sales_commission' WHERE id = 1";
    }else{
        $update1="INSERT INTO tbl_set_commission (subscription_commission, sales_commission) value ('$subscription_monthly_amount','$sales_commission')";
    }

    $update2="UPDATE spmembership SET `spMembershipAmount` = '$subscription_monthly_amount' WHERE spMembershipName = 'PAID MONTHLY'";
    $result5  = dbQuery($dbConn,$update2);
    $update2="UPDATE spmembership SET `spMembershipAmount` = '$subscription_yearly_amount' WHERE spMembershipName = 'PAID ANNUALLY'";
    $result5  = dbQuery($dbConn,$update2);

    $result4  = dbQuery($dbConn,$update1);

}
?>

<?php
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';


if (!defined('WEB_ROOT')) {
exit;
}



?>
<style type="text/css">
input{
width: 80px;
}
.table-responsive {
min-height: .01%;
overflow-x: unset !important;
}

</style>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Set Subscription Commission</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">

<form method="post" action="">
<div class="box-body">
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>


<div class="table-responsive tbl-respon
">
<table class="table table-bordered table-striped text-center" id="example1">
<thead>
<tr>

<th class="text-center">Subscription Amount</th>
<th class="text-center">Sales Commission (%)</th>
<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php

$sql =  "SELECT * FROM tbl_set_commission";
$result  = dbQuery($dbConn, $sql);


if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
?>
<tr>

<td>
    <label style="font-size: 80%;">Monthly Amount</label>
    <div style="display:flex;     justify-content: center;">
        <span style="background: #80808080;padding: 4px;">$</span>
        <input type="number" name="subscription_monthly_amount" value="<?=intval($row['subscription_monthly_amount'])?>" >
    </div>
    <label style="font-size: 80%;">Yearly Amount</label>
    <div style="display:flex;     justify-content: center;">
        <span style="background: #80808080;padding: 4px;">$</span>
        <input type="number" name="subscription_yearly_amount" value="<?=intval($row['subscription_yearly_amount'])?>" >
    </div>
</td>

<td>
    <input type="number" value="<?=intval($row['sales_commission'])?>"  name="sales_commission">
</td>

<td><input style="background-color: blue !important;" type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Update"></td>

</tr>
<?php
$i++;
}
}
?>
</tbody>
</table>
</div>
</div>
</form>
<!--- End Table ---------------->
</div>


</section><!-- /.content -->

<script type="text/javascript">  /*js start*/

function isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
}  	

</script>	<!-----js end------->

<script>
var validNumber = new RegExp(/^\d*\.?\d*$/);
var lastValid = document.getElementById("test1").value;  
function validateNumber(elem) {
  if (validNumber.test(elem.value)) {
    lastValid = elem.value;
  } else {
    elem.value = lastValid;
  }
}
</script>


<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
searching: false, paging: false, info: false,"ordering": false,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

