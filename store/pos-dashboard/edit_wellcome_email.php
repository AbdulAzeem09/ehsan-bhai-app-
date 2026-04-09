

<?php
//die('==========');
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


//print_r($_SESSION); die();
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
		  
   <h3 class="py-3">Welcome Email Content</h3>
   <div class="row justify-content-md-center"> 
      <div class="col-auto text-center mb-3">
         <?php $us= new _pos;
         $wr=$us->read_Wellcomeemail_c($_SESSION['uid'],$_SESSION['pid']); 

         if($wr){

           $data_w=mysqli_fetch_assoc($wr);
			//print_r($row1);
			//die('==');
		 
           ?>

         <form action="add_edit_wellcome_email.php" method="post" enctype="multipart/form-data">
            <div class=""> 

                 <input type="hidden" name="id"  value="<?php echo $data_w['id'];  ?>" />

			   <label for="spUserEmail" class="control-label" style="display:flex">Paragraph:
                </label>
				<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea class="form-control mb-3" name="paragraph_w1" id="spPostingNotes_w" style="display:none;" required><?php echo $data_w['paragraph']; ?></textarea>

<div id="editor-container_w" style=" height: 135px;background-color: white;width: 450px; "><?php echo $data_w['paragraph']; ?></div>


<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill = new Quill('#editor-container_w', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill.on("text-change", function() {
var editor_content_w = quill.container.firstChild.innerHTML ;

document.getElementById("spPostingNotes_w").value = editor_content_w;
//alert(editor_content);
});
</script>

<br>
    <!-- <label for="subject" class="control-label" style="display:flex">Subject:</label>

               <input type="text" name="subject_w1" class="form-control" value="<?php echo $data_w['subject']; ?>" placeholder="Enter Subject"/>-->
			 
			 <?php
			 $data=$_GET['customer_id'];
			 //print_r($data);
			 $i=0;
			  while($i<sizeof($data)){
				  //echo $data[$i];
				  echo "<input type='hidden' name='customer_id[]'  value='".$data[$i]."'>";
				  
				  $i++;
			  }
			 ?>
               <input type="submit" style="margin-top: 10px;" name="btn_update_w" class="btn btn-main float-end" value="Send Email" />
            </div>
         </form>

         <?php


      } else{ ?>

         <form action="add_edit_wellcome_email.php" method="post" enctype="multipart/form-data">
            <div class="">
			<label for="spUserEmail" class="control-label" style="display:flex">Paragraph:</label>
			<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
			  <textarea class="form-control mb-3" name="paragraph_w" id="spPostingNotes2_w" style="display:none;" required></textarea>

<div id="editor-container2_w" style=" height: 135px;background-color: white;width: 450px; "></div>
<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill1 = new Quill('#editor-container2_w', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill1.on("text-change", function() {
var editor_content1_w = quill1.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes2_w").value = editor_content1_w;
//alert(editor_content1);
});
</script> 
			   </label>
			 
<br>
<!--<label for="subject" class="control-label" style="display:flex">Subject:</label>

               <input type="text" name="subject_w" class="form-control" value="" placeholder="Enter Subject"/>-->
			   <?php
			 $data=$_GET['customer_id'];
			 //print_r($data);
			 $i=0;
			  while($i<sizeof($data)){
				  //echo $data[$i];
				  echo "<input type='hidden' name='customer_id[]'  value='".$data[$i]."'>";
				  
				  $i++;
			  }
			 ?>
               <input type="Submit" style="margin-top: 10px;" name="btn_insert_w" id="btn_insert" class="btn btn-main float-end" value="Submit" />
            </div>
         </form>

         <?php 
      }?>


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
       var table = $('#table_id').dataTable( );

    } );
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
			url: "delete_product.php",
			data: {postid:id}, 
			success: function(response){
				
            window.location.href = "product-list.php";    
			
			}

			});
      }
    })  
	
	
	
}   
      
	  
	   
    </script>
 
</body>
</html>

<?php } ?>