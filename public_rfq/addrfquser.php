<?php
// 	error_reporting(E_ALL);
// ini_set('display_errors', '1');
	include('../univ/baseurl.php');
	
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

	$r = new _rfq;

	$spProfiles_idspProfiles = $_POST['spProfiles_idspProfiles'];
    $rfq_spProfiles_idspProfiles = $_POST['rfq_spProfiles_idspProfiles'];
	$idspRfq = $_POST['idspRfq'];
	$rfqDesc = $_POST['rfqDesc'];
	$rfqPrice = $_POST['rfqPrice'];
	$rfqcProductName = $_POST['rfqProductTitle'];
	$rfqcModelNum = $_POST['rfqModelNumber'];
	$rfqcMinOrder = $_POST['rfqMinOrder'];
	$rfqcMaxOrder = $_POST['rfqMaxOrder'];
	$rfqcLinkProduct = $_POST['rfqLink'];
	$rfqcvideoLink = $_POST['rfqvideolink'];
		
	

	// $rfqImg  = $_FILES['spPostingsMedia']['tmp_name'];
    // if ($rfqImg != '') {
    //     $rfq_img =   $r->uploadRfqPic('spPostingsMedia' , "../upload/store/rfq/", true, true);
    // }else {
    //     $rfq_img = '';
    // }


    // $image = ['spPostingsMedia']['name'];
    //  $tmp_name=['spPostingsMedia']['tmp_name'];
    //  move_uploaded_file($tmp_name,$image);

   
      
    $image_name = $_FILES['spPostingsMedia']['name'];
    $tmp_name = $_FILES['spPostingsMedia']['tmp_name'];
    $targetDir = "upload/".$image_name;
    move_uploaded_file($tmp_name,$targetDir);

/*
  
			$result = $r->readawskey();
			
			$row = mysqli_fetch_array($result);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	
            

 
			$result1 = $r->readawskeyagain($ids=14);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = $row1['region_name'];   
			$bucketName = $row1['bucketName'];	
        //    die("0000000000023");

include $_SERVER['DOCUMENT_ROOT'].'/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;
$s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
    'key'    => $key_name,
    'secret' => $secret_name
    ]
]);
//die("00000000000909878");

    if(!empty($image_name)){ 
        foreach($_FILES['spPostingsMedia']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['spPostingsMedia']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            die("00000000234000");
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["spPostingsMedia"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
					$file_Path4 = $targetFilePath;
					//$file_Path4 = $file ;

					$key = random_int(1000000000, 9999999999);
                   
					try {
						$result = $s3->putObject([
							'Bucket' => $bucketName,
							'Key'    => $key,  
							'Body'   => fopen($file_Path4, 'r'),
							'ACL'    => 'public-read',
						]);
					  //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
					} catch (Aws\S3\Exception\S3Exception $e) {
						echo "There was an error uploading the file.\n";
						echo $e->getMessage();
					}

					$insertValuesSQL .= 'https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key.',';

					unlink($file_Path4);
										
					
					
                   // $insertValuesSQL .=  $fileName.",";
                }else{ 
                    $errorUpload .= $_FILES['spPostingsMedia']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['spPostingsMedia']['name'][$key].' | '; 
            } 
        } 
         */
          // echo  $insertValuesSQL;
           //die("00000000000");

        if(!empty($rfqPrice)){ 
        //    $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
           // $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL"); 

        $pro = new _spprofiles;
        $result = $pro->read($spProfiles_idspProfiles);
      //  echo $pro->ta->sql;

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $sellerName = $row['spProfileName'];

            $sellerEmailid = $row['spProfileEmail'];

            //  $spUserid = $row['spUser_idspUser'];

               //$profiletype = 1;
              
        }

            $pro = new _spprofiles;

          $result1 = $pro->read($rfq_spProfiles_idspProfiles);
        //echo $pro->ta->sql;

        

        if ($result1) {
            $row1 = mysqli_fetch_assoc($result1);
           $buyerName = $row1['spProfileName'];

               $buyerEmailid = $row1['spProfileEmail'];

             // $spUserid = $row['spUser_idspUser'];

               //$profiletype = 1;
              
        }

       // $sp = new _rfq;

          $result2 = $r->readRfq($idspRfq);
       // echo $sp->ta->sql;

        if ($result2) {
            $row2 = mysqli_fetch_assoc($result2);
          //  $ProfileName = $row['spProfileName'];

               $spTitle = $row2['rfqTitle'];

             // $spUserid = $row['spUser_idspUser'];

               //$profiletype = 1;
              
        }
     

      $insert =  $r->createRfqComment($rfq_spProfiles_idspProfiles, $spProfiles_idspProfiles, $idspRfq, $rfqDesc, $rfqPrice, $rfqcProductName, $rfqcModelNum, $rfqcMinOrder, $rfqcMaxOrder, $rfqcLinkProduct, $image_name, $rfqcvideoLink, $sellerEmailid, $buyerEmailid, $spTitle, $sellerName, $buyerName);

      //echo $targetDir;
      //die("----------");
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 

    //echo  $statusMsg ;

 //print_r($sellerEmailid);
 // print_r($buyerEmailid);
  //print_r($spTitle);
  //  print_r($buyerName);
 //print_r($sellerName);

	//$r->createRfqComment($_POST);


   //echo $r->tcd->sql;

	$re = new _redirect;
  	$re->redirect($BaseUrl.'/store/dashboard/myprivate_rfq.php');



   	
?>