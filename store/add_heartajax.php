<?php
    session_start();

    include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $fv = new _store_favorites;
  //   $selltype= strtolower($_GET['selltype']);

    // $cattid= $_GET['catid'];
     //echo $cattid;
     //echo "<br>";

    $postid = $_POST['postid'];
    //echo $postid;
     //echo "<br>";
    $pid = $_SESSION['pid'];
    //echo $pid;
     //echo "<br>";
    $uid = $_SESSION['uid'];
    //echo $uid;
     //echo "<br>";

    $data = array("spProfiles_idspProfiles"=>$pid,
        "spPostings_idspPostings"=>$postid,
        "spUserid"=>$uid
);


    $res_fv = $fv->addstorefavorites($data);

   // if($res_fv){
     /* if($selltype=="retail"){
   
        header("Location: $BaseUrl/retail/detail.php?catid=$cattid&postid=$postid");  
   }
   
   if($selltype=="wholesaler"){
   
        header("Location: $BaseUrl/store/detail.php?catid=$cattid&postid=$postid");
   }
   
    
   if($selltype=="auction"){
   
        header("Location: $BaseUrl/store/detail.php?catid=$cattid&postid=$postid");
   }*/

?>    