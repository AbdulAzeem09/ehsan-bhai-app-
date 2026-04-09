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
                 

                 <form action="contactInsert.php" method="POST" enctype="multipart/form-data">
                     <div class="row">
					 
                        <div class="col-md-8">
                                                        
                              <label for="spConCom">spConCom</label>
                              <input type="text" class="form-control"  name="spConCom" id="spConCom" placeholder="enter a spConCom"  >
                                                
                   <label for="spConName">spConName</label>
                    <input type="text" class="form-control" id="spConName" name="spConName" placeholder="enter a spConName" >
					
					 <label for="spConPho">spConPho</label>
                    <input type="number" class="form-control" id="spConPho" name="spConPho"  placeholder="enter a spConPho" >
					
					 <label for="spConEmail">spConEmail</label>
                    <input type="email" class="form-control" id="spConEmail" name="spConEmail"  placeholder="enter a spConEmail" >
					
					 <label for="spConDesc">spConDesc</label>
                    <input type="text" class="form-control" id="spConDesc" name="spConDesc" placeholder="enter a spConDesc" >
					
					 <label for="spConStatus">spConStatus</label>
                    <input type="text" class="form-control" id="spConStatus" name="spConStatus"  placeholder="enter a spConStatus" >
					
					 <label for=" g-recaptcha-response "> g-recaptcha-response</label>
                    <input type="text" class="form-control" id=" g-recaptcha-response " name="g_recaptcha_response"  placeholder="enter a  g_recaptcha_response" >
					 
					 <label for="spConTopic">spConTopic</label>
                    <input type="text" class="form-control" id="spConTopic" name="spConTopic"  placeholder="enter a spConTopic" >
					
					<label for="spConSubj">spConSubj</label>
                    <input type="text" class="form-control" id="spConSubj" name="spConSubj"  placeholder="enter a spConSubj" ><br>
					 
					
                        
                       <input class="btn btn-primary pull-right" type="submit" name="submit" value="submit" > 
                        
                           
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
		
		