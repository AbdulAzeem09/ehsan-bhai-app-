<?php


    require_once("../../univ/baseurl.php" );
    //session_start();
/*if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
   include_once ("../authentication/check.php");
    
}else{ */
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
   //print_r($_SESSION);
  // die('=====');
    $pageactive = 2;
    // background color
    //die('==========');
 
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <head>
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
       
        <section class="">
            <div class="container-fluid no-padding">
			
			
                <div class="row">
               
                
                   <div class="col-md-12">
                        <div class="rightContent">
                            
                    
	<div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                       <!-- <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header 
                                            <div class="box-body">-->
											
											

											
                                                <!--<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">ID</th>
																 <th  class="text-center">ID</th>
                                                               <th  class="text-center">Username</th>
                        <th  class="text-center">Amount</th>
						<th  class="text-center">Requested Date</th>
						<th  class="text-center">Status</th>
						<th  class="text-center">Action Date</th>
                                                               
                                                                
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															/*


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/

$userid=$_SESSION['uid'];
                                                         $pw = new _orderSuccess;
                                                        // die("------------");
                                                       $result = $pw->readdet($userid);
													  // var_dump($result);
															
															
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
									
									$id1=$row['id'];
									$st1=$row['status'];
								$date=$row['action_date'];
																	//echo "<pre>";
															print_r($row); //die("--------------------------");
																									
																		   
							$pf = new _spprofiles;
							$id=$pf->profileforresume($row['user_id']);
						 $result1 = $pf->profile($row['user_id']);
						 if($result1!=false){
							$row1 = mysqli_fetch_assoc($result1);
							//print_r($row1);die('=====');
						 }									   
                                                                    ?>
																	
																	<?php    
	//echo $_SESSION['uid'];
		 $sp= new _spuser;
		// echo  $row['user_id'];
		 $result = $sp->readcurrency($row['user_id']);
		 
		  if($result!=false){ 
	
	while($row_n=mysqli_fetch_assoc($result)){

	
	 $currency=$row_n['currency'];

	
	}
		  }
	
	?>
																	
																	
																	
																	
																	
																	<tr>
																	<td></td>
														<td class="text-center"><?php  echo $i; ?></td>
										
 
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row1['user_name']); ?></span></td>
 <td   class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
 <td class="text-center "><span class="smalldot"><?php echo $row['date']; ?></span></td>
 <td class="text-center ">
	
	<?php if($st1==0){?>
	
	  <select class="form-control" onchange="location = this.value;">
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=0" <?php if($st1==0){echo "selected"; }?> >Pending</option>
				
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=1" <?php if($st1==1){echo "selected"; }?> >Accepted</option>
	
	<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=2" <?php if($st1==2){echo "selected"; }?>>Rejected</option> 
					
					</select>
	<?php } else{
		if($st1==1){
		echo "<span class='text-center' style='color:#006400;'>Accepted</span>";
		
		}
		if($st1==2){
		echo "<span class='text-center' style='color:red;'>Rejected</span>";
		}
		
		
		
	}
		
		?>												
	 
	 
	 
	</td>
	
	<td class="text-center ">
		<?php 
			
			if($date!= '0000-00-00'){
			
			echo $date;
			}
			else{
			echo "NA";
			}
				
			
			
			
			
			?>
		
		
		
		
		</td>
  <!-- <td class="tchext-center">
<?php //echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>
															
															</td>
<td  class="text-center ">
<button type="button" 
    data-module="<?php echo $row['module'];?>" 
    data-amount="<?php echo $row['amount'];?>" 
	data-date="<?php echo $row['date'];?>" 
	data-username="<?php echo $row1['user_name']; ?>" 
	data-spBankusername="<?php echo $row['spBankusername'];?>" 
	data-spBankname="<?php echo $row['spBankname']; ?>" 
	data-spBanknumber="<?php echo $row['spBanknumber']; ?>" 
	data-spBranchnumber="<?php echo $row['spBranchnumber']; ?>"
	data-spAccountnumber="<?php echo $row['spAccountnumber']; ?>" 
	data-spBankcode="<?php echo $row['spBankcode']; ?>" class="btn btn-primary withdraw" data-toggle="modal" data-target="#exampleModal">
  View
</button></td>   

                                                            
																	
																	</tr>
                                                                    <?php
                                                                   $i++;;
                                                                }
                                                            }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
													
                                    </div> anoop--><div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
         <div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
    border-color: #BACCE8;">
                        <ul class="nav nav-tabs">
						<li class="active"><a href="#tab4warning" data-toggle="tab">All</a></li>
                            <li style="background-color:blue;"><a href="#tab1warning" data-toggle="tab" style="color:black;">Pending</a></li>
                            <li style="background-color:green;"><a href="#tab2warning" data-toggle="tab" style="color:black;" >Accepted</a></li>
                           
                            <li style="background-color:red;"><a href="#tab3warning" data-toggle="tab" style="color:black;">Rejected</a></li>
                       
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
					<div class="tab-pane fade in active" id="tab4warning">

                  
                            <div class="col-md-12 ">
                                <div class="">
                                  <div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">ID</th>
																 <th  class="text-center">ID</th>
                                                               <th  class="text-center">Username</th>
                        <th  class="text-center">Amount</th>
						<th  class="text-center">Currency</th>
						<th  class="text-center">Requested Date</th>
						<th  class="text-center">Status</th>
						
						<th  class="text-center">Action Date</th>
                                                               
                                                                
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															/*


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/

//$userid=$_SESSION['uid'];
                                                         $pw = new _orderSuccess;
                                                        // die("------------");
                                                       $result = $pw->readdet();
													  // var_dump($result);
															
															
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
									
									$id1=$row['id'];
									$st1=$row['status'];
								$date=$row['action_date'];
																	//echo "<pre>";
															//print_r($row); //die("--------------------------");
																									
																		   
							$pf = new _spprofiles;
							$id=$pf->profileforresume($row['user_id']);
						 $result1 = $pf->profile($row['user_id']);
						 if($result1!=false){
							$row1 = mysqli_fetch_assoc($result1);
							//print_r($row1);
						 }			


						 
                                                                    ?><tr>
																	<td></td>
														<td class="text-center"><?php  echo $i; ?></td>
										
 
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row1['user_name']); ?></span></td>
 <td   class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
 <td class="text-center "><?php echo $currency ; ?></td>
 <td class="text-center "><span class="smalldot"><?php echo $row['date']; ?></span></td>
 <td class="text-center ">
	
	<?php if($st1==0){?>
	
	  <select class="form-control" onchange="location = this.value;">
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=0" <?php if($st1==0){echo "selected"; }?> >Pending</option>
				
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=1" <?php if($st1==1){echo "selected"; }?> >Accepted</option>
	
	<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=2" <?php if($st1==2){echo "selected"; }?>>Rejected</option> 
					
					</select>
	<?php } else{
		if($st1==1){
		echo "<span class='text-center' style='color:#006400;'>Accepted</span>";
		
		}
		if($st1==2){
		echo "<span class='text-center' style='color:red;'>Rejected</span>";
		}
		
		
		
	}
		
		?>												
	 
	 
	 
	</td>
	
	
	
	
	<td class="text-center ">
		<?php 
			
			if($date!= '0000-00-00'){
			
			echo $date;
			}
			else{
			echo "NA";
			}
				
			
			
			
			
			?>
		
		
		
		
		</td>
  <!-- <td class="tchext-center">
<?php //echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>-->
															
															</td>
<td  class="text-center ">
<!--<button type="button" 
    data-module="<?php echo $row['module'];?>" 
    data-amount="<?php echo $row['amount'];?>" 
	data-date="<?php echo $row['date'];?>" 
	data-username="<?php echo $row1['user_name']; ?>" 
	data-spBankusername="<?php echo $row['spBankusername'];?>" 
	data-spBankname="<?php echo $row['spBankname']; ?>" 
	data-spBanknumber="<?php echo $row['spBanknumber']; ?>" 
	data-spBranchnumber="<?php echo $row['spBranchnumber']; ?>"
	data-spAccountnumber="<?php echo $row['spAccountnumber']; ?>" 
	data-spBankcode="<?php echo $row['spBankcode']; ?>" class="btn btn-primary withdraw" data-toggle="modal--" data-target="exampleModal--"
	onclick="vmodal()"
	>
  View
</button>-->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal99810" 
onclick="appendviewmodal('<?php echo $row['module'];?>',
'<?php echo $row['amount'];?>',
'<?php echo $row['date'];?>',
'<?php echo $row1['user_name']; ?>',
'<?php echo $row['spBankusername'];?>',
'<?php echo $row['spBankname']; ?>',
'<?php echo $row['spBanknumber']; ?>',
'<?php echo $row['spBranchnumber']; ?>',
'<?php echo $row['spAccountnumber']; ?>',
'<?php echo $row['spBankcode']; ?>'
)">View</button>
</td>

                                                            
																	
																	</tr>
																	
											
			
			
			
                                                                    <?php
                                                                   $i++;;
                                                                }
                                                            }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
													
                                    </div>
                                </div>
                            </div>
                       </div> 
					   
					
											<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

											
			<script type="text/javascript">
												$(document).ready(function() {
													
													var table = $('#example').DataTable({ 
														select: false,
														"columnDefs": [{
															className: "Name", 
															"targets":[0],
															"visible": false,
															"searchable":false
														}]
													});//End of create main table
													
													
													$('#example tbody').on( 'click', 'tr', function () {
														
														// alert(table.row( this ).data()[0]);
														
													} );
												});
											 </script>
                        <div class="tab-pane fade " id="tab1warning">

                  
                            <div class="col-md-12 ">
                                <div class="">
                                   <div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example1" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">ID</th>
																 <th  class="text-center">ID</th>
                                                               <th  class="text-center">Username</th>
                        <th  class="text-center">Amount</th>
						<th  class="text-center">Currency</th>
						<th  class="text-center" >Requested Date</th>
						<th  class="text-center">Status</th>
							
						<th  class="text-center">Action Date</th>
                                                               
                                                                
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															/*


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/

//$userid=$_SESSION['uid'];
                                                         $pw = new _jobpostings;
                                                        // die("------------");
                                                       $result = $pw->readdet(0);
													  // var_dump($result);
															
															
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
									
									$id1=$row['id'];
									$st1=$row['status'];
								$date=$row['action_date'];
																	//echo "<pre>";
															//print_r($row); //die("--------------------------");
																									
																		   
							$pf = new _spprofiles;
							$id=$pf->profileforresume($row['user_id']);
						 $result1 = $pf->profile($row['user_id']);
						 if($result1!=false){
							$row1 = mysqli_fetch_assoc($result1);
							//print_r($row1);die('=====');
						 }									   
                                                                    ?><tr>
																	<td></td>
														<td class="text-center"><?php  echo $i; ?></td>
										
 
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row1['user_name']); ?></span></td>
 <td   class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
 <td class = "text-center"><?php echo $currency ; ?></td>
 <td class="text-center "><span class="smalldot"><?php echo $row['date']; ?></span></td>
 <td class="text-center ">
	  <select class="form-control" onchange="location = this.value;">
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=0" <?php if($st1==0){echo "selected"; }?> >Pending</option>
				
<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=1" <?php if($st1==1){echo "selected"; }?> >Accepted</option>
	
	<option value="<?php $Baseurl;?>/backofadmin/withdraw/update.php?action=update&id=<?php echo $id1; ?>&status=2" <?php if($st1==2){echo "selected"; }?>>Rejected</option> 
					
					</select>
	<?php //if($st1==0){echo "Pending";}?>
	
												
	 
	 
	 
	</td>
	
	
	<td class="text-center ">
		<?php 
			
			if($date!= '0000-00-00'){
			
			echo $date;
			}
			else{
			echo "NA";
			}
				
			
			
			
			
			?>
		
		
		
		
		</td>
  <!-- <td class="tchext-center">-->
<?php //echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>
															
															</td>
<td  class="text-center ">

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal99810" onclick="appendviewmodal('<?php echo $row['module'];?>',
'<?php echo $row['amount'];?>',
'<?php echo $row['date'];?>',
'<?php echo $row1['user_name']; ?>',
'<?php echo $row['spBankusername'];?>',
'<?php echo $row['spBankname']; ?>',
'<?php echo $row['spBanknumber']; ?>',
'<?php echo $row['spBranchnumber']; ?>',
'<?php echo $row['spAccountnumber']; ?>',
'<?php echo $row['spBankcode']; ?>'

)">View</button>
</td>

                                                            
																	
																	</tr>
                                                                    <?php
                                                                   $i++;;
                                                                }
                                                            }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
													
                                    </div>
								
											<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

											
			<script type="text/javascript">
												$(document).ready(function() {
													
													var table = $('#example1').DataTable({ 
														select: false,
														"columnDefs": [{
															className: "Name", 
															"targets":[0],
															"visible": false,
															"searchable":false
														}]
													});//End of create main table
													
													
													$('#example1 tbody').on( 'click', 'tr', function () {
														
														// alert(table.row( this ).data()[0]);
														
													} );
												});
											 </script>
                                </div>
                            </div>
                       </div> 
					    <div class="tab-pane fade " id="tab2warning">

                  
                            <div class="col-md-12 ">
                                <div class="">
                                <div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example21" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">ID</th>
																 <th  class="text-center">ID</th>
                                                               <th  class="text-center">Username</th>
                        <th  class="text-center">Amount</th>
							<th  class="text-center">Currency</th>
						<th  class="text-center">Requested Date</th>
						<th  class="text-center">Status</th>
					
						<th  class="text-center">Action Date</th>
                                                               
                                                                
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															/*


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/

//$userid=$_SESSION['uid'];
                                                         $pw = new _jobpostings;
                                                        // die("------------");
                                                       $result = $pw->readdet(1);
													  // var_dump($result);
															
															
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
									
									$id1=$row['id'];
									$st1=$row['status'];
								$date=$row['action_date'];
																	//echo "<pre>";
															//print_r($row); //die("--------------------------");
																									
																		   
							$pf = new _spprofiles;
							$id=$pf->profileforresume($row['user_id']);
						 $result1 = $pf->profile($row['user_id']);
						 if($result1!=false){
							$row1 = mysqli_fetch_assoc($result1);
							//print_r($row1);die('=====');
						 }									   
                                                                    ?><tr>
																	<td></td>
														<td class="text-center"><?php  echo $i; ?></td>
										
 
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row1['user_name']); ?></span></td>
 <td   class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
 <td class="text-center "><?php echo $currency ; ?></td>
 <td class="text-center "><span class="smalldot"><?php echo $row['date']; ?></span></td>
 <td class="text-center ">
	
	<?php if($st1==1){echo "Accepted";}?>
	
												
	 
	 
	 
	</td>
	
	
	<td class="text-center ">
		<?php 
			
			if($date!= '0000-00-00'){
			
			echo $date;
			}
			else{
			echo "NA";
			}
			?>
		</td>
  <!-- <td class="tchext-center">-->
<?php //echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>
															
															</td>
<td  class="text-center ">

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal99810" onclick="appendviewmodal('<?php echo $row['module'];?>',
'<?php echo $row['amount'];?>',
'<?php echo $row['date'];?>',
'<?php echo $row1['user_name']; ?>',
'<?php echo $row['spBankusername'];?>',
'<?php echo $row['spBankname']; ?>',
'<?php echo $row['spBanknumber']; ?>',
'<?php echo $row['spBranchnumber']; ?>',
'<?php echo $row['spAccountnumber']; ?>',
'<?php echo $row['spBankcode']; ?>'

)">View</button>
</td>

                                                            
																	
																	</tr>
                                                                    <?php
                                                                   $i++;;
                                                                }
                                                            }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
													
                                    </div>
									
									<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
											<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

											
			<script type="text/javascript">
												$(document).ready(function() {
													
													var table = $('#example21').DataTable({ 
														select: false,
														"columnDefs": [{
															className: "Name", 
															"targets":[0],
															"visible": false,
															"searchable":false
														}]
													});//End of create main table
													
													
													$('#example21 tbody').on( 'click', 'tr', function () {
														
														// alert(table.row( this ).data()[0]);
														
													} );
												});
											 </script>
                                </div>
                            </div>
                       </div> 
					    <div class="tab-pane fade " id="tab3warning">

                  
                            <div class="col-md-12 ">
                                <div class="">
                                   <div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example3" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">ID</th>
																 <th  class="text-center">ID</th>
                                                               <th  class="text-center">Username</th>
                        <th  class="text-center">Amount</th>
						<th  class="text-center">Currency</th>
						<th  class="text-center">Requested Date</th>
						<th  class="text-center">Status</th>
						
						<th  class="text-center">Action Date</th>
                                                               
                                                                
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															/*


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/

//$userid=$_SESSION['uid'];
                                                         $pw = new _jobpostings;
                                                        // die("------------");
                                                       $result = $pw->readdet(2);
													  // var_dump($result);
															
															
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
									
									$id1=$row['id'];
									$st1=$row['status'];
								$date=$row['action_date'];
																	//echo "<pre>";
															//print_r($row); //die("--------------------------");
																									
																		   
							$pf = new _spprofiles;
							$id=$pf->profileforresume($row['user_id']);
						 $result1 = $pf->profile($row['user_id']);
						 if($result1!=false){
							$row1 = mysqli_fetch_assoc($result1);
							//print_r($row1);die('=====');
						 }									   
                                                                    ?><tr>
																	<td></td>
														<td class="text-center"><?php  echo $i; ?></td>
										
 
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row1['user_name']); ?></span></td>
 <td   class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
 	<td  class="text-center"><?php echo $currency ; ?></td>
 <td class="text-center "><span class="smalldot"><?php echo $row['date']; ?></span></td>
 <td class="text-center ">
	
	<?php if($st1==2){echo "Rejected";}?>
	
												
	 
	 
	 
	</td>

	<td class="text-center ">
		<?php 
			
			if($date!= '0000-00-00'){
			
			echo $date;
			}
			else{
			echo "NA";
			}
				
			
			
			
			
			?>
		
		
		
		
		</td>
  <!-- <td class="tchext-center">-->
<?php //echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>
															
															</td>
<td  class="text-center ">

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal99810" onclick="appendviewmodal('<?php echo $row['module'];?>',
'<?php echo $row['amount'];?>',
'<?php echo $row['date'];?>',
'<?php echo $row1['user_name']; ?>',
'<?php echo $row['spBankusername'];?>',
'<?php echo $row['spBankname']; ?>',
'<?php echo $row['spBanknumber']; ?>',
'<?php echo $row['spBranchnumber']; ?>',
'<?php echo $row['spAccountnumber']; ?>',
'<?php echo $row['spBankcode']; ?>'

)">View</button>

                                                            
																	
																	</tr>
                                                                    <?php
                                                                   $i++;;
                                                                }
                                                            }
                                                            ?>
                                                            

                                                        </tbody>
                                                    </table>
													
                                    </div>  

							
									
								
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>	
									
									
											<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

					<script>
			function vmodal(){
				alert('==');
				$('#myModal').modal('show');
				
			}	
					
					
					</script>						
			<script type="text/javascript">
												$(document).ready(function() {
													
													var table = $('#example3').DataTable({ 
														select: false,
														"columnDefs": [{
															className: "Name", 
															"targets":[0],
															"visible": false,
															"searchable":false
														}]
													});//End of create main table
													
													
													$('#example3 tbody').on( 'click', 'tr', function () {
														
														// alert(table.row( this ).data()[0]);
														
													} );
												});
											 </script>
                                </div>
                            </div>
                       </div> 
                       </div>                                             
                       </div>                                             
                                            </div>
											
                                        </div>
<?php  
/*	$oi= new _spcustomers_basket;
$oid= $oi->readid($_SESSION['uid']);
	
	if($oid!=false){
	//$amount=0;
	while($r=mysqli_fetch_assoc($oid)){
	//print_r($r);
	
	$amount1+=$r['amount'];
	
	}?>
	<div style="font-size: 15px;"> Total Amount :
	<?php echo $curr.' '.$amount1;
	}
	?>

                                    </div>
									 <?php 
									 if(isset($_POST['submit']))
									 {
								// print_r($_POST);
								 //
								 $uid=$_SESSION['uid'];
								 $pid=$_SESSION['pid'];
										 
				$arr=array("user_id"=>$uid,
				"userprofile_id"=>$pid,
				"amount"=>$_POST['amount'],
				"module"=>$_POST['store'],
				"spBankusername"=>$_POST['spBankusername'],
				"spBankname"=>$_POST['spBankname'],
				"spBanknumber"=>$_POST['spBanknumber'],
				"spBranchnumber"=>$_POST['spBranchnumber'],
				"spAccountnumber"=>$_POST['spAccountnumber'],
				"spBankcode"=>$_POST['spBankcode'],
				"date"=> date('Y-m-d H:i:s')
				
				);	
				
				
				$w= new _orderSuccess;
				$wa= $w->createwithdrawalstore($arr);
									 
									 }		 
										*/
										 ?>
									
									<!-- Button trigger modal -->


 <!--Modal -->


                                   </div>
                                </div>

                            </div>

</div>
     </div>
            </div>
        </section>
		
		
		<script>
		
	function appendviewmodal(module,amount,date,user_name,spBankusername,spBankname,spBanknumber,spBranchnumber,spAccountnumber,spBankcode){		
//alert(module);
	//alert(amount);
	//alert(date);
	//alert(spBankusername);
	//alert(spBranchnumber);
	//alert(spAccountnumber);
	//alert(spBankcode);	

	
  //var username = $(this).data('username');
$('#module_new').val(module);

 //var amount = $(this).data('amount');
$('#username_new').val(user_name);

 //var date = $(this).data('date');
$('#amount_').val(amount);
$('#date_').val(date);
$('#spBanknumber_').val(spBanknumber);
$('#spBankname_').val(spBankname);
$('#spBankusername_').val(spBankusername);
$('#spBranchnumber_').val(spBranchnumber);
$('#spAccountnumber_').val(spAccountnumber);
$('#spBankcode_').val(spBankcode);




	}
		</script>

        <!-- ChartJS 1.0.1 -->
      
       
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php 
        //include('../../component/f_footer.php');
        //include('../../component/f_btm_script.php'); 
        ?>

<!-- <script type="text/javascript">

   
$(document).ready(function(e){
   
 $(".mynewModalclass").on("click", function () {

      //  alert();

        var session_id = '<?php echo $_SESSION['uid'];?>';

      //  alert(session_id);

     //  e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'verifywithdraw.php',
            data: {'userid': session_id},
             
            success: function(data){ 

                         //console.log(data);
             $("#mynewverifyModal").modal("show");
  
            }
        });
    });
});

</script> -->

  


        <!-- Sky Icons -->
      
      

        <!-- OTHER DASHBOARD STORE DETAIL -->
        <!-- Morris.js charts -->
   
        <!-- ALL DASHBOARD GRAPHS -->
        
        
        <!-- END -->

    </body>	
</html>
<?php
//}
?>


  
<script>
    $.fn.bsModal = $.fn.modal.noConflict();
</script>

<div class="modal fade" id="myModal99810" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel"><b>Transaction Details</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
	  <form action="" method="post">
      <input type="hidden" name="store" value="store">
	   
	  <div class="row">
																	
																	<?php
																		/*$uid = $_SESSION['uid'];
																		$b = new _spbankdetail;
																		$data = $b->read($uid);
																		$row = mysqli_fetch_array( $data );
																		//print_r($row);*/	
																		?>
																		
				<div class="col-md-6">
<div class="form-group">
<label for="price" class="control-label">Module<span class="red">*</span></label>
<input type="text" class="form-control" id="module_new" name="module" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
																		
																		<div class="col-md-6">
<div class="form-group">
<label for="username" class="control-label">Username<span class="red">*</span></label>
<input type="text" class="form-control" id="username_new" name="username" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="amount" class="control-label">Amount<span class="red">*</span></label>
<input type="text"  class="form-control" id="amount_" name="amount" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="date" class="control-label">Requested Date<span class="red">*</span></label>
<input type="text" class="form-control" id="date_" name="date" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
																	
																	<div class="col-md-6">
													<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $pid; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $uid;?>">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankusername_" name="spBankusername" value="<?php //echo $row['spBankusername'];?>" readonly>
   <span id="spBankuser_error" style="color:red;"></span>
																		</div>
																	</div>
																	
																	<div class="col-md-6">
									<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname_" name="spBankname" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
																		</div>
																	</div>
																
																	<div class="col-md-6">
											<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber_" name="spBanknumber" value="<?php //echo $row['spBanknumber'];?>" readonly>
<span id="spBanknumber_error" style="color:red;"></span>
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber_" name="spBranchnumber" value="<?php //echo $row['spBranchnumber'];?>" readonly>
<span id="spBranchnumber_error" style="color:red;"></span>
																		</div>
																	</div>
																
																
																
																	<div class="col-md-6">
											<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber_" name="spAccountnumber" value="<?php //echo $row['spAccountnumber'];?>" readonly>
<span id="spAccountnumber_error" style="color:red;"></span>
																		</div>
																	</div>
																	
																	<div class="col-md-6">
														<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode_" name="spBankcode" value="<?php // echo $row['spBankcode'];?>" readonly>
	<span id="spBankcode_error" style="color:red;"></span>  
																		</div>
											 						</div>
																	<div class="col-md-6">

																	</div>
															</div>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:red">Close</button>
       
		 </form>
      </div>
      </div>
      
    </div>
  </div>
		
		