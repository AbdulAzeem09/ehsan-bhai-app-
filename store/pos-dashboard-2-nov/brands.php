
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


//print_r($_SESSION); die();
?>

<?php 

if(isset($_POST['submit'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$brand_name_in = $_POST['brand_name_in'];
	
	
	$data = array("uid" => $uid,
	              "pid" => $pid,
	              "brand_name" => $brand_name_in,
	             
	
	);
	
	$pf = new _pos;
					
	$res = $pf->create_brand($data);  

$_SESSION['msg'] = 1;	
	
}


?>


<?php 

if(isset($_POST['update'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$id = $_POST['id'];
	$brand_name_in = $_POST['brand_name_in'];
	
	
	$data = array(
	              "brand_name" => $brand_name_in,
	             
	
	);  
	
	$pf = new _pos;
					
	$res = $pf->update_brand_list($data,$id);       
	$_SESSION['msg'] = 2;	
}


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



		
		 
         <div class="col py-3">
            <div class="row mb-4">
               <div class="col-12">
			   <?php if($_SESSION['msg']=="1"){  unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="success" role="alert">
  Successfully Submitted.
</div>	   
			   
			   <?php } ?>
			   
			   <?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">
     Successfully updated .
</div>	   
			   
			   <?php } ?> 
			   
                  <h3>Brands List</h3>
				   <form action="" method="post">
                  <div class="row d-flex">                    
                     <div class="col-auto mobile-view mb-3">
                        <input type="text" class="form-control" placeholder="Brand Name" value="" id="brand_name_id_1"  name="brand_name_in" aria-label="brands" aria-describedby="addon-wrapping">
						<span id="error_1" class="text-danger"></span>
						</div> 
					<div class="col-auto">
                         <button type="submit" name="submit"  onclick=" return fun_brand()" class="btn btn-main"> Add</button> 
                     </div>                      
                  </div> 
				  </form>
				  
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                   <thead>
                    <tr>
                     <th>ID</th>
                     <th>Brand Name</th>                   
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php 
			   $p = new _pos;
					
							$result = $p->read_brand();  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
					
			   
			   
			   
			   ?>
			   
                  <tr>
                     <td><?php echo $row['id']; ?></td>
                     <td><?php echo $row['brand_name']; ?></td>
                     <td>
					<!-- <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editBrand"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a>-->
					 
					  <a  onclick="edit_attributes('<?php echo $row['id']; ?>','<?php echo $row['brand_name']; ?>')"><i class="fas fa-edit me-1"></i></a>| 
					  
					  <a onclick="delete_attributes('<?php echo $BaseUrl?>/store/pos-dashboard/delete_brand_list.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
					 
					 </td>
                  </tr>
					<?php }}  ?>  
                  <!--<tr>
                     <td>2</td>
                     <td>Canon</td>
                     <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editBrand"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>-->
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
<!-- Modal Edit Brand -->
<div class="modal fade" id="editBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <form action ="" method="post">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="helpM">Edit Brand</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row d-flex">
               <div class="col-auto mobile-view mb-3">
			    <input type="hidden" name="id" id="post_id">
                  <input type="text" class="form-control mb-3 me-2"  id="brand_name_id"  name="brand_name_in" placeholder="Brand Name" aria-label="attributeName" aria-describedby="addon-wrapping">                                             
               </div>                                     
           </div>
        </div>
        <div class="modal-footer">  
         <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
         <button type="submit" name="update" class="btn btn-main mb-3 me-2"><i class="fas fa-save"></i> Update</button>                

      </div>
   </div>
   </form>
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
     var table = $('#table_id').dataTable( );
    
  } );
</script>



<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function delete_attributes(url){
        //alert('jjjjjj');
        Swal.fire({
         title: 'Are you sure want to delete?',

         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',

      }).then((result) => {
         if (result.isConfirmed) {
            window.location = url;
         }
      })  

   }

function edit_attributes(a,b){
       // alert(a);  

       $("#editBrand").modal('show');   
       $("#brand_name_id").val(b);
      
       $("#post_id").val(a);  
      
 }    

function fun_brand(){
	
	var  a = $('#brand_name_id_1').val();
	//alert(a);
	if(a ==''){
		$("#error_1").text("Enter brand name.");
		return false;  
	}


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

<?php  } ?>