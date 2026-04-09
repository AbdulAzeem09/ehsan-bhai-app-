
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
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
?>




<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  <?php include('left_side_landing.php');?>  
	  <?php
	  $s=new _spuser;
	  $data=$s->read_currency($_SESSION['uid']);
	  $row= mysqli_fetch_assoc($data);
	  $currency=$row['currency'];
	 // print_r($row);
	 // die('==');
	  ?>
      
         <div class="col py-3">
		 <div class="row">
		 <!--++Member By Quantity++ -->
           <div class="col-md-6" style="text-align: center;">
		  <h4>Member By Quantity</h4>
		  <form action="add_cust_assign_memb.php" method="POST">
		  <input type="hidden" name="customer_id" value="<?php echo $_GET['postid'];?>">
		  <input type="hidden" name="currency" value="<?php echo $currency;?>">
		  <label for="">Option1 : </label>
		  <select name="barcode" for="barcode">
		  <option>Select Option</option>
		  <?php
		  $p = new _pos; 
         $result_1 = $p->read_data_membership_qty($_SESSION['uid']);
         if ($result_1) {
         //$i = 1;
        while ($row_1 = mysqli_fetch_assoc($result_1)){  
		  
		  ?>
		  <!--<option><?php //echo $row_1['barcode'];die('===');?></option>-->
		  <option value="<?php echo $row_1['barcode']; ?>"><?php echo $row_1['name_qty']; ?></option>
		  
		 <?php }}?>
		  </select>
		  <br>
		  <br>
		  <input type="text" name="quantity" placeholder="">
		  <br>
		  <br>
		  
		  <input type="submit" name="quantity_btn" value="Submit">

		  </form>
		  </div>
		  <!--++Member By Duration++ -->
		  <div class="col-md-6" style="text-align: center;">
		  <h4>Member By Duration</h4>
		  <form action="add_cust_assign_memb.php" method="POST">
		  <input type="hidden" name="customer_id_d" value="<?php echo $_GET['postid'];?>">
		  <input type="hidden" name="currency_d" value="<?php echo $currency;?>">
		  <label for="">Option2 : </label>  
		  <select name="barcode_d" for="barcode_d">
		  <option>Select Option</option>
		  <?php $p = new _pos;
                $result_2 = $p->read_data_membership_dur($_SESSION['uid']); 
               if ($result_2) {
                //$i = 1;
               while ($row_2 = mysqli_fetch_assoc($result_2)) {?>
		  <option value="<?php echo $row_2['barcode']; ?>"><?php echo $row_2['Name']; ?></option>
			   <?php }}?>
		  </select>
		  <br>
		  <br>
		  <input type="text" name="quantity_d" placeholder="">
		  <br>
		  <br>
		  <input type="submit" name="quantity_btn_d" value="Submit">
		  </form> 
		  

		   </div>
		   </div>
		  <!-- <i class="fa fa-minus" aria-hidden="true"></i>-->
		    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addcustomer"> <i class="fas fa-minus"></i> </button> 
		   <!-- modal open  -->
		   
		   
		    <div class="modal fade" id="addcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Customers Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="customer_membership1.php" method="POST">
                     <div class="row">
                        <div class="col-8">
                           <div class="mb-3">
						   <label for="customerno">Enter a number</label>
                              <input type="number" class="form-control shadowBox" id="customerno" placeholder="enter a number" value="" name="first">
							  <input type="hidden" value="<?php echo $_GET['postid'];  ?>" name="postid">
                           </div>
                         <!--  <div class="mb-3">
                              <input type="number" class="form-control shadowBox" id="customername" placeholder="" value="">
                           </div>-->
                          
                       
                         
                        </div>
                        
                     </div>
                  
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-secondary" id="close_" data-bs-dismiss="modal">Submit</button>
                 
               </div>
               </form>
            </div>
         </div>
      </div>
		   
		   
		   
		   <!-- modal close --->
		   
		   
		   
		   
		   
		   
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
      title: 'Are you sure?',
      text: "It will deleted permanently !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
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
	
</body>
</html>

<?php } ?>