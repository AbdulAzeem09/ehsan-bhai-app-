<?php
    session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

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


    $p = new _rfq;

    $rfqTitle = $_POST['rfqTitle'];
    $rfqCategory = $_POST['rfqCategory'];
    $rfqQty = $_POST['rfqQty'];
    $rfqDelivered = $_POST['rfqDelivered'];
    $rfqCountry = $_POST['rfqCountry'];
    $rfqState = $_POST['rfqState'];
    $rfqCity = $_POST['rfqCity'];
    $rfqDesc = $_POST['rfqDesc'];
    $pid = $_SESSION['pid'];
    $catid = 1;

    $rfqImg  = $_FILES['spPostingMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   uploadPagePic('spPostingMedia' , "../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }

    $result = $p->createRfq($rfqTitle, $rfqCategory, $rfqQty, $rfqDelivered, $rfqCountry, $rfqState, $rfqCity, $rfqDesc, $pid, $catid, $rfq_img);
  //  echo $p->ta->sql;
    
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Success!</strong> Your Enquiry Send To The Wholesalers!";

    $re = new _redirect;
    $re->redirect("rfq.php");
    
    
?>