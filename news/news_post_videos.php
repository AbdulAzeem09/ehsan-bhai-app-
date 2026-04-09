
<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 'On');*/


	include '../univ/baseurl.php';

date_default_timezone_set('Asia/Kolkata');

	session_start();

//print_r($_POST); die;
/* function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $p = new _postings;
  if(isset($_POST["idspPostings"]))
  {
  $postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
  }

  else
  {
  if($_POST["spProfiles_idspProfiles"]!=""){
  if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
  $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
  else
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
  }
  } */

  function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
  }

/*print_r($_POST);
exit;*/
//print_r($_FILES);
///die("PPPPPPPPPPPP");
  spl_autoload_register("sp_autoloader");
  
  
  
 //$images= $_FILES['spPostingPic'];
//echo $images;
 //$video= $_FILES['spPostingMedia']; 
 //echo $video; 
 
 
 $obj=new _news ;
 
 
 
 
 
 $newsPic= $_FILES['newsPic'];
 
 $pid=$_SESSION['pid'];
 
 $document= $_FILES['newsDocument'];
 $newsvideo= $_FILES['newsMedia'];   
  $lastid= $_POST['lastid'];
  $randnum= $_POST['randnum'];
    
 

/*if($_FILES['newsDocument']['size'] != 0){
		$File_Name = strtolower($_FILES['newsDocument']['name']);
	$name = $_FILES["newsDocument"]["name"];
	$tmp_name = $_FILES["newsDocument"]["tmp_name"];
		
	 $uploads_dir = 'news_upload';
  move_uploaded_file($tmp_name, "$uploads_dir/$name");

$data=array(

'postid'=>$lastid,
'attachmentfiles'=>$name,
'type'=>1

);

$obj->create_news_attachment($data);
}
*/
 
  
  
 if($_FILES['newsMedia']['size'] != 0){
		 //$File_Name2   = strtolower($_FILES['newsMedia']['name']);
		 
		 $temp = explode(".", $_FILES["newsMedia"]["name"]);
$name2 = round(microtime(true)) . '.' . end($temp);
		 
	// $name2 = $_FILES["newsMedia"]["name"];
	 $tmp_name2 = $_FILES["newsMedia"]["tmp_name"];  
	
	
    $uploads_dir2 = 'news_upload';
  move_uploaded_file($tmp_name2, "$uploads_dir2/$name2");  



$data2=array(

'relation_id'=>$randnum,
'filename'=>$name2, 
'file_type'=>2,
'pid'=>$pid

);


 
$lastid = $obj->create_news_attachment2($data2);

} 
  
        $result=$obj->read_tempfiles($lastid,2);  
         if($result!=false){
         $row=mysqli_fetch_assoc($result);
		 }
  	
	

        echo '<div id="previewbox'.$lastid.'"><div class="col-md-4" style="float:left;"><span onclick="DelPriView('.$lastid.')"><i class="fa fa-times" aria-hidden="true"></i></span><video style="height:100px; width:100%;" controls>
                                          <source src="'.$BaseUrl.'/news/news_upload/'. $row['filename'] .'"  type="video/mp4">
                                          <source src="'.$BaseUrl.'/news/news_upload/'.$row['filename'].'" type="video/ogg">
                                       </video></div></div>';
 
 
 

	
	



























?>
