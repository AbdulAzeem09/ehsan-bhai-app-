<?php



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
$obj2=new _spprofiles;
$res4= $obj2->loadmoredata($row,$rowperpage);


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

	                                                    while(  $roow4=mysqli_fetch_assoc($res4)){
																	$id=$roow4['id'];
																	$uid=$roow4['userid'];
																	$msg=$roow4['comment'];
																	$date=$roow4['comment_date'];
																	$pid1=$roow4['pid'];
																	
																$ppid=$roow4['pid'];
																
																
																$res5=$obj2->readcommentbypid($ppid);
																$row5=mysqli_fetch_assoc($res5);
																
																 $pic=$row5['spProfilePic'];
															$name=$row5['spProfileName'];
																 // die("9999999999999999999999999999999999999999999");
																 
																     $ob=new _spprofilefeature;
																		$pid2=$_SESSION['pid'];
																		$rr1=$ob->bookmarkeddata($pid2);
																		if($rr1 !=false){
																		
																		while($row9=mysqli_fetch_assoc($rr1)) {
																			
																		    if($row9['comment_id']!=$id){
																				continue;
																		}
																 //print_r($rr1);
	                                                                 //die("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$"); 
														  


                                                        include('bookmarkData.php');

	                                                       

echo $html;


}}} ?>











	
	 
	 
	
	


   