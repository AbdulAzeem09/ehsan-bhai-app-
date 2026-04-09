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
					 <h1>Create New Sales</h2>
					 
					 <form action="add_detail_sales.php" method="post" enctype="multipart/form-data" class="" >   

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">


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
      <label class="add_shippinglabel" for="size_">Size:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="size_" placeholder="" name="size" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="color_">Color:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="color_" placeholder="" name="color" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="width_">Width:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="width_" placeholder="" name="width" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_">Quantity:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_" placeholder="" name="quantity" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="s_unit_">S. Unit:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="s_unit_" placeholder="" name="s_unit" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="u_price_">U. Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="u_price_" placeholder="" name="u_price" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="discount_">Discount:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="discount_" placeholder="" name="discount" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	
	
	 <div class="row">
	 
	
	 <div class="col-md-4 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="amount_">Amount:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="amount_" placeholder="" name="amount" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	 <div class="col-md-4 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="g_">G:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="g_" placeholder="" name="g_sales" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-4 ">
	  <div class="form-group" >
      <label class="add_shippinglabel" for="p_sales_">P:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="p_sales_" placeholder=""  name="p_sales" required>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
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