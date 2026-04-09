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
?>
<!DOCTYPE html>
<html lang="en-US"> 
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>   
        

    </head>
<style>
#header{margin-top: 25px!important;}
</style>
    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    
 <section class="main_box">
            <div class="container">
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding" >
                        <div class="left_grid store_left_cat" >
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					
					<div class="col-md-1"></div>
					
					 <div class="col-md-8 bg_white" style="padding-bottom: 15px; margin-top: 20px;">
					 <h1>Create New PO</h2>
					 
					 <form action="add_detail_po.php" method="post" enctype="multipart/form-data" class="" >   

  



    <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="iteam_">Iteam:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="iteam_" placeholder="Enter Your Iteam" name="iteam" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="ship_">Ship:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="ship_" placeholder="" name="ship" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="on_hand_">On Hand:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="on_hand_" placeholder="" name="on_hand" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_">Quantity:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_" placeholder="" name="quantity" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_sold_">Quantity Sold:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_sold_" placeholder="" name="quantity_sold" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_record_">Quantity Record:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_record_" placeholder="" name="quantity_record" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="unit_cost_">Unit Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="unit_cost_" placeholder="" name="unit_cost" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="total_cost_">Total Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="total_cost_" placeholder="" name="total_cost" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	
	
	 <div class="row">
	 
	
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="mi_">MI:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="mi_" placeholder="" name="mi" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-6 ">
	  <div class="form-group" style="margin-top: 23px;">
      <label class="add_shippinglabel" for="GST_">GST:<span class="red"></span></label>
              
    <input type="checkbox" class=""   id="GST_" placeholder="" value="1" name="GST" required>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	<div class="form-group">
  <label class="add_shippinglabel" for="notes_">Notes<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="notes" id="notes_" required></textarea>    
   <span id="shippaddress_error" style="color:red;"></span>
  </div>

 <div class="form-group">
  <label class="add_shippinglabel" for="Description">Description<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="Description" id="Description" required></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>

 


    <div class="form-group">        
      <div class="">
        <button type="submit" class="btn btn-default Add_adderess">Add Detail</button>  
      </div>
    </div>

</form>
					
				     </div>
				
				</div>
				</div>
 </section>










    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        // <!-- ========DASHBOARD FOOTER CHARTS====== -->
        include('../../component/dash_btm_script.php');
        ?>
    </body>
</html>
<?php
}
?>