<?php

function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spgroup;
	$img = $_POST["groupPic"];
	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);
    $pid=$_POST["groupid"];
    $data1=array(
'idspGroup'=>$pid,
'spgroupimage'=>$data

    );
	$p->insrtpic($data1);
?>