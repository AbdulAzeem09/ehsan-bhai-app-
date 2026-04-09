

<?php

    include('../../univ/baseurl.php');
    session_start();
	
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
	
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "1";
	//print_r($_SESSION);
	//die();
?>




<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Customer List | TheSharepage-POS </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
   <style>
.me-3 {
	padding-left:0px;
	padding-right:0px;
  margin-right: 14rem !important;
  margin-bottom: 3px;
}
   
   </style>
   
   
   
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  <?php include('left_side_landing.php');?>  
	  
      
         <div class="col py-3">
            <div class="row mb-4">
			 <div class="d-flex justify-content-between border-bottom mb-3"> 
			 
			  <?php if($_SESSION['msg']=="1"){  unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="success" role="alert">Customer Created
  Successfully .
</div>	   
			   
			   <?php } ?>
			   
			   <?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">Customer Updated
     Successfully  .
</div>	   
			   
			   <?php } ?> 




            <?php if($_SESSION['msg']=="3"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">Customer Delete
     Successfully  .
</div>	   
			   
			   <?php } ?> 
                   <h3>Customer List</h3>
				    
					
				   
				  
				    
					
					
                  <span class="float-end">
				  
				  <form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/pos-dashboard/import_customer.php" method="post" id="sp-form-post" name="postform">
<a  href= "<?php echo $BaseUrl.'/store/pos-dashboard/pos_csv/import_customer.csv'; ?>" class="btn btn-outline-secondary mee-3"style=" padding: 2px;margin-top: -2px;margin-right:7px;">Sample CSV</a>
				   
                     <input type="file" name="file" id="file" accept= ".csv" class="" style="margin-right: -60px;" required>
                  <!--<a href="index.php" class="btn btn-main me-3"><i class="fas fa-file-import"></i> Import</a>-->
				  <button type="" class="btn btn-main mee-3" name="submit_retail" value="Upload"><i class="fas fa-file-import"></i>Import</button>
<a href="customer-add.php" class="btn btn-main"> <span class="d-none d-sm-inline">Add Customer</span></a>
				  </form>
				  
                  </span>   
                    
                    
               </div>
			
               <div class="col-12">
                 
                  <table id="table_id" class="display"  data-order='[[ 0, "desc" ]]' data-page-length='25'>
                    <thead>
                      <tr>
                        <th>ID</th>
                      <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                      
                        <th>Email</th>
                        <th>Customer Type</th>                        
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

				  <?php
					$p = new _pos;
					
							$result = $p->read_data($_SESSION['pid']);
							//print_r($result);
							//die('=======');
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							//print_r($row);
							//die('======');
							
							$phone=$row['phone'];
							//echo $phone;
							//die('========');
							//$data_s = $p->read_cust_id($phone);
							$data_s = $p->read_cust_id($row['email']);
							//print_r($data_s);
							//die('=======');
							if($data_s){
				            $row11 = mysqli_fetch_assoc($data_s);
							$id_p=$row11['idspUser'];
							//print_r($row11);
							//die('======');
							}
							?>
                   <tr>
                     <td><?php echo $row['id']; ?></td>
                     <td><?php echo $row['customer_name']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td><?php echo $row['phone']; ?></td>
                    
                     <td><?php echo $row['email']; ?></td>
                     <td>
					 <?php if($row['customer_type']== 1){ ?>
					 
					 <?php echo "Retail"; ?>
					 
					 <?php } ?>
					 
					 <?php if($row['customer_type']== 2){ ?>
					 
					 <?php echo "Whole Sale"; ?>
					 
					 <?php } ?>
					 
					 <?php if($row['customer_type']== 3){ ?>
					 
					 <?php echo "Domestic"; ?>
					 
					 <?php } ?>
					 
					 </td>                     
                     <td style="padding: 8px 6px;">
					 <a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-edit.php?postid='.$row['id']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['id']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>|
                <a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-history.php?postid='.$row['id']; ?>&action=all"><i class="fas fa-eye me-1"></i></a>|
                <a href="<?php echo $BaseUrl.'/store/pos-dashboard/pos.php?phone='.$row['phone']; ?>"><i class="fas fa-plus me-1"></i></a>
					 <!-- <a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-assign-membership.php?postid='.$id_p; ?>" class="text-danger"> <i class="fa fa-plus" aria-hidden="true"></i></a>   -->
					 
					 </td>  
                  </tr> 
				  <?php
			   $i++;
			   $id_p=0;
			}   
		}
		?>			
                <!-- <tr>
                     <td>#124</td>
                     <td>Mark</td>
                     <td>Abc Street Lorem ipsum dolor sit amet, </td>
                     <td>+987654</td>
                   
                     <td>1customer@gmail.com</td>
                     <td>whole Sale</td>                     
                     <td><a href="customer-edit.php"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr> -->  
                   
                   	   
               </tbody>
            </table>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12 footer">                     
            <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
         </div>
      </div>
   </div>
</div>
</div>
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
     $('#table_id').DataTable({  
   buttons: {
        buttons: [ 'copy', 'csv', 'excel' ]
    }
     });        
   });
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>  
<script type="text/javascript">
   function deletefun(id){ 
	
 var my_path1 = $("#my_path1").val();
   
	 Swal.fire({
   
      title: "Are You Sure You Want to Delete?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonText: 'No',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {
         $.ajax({
			type: "GET",
			url: "delete.php",
			data: {postid:id}, 
			success: function(response){
				
            window.location.href = "customer-list.php";    
			
			}

			});
      }
    })  
	
	
	
}   
      
	  
	   
    </script>
	
	
	<script>
	    setTimeout(function () {
                    $("#success").hide();
                 }, 5000);
		setTimeout(function () {
                    $("#no_member").hide();
                 }, 5000);
				 setTimeout(function () {
                    $("#p_success").hide();
                 }, 5000);
				 
	  </script>
     
     <script>
      <?php 
      if(isset($_SESSION['conf'])){
         unset($_SESSION['conf']);
         ?>
          Swal.fire({
      title: 'File uploaded successfully',
    });
       // swal('File uploaded successfully');

         
   <?php   } 
      ?>
      
     </script>
</body>
</html>

<?php } ?>