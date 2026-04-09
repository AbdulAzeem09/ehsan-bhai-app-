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

    if(isset($_POST["news_id"])) {
        
        $post["news_id"] = $_POST["news_id"];
        $post["userid"] = $_SESSION["uid"];
        $post["pid"] = $_SESSION["pid"];
        $post["comment"] = $_POST["comment"];
		

        $n->add_news_comment($post);
		
     $nn = new _news;
     $rss=$nn->add_news_comment_read($post);

        
		$commends=$_POST["comment"];
		$pidn=$_SESSION["pid"];
		$uidn=$_SESSION["uid"];
		$newsid=$_POST["news_id"];
		$pidsa=$_POST["spids"];
		$date = date('Y-m-d H:i:s');
			$data=array(
															
															'news_link'=>$commends,
															'sender_pid'=>$pidn,
															'sender_uid'=>$uidn,
															'receiver_pid'=>$pidsa,
															'share_datetime'=>$date
															 
															);
															$newsn= $nn->news_notifications($data);
		
		
     $rw=mysqli_fetch_assoc($rss);
      if($rw){
	?>
	<script>
			window.location.href = "<?php echo $BaseUrl; ?>/news/?mssg=success&page=1";
		</script>
	<?php
}

	
		}
            
    }

?>