<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
session_start();
include('../univ/baseurl.php');

function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}
// print_r($_POST);
// die('kjughkjg');
spl_autoload_register("sp_autoloader");

//print_r($_POST['quote_id']);
// print_r($_POST['deleveryprice']);


$q = new _spquotation;


if (isset($_POST['quote_id']) && isset($_POST['deleveryprice'])) {


  $q->updatequote($_POST['deleveryprice'], "WHERE idspQuotation =" . $_POST["quote_id"]);

  /*  echo $q->ta->sql;    */
} else {

  $pro = new _spprofiles;
  $result = $pro->read($_POST['spQuotationSellerid']);
  //  echo $pro->ta->sql;

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $sellerName = $row['spProfileName'];

    $sellerEmailid = $row['spProfileEmail'];

    //  $spUserid = $row['spUser_idspUser'];

    //$profiletype = 1;

  }

  $pro = new _spprofiles;

  $result1 = $pro->read($_POST['spQuotationBuyerid']);
  //echo $pro->ta->sql;

  if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $buyerName = $row1['spProfileName'];

    $buyerEmailid = $row1['spProfileEmail'];

    // $spUserid = $row['spUser_idspUser'];

    //$profiletype = 1;

  }

  $sp = new _productposting;

  $result2 = $sp->read(isset($_POST['spPostings_idspPostings']) ? (int)$_POST['spPostings_idspPostings'] : 0);
  // echo $sp->ta->sql;

  if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    //  $ProfileName = $row['spProfileName'];

    $spTitle = $row2['spPostingTitle'];

    // $spUserid = $row['spUser_idspUser'];

    //$profiletype = 1;

  }
  // print_r($sellerEmailid);
  // print_r($buyerEmailid);
  // print_r($spTitle);

  /*print_r($_POST);*/

  // $id=$_POST['idspQuotation'];
  $buyerid = $_POST['spQuotationBuyerid'];
  $sellerid = $_POST['spQuotationSellerid'];
  $prodid = isset($_POST['spPostings_idspPostings']) ? (int)$_POST['spPostings_idspPostings'] : 0;
  $qty = $_POST['spQuotationTotalQty'];
  $prddetails = $_POST['spQuotatioProductDetails'];
  $delivery = $_POST['spQuotationDelevery'];
  $country = $_POST['spQuotationCountry'];
  $city = $_POST['spQuotationCity'];
  $state = $_POST['spQuotationState'];
  $price = $_POST['spQuotationPrice'];
  $status = $_POST['spQuotationStatus'];
  $datetime = $_POST['createddatetime'];





  $data = array("spQuotationBuyerid" => $buyerid, "spQuotationSellerid" => $sellerid, "spPostings_idspPostings" => $prodid, "spQuotationTotalQty" => $qty, "spQuotatioProductDetails" => $prddetails, "spQuotationDelevery" => $delivery, "spQuotationCountry" => $country, "spQuotationCity" => $city, "spQuotationState" => $state, "spQuotationPrice" => $price, "spQuotationStatus" => $status, "createddatetime" => $datetime);


  //$q->create($_POST, $sellerEmailid, $buyerEmailid, $spTitle, $sellerName, $buyerName);
  $q->create($data);

  //echo $q->ta->sql;

  $pl = new _postenquiry;


  $addmssage =  array('buyerProfileid' => $_SESSION['pid'], 'sellerProfileid' => $_POST['spQuotationSellerid'], 'spPostings_idspPostings' => isset($_POST['spPostings_idspPostings']) ? (int)$_POST['spPostings_idspPostings'] : 0, 'message' => 'You have an RFQ.Please check your Private RfQ', 'module' => 'Store');

  $pl->addenquiry($addmssage);





  // EMAIL SEND TO TO SELLER PERSON TO RECORD
  // $headers = "From: The SharePage <admin@thesharepage.com> \r\n";

  // $msg = "Dear ".$_POST["buyername_"]."\r\n
  // You are receiving this mail because the users quotes on your post .\r\n\r\n";

  // $msg .= "Quotes Details\r\n
  //  Product Name : ".$_POST["spQuotationProductName"]."\r\n
  //  Quantity Required :".$_POST["spQuotationTotalQty"]."\r\n
  // ";

  // $msg .= "See More Details click on link https://thesharepage.com/\r\n";

  // mail($_POST["buyeremail_"], "The SharePage, registration successful.", $msg, $headers);
  $buyerName = $row1['spProfileName'];
  $buyerEmailid = $row1['spProfileEmail'];
  $sellerName = $row['spProfileName'];
 $sellerEmailid = $row['spProfileEmail'];
  $spTitle = $row2['spPostingTitle'];
  // echo $buyerName;
  // echo $buyerEmailid;
  // echo $sellerName;
  // echo $sellerEmailid;
  // echo $spTitle;
  // die('========');
  //https://dev.thesharepage.com/store/detail.php?catid=1&postid=2479
  $productlink = $BaseUrl.'/store/detail.php?catid=1&postid='.$prodid;

  $buyerlink = $BaseUrl.'/friends/?profileid='.$buyerid; 

  $em = new _email;
  $em->send_privaterfq_email($sellerEmailid, 'shubham18822@gmail.com', $spTitle, $sellerName, $buyerName, $productlink, $buyerlink);

  $_SESSION['count'] = 0;
  $_SESSION['errorMessage'] = "<strong>Your Private RFQ has been posted successfully.</strong>";


  $re = new _redirect;
  $re->redirect($BaseUrl . '/store/dashboard/my_rfq.php');

  header("Location: $BaseUrl/wholesale/?condition=All&folder=retail&msg=conf&page=1");

  // header("Location:http://localhost/sharepagego/Sharepage/wholesale/");

}
