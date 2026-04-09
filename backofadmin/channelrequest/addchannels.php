<div style="margin-left: 15px;">
<section>
<h3> Add New Channel</h3>
</section>
<style>
 
</style>
<form method="post" action="" style="width:60%">
<label>Website Name<span class="sp">*</span></label>
<input type="text" class="form-control" name="bwebsite">
<label>Website Link<span>*</span></label>
<input type="text" class="form-control" name="blink">
<label>News types</label>
<select class="form-control" name="spnews">
<option>Select category</option>
<option>local</option>
</option></option>
</select>
 <div class="form-group">
<label>country:</label>
  <select id="news_country" class="form-control myclass" name="country">
<option value="0">select country</option>
<?php 
                $country="select*from tbl_country";
			$res = dbQuery($dbConn,$country);
                    
                     if ($res != false) {
                       while ($row1 = mysqli_fetch_assoc($res)) {
						   ?>
						   
                       
                        <option value='<?php echo $row1['country_id']; ?>'><?php echo $row1['country_title']; ?></option>
                        <?php
						
						$country_id=$row1['country_id']; 
                     }
                  }
                  ?>
</select>
</div>
<div id="news_State">
               <label>State</label>
			   <input type="text" class="form-control" placeholder="Select State" style="margin-bottom:15px">
            </div>
			
			<div class="form-group">
               <label for="news_category" class="lbl_7">Category
                  <span class="red">* <span class="spUserCountry erormsg"></span></span>
               </label>
               <select id="news_category" class="form-control" name="category" required>
                  <option value="">Select Category</option>
                  <?php
                  $category="select *from news_categories";
                    $cats=dbQuery($dbConn,$category);
                  if ($cats != false) {
                     while ($row2 = mysqli_fetch_assoc($cats)) {
                        ?>
                        <option value='<?php echo $row2['id']; ?>'><?php echo $row2['name']; ?></option>
                        <?php
                     }
                  }
                  ?>
               </select>
            </div>
			<input type="submit" name="btndata" class="btn btn-success">
</form>
</div>




<?php
if (isset($_POST['btndata']))
{
	$websitename=$_POST['bwebsite'];
	$weblink=$_POST['blink'];
	$tnews=$_POST['spnews'];
	$country=$_POST['country'];
	$states=$_POST['news_State'];
	$scategory=$_POST['category'];
	
	$inserts="insert into rss_addchannel(website_name,website_link,news_type,country,state,category)values('$websitename','$weblink','$tnews','$country','$states','$scategory')";
	$sres=dbQuery($dbConn,$inserts);
?>
<script>
window.location.replace("<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=worldnewsns");
 </script>	
 <?php
}
 ?>
<script>

$(document).ready(function(){
	 $("#news_country").on("change", function () {
		 var x= $(this).val();
		// alert(x);
		 
		 	$.ajax({
							  url: "loaduserstate.php",
							type: "POST",
							cache:false,
						 data: {'country_id':x},
						success: function(data) {
	                                              												// location.reload();
					$('#news_State').html(data);	
															  
							}
												
					});
		 
		   
	   });
   });
   
   
   
</script>