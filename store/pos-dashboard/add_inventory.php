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
    $active = 5;
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
					 <h1>Create New Inventory</h2>
					 
					 <form action="add_detail_inventory.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">


    <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="pro_name">Product Name:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="pro_name" placeholder="Enter Product Name " name="pro_name" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="pur_price">Purchase Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="pur_price" placeholder="Enter Purchase Price" name="purchase_price" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="cost_">Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="cost_" placeholder="" name="cost" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="sell_pr">Sell Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="sell_pr" placeholder="" name="sell_pr" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="color">Color:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="color" placeholder="" name="color" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="size">Size:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="size" placeholder="" name="size" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="tax">Tax:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="tax" placeholder="" name="tax" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="barcode">Bar Code:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="barcode" placeholder="Enter Bar Code" name="barcode" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="Category">Select Category:<span class="red"></span></label>
              
    <select class="form-control form-select" id="select_cat" name="category">
	                            <option value="0">Select Option</option>
                            <option value="Jhone">Jhone</option>
                            <option value="Dave">Dave</option>
                            <option value="Yusha">Yusha</option>
                         </select>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="price_">Select Sub Category:<span class="red"></span></label>
              
    <select class="form-control" id="select_sub" name="subcategory">
                            <option value="0">Select Option</option>
                            <option value="Jhone">Jhone</option>
                            <option value="Dave">Dave</option>
                            <option value="Yusha">Yusha</option>
                         </select> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="img">Upload file:<span class="red"></span></label>
              
    <input style="display:block" type="file" id="myfile" name="myfile">
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	<!-- <div class="row">
	 
	 <div class="col-md-3 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="shipp_username">Type:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="_type" placeholder="Enter Type" name="type" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
  <!--  </div>
	 
	</div>
	 <div class="col-md-3 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="conv_">conv:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="conv_" placeholder="Enter conv" name="conv" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
   <!-- </div>
	 
	</div>
	<div class="col-md-3 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="conv_">Bar Code:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="barcode" placeholder="Enter Bar Code" name="barcode" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
  <!--  </div>
	 
	</div>
	
	<div class="col-md-3 ">
	  <div class="form-group" style="margin-top: 23px;">
      <label class="add_shippinglabel" for="GST_">GST:<span class="red"></span></label>
              
    <input type="checkbox" class=""   id="GST_" placeholder="" value="1" name="GST" required>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
 <!--   </div>
	 
	</div>
	
	</div> -->

 <div class="form-group">
  <label class="add_shippinglabel" for="Description">Description<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="Description" id="Description" required></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>

 


    <div class="form-group">        
      <div class="">
        <button type="submit" class="btn btn-default Add_adderess">Add Inventory</button>  
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