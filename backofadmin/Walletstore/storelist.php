<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
  	$sql		=	"SELECT * FROM spstorewallet";
  	$result = dbQuery($dbConn, $sql);
   
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 
 if (isset($_POST['submit'])) {
 //echo $_POST['selectname'].'===';
  $sdate=$_POST['sdate'];
  $edate=$_POST['edate'];
  $selectname=$_POST['selectname'];
  if(($sdate && $edate) && $selectname){
 // echo 1;
  $query2="SELECT * FROM spstorewallet WHERE seller_userid='$selectname' AND date_txn BETWEEN '$sdate' AND '$edate'";
  }
 else if(($sdate && $edate)&& !($selectname)){
 // echo 2;
   $query2="SELECT * FROM spstorewallet WHERE  date_txn BETWEEN '$sdate' AND '$edate'";
  
  }
 else if(($selectname)&& !($sdate && $edate)){
 //echo 3;
	  
   $query2="SELECT * FROM spstorewallet WHERE seller_userid='$selectname' ";
  }
  
 
 $result=dbQuery($dbConn, $query2);

 //$roww2=mysqli_fetch_assoc($ress2);

}

else {
	$sdate="";
 $edate="";
  $selectname="";
}
	 
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Store Wallet<small>[List]</small></h1>
		<form  action="" method="POST">
		Select Name : <select  id='selUser' name="selectname"  style="width:450px;">
		<option value="0">Select User</option>
		<?php 
		$sqll = "SELECT * FROM spuser" ;
		$ress=dbQuery($dbConn ,$sqll);
		while($roww=mysqli_fetch_assoc($ress))
		{
		?><option value="<?php echo $roww['idspUser'];?>" <?php if($selectname==$roww['idspUser']){echo 'selected';}?>><?php echo $roww['spUserName'].' '.'('.$roww['spUserEmail'].')' ;?></option>
		<?php } ?>
		</select>
		
		Start Date:<input type="date" name="sdate" id="sdate" value="<?php echo $sdate; ?>" >
		
		End Date:<input type="date" name="edate" id="edate" value="<?php echo $edate; ?>" >
		
		<input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary">
		</form>
		<a href="<?php  $_SERVER["DOCUMENT_ROOT"] ?>/backofadmin/Walletstore/index.php?view=storelist" class="btn btn-primary">Reset</a>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<div>
				<?php 
				if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
					if($_SESSION['count'] <= 1){
						$_SESSION['count'] +=1; ?>
						<div class="space"></div>
						<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
						unset($_SESSION['errorMessage']);
					}
				} ?>
			</div>
			<div class="box-body tbl-respon">
              	<table id="example1" class="table table-bordered table-striped tbl-respon2">
	                <thead>
	                 	<tr>
							
							<th>Id</th>
							<th>Buyer Name</th>
							<th>Amount</th>
							<th>Currency</th>
							<th>Seller Name </th>
							<th>TXN Number</th>            
							<th>Date</th>
						</tr>
	                </thead> 
	                <tbody>
	                	<?php 
			
					    $total=0;
						while($row11=mysqli_fetch_assoc($result))
						{
						$id=$row11['id'];
                        //echo $id;
                    
						?>
						<tr>
						
						<td><?php echo $row11['id'];?></td>
						<td><?php $userid = $row11['buyer_userid'];
 $sql2		=	"SELECT * FROM spuser WHERE idspUser=$userid"; 
									//echo $sql2;
								
							 $result2 = dbQuery($dbConn, $sql2);

								$row12=mysqli_fetch_array($result2);?>
 <a href="<?php  $_SERVER["DOCUMENT_ROOT"] ?>/backofadmin/registerdUser/index.php?view=detail&uid=<?php echo @$row12['idspUser']; ?>" ><?php    echo @$row12['spUserFirstName'].' '.@$row12['spUserLastName'];


                            ?></a></td>
									
						<td><?php echo $row11['amount'];
						$total=$total+$row11['amount'];
						
						?></td>
						<td><?php echo @$row12['currency']; ?></td>
						<td><?php $userid2=$row11['seller_userid'];
                           $sql3		=	"SELECT * FROM spuser WHERE idspUser=$userid2";
									//echo $sql2;
								
							        $result3 = dbQuery($dbConn, $sql3);

								   $row13=mysqli_fetch_array($result3);?>
 <a href="<?php  $_SERVER["DOCUMENT_ROOT"] ?>/backofadmin/registerdUser/index.php?view=detail&uid=<?php echo @ $row13['idspUser']; ?>" ><?php echo  @ $row13['spUserFirstName'].' '. @ $row13['spUserLastName'];


                                  
                                   ?></a></td>
						<td><?php echo $row11['balanceTransaction'];?></td>
						<td><?php echo $row11['date_txn'];?></td>
						</tr>
						<?php 
						}
						?>
	                </tbody>
	                
              	</table>
            </div><!-- /.box-body -->
			

				<!--- End Table ---------------->
		</div>
		<!--<div class="section bg-gray p-5">
		<h3>Total= <?php  
			echo $total;
		
			?>
			</h3>
			</div>-->
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>
	
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
		<script>
		$(document).ready(function(){
 
  // Initialize select2
  $("#selUser").select2();
  $('#submit').click(function(){
var userid = $('#selUser').val();
var sdate=$('#sdate').val();
//alert(sdate);
var edate=$('#edate').val();
//alert(edate);
//alert(userid);
if(userid==0&&((sdate && edate)=="")){
	alert('Please Select User Or Date To Filter');
	return false;
}
else{
	return true;
}

  });
  // Read selected option
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();
alert(userid);
    $('#result').html("id : " + userid + ", name : " + username);

  });
});
		</script>