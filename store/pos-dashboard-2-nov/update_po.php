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
		$p = new _pos_po;
															
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
					  <h1>Update PO</h2>
					 
					 <form action="../update_detail_po.php" method="post" enctype="multipart/form-data" class="" >  

  
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
      <label class="add_shippinglabel" for="ship_">Ship:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="ship_" placeholder="" name="ship" value="<?php echo $row['ship'] ?>" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="on_hand_">On Hand:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="on_hand_" placeholder="" name="on_hand" value="<?php echo $row['on_hand'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_">Quantity:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_" placeholder="" name="quantity" value="<?php echo $row['quantity'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_sold_">Quantity Sold:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_sold_" placeholder="" name="quantity_sold" value="<?php echo $row['quantity_sold'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="quantity_record_">Quantity Record:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="quantity_record_" placeholder="" name="quantity_record" value="<?php echo $row['quantity_record'] ?>" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="unit_cost_">Unit Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="unit_cost_" placeholder="" name="unit_cost" value="<?php echo $row['unit_cost'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="total_cost_">Total Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="total_cost_" placeholder="" name="total_cost" value="<?php echo $row['total_cost'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	
	
	 <div class="row">
	 
	
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="mi_">MI:<span class="red"></span></label>
              
    <input type="text" class="form-control"   id="mi_" placeholder="" name="mi" value="<?php echo $row['mi'] ?>" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-6">
	  <div class="form-group" style="margin-top: 23px;">
      <label class="add_shippinglabel" for="GST_">GST:<span class="red"></span></label>
       <?php if($row['GST'] == 1){?>       
    <input type="checkbox" class=""   id="GST_" placeholder="" value="0" name="GST" checked >  
       <!--<span id="shippname_error" style="color:red;"></span>-->
	   <?php }else{ ?>
	    <input type="checkbox" class=""   id="GST_" placeholder="" value="1" name="GST" >  
	   <?php }?>
    </div>
	 
	</div>  
	
	</div>
	
	<div class="form-group">
  <label class="add_shippinglabel" for="notes_">Notes<span class="red"></span></label>
  <textarea class="form-control" rows="2" name="notes" id="notes_" required><?php echo $row['notes'] ?></textarea>    
   <span id="shippaddress_error" style="color:red;"></span>
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