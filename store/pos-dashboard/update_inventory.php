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

    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    <?php 
		$p = new _pos_inventory;
															
	    $result = $p->read_data_id($_GET['postid']);
		
		
                                                               
        $row = mysqli_fetch_assoc($result); 
	//print_r($row);
		//die('===');
			 
		
																	
	
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
					  <h1>Update Inventory</h2>
					 
					 <form action="../update_detail_inventory.php" method="post" enctype="multipart/form-data" class="" >  

  
<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">

<input type="hidden" name="id" value="<?php echo $_GET['postid']; ?>">



  <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="pro_name">Product Name:<span class="red"></span></label>
              
    <input type="text" class="form-control" value="<?php echo $row['pro_name']; ?>"  id="pro_name" placeholder="Enter Product Name " name="pro_name" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="pur_price">Purchase Price:<span class="red"></span></label>
              
    <input type="text" class="form-control" value="<?php echo $row['purchase_price']; ?>"   id="pur_price" placeholder="Enter Purchase Price" name="purchase_price" required > 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	 <div class="form-group">
      <label class="add_shippinglabel" for="cost_">Cost:<span class="red"></span></label>
              
    <input type="text" class="form-control"  value="<?php echo $row['cost']; ?>"  id="cost_" placeholder="" name="cost" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="sell_pr">Sell Price:<span class="red"></span></label>
              
    <input type="text" class="form-control"  value="<?php echo $row['sell_pr']; ?>"  id="sell_pr" placeholder="" name="sell_pr" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="color">Color:<span class="red"></span></label>
              
    <input type="text" class="form-control" value="<?php echo $row['color']; ?>"  id="color" placeholder="" name="color" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="size">Size:<span class="red"></span></label>
              
    <input type="text" class="form-control"  value="<?php echo $row['size']; ?>"   id="size" placeholder="" name="size" required>      
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="tax">Tax:<span class="red"></span></label>
              
    <input type="text" class="form-control"   value="<?php echo $row['tax']; ?>" id="tax" placeholder="" name="tax" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="barcode">Bar Code:<span class="red"></span></label>
              
    <input type="text" class="form-control" value="<?php echo $row['barcode']; ?>"   id="barcode" placeholder="Enter Bar Code" name="barcode" required> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	</div>
	
	 <div class="row">
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="Category">Select Category:<span class="red"></span></label>
              
    <select class="form-control form-select" id="select_cat"  name="category">
	                    <option value="0" <?php if($row['category']==0){echo 'selected';} ?> >Select Option</option>
                            <option value="Jhone" <?php if($row['category']=="Jhone"){echo 'selected';} ?> >Jhone</option>
                            <option value="Dave" <?php if($row['category']=="Dave"){echo 'selected';} ?>  >Dave</option>
                            <option value="Yusha" <?php if($row['category']=="Yusha"){echo 'selected';} ?>  >Yusha</option>
                         </select>  
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	 <div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="price_">Select Sub Category:<span class="red"></span></label>
              
    <select class="form-control" id="select_sub"   name="subcategory">
                            <option value="0" <?php if($row['subcategory']==0){echo 'selected';} ?>  >Select Option</option>
                            <option value="Jhone" <?php if($row['subcategory']=="Jhone"){echo 'selected';} ?>  >Jhone</option>
                            <option value="Dave"  <?php if($row['subcategory']=="Dave"){echo 'selected';} ?> >Dave</option>
                            <option value="Yusha" <?php if($row['subcategory']=="Yusha"){echo 'selected';} ?> >Yusha</option>
                         </select> 
       <!--<span id="shippname_error" style="color:red;"></span>-->
    </div>
	 
	</div>
	
	<div class="col-md-6 ">
	  <div class="form-group">
      <label class="add_shippinglabel" for="img">Upload file:<span class="red"></span></label>
              
    <input style="display:block" type="file" value="<?php echo $row['file_name']; ?>" id="myfile" name="myfile">
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
  <textarea class="form-control" rows="2" name="Description"  id="Description" required> <?php echo $row['Description']; ?> </textarea>
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