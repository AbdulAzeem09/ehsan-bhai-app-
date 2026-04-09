<?php
include('../../univ/baseurl.php');

	
$id=$_GET['id'];
//echo $id;
//die('=====');
$sqlc="SELECT * FROM company_news WHERE idcmpanynews =$id";
	$resc= dbQuery($dbConn, $sqlc);
	//print_r();
	//die('==========');
	if($resc){
	$row = mysqli_fetch_array($resc);
	//print_r($row);
	//die('======');
	}


?>
<html>
	<body>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
	
		<span style="font-size:20px;">Company News<small>[List]</small></span>
			
	</section>
	<!-- Main content -->
	
	<section style="margin-top: 15px;">
      
       
            <div class="row" style="margin-right: 0px !important;
margin-left: 35px;">
               <div class="">
                 

                 <form action="companyUpdate.php" method="POST">
                     <div class="row">
					 
                        <div class="col-md-8">
                                                        
                    <label for="cmpanynewsTitle">companynewsTitle</label>
                    <input type="text" class="form-control"  name="companynewsTitle" id="cmpanynewsTitle" placeholder="enter a companynewsTitle" value="<?php echo $row['cmpanynewsTitle'];   ?>" >
                                                
                   <label for="cmpanynewsDesc">cmpanynewsDesc</label>
                    <input type="text" class="form-control" id="cmpanynewsDesc" name="cmpanynewsDesc" placeholder="enter a cmpanynewsDesc"value="<?php echo $row['cmpanynewsDesc'];   ?>" >
					
					 <label for="spProfiles_idspProfiles">spProfiles_idspProfiles</label>
                    <input type="text" class="form-control" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles"  placeholder="enter a spProfiles" value="<?php echo $row['spProfiles_idspProfiles'];   ?>">
					
					 <label for="cmpanynewsdate">cmpanynewsdate</label>
                    <input type="date" class="form-control" id="cmpanynewsdate" name="cmpanynewsdate"  placeholder="enter a cmpanynewsdate" value="<?php echo $row['cmpanynewsdate'];   ?>">
					
					 <label for="cmpanynewsStatus">cmpanynewsStatus</label>
                    <input type="text" class="form-control" id="cmpanynewsStatus" name="cmpanynewsStatus" placeholder="enter a cmpanynewsStatus" value="<?php echo $row['cmpanynewsStatus'];   ?>" >
					
					 <label for="banDesc">banDesc</label>
                    <input type="text" class="form-control" id="banDesc" name="banDesc"  placeholder="enter a banDesc" value="<?php echo $row['banDesc'];   ?>" ><br>
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
		
		