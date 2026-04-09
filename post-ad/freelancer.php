<?php
	//$pf = new _postfield;
          $post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
	  $sf  = new _freelancerposting;


	if($post_id){

		//$result2 = $pf->read($_GET['postid']);
		$result2 = $sf->read1($post_id);
		$result3 = $sf->read2($post_id);
		//echo "here"; echo $sf->ta->sql;
		if($result3){
		$mediafile = "";
		 while ($row2 = mysqli_fetch_assoc($result3)) {
		  $mediafile = $row2['spFileName'];	            
		 }
		}
		if($result2){
			
			$bidPrice = "";
	        $totalDays = "";
	        $profileType = "";
	    
	        $postCategory = "";
	        $profilepostType = "";
	        $skillneded = "";
	        $closingDate = "";
	        $fixedprice = "";
	        $hourlyrate = "";

	        
			while ($row2 = mysqli_fetch_assoc($result2)) {

			/*	echo "<pre>";
				print_r($row2);*/


    if($row2['spPostingPriceHourly']=="1"){
		$c_hourly="checked";
		$one_value_hourly = 1;
	}
	else { 
		$c_hourly="";
		$one_value_hourly = 0;
	}
	
	    if($row2['spPostingPriceFixed']=="1"){
			$c_fixed="checked";
			$one_value_fixed = 1;
		}
		else {
			$c_fixed="";
			$one_value_fixed = 0;
		}




				if($postCategory == ""){
	              /*  if($row2['spPostFieldName'] == 'spPostingCategory_'){*/
	                    $postCategory = $row2['spPostingCategory'];
	                /*}*/
	            }
	            if($profilepostType == ""){
	                if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
	                    $profilepostType = $row2['spPostFieldValue'];
	                }
	            }
	            if($skillneded == ""){
	               /* if($row2['spPostFieldName'] == 'spPostingSkill_'){*/
	                    $skillneded = $row2['spPostingSkill'];
	                /*}*/
	            }
	            if($closingDate == ""){
	                /*if($row2['spPostFieldName'] == 'spPostingExpDt'){*/
	                    $closingDate = $row2['spPostingExpDt'];
	               /* }*/
	            }
	            if($fixedprice == ""){
	                /*if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
	                    $fixedprice = $row2['spPostFieldValue'];
	                }*/
	                  if($row['spPostingPriceFixed'] == 1){
	                  	 $fixedprice = "Fixed Rate";
	                  }else{
	                  	 $hourlyrate ="Hourly Rate";  
	                  }

	            }
	           /* if($hourlyrate == ""){
	                if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
	                    $hourlyrate = $row2['spPostFieldValue'];
	                }
	            }*/

			}
		}
	}
	
?>



			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="spPostingCategory_" class="">Category <span class="red_clr">* <span id="category_error" class="label_error"></span></span></label>
					<select class="form-control spPostField" data-filter="1" class="form-control" id="spPostingCategory_" name="spPostingCategory" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]);?>">
						<option value="0">Category</option>
						<?php
							$m = new _subcategory;
							$catid = 5;
							$result = $m->read($catid);
							if($result){
								while($rows = mysqli_fetch_assoc($result)){?>
									<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php if(isset($postCategory)){if($postCategory == $rows["subCategoryTitle"]){echo "selected";}}?> data-id="<?php echo $rows['idsubCategory']; ?>" ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>";
									<?php
								}
							}
						?>
				  </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="spPostInSubCategory_" class="">Sub Category <span class="red_clr"> </span><span id="subcategory_error" class="label_error"></span></label>
					<select class="form-control spPostField" data-filter="1" class="form-control" id="spPostInSubCategory_" name="spPostInSubCategory" value=""  >
						<option value="0">Sub Category</option>
						<?php if(!empty($spPostInSubCategory)){ ?>

                              
                              <option value="<?php echo $spPostInSubCategory; ?>" selected><?php echo $spPostInSubCategory; ?></option>


					  <?php	} ?>
				  </select>
				</div>
			</div>

			<!-- <div class="col-md-6">
				<div class="form-group">
					<label for="spClosingDate_" class="lbl_4">Closing Date <span class="red_clr">*</span></label>
					<div class="input-group date form_datetime" data-date="" data-date-format="dd-M-yyyy " data-link-field="dtp_input1">
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>  

			<input class="form-control spPostField" data-filter="1" size="16" id="spClosingDate_" name="spClosingDate_" type="text" value="<?php echo date('d-M-Y')?>" >
						
					</div>
					<input type="hidden" id="dtp_input2" value="" /><br/>
				</div>
			</div> -->
			<!-- <div class="col-md-6">
				<div class="form-group" style="margin-bottom: 36px;">
					<label for="spPostingProfiletype_" class="control-label">Profile Type</label>
					<select class="form-control spPostField" id="spPostingProfiletype_" name="spPostingProfiletype_">
						<?php
						$t = new _projecttype;
						$result = $t->readall();
						if($result){
							while ($row = mysqli_fetch_assoc($result)) { ?>
								<option value="<?php echo $row['project_id'];?>" <?php if(isset($profilepostType)){if($profilepostType == $row['project_id']){echo "selected";}}?>><?php echo $row['project_title'];?></option> 
								<?php
							}
						}
						?>
					</select>
				</div>
			</div> -->
			<div class="col-md-12">
				<div class="form-group">
					<label for="spPostExperienceLevl_" class="">Experience Level <span class="red_clr">* <span id="experience_error" class="label_error"></span></span></label>
					<select class="form-control spPostField" id="spPostExperienceLevl_" name="spPostExperienceLevl" />
					<option value="0">Select Experience</option>
						<option value="Entry" <?php if($spPostExperienceLevl == "Entry"){ echo "selected"; } ?>>Entry</option>
						<option value="Intermediate" <?php if($spPostExperienceLevl == "Intermediate"){ echo "selected"; } ?> >Intermediate</option>
						<option value="Expert" <?php if($spPostExperienceLevl == "Expert"){ echo "selected"; } ?> >Expert</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="spPostingSkill_" class="">Skills Needed <span class="red_clr">* <span id="skill_error" class="label_error"></span></span></label>
					<input type="text" class="form-control spPostField" data-filter="1" id="tokenfield-typeahead" name="spPostingSkill" value="<?php if(isset($skillneded)){ echo ($skillneded == '') ? "" : $skillneded;}?>" required placeholder="Type skill and hit enter"  />
				</div>
			</div>
			<!-- Text:-
			<input type="text" name="text" id="a_text" placeholder="enter  the text"> -->
			<?php

$userid=$_SESSION['uid'];
//$profid=$_SESSION['pid'];

$c= new _spuser;


$currency= $c->getcurrency($userid);
$res1= mysqli_fetch_assoc($currency);

// print_r($res1);
// die();
?>
			<div class="col-md-12">
				<div class="form-group">
			<!--<label>Default Currency:</label>-->
				<input type="hidden"class="form-control"name="Default_Currency" value="<?php echo $res1['currency']; ?>">
				</div>
				</div>
			
			<!-- <div class="col-md-6">
				<div class="form-group">
					<label for="spClosingDate_">Closing Date <span id="errorCloseDate"></span></label>
					<input type="date" class="form-control spPostField" data-filter="1" id="spClosingDate_" name="spClosingDate_" value="<?php echo ($closingDate == '') ? "" : $closingDate;?>" required />
				</div>
			</div> -->
			
			<!-- <div class="col-md-6 form-group" style="margin-bottom: 37px;">
	            <label for="contatcby">Contact By</label>
	            <div class="radio form-control no-margin" id="contatcby">
	                <label class="checkbox-inline">
	                    <input type="checkbox" id="spPostingEmail" name="spPostingEmail" value="1" checked > Email
	                </label>
	                <label class="checkbox-inline">
	                    <input type="checkbox" id="spPostingPhone" name="spPostingPhone" value="0"> Phone
	                </label>
	            </div>
	        </div> -->

	        <div class="col-md-6">
				<div class="form-group">
					<label for="spPostingPrice_" class="">Price <span class="red_clr">* <span id="price_error" class="label_error"></span></span></label><br>
					<label class="radio-inline" for="spPostingPrice_" style="margin-bottom: 3px;" >

<?php 




 ?>


			<input type="radio" style="margin-top: 3px;"   class="spPostField fixedprice" data-filter="0" id="spPostingPrice_"  name="spPostingPriceFixed"  <?php if($spPostingPriceFixed==1){echo 'checked';} ?> value="1">Fixed Price</label>
			
			
					<label class="radio-inline" for="spPostingPrice_1" >
					
					<input type="radio" style="margin-top: 3px;"  class="spPostField hourlyrate" data-filter="0" id="spPostingPrice_1" name="spPostingPriceFixed"  <?php if($spPostingPriceFixed==0){echo 'checked';} ?> value="0">Hourly Rate
					
					</label>
					<div class="cost">
						
						
						<?php
						if(isset($fixedprice) && $fixedprice == 1){
							?>
							<div class='input-group'><span class='input-group-addon'>USD</span><input type='text' id='sppostcost' class='form-control' style='width:5cm;' name='spPostingPrice' value="<?php echo $ePrice;?>" onKeyUp="numericFilter(this);"  maxlength="10" ></div>
							<?php
						}else{
							?>
							<div class='input-group'><span class='input-group-addon'>USD</span><input type='text' id='sppostcost' class='form-control' style='width:5cm;' name='spPostingPrice' value="<?php echo $ePrice;?>" onKeyUp="numericFilter(this);" maxlength="10" ></div>
							<?php
						}

						if(isset($hourlyrate) && $hourlyrate == 1){
							?>
							<div class='input-group' style='width:5cm;'><span class='input-group-addon'>USD</span><input type='text' id='sppostcost' class='form-control' style='width:5cm;' name='spPostingPrice' value="<?php echo $ePrice;?>" onKeyUp="numericFilter(this);" ><span class='input-group-addon'>/hour</span></div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
        <div class="form-group">
          <label for="mediaFiles">Files <span class="red_clr"><span id="spPostingMedia_error" class="label_error"></span></span></label>
          <input type="file" name="mediaFiles[]" id="mediaFiles"  multiple="" class="fileimage" value="<?php if(isset($mediafile)){ echo ($mediafile == '') ? "" : $mediafile;}?>"/>
            <?php if(!empty($mediafile)) { ?>
             <p>Uploaded File: <a target="_blank"><?php echo basename($mediafile); ?></a></p>
             <?php } ?>
          <span class="validation" style="display:none;"> Upload Max 5 Files allowed </span>
        </div>
      </div>
		</div>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
		
		<script>

			$(document).ready(function(){
			// Initialize select2
			$("#spPostingCategory_1").select2();
			$("#spPostingCategory_1").select2("val", "4");
			$('#spPostingCategory_1 option:selected').text('Vizag');
			});
      
		</script>
		<!-- <script>
		$(document).ready(function(){
    $('#spPostSubmitFreelance').click(function(){
		alert('eeeee');
        var check = true;
        $("input:radio").each(function(){
            var name = $(this).attr("name");
            if($("input:radio[name="+name+"]:checked").length == 0){
                check = false;
            }
        });
        
        if(check){
            $("#price_error").text("");
        }else{
				$("#price_error").text("Please select one");			
				return false;
        }
    });
});
		
		</script> -->
		
		
<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("mediaFiles").addEventListener("change", function() {
    var fileInput = this;
    var isValid = true;

    for (var i = 0; i < fileInput.files.length; i++) {
      var file = fileInput.files[i];
      if (file.type !== "application/pdf") {
        isValid = false;
         break;
      }
    }

    if (!isValid) {
      alert("Please upload only PDF files.");
      fileInput.value = "";
    }
  });
});
</script>
		
		
		
	
	
