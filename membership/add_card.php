<?php
session_start();
include '../common.php';
if(isset($_SESSION['uid'])){
  if(!empty($_POST['customerName'])){
    $customerName = $_POST['customerName'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Card holder name should not be empty']);
    die;
  }
  if(!empty($_POST['cardNumber'])){
    $cardNumber = $_POST['cardNumber'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Card number should not be empty']);
    die;
  }
  if(!empty($_POST['cardCVC'])){
    $cardCVC = $_POST['cardCVC'];
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Security code should not be empty']);
    die;
  }
  if(!empty($_POST['expiryDate'])){
    $expiryDate = $_POST['expiryDate'];
    $cardExpMonth = "";
    $cardExpYear = "";
    if($expiryDate){
      $cardExpMonth = substr($expiryDate, 0, 2);
      $cardExpYear = substr($expiryDate, 3, 5); 
    }
  } else {
    echo json_encode(['status' =>  0, 'message' => 'Expiry date should not be empty']);
    die;
  }
  $insert_id = 0;
  $arr[] = encryptMessage($cardNumber);
  $arr[] = $customerName;
  $arr[] = $cardExpMonth;
  $arr[] = $cardExpYear;
  $arr[] = $cardCVC;
  if(isset($_POST['card_id']) && $_POST['card_id'] > 0){
    $cardDetails = selectQ("select * from spcarddetail where id = ? and uid = ?", "ii", [$_POST['card_id'], $_SESSION['uid']]);
    if($cardDetails){
      $arr[] = $_POST['card_id'];
      insertQ('update spcarddetail set cardNumber = ?, customerName = ?, cardExpMonth = ?, cardExpYear = ?, cardCVC = ? where id = ?', 'sssssi', $arr);
      $insert_id = $_POST['card_id'];
    } else {
      echo json_encode(['status' => 0, 'message' => 'Invalid Card']);
      die;
    }
  } else {
    $arr[] = $_SESSION['pid'];
    $arr[] = $_SESSION['uid'];
    $arr[] = date("Y-m-d h:i:s");
    $insert_id = insertQ('insert into spcarddetail (cardNumber, customerName, cardExpMonth, cardExpYear, cardCVC, pid, uid, createdDate) values (?, ?, ?, ?, ?, ?, ?, ?)', 'sssssiis', $arr);
  }
  echo json_encode(['status' =>  1 , 'message' => 'Card Saved Successfully', 'card_id' => $insert_id]);
}
?>
