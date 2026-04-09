
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

$active = 1;

$_GET["categoryid"] = "1";


//print_r($_SESSION); die();
?>

<?php 

if(isset($_POST['submit'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$attributeName_in = $_POST['attributeName_in'];
	$attributeValue_in = $_POST['attributeValue_in'];
	
	$data = array("spBuyeruserId" => $uid,
	              "spByuerProfileId" => $pid,
	              "idsop" => $attributeName_in,
	              "opton_values" => $attributeValue_in,
                 'pos_empid' => $_SESSION['pos_emplyee_id']
	);
	
	$pf = new _spproductoptionsvalues;
					
	$res = $pf->create($data);    
	$_SESSION['msg'] =1;
}


?>


<?php 

if(isset($_POST['update'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$id = $_POST['id'];
	$attributeName_in = $_POST['attributeName_in'];
	$attributeValue_in = $_POST['attributeValue_in'];
	
	/*$data = array(
	              "idsop" => $attributeName_in,
	              "opton_values" => $attributeValue_in,
	
	);*/  
	
	$pf = new _spproductoptionsvalues;
					
	$res = $pf->updateopvalue($attributeName_in,$attributeValue_in,$id);   

$_SESSION['msg'] =2;	
	
}


?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Attributes List | TheSharepage-POS </title>
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



            <?php if($_SESSION['msg']=="3"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">
     Delete Successfully .
</div>	   
			   
			   <?php } ?> 
                  <h3>Attributes List</h3>
				  <form action="" method="post">
                  <div class="row d-flex">
				  
                     <div class="col-auto mobile-view mb-3">
                        <!--<input type="text" class="form-control mb-3 me-2" name="attributeName_in" placeholder="Attribute Name" aria-label="attributeName" aria-describedby="addon-wrapping">--> 
                       <select class="form-control form-select shadowBox mb-3 me-2" id="attributeName" name="attributeName_in" required>
                                 <option value='' >Select attributes</option>
                                 <option value="1">Color</option>
                                 <option value="2">Size</option>
                                 
                              </select>	
                         <span id="error_1" class="text-danger"></span>							  
                     </div>
                     <div class="col-auto mobile-view mb-3">
                       <input type="text" class="form-control mb-3 me-2" id= "attributeValue_in_id" name="attributeValue_in"  placeholder="Attribute Value" aria-label="attributeValue" aria-describedby="addon-wrapping" required>  <span id="error_2" class="text-danger"></span>                           
                    </div>         
                    <div class="col-auto mobile-view mb-3">
                     <button type="submit"  name="submit" onclick="return fun_category()" class="btn btn-main mb-3 me-2"><i class="fas fa-plus"></i> Add</button>
                  </div> 
               	  
               </div> 
			   </form>			
			   
			   
			   
               <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                 <thead>
                   <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Value</th>                     
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php 
			   $p = new _spproductoptionsvalues;
					
							$result = $p->read($_SESSION['uid'],$_SESSION['pid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
					
							
			   
			   
			   ?>
			   
                  <tr>
                     <td><?php echo $i;  ?></td>
                     <td>
					 <?php if($row['idsop'] == 1){
						 
						 echo "color";
					 }
					 
					 if($row['idsop'] == 2){
						 
						 echo "size";  
					 }
					 
					 
					 ?>
					 
					 </td>
                     <td><?php echo $row['opton_values']; ?></td>
                     <td>
					 <!--<button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAttribute"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a>-->
					  <a  onclick="edit_attributes('<?php echo $row['idsopv']; ?>','<?php echo $row['idsop']; ?>','<?php echo $row['opton_values']; ?>')"><i class="fas fa-edit me-1"></i></a>| 
					  
					  <a onclick="delete_attributes('<?php echo $BaseUrl?>/store/pos-dashboard/delete_attributes.php?id=<?php echo $row['idsopv'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
					 
					 
					 </td>
                  </tr>
				  
					<?php  $i++; }} ?>
                 <!-- <tr>
                     <td>2</td>
                     <td>Size</td>
                     <td>Medium</td>
                     <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAttribute"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td>Size</td>
                     <td>Large</td>
                     <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAttribute"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>
                  <tr>
                     <td>4</td>
                     <td>Color</td>
                     <td>Green</td>
                     <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAttribute"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>
                  <tr>
                     <td>4</td>
                     <td>Color</td>
                     <td>Black</td>
                     <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAttribute"><i class="fas fa-edit me-1"></i></button>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>   -->               
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
<!-- Modal Edit Attribute -->
<div class="modal fade" id="editAttribute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
   <form action ="" method="post">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="helpM">Edit Attribute</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row d-flex">
               <div class="col-auto mobile-view mb-3">
			   <input type="hidden" name="id" id="post_id">
                 <!-- <input type="text" class="form-control mb-3 me-2" placeholder="Attribute Name" aria-label="attributeName" aria-describedby="addon-wrapping"> -->
                    <select class="form-control form-select shadowBox mb-3 me-2" id="attributeName_id" name="attributeName_in">
                                 <option value="uncategories" selected>Select attributes</option>
                                 <option value="1">Color</option>
                                 <option value="2">Size</option>
                                 
                              </select>						  
               </div>
               <div class="col-auto mobile-view mb-3">
                 <input type="text" class="form-control mb-3 me-2" id="attributeValue_id" name="attributeValue_in" placeholder="Attribute Value" aria-label="attributeValue" aria-describedby="addon-wrapping">                         
              </div>         
              <div class="col-auto mobile-view mb-3">

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
         cancelButtonText: 'NO',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes'
     

      }).then((result) => {
         if (result.isConfirmed) {
            window.location = url;
         }
      })  

   }

function edit_attributes(a,b,c){
       // alert(a);  

       $("#editAttribute").modal('show');   
       $("#attributeName_id").val(b);
       $("#attributeValue_id").val(c);
       $("#post_id").val(a);
      
 }       
 
 function fun_category(){
	 var a = $('#attributeName').val();
	 var b = $('#attributeValue_in_id').val();
	 if(a=='' || b==''){
	 if(a==''){
		 $("#error_1").text("Select Attribute.");
		 
	 }else{
		 $("#error_1").text("");
	 }
	 
	  if(b ==''){
		  $("#error_2").text("Enter Attribute Value.");
		 
	 }else{
		 $("#error_2").text("");
	 }
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

<?php } ?>