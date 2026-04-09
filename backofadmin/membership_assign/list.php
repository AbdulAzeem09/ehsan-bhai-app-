<?php
if (!defined('WEB_ROOT')) {
exit;
}


$sql =  "SELECT * FROM spmembership_transaction ";
$result  = dbQuery($dbConn, $sql);


?>


<?php  
if(isset($_POST['submit'])){
//print_r($_POST); 
$pid = $_POST['pid'];
//print_r($_POST);
$sql2 =  "SELECT * FROM `spprofiles` WHERE idspProfiles =". $pid ;
//echo $sql2;
$result2  = dbQuery($dbConn, $sql2); 

if ($result2) {
//$i = 1;
while ($row2 = dbFetchAssoc($result2)) {
extract($row2);
//print_r($row);
//$idspProfiles  = $row['idspProfiles'] ;
$uid  = $row2['spUser_idspUser'] ; 



}} 

//$uid = $_POST['uid'];
$spmembership = $_POST['spmembership'];

$sql1 =  "SELECT * FROM `spmembership` WHERE idspMembership = " .$spmembership ;

$result1  = dbQuery($dbConn, $sql1); 

if($result1) 
{ 
$row1 = dbFetchAssoc($result1);
// print_r($row1);
$spMembershipDuration= $row1["spMembershipDuration"];
}

$date = $_POST['date'];
$date1 = $date.' '. date("h:i:s");   
$amount = $_POST['amount'];
$transaction = $_POST['transaction'];

$sql3 = "INSERT INTO spmembership_transaction (membership_id, amount, txn_numberpid, uid, createdon , pid , duration) VALUES ('.$spmembership.','$amount','$transaction','.$uid.','$date1', '$pid','$spMembershipDuration')";
//echo $sql3; //die("------------");
$result3  = dbQuery($dbConn, $sql3);

}
?>
<section class="content-header top_heading">
<h1>Membership Assign<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">



<div class="box-body" >
<form action="" method="POST">
<div class="row">  
<div class="col-md-6">
<input type="text" name="name" placeholder="Enter to search Profile" value= "<?php if(isset($_POST['search'])){echo $_POST['name']; }?>">
<input type="submit" value="Search" name="search">
</div>
</div>

</form><br>




<?php if(isset($_POST['search'])){

$name= $_POST['name'];

$sql4 =  "SELECT  spProfileName,idspProfiles,spProfileEmail, spProfilePhone FROM `spprofiles` WHERE  spProfileType_idspProfileType = 1 AND spProfileName LIKE '$name%'";
//echo $sql4;
$result4  = dbQuery($dbConn, $sql4);

// var_dump($result4);
?>
<form  action = "" method= "POST">


<?php 
if($result4->num_rows==0){
echo "&nbsp;&nbsp;&nbsp;<span style='color:red;'>No Record Found<span>";
}
if($result4!=false){

while($na=mysqli_fetch_assoc($result4)){
//print_r($na);
?>
<div class="row">
<div class="col-md-3">
<input type="radio" id="html" name="pid" value="<?php echo $na['idspProfiles'];?> ">
<a href="https://dev.thesharepage.com/friends/?profileid=<?php echo $na['idspProfiles'];?>"><label for="names"><?php echo $na['spProfileName']?></label></a><br> 
</div>
<div class="col-md-3"><?php echo $na['spProfileEmail']; ?>
</div>
<div class="col-md-3"><?php echo $na['spProfilePhone']; ?>
</div>
</div>
<?php } } 
?>

<div class="row">  
<div class="col-md-6">


<!--<label for="names">Profile Name:</label>

<select id='selUser' class = "form-control"  name="pid">

<?php 
$sql =  "SELECT * FROM spprofiles WHERE spProfileType_idspProfileType = 1 ";
$result  = dbQuery($dbConn, $sql);
if ($result) {
//$i = 1;
while ($row = dbFetchAssoc($result)) {
extract($row);
//print_r($row);
//$idspProfiles  = $row['idspProfiles'] ;
$spUser_idspUser  = $row['spUser_idspUser'] ;


?>spProfileEmail

<option value="<?php echo  $row['idspProfiles'] ;?>" ><?php echo  $row['spProfileName'].' '.'('.$row['spProfileEmail'].')' ;?></option>
<?php 

}} ?>
</select>-->
<div id='result'></div>
</div>
</div>


<div class="row">  
<div class="col-md-6">


<label for="spmembership">Membership:</label> 
<select class = "form-control" name="spmembership" id="spmembership">

<?php 
$sql1 =  "SELECT * FROM spmembership ";
$result1  = dbQuery($dbConn, $sql1);
if ($result1) {
//$i = 1;
while ($row1 = dbFetchAssoc($result1)) {
extract($row1);
//print_r($row);


?>

<option value="<?php echo  $row1['idspMembership'] ;?>"><?php echo  $row1['spMembershipName'] ;?></option>
<?php }} ?>
</select>
</div>
</div>

<div class="row">  
<div class="col-md-6">
<label for="birthday">Start Date:</label>
<input class = "form-control" type="date" id="date" name="date">
</div>
</div>

<div class="row">  
<div class="col-md-6">
<label for="birthday">Amount:</label>
<input  class = "form-control" type="text" id="amount" name="amount" value="By Admin" readonly>
</div>
</div>
<div class="row">  
<div class="col-md-6">
<label for="birthday">Transaction:</label>
<input  class = "form-control" type="text" id="transaction" name="transaction" value="By Admin" readonly>
</div>
</div>
<br>

<?php if($result4->num_rows>0){?>
<button type="submit" class="btn btn-primary" name="submit">Submit</button>
<?php } ?>
</form>

<?php 
}

?>

</div>
<!--- End Table ---------------->
</div>


</section>


<!-- Content Header (Page header) -->
<!-- /.content -->
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

<!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function(){

// Initialize select2
$("#selUser").select2();

// Read selected option
$('#but_read').click(function(){
var username = $('#selUser option:selected').text();
var userid = $('#selUser').val();

$('#result').html("id : " + userid + ", name : " + username);

});
});
</script>