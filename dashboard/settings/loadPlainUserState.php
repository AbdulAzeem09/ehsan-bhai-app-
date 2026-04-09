
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
   
    $pr = new _state;
    $result2 = $pr->readState($countryId);
    echo "<option value=''>Select State</option>";
    if($result2 != false){
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo "<option value='".$row2["state_id"]."'>".$row2["state_title"]."</option>";
        }
    }
    ?>

    
    