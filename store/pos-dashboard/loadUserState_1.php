
<?php
    //include('../../unive/baseurl.php');
    //session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $countryId = $_POST['countryId'];
?>


    
    <label for="spUserState" class="control-label lbl_7">State<span class="red"></span></label>
    <select class="form-control"  name="spUserState" id="spPostingsState_1"  >  
        <option value="">Select State</option>
        <?php
        $pr = new _state;
        $result2 = $pr->readState($countryId);
       // echo $pr->ta->sql;
        if($result2 != false){
            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<option value='".$row2["state_id"]."'>".$row2["state_title"]."</option>";
            }
        }
        ?>
    </select>
	
        

     <script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spPostingsState_1").on("change", function () {
        
            //alert(this.value);
            var state = this.value;
            $.post("../loadUserCity.php", {state: state}, function (r) {
                //alert(r);
                $(".loadCity").html(r);
            });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    