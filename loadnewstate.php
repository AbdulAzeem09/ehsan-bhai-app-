
<?php
    //include('../../unive/baseurl.php');
    //session_start();
    function sp_autoloader($class){
        include 'mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $countryId = $_POST['countryId'];
?>
        <option value="0" selected>Select State</option>
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
 

    
