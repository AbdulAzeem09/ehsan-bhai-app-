 <?php
 require_once '../library/config.php';
	require_once '../library/functions.php';
   $countryId = $_POST['country_id']; 
 
 ?>
 <div class="form-group">
            <label for="news_State" class="control-label">State<span class="red">*</span></label>
            <select class="form-control" id="news_State" name="news_State">
                <option value="0">Select State</option>
                <?php
				 
                $states="select*from tbl_state where country_id='$countryId'";

                 $ress=dbQuery($dbConn,$states);
                if($ress != false){
                    while ($row22 = mysqli_fetch_assoc($ress)) {
                        echo "<option value='".$row22["state_id"]."'>".$row22["state_title"]."</option>";
                    }
                }
                ?>
            </select>
             <span id="shippstate_error" style="color:red;"></span>
        </div>