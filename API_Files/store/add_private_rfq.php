<?php


  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");

/*
echo "string";*/
      $q = new _spquotation;


  $timestamp = time();

    $pri_rfq = array('spQuotationBuyerid' => $_POST['spQuotationBuyerid'],'spQuotationSellerid' => $_POST['spQuotationSellerid'],'spPostings_idspPostings' => $_POST['spPostings_idspPostings'],'createddatetime' =>  date("F d, Y h:i:s", $timestamp),'spQuotationTotalQty' => $_POST['spQuotationTotalQty'],'spQuotationDelevery' => $_POST['spQuotationDelevery'],'spQuotationCountry' => $_POST['spQuotationCountry'],'spQuotationState' => $_POST['spQuotationState'],'spQuotationCity' => $_POST['spQuotationCity'],'spQuotatioProductDetails' => $_POST['spQuotatioProductDetails'] );
      
    /*print_r($_POST);*/
/*
    $rfqImg  = $_FILES['spPostingsMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   $r->uploadRfqPic('spPostingsMedia' , "../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }*/

  


  if(!empty($_POST['spQuotationSellerid'])){
    //echo "here";

    //print_r($_POST);
       $q->create($pri_rfq);


   /* $quote_data = array('rfq_spProfiles_idspProfiles' => $_POST['rfq_spProfiles_idspProfiles'],'idspRfq' => $_POST['idspRfq'],'rfqDesc' => $_POST['rfqDesc'],'rfqPrice' => $_POST['rfqPrice'],'rfqProductTitle' => $_POST['rfqProductTitle'],'rfqModelNumber' => $_POST['rfqModelNumber'],'rfqMinOrder' => $_POST['rfqMinOrder'],'rfqMaxOrder' => $_POST['rfqMaxOrder'],'rfqLink' => $_POST['rfqLink'],'rfqvideolink' => $_POST['rfqvideolink'],'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'] );
       // echo $p->tad->sql;*/

     $data = array("status" => 200, "message" => "success","data"=>$pri_rfq);
  }else{

    $data = array("status" => 1, "message" => "Enter Seller id");
  } 



echo json_encode($data);

?>