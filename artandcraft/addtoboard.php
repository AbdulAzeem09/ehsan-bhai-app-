<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _addtoboard;
    if($_POST['remove']){
        $p->removeboard($_POST['spPosting_idspPosting'], $_POST['spProfile_idspProfile']);
    }else{
        $result = $p->chkExist($_POST['spPosting_idspPosting'], $_POST['spProfile_idspProfile']);
        if($result != false){

        }else{
            $id = $p->create($_POST);       
            echo $id;
        }
    }
    
    
    
?>