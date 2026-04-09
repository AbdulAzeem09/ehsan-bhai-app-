
<?php
    
    //session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $categoryId = $_POST['categoryId'];


    $co = new _spAllStoreForm;
    $result3 = $co->readInSubCategory($categoryId);
    //echo $co->ta->sql;
    if($result3 != false){
        while ($row3 = mysqli_fetch_assoc($result3)) {
            echo "<option value='".$row3['insubcatTitle']."'>".$row3['insubcatTitle']."</option>";
        }
    }
    ?>