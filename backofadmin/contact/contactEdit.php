<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('../../univ/baseurl.php');

	

$id=$_GET['id'];
$sqlc="SELECT * FROM tbl_contact WHERE spConId =$id";
	$resc= dbQuery($dbConn, $sqlc);
//	print_r($resc);
	
	if($resc){
	$row = mysqli_fetch_array($resc);
	// print_r($row);
	
	}

?>
<html>
	<body>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
	
		 <span style="font-size:20px;">Contact</span>
			
	</section>
	<!-- Main content -->
	
	<section style="margin-top: 15px;">
      
       
            <div class="row" style="margin-right: 0px !important;
margin-left: 35px;">
               <div class="">
                 

                 <form action="contactUpdate.php" method="POST">
                     <div class="row">
					 
                        <div class="col-md-8">
                                                        
                   <label for="spConCom">spConCom</label>
                              <input type="text" class="form-control"  name="spConCom" id="spConCom" placeholder="enter a spConCom" value="<?php echo $row['spConCom'];  ?>"  >
                                                
                   <label for="spConName">spConName</label>
                    <input type="text" class="form-control" id="spConName" name="spConName" placeholder="enter a spConName"value="<?php echo $row['spConName'];  ?>" >
					
					 <label for="spConPho">spConPho</label>
                    <input type="number" class="form-control" id="spConPho" name="spConPho"  placeholder="enter a spConPho"value="<?php echo $row['spConPho'];  ?>" >
					
					 <label for="spConEmail">spConEmail</label>
                    <input type="email" class="form-control" id="spConEmail" name="spConEmail"  placeholder="enter a spConEmail" value="<?php echo $row['spConEmail'];  ?>" >
					
					 <label for="spConDesc">spConDesc</label>
                    <input type="text" class="form-control" id="spConDesc" name="spConDesc" placeholder="enter a spConDesc" value="<?php  echo $row['spConDesc'];  ?>" >
					
					 <label for="spConStatus">spConStatus</label>
                    <input type="text" class="form-control" id="spConStatus" name="spConStatus"  placeholder="enter a spConStatus" value="<?php echo $row['spConStatus'];  ?>" >
					
					 <label for=" g-recaptcha-response "> g-recaptcha-response</label>
                    <input type="text" class="form-control" id=" g-recaptcha-response " name="g_recaptcha_response"  placeholder="enter a  g_recaptcha_response " value="<?php  echo $row['g_recaptcha_response'];  ?>">
					 
					 <label for="spConTopic">spConTopic</label>
                    <input type="text" class="form-control" id="spConTopic" name="spConTopic"  placeholder="enter a spConTopic" value="<?php echo $row['spConTopic'];  ?>" >
					
					<label for="spConSubj">spConSubj</label>
                    <input type="text" class="form-control" id="spConSubj" name="spConSubj"  placeholder="enter a spConSubj" value="<?php echo $row['spConSubj'];  ?>"><br>
					
					
                      <input type="hidden" name="id" value="<?php echo $id;?>">  
					  
                       <input class="btn btn-primary pull-right" type="submit" name="update" value="update" >  
                        
                           
                        </div>
                                               
                     </div>
                  
                       
            </form>

         </div>
      </div>
      
      
   

</section>
</body>
</html>
<!-- /.content --><script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>	
		
		