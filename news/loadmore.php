<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/
include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	







 
// configuration


$row = $_POST['row'];
$rowperpage = 10;

// selecting posts
//$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$obj2=new _spprofilefeature;


$res4= $obj2->followedmemberloadmore($_SESSION['pid'],$row,$rowperpage);
if($res4!=false){

$html = '';
/*
while($row = mysqli_fetch_assoc($res4)){
    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
    $shortcontent = substr($content, 0, 160)."...";
    $link = $row['link'];

    // Creating HTML structure
    $html .= '<div id="post_'.$id.'" class="post">';
    $html .= '<h1>'.$title.'</h1>';
    $html .= '<p>'.$shortcontent.'</p>';
    $html .= '<a href="'.$link.'" class="more" target="_blank">More</a>';
    $html .= '</div>';

}*/

	while(  $row4=mysqli_fetch_assoc($res4)){
														$id=$row4['id'];
														$pids=$row4['pid'];
														$uid=$row4['userid'];
														$msg1=$row4['comment'];


														$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
														if(preg_match($reg_exUrl, $msg1, $url)) {
															$msg= preg_replace($reg_exUrl, '<a target=" " href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $msg1);

														} else {


															$msg= $msg1;

														}

																	//cccccccc
														$date=$row4['comment_date'];

														$ppid=$row4['pid'];
														
                                                       $obj4=new _spprofiles;

														$res5=$obj4->readcommentbypid($ppid);
														$row5=mysqli_fetch_assoc($res5);

														$pic=$row5['spProfilePic'];
														$name=$row5['spProfileName'];
																 // die("9999999999999999999999999999999999999999999");
														 
														 
														 
													 include('rightSidebarData.php');
														 
														 
	} }

echo $html;














	
	 
	 
	?>
	


   