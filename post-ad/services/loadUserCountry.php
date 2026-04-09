
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $idProvision = $_POST['provision'];
?>


    <div class="col-md-4">
        <div class="form-group">
            <label for="spPostCountry_">Country</label>
            <select id="spPostCountry_" class="form-control spPostField " name="spPostCountry">
                <option value="">Select Country</option>
                <?php
                $co = new _country;
                $result3 = $co->readCountry($idProvision);
                if($result3 != false){
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<option value='".$row3['country_id']."'>".$row3['country_title']."</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spPostCountry_").on("change", function () {
            //alert(this.value);
            var country = this.value;
            $.post("loadcity.php", {country: country}, function (r) {
                //alert(r);
                $(".loadCity").html(r);
            });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    