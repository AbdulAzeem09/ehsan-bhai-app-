
<?php
    //include('../../unive/baseurl.php');
    //session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $countryId = $_POST['countryId'];
    $stateId = $_POST['stateId'] ?? 0;

?> 
        
            <label for="spProfilesState">State<span class="red">* <span class="lbl_6"></span></span></label>
            <select class="form-control" id="spProfilesState" name="spProfilesState" >
                <option value=''>Select State</option>
                <?php
                $pr = new _state;
                $result2 = $pr->readState($countryId);
                if($result2 != false){
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<option value='".$row2["state_id"]."' ".($stateId == $row2["state_id"] ? 'selected' : '').">".$row2["state_title"]."</option>";
                    }
                }
                ?>
            </select>
        
   

    <script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spProfilesState").on("change", function () {
        
            //alert(this.value);
            var state = this.value;
            $.post("loadcity.php", {state: state}, function (r) {
                //alert(r);
                $(".loadCity").html(r);
                <?php if(isset($pre_data)){ ?>
                    $("#spProfilesCity").val("<?= $pre_data['spPostingsCity'] ?>");
                <?php }else{ ?>
                    //alert();
                    $("#spProfilesCity").val("<?= $user_data['spUserCity'] ?>");
                <?php } ?>
            });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    