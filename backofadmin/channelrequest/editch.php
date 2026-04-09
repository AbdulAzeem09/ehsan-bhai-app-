<?php


 
$id=$_GET['id'];
$cmds="select *from rss_addchannel where id='$id'";
$res=dbQuery($dbConn,$cmds);
$result=mysqli_fetch_assoc($res);

 ?>
 <div style="margin-left: 15px;">
<section>
<h3> Update Channel</h3>
</section>
<style>
 
</style>
<form method="post" action="" style="width:60%">
<label>Website Name<span class="sp">*</span></label>
<input type="text" class="form-control" name="bwebsite" value="<?php echo $result['website_name']; ?>">
<label>Website Link<span>*</span></label>
<input type="text" class="form-control" name="blink" value="<?php echo $result['website_link']; ?>">
<label>News types</label>
 
<select class="form-control" name="spnews" value="<?php echo $result['news_type']; ?>">
<option>Select category</option>
<option <?php if($result['news_type'] == 'local'){ echo 'selected'; } ?>>local</option>
<option <?php if($result['news_type'] == 'Country wise'){ echo 'selected'; } ?>>Country wise</option>
 
</select>
 <div class="form-group">
<label>country:</label>
  <select id="news_country" class="form-control myclass" name="country" value="<?php echo $result['country']; ?>">
<option value="0">select country</option>
<?php 
            $country="select*from tbl_country";
			$res = dbQuery($dbConn,$country);
                    
                     if ($res != false) {
                       while ($row1 = mysqli_fetch_assoc($res)) {
						   ?>
						   
                       
                        <option <?php if($result['country']==$row1['country_id']){ echo 'selected';} ?> value='<?php echo $row1['country_id']; ?>'><?php echo $row1['country_title']; ?></option>
                        <?php
						
						$country_id=$row1['country_id']; 
                     }
                  }
                  ?>
</select>
</div>
<div class="form-group">
            <label for="news_State" class="control-label">State<span class="red">*</span></label>
            <select class="form-control" id="news_State" name="news_State">
                <option value="0">Select State</option>
                <?php
				 $countryid=$result['country'];
                $states="select*from tbl_state where country_id='$countryid'";

                 $ress=dbQuery($dbConn,$states);
                if($ress != false){
                    while ($row22 = mysqli_fetch_assoc($ress)) {
					  if($result['state']==$row22['state_id']){ $sel= 'selected';}else { $sel='';} 
					 
                        echo "<option ".$sel."  value='".$row22['state_id']."'>".$row22["state_title"]."</option>";
                    }
                }
                ?>
            </select>
             <span id="shippstate_error" style="color:red;"></span>
        </div>
			
			<div class="form-group">
               <label for="news_category" class="lbl_7">Category
                  <span class="red">* <span class="spUserCountry erormsg"></span></span>
               </label>
               <select id="news_category" class="form-control" name="category" value="<?php echo $result['category']; ?> required>
                  <option value="">Select Category</option>
                  <?php
                  $category="select *from news_categories";
                    $cats=dbQuery($dbConn,$category);
                  if ($cats != false) {
                     while ($row2 = mysqli_fetch_assoc($cats)) {
                        ?>
                        <option <?php if($result['category']==$row2['id']){ echo 'selected';} ?> value='<?php echo $row2['id']; ?>'><?php echo $row2['name']; ?></option>
                        <?php
                     }
                  }
                  ?>
               </select>
            </div>
			<input type="submit" name="btndata" class="btn btn-success" value="Update">
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
	
	$updates="update rss_addchannel set website_name='$websitename',website_link='$weblink',news_type='$tnews',country='$country',state='$states',category='$scategory' where id='$id'";
	$sres=dbQuery($dbConn,$updates); 
	
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