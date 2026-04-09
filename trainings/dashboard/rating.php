<?php


	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
        }
	spl_autoload_register("sp_autoloader");
  //echo $_POST["post_id"].'yyy';
  //echo $_POST['rate'];
 
	$p = new _trainingrating;
    $result=$p->read_purchase($_POST["post_id"]);
  if($result){
    $rate=$_POST["rate"];
    $post_id=$_POST["post_id"];
    $arr=array(
        "rating"=>$rate
    );
    $p->update_purchase($arr,$post_id);

  }else{
    $rate=$_POST["rate"];
        $post_id=$_POST["post_id"];

        $pid=$_POST["pid"];
        $uid=$_POST["uid"];
        $arr=array(
            "rating"=>$rate,
            "postid"=>$post_id,
            "pid"=>$pid,
            "uid"=>$uid
        );
        //print_r($arr);die('====000');
	   $p->addPerchaseRating($arr);

  }
        
	
?>