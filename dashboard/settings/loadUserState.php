
<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
		$home_path = $_SERVER["DOCUMENT_ROOT"];


        include $home_path.'/mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $countryId = $_POST['countryId'];
?>


   <!--  <div class="col-md-8"> -->
        <div class="form-group">
            <label for="spUserState" class="control-label">State<span class="red">*</span></label>
            <select class="form-control" id="spUserState" name="spUserState" >
                <option value="0">Select State</option>
                <?php
                $pr = new _state;
                $result2 = $pr->readState($countryId);
                if($result2 != false){
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<option value='".$row2["state_id"]."'>".$row2["state_title"]."</option>";
                    }
                }
                ?>
            </select>
             <span id="shippstate_error" style="color:red;"></span>
        </div>
  <!--   </div> -->

    <script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spUserState").on("change", function () {
        
            var state = this.value;
            $.post("loadUserCity.php", {state: state}, function (r) {
                //alert(r);
                $(".loadCity").html(r);
            });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    