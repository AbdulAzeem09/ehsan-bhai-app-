
<?php

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
 
 
 
 
 $pid=$_SESSION['pid'];
 $newsPic= $_FILES['newsPic'];
 
 $document= $_FILES['newsDocument'];
 $newsvideo= $_FILES['newsMedia'];   
  $lastid= $_POST['lastid'];
  
  $randnum= $_POST['randnum'];
    
 

if($_FILES['newsDocument']['size'] != 0){
		$File_Name = strtolower($_FILES['newsDocument']['name']);
		
		$temp = explode(".", $_FILES["newsDocument"]["name"]);
$name = round(microtime(true)) . '.' . end($temp);  
		
		
	//$name = $_FILES["newsDocument"]["name"];
	$tmp_name = $_FILES["newsDocument"]["tmp_name"];
		
	 $uploads_dir = 'news_upload';
  move_uploaded_file($tmp_name, "$uploads_dir/$name"); 

$data=array(

'relation_id'=>$randnum,
'filename'=>$name, 
'file_type'=>1,
'pid'=>$pid

);

$lastid = $obj->create_news_attachment($data);  
}

        $result=$obj->read_tempfiles($lastid,1);
         if($result!=false){
         $row=mysqli_fetch_assoc($result);  
		 }
 
  echo '<div id="previewbox'.$lastid.'"><div class="col-md-4 document"><span onclick="DelPriView('.$lastid.')"><i class="fa fa-times" aria-hidden="true"></i></span>
		<span>DOCUMENT <a href="'.$BaseUrl.'/news/news_upload/'.$row["filename"].'" download='.$row["filename"].'">'.$row['filename'].'</a></span>    
		</div></div>';
 
	
	



























?>
