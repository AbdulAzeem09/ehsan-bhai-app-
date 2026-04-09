<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		case 'delete' :
			deletee($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
		$pageId	= mysqli_real_escape_string($dbConn, $_POST['pageId']);
		//$txtDesc =  $_POST['txtDesc'];
		$profilename =  $_POST['profilenames'];
		$profiletextdesc =  $_POST['profiletxtDesc'];
	    $profilecat =	$_POST['profilecategory'];

		//print_r($_POST['profilecatId']);

		//$image = $_FILES['image']['name'];

        /*print_r($pageId);
		print_r($txtDesc);
		print_r($profilename);
		print_r($profiletextdesc);
		print_r($image);*/

		//$target = '../images/'.basename($image);

		// File upload path

$targetDir = "images/";
$fileName = basename($_FILES['image']['name']);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



		


		 $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){

        	 // Insert image file name into database
           $sql2 = "INSERT INTO spprofilecontent(profilecategory, profilenames, profiletxtDesc, image, pageId) VALUES ('$profilecat', '$profilename', '$profiletextdesc', '$fileName', '$pageId')";

            if($sql2){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }


       //echo $statusMsg;

		//echo $sql2;
		
		//$result3 = dbQuery($dbConn, $sql3);

		
		
		
	//	$sql = "SELECT * FROM spnewcontent WHERE contPageId = 1";
		$result = dbQuery($dbConn,$sql);

		/*if (dbNumRows($result) > 0) {
			$sql2 = "UPDATE spcontent SET contDesc = '$txtDesc' WHERE contPageId = $pageId";
		}else{
			$sql2 = "INSERT INTO spcontent(contDesc, contPageId, profilenames, profiletxtDesc, image) VALUES ('$txtDesc', $pageId, $profilename, $profiletextdesc ,$image)";
		}*/

		/*if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	    }else{
  	 	$msg = "Failed to upload image";
     	}

     	echo $msg;*/
		

		$result2 = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	
	}





	//modify 
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtDesc = $_POST['txtDesc'];
		$profilenames = $_POST['profilenames'];


		/*print_r($_FILES);*/
if(!empty($_FILES['image']['name'])){

$targetDir = "images/";
$fileName = basename($_FILES['image']['name']);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$allowTypes = array('jpg','png','jpeg','gif','pdf');

		if(in_array($fileType, $allowTypes)){

            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                
        	 // Insert image file name into database
            	$sql1 = "UPDATE spprofilecontent SET image = '$fileName'  WHERE idspContent = $hidId";
                $result1 = dbQuery($dbConn, $sql1);

        }


		}

}



		$sql = "UPDATE spprofilecontent SET profiletxtDesc = '$txtDesc', profilenames = '$profilenames'  WHERE idspContent = $hidId";


		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}
	
	function deletee($dbConn) {

		if(isset($_GET['noteId']) && ($_GET['noteId'])>0 ){
			$noteId = $_GET['noteId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql    =	"DELETE FROM tbl_notes WHERE idspNotes ='$noteId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Delted Successfully";
		redirect("index.php?view=list");
		
	}
	
	

	

?>