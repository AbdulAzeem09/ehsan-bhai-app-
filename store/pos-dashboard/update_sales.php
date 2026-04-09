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

    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    <?php 
		$p = new _pos_sales;
															
	    $result = $p->read_data_id($_GET['postid']);
		
		if ($result) {
                                                               
         while ($row = mysqli_fetch_assoc($result)) {
			 
		
																	
	
	?>
 <section class="main_box">
            <div class="container">
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					
					<div class="col-md-1"></div>
					 <div class="col-md-8 bg_white" style="padding-bottom: 15px; margin-top: 10px;">
					  <h1>Update Sales</h2>
					 
					 <form action="../update_detail_sales.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

<input type="hidden" name="id" value="<?php echo $_GET['postid']; ?>">

 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="iteam_">Iteam:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="iteam_" placeholder="Enter Your Iteam" name="iteam" value="<?php echo $row['iteam'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="size_">Size:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="size_" placeholder="" name="size" value="<?php echo $row['size'] ?>" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="color_">Color:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="color_" placeholder="" name="color" value="<?php echo $row['color'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="width_">Width:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="width_" placeholder="" name="width" value="<?php echo $row['width'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_">Quantity:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_" placeholder="" name="quantity" value="<?php echo $row['quantity'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="s_unit_">S. Unit:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="s_unit_" placeholder="" name="s_unit" value="<?php echo $row['s_unit'] ?>" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="u_price_">U. Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="u_price_" placeholder="" name="u_price" value="<?php echo $row['u_price'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="discount_">Discount:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="discount_" placeholder="" name="discount" value="<?php echo $row['discount'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	
	
	 <div class="row">
	 
	
	 <div class="col-md-4 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="amount_">Amount:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="amount_" placeholder="" name="amount" value="<?php echo $row['amount'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	 <div class="col-md-4 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="g_">G:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="g_" placeholder="" name="g_sales"  value="<?php echo $row['g_sales'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-4 ">
	  <div class="form-group" >
      <label class="add_shippinglabel" for="p_sales_">P:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="p_sales_" placeholder=""  name="p_sales" value="<?php echo $row['p_sales'] ?>" required>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
 <div class="form-group">
  <label class="add_shippinglabel" for="Description">Description<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="Description" id="Description" required><?php echo $row['Description'] ?></textarea>
   <span id="shippaddress_error" style="color:red;"></span>
  </div>

 


    <div class="form-group">        
      <div class="">
        <button type="submit" class="btn btn-default Add_adderess">Update Detail</button>  
      </div>
    </div>

</form>
					
				     </div>
				
				</div>
				</div>
 </section>


<?php  }

		} ?>







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

<script>
$(document).ready(function(){
  $("#x2").click(function(){
	  var a= "<?php  echo $_GET['postid']?>";
	  var b = "first_img";
	  
	  $.ajax({
		  url: "../delete_file.php",
       type: "POST",
       data: {id : a, type:b},
		  success: function(result){
      $("#img2").hide();
	  }
	  });
    
  });
  $("#x1").click(function(){  
	  var a= "<?php  echo $_GET['postid']?>";
	  var b = "second_img"; 
	   $.ajax({
		  url: "../delete_file.php",
       type: "POST",
       data: {id : a, type:b},
		  success: function(result){
     $("#img1").hide();
	  }
	  });
    
  });
});
</script>

 <script>
 
 $(document).ready(function(){
	 
		  $("#spUserCountry_1").on("change", function () { 
		var a = $("#spUserCountry_1").val();
		  $.post("../loadUserState_1.php", {countryId: a}, function (r) {
               // alert(r);
                $(".loadUserState").html(r);
            });
	 });
	 
	  $("#spUserState_1").on("change", function () { 
		var b = $("#spUserState_1").val();
		  $.post("../loadUserCity.php", {state: b}, function (r) {
               // alert(r);
                $(".loadCity").html(r);
            });
	 });
	 
	 
	 });
	 
	 
   
 </script>