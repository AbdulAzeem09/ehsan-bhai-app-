
<?php
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p = new _spprofiles;

    $proId = $_POST['proId'];
    
    if(isset($proId[0]) && $proId[0] != ''){
        foreach ($proId as $key => $value) {
            //echo $value."<br>";
            $result = $p->read($value);
            if($result != false){
                $row = mysqli_fetch_assoc($result);
                echo "<span>".$row['spProfileName']."</span>";
            }
        }
    } 
   
    
?>
    