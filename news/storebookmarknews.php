<?php
// echo "Hello"; die();
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

    $n = new _news;

    if(isset($_POST["news_title"])) {
        
        $post["uid"] = $_SESSION["uid"];
        $post["pid"] = $_SESSION["pid"];
        $post["website_name"] = $_POST["website_name"];
        $post["news_link"] = $_POST["news_link"];
        $post["news_title"] = $_POST["news_title"];
        $post["pubDate"] = $_POST["pubDate"];
        $post["news_description"] = $_POST["news_description"];
        $post["news_added_to"] = $_POST["news_added_to"];


        $n->bookmark_news($post);
        echo 1;
            
    }
}
?>