<?php

	function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");


	$r = new _rfq;

$contact_title = $_POST['quoteTitle'];


$contact_desc = $_POST['quotedescription'];

$idspRfqComment = $_POST['idspRfqComment'];


//print_r($_POST['contact_image']);
$image = $_POST['quoteMedia'];

//echo $image;
	
/*
	$rfqcontactImg  = $_FILES['contact_image']['tmp_name'];
    if ($rfqcontactImg != '') {
        $rfqcontactImg =   $r->uploadRfqPic('contact_image' , "../upload/store/rfq/", true, true);
    }else {
        $rfqcontactImg = '';
    }
*/

//print_r($data);

  $targetDir = "../../upload/store/rfq/"; 
$fileName = basename($_FILES['quoteMedia']['name']);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


//print_r($fileName);
		
//echo $fileName;

		 $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES['quoteMedia']["tmp_name"], $targetFilePath)){

        	 // Insert image file name into database
        
     $insert =  $r->createRfqContact($contact_title, $contact_desc, $idspRfqComment, $fileName);


            if($insert){
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

$re = new _redirect;
 	$re->redirect($BaseUrl.'/store/dashboard/quotation_list.php?idspRfq='.$_POST['idspRfq']);

//echo $r->ta->sql;




?>