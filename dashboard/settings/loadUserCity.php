<?php


error_reporting(E_ALL);
ini_set('display_errors', 'On');
    //include('../../unive/baseurl.php');
	//$BaseUrl
    session_start();
    function sp_autoloader($class){
		$home_path = $_SERVER["DOCUMENT_ROOT"];
        
 if($_SERVER['HTTP_HOST']=='localhost'){
    $_SERVER['DOCUMENT_ROOT']='E:/wamp64/www/SHAREPAGE_CODES';
    $BaseUrl='http://localhost/SHAREPAGE_CODES/';
}
        include $home_path.'/mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
?>

<!--
    <div class="col-md-4">
        <div class="form-group">-->
            <label for="spUserCity" class="control-label">City<span class="red">*</span></label>
            <select id="spUserCity" class="form-control " name="spUserCity">
                <?php
                $co = new _city;
                $result3 = $co->readCity($stateId);
                //echo $co->ta->sql;
                if($result3 != false){
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<option value='".$row3['city_id']."'>".$row3['city_title']."</option>";
                    }
                }
                ?>
            </select>
            <span id="shippcity_error" style="color:red;"></span>
       <!-- </div>
    </div> -->


    