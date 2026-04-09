
<?php
    //include('../../unive/baseurl.php');
    //session_start();
    function sp_autoloader($class){
        include 'mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $countryId = $_POST['countryId'];
?>


    
    <label for="spUserState" class="my-2 text-capitalize">State<span class="red">*</span></label>
    <select class="form-select" id="spUserState22" name="spUserState" >
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
    <span class="spUserState erormsg" id="state" style="color:red;"></span> 

    <script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spUserState22").on("change", function () {
          document.getElementById("state").innerHTML = "";
        
          //alert(this.value);
          var state = this.value;
          $.post("loadUserCity.php", {state: state}, function (r) {
            //alert(r);
            $(".loadCity").html(r);
          });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    
