
<?php
     
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

require_once $_SERVER['DOCUMENT_ROOT'].'/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;


	switch ($action) {
		
				
		case 'modify_qa' :
			modify_qa($dbConn);
			break;
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		case 'delete_qa' :
			delete_qa($dbConn);
			break;
		
		case 'delete_faq' :
			delete_faq($dbConn);
			break;

			case 'add_q_a' :
			add_q_a($dbConn);
			break;
		case 'img_del' :
			img_del($dbConn);
			break;

			case 'video_del' :
			video_del($dbConn);
			break;

		default :
			redirect('index.php');
	}
	
	// UPDATE CATEGORY
	function modify($dbConn){
		$ID   = mysqli_real_escape_string($dbConn,$_POST['id']);

		$module_name   = mysqli_real_escape_string($dbConn,$_POST['module_name']);
		
		$sql2 = "SELECT id FROM faq WHERE module_name = '$module_name'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&eventCatId='.$id);	
		}else{
			
			// Insert
			$sql = "UPDATE faq SET module_name = '$module_name' WHERE id = $id";
			//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$module_name   = mysqli_real_escape_string($dbConn,$_POST['module_name']);
		$module_pos   = mysqli_real_escape_string($dbConn,$_POST['module_position1']);
		
		$sql2 = "SELECT id FROM faq WHERE module_name = '$module_name'"; 
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO faq (module_name,position) VALUES ('$module_name','$module_pos')";

			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE CATEGORY
	function deletee($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
		function delete_qa($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq_q_a WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect("faq_q_a_list.php?msg=del");			
	}
	
	function delete_faq($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect("index.php");			
	}
	
	function modify_qa($dbConn){

		$ID   = mysqli_real_escape_string($dbConn,$_POST['id']);
		$question_ids=$ID;

				$module   = mysqli_real_escape_string($dbConn,$_POST['module']);
				$question   = mysqli_real_escape_string($dbConn,$_POST['question']);
				$answer   = mysqli_real_escape_string($dbConn,$_POST['answer']);
				$video1=isset($_FILES['vid']['name'])?$_FILES['vid']['name']:null;
    		$image=isset($_FILES['img']['name'])?$_FILES['img']['name']:null;
		
			// Insert
			$sql = "UPDATE faq_q_a SET question = '$question', answer = '$answer', module_id = '$module' WHERE id = $ID";
		//	echo $sql; die;
			//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);

			 $extension=array("jpeg","jpg","png","gif","mp4","wma");
 $sql2aws="select * from aws_s3_key";

            $result = mysqli_query($dbConn,$sql2aws);
            
            $row = mysqli_fetch_array($result);

            $key_name = $row['key_name'];
            $secret_name = $row['secret_name']; 

            $sql2aws1="select * from aws_s3 where id=13";

            $result1 = mysqli_query($dbConn,$sql2aws1);
            
            $row1 = mysqli_fetch_array($result1);
            $region_name = $row1['region_name']; 
            $bucketName = $row1['bucketName'];   
			


$s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
    'key'    => $key_name,
    'secret' => $secret_name
    ]
]);  
    if (isset($_FILES['img'])) {
    	foreach($_FILES["img"]["tmp_name"] as $key=>$tmp_name) {
    $file_name=$_FILES["img"]["name"][$key];
    
    $file_tmp=$_FILES["img"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
     if(in_array($ext,$extension)) {
       
         if(move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"][$key],"attechment/images/".$file_name)){


$file = "attechment/images/".$file_name;
$file_Path4 = $file ;

$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,  
        'Body'   => fopen($file_Path4, 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

 $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

unlink($file);


//die('===============');

         	$img_sql="insert into faq_attechment (type,file,question_id) values ('2','$data','$ID')";

         mysqli_query($dbConn,$img_sql);
         }
 
  }
    }
    }





  if (isset($_FILES['vid'])) {
  
    $filename = $_FILES["vid"]["name"];
    $tempname = $_FILES["vid"]["tmp_name"];    
    $folder = "attechment/video/".$filename;
         
        
        if (move_uploaded_file($tempname, $folder))  {
			
						
			        $file = $folder;
       


$file_Path4 = $file ;

$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,  
        'Body'   => fopen($file_Path4, 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

 $data1='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

unlink($file);
			
			
           $vid_sql="insert into faq_attechment (type,file,question_id) values ('1','$data1','$ID')";
           mysqli_query($dbConn,$vid_sql);
        }
    }

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			

	// redirect('faq_q_a_list.php?msg=edit');	
      		redirect('faq_q_a_list.php?view=modify&id='.$question_ids);


		
	}

	function add_q_a($dbConn){
			
					
            $sql2aws="select * from aws_s3_key";

            $result = mysqli_query($dbConn,$sql2aws);
            
            $row = mysqli_fetch_array($result);

            $key_name = $row['key_name'];
            $secret_name = $row['secret_name']; 

            $sql2aws1="select * from aws_s3 where id=13";

            $result1 = mysqli_query($dbConn,$sql2aws1);
            
            $row1 = mysqli_fetch_array($result1);
            $region_name = $row1['region_name']; 
            $bucketName = $row1['bucketName'];   
			


$s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
    'key'    => $key_name,
    'secret' => $secret_name
    ]
]);
	
      if($_SERVER['REQUEST_METHOD']=="POST"){

        if(isset($_POST['submit']) and !empty($_POST['submit'])){	

     $id=isset($_POST['module'])?$_POST['module']:null;
     $que=isset($_POST['question'])?$_POST['question']:null;
     $ans=isset($_POST['answer'])?$_POST['answer']:null;
     $video1=isset($_FILES['vid']['name'])?$_FILES['vid']['name']:null;
    $image=isset($_FILES['img']['name'])?$_FILES['img']['name']:null;
   

     $id1=mysqli_real_escape_string($dbConn,$id);
      $que1=mysqli_real_escape_string($dbConn,$que);
      $ans1=mysqli_real_escape_string($dbConn,$ans);
 $sql2="insert into faq_q_a (module_id,question,answer) values ('$id1','$que1','$ans1')";

   if(mysqli_query($dbConn,$sql2)){
    if(mysqli_affected_rows($dbConn)>0){
    	 $last_id = mysqli_insert_id($dbConn);
      
    }
   }

    $extension=array("jpeg","jpg","png","gif","mp4","wma");
  
    if (isset($_FILES['img'])) {

   foreach($_FILES["img"]["tmp_name"] as $key=>$tmp_name) {
    $file_name=$_FILES["img"]["name"][$key];
    
    $file_tmp=$_FILES["img"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

     if(in_array($ext,$extension)) {
       
         if(move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"][$key],"attechment/images/".$file_name)){

$file = "attechment/images/".$file_name;
$file_Path4 = $file ;

$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,  
        'Body'   => fopen($file_Path4, 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

 $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

unlink($file);


         	$img_sql="insert into faq_attechment (type,file,question_id) values ('2','$data','$last_id')";

         mysqli_query($dbConn,$img_sql);
         }
 
  }
    }
    }
 
    if (isset($_FILES['vid'])) {
  
    $filename = $_FILES["vid"]["name"];
    $tempname = $_FILES["vid"]["tmp_name"];    
        $folder = "attechment/video/".$filename;  
        
        if (move_uploaded_file($tempname, $folder))  {
			
			
			        $file = $folder;
       


$file_Path4 = $file ;

$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,  
        'Body'   => fopen($file_Path4, 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

 $data1='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

unlink($file);
			
			
           $vid_sql="insert into faq_attechment (type,file,question_id) values ('1','$data1','$last_id')";
           mysqli_query($dbConn,$vid_sql);
        }
    }

	
     
     redirect('faq_q_a_list.php?view=list&msg=add');

     }

        }
      }


      function img_del($dbConn)
      {
      	$question_id=$_GET['id'];
      	$id=$_GET['questionid'];
$sql="delete from faq_attechment where id='$question_id'";

      	mysqli_query($dbConn,$sql);

      	if (mysqli_affected_rows($dbConn)) {
      		

      		redirect('faq_q_a_list.php?view=modify&id='.$id.'&questionid='.$question_id);
      	}else{
      		echo "not".mysqli_error($dbConn);
      	}
      	
     		
     		// mysqli_query($dbConn,$sql);
      }


      function video_del($dbConn)
      {
      	$question_id=$_GET['id'];
      	$id=$_GET['questionid'];

      		
      			$sql="delete from faq_attechment where id='$question_id'";

      	mysqli_query($dbConn,$sql);

      	if (mysqli_affected_rows($dbConn)) {

      		// 
      		redirect('faq_q_a_list.php?view=modify&id='.$id.'&questionid='.$question_id);
      	}else{
      		echo "not".mysqli_error($dbConn);
      	}
      	
     		
     		// mysqli_query($dbConn,$sql);
      }
      
	
?>