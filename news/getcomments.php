<?php
include '../univ/baseurl.php';
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "videos/";
    include_once "../authentication/check.php";

} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    //echo "<pre>"; print_r($_FILES); print_r($_REQUEST); exit;

    $n = new _news;
    $id = $_POST['id'];
   
    $result = $n->read_news_comment($id);
    // print_r($res);
    // exit();
    $resultarr = [];
    if($result != false){
        while ($row = mysqli_fetch_assoc($result)) {  
            array_push($resultarr,$row);
        }
        header('Content-type:application/json');
        echo json_encode($resultarr);
    } else {
        echo $return = "<h4>No Record Found</h4>";
    }
}
?>


