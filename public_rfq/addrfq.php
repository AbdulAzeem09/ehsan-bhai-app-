<?php
    session_start();
    include('../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");


$p = new _rfq;


//echo "here";
//print_r($_POST['quote_id']);
//print_r($_POST['deleveryprice']);


if (isset($_POST['quote_id']) && isset($_POST['deleveryprice'])) {

  
  $p->updatequote($_POST['deleveryprice'], "WHERE idspRfq =" . (int)$_POST["quote_id"]);

  //echo $p->ta->sql;          
    
  }else{

/*
    // Upload Imge
    function uploadPagePic($inputName, $uploadDir,$newW, $newH){
        $image     = $_FILES[$inputName];
        $imagePath = '';
        $thumbnailPath = '';
        $imgSize = getimagesize($image['tmp_name']);
        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];
            // generate a random new file name to avoid name conflict
            $imagePath = md5(rand() * time()) . ".$ext";
            list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
            // make sure the image width does not exceed the
            // maximum allowed width
            if ($width > $newW) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
            // make sure the image height does not exceed the
            // maximum allowed height
            
            if ($height > $newH) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
        }
        //return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
        return $imagePath;
    }
*/

    $p = new _rfq;

    $rfqTitle = $_POST['rfqTitle'];
    $rfqCategory = $_POST['rfqCategory'];
    $rfqQty = $_POST['rfqQty'];
    $rfqDelivered = $_POST['rfqDelivered'];
    $rfqCountry = $_POST['rfqCountry'];
    $rfqState = $_POST['spQuotationState'];
    $rfqCity = $_POST['spQuotationCity'];
    $rfqDesc = $_POST['rfqDesc'];
    $rfqquote = $_POST['spQuotereached'];
    
    $pid = $_SESSION['pid'];


    $catid = 1;

    $timestamp = time();

     $datetime  = date("F d, Y h:i:s", $timestamp);

  

   $targetDir = "../upload/store/rfq/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['spPostingMedia']['name']); 

  

    if(!empty($fileNames)){ 
        foreach($_FILES['spPostingMedia']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['spPostingMedia']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["spPostingMedia"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .=  $fileName.",";
                }else{ 
                    $errorUpload .= $_FILES['spPostingMedia']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['spPostingMedia']['name'][$key].' | '; 
            } 
        } 
         
          // echo  $insertValuesSQL;

        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
           // $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL"); 

     /* $insert =  $r->createRfqComment($rfq_spProfiles_idspProfiles, $spProfiles_idspProfiles, $idspRfq, $rfqDesc, $rfqPrice, $rfqcProductName, $rfqcModelNum, $rfqcMinOrder, $rfqcMaxOrder, $rfqcLinkProduct, $insertValuesSQL, $rfqcvideoLink);*/



    $insert = $p->createRfq($rfqTitle, $rfqCategory, $rfqQty, $rfqDelivered, $rfqCountry, $rfqState, $rfqCity, $rfqDesc, $pid, $catid, $rfqquote, $insertValuesSQL, $datetime);

         
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 


//echo $statusMsg;
/*
 
    $rfqImg  = $_FILES['spPostingMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   uploadPagePic('spPostingMedia' , "../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }*/


   // echo $p->ta->sql;
    
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Your Public RFQ has been posted successfully.</strong>";



   $re = new _redirect;
  // $re->redirect("/public_rfq");
   $re->redirect($BaseUrl.'/store/dashboard/my_rfq.php');
 


    }
  
?>