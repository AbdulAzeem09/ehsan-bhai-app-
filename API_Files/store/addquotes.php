<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

/*
echo "string";*/
    $r = new _rfq;
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
        
    /*print_r($_POST);*/
/*
    $rfqImg  = $_FILES['spPostingsMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   $r->uploadRfqPic('spPostingsMedia' , "../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }*/
    $rfqImg  = $_FILES['spPostingMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   uploadPagePic('spPostingMedia' , "../../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }

  


	if(!empty($_POST['spProfiles_idspProfiles'])){
		//echo "here";

		//print_r($_POST);
		    $insert =  $r->createRfqComment($rfq_spProfiles_idspProfiles, $spProfiles_idspProfiles, $idspRfq, $rfqDesc, $rfqPrice, $rfqcProductName, $rfqcModelNum, $rfqcMinOrder, $rfqcMaxOrder, $rfqcLinkProduct, $rfq_img, $rfqcvideoLink);


    $quote_data = array('rfq_spProfiles_idspProfiles' => $_POST['rfq_spProfiles_idspProfiles'],'idspRfq' => $_POST['idspRfq'],'rfqDesc' => $_POST['rfqDesc'],'rfqPrice' => $_POST['rfqPrice'],'rfqProductTitle' => $_POST['rfqProductTitle'],'rfqModelNumber' => $_POST['rfqModelNumber'],'rfqMinOrder' => $_POST['rfqMinOrder'],'rfqMaxOrder' => $_POST['rfqMaxOrder'],'rfqLink' => $_POST['rfqLink'],'rfqvideolink' => $_POST['rfqvideolink'],'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'] );
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$quote_data);
	}else{

		$data = array("status" => 1, "message" => "Enter Profile id");
	}	



echo json_encode($data);

?>