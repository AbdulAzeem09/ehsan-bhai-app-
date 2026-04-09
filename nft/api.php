<?php
session_start();
include '../mlayer/_data.class.php';
//echo "<pre>";

//echo time();
$conn = _data::getConnection();



if (isset($_POST['action'])) {
  /*--------------------------------------------*/
  if ($_POST['action']=="update_user_wallet_address") {
      $wallet_address = $_POST['address'];
      $user_id = $_SESSION['uid'];

      $sql = "UPDATE spuser SET wallet_address='$wallet_address' WHERE idspUser=$user_id";

      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      die();
  }

  /*-------------------------------------------------*/

  if ($_POST['action']=="get_owner_data") {

      $response = (object) array('code'=>0,'error'=>'','output'=>array());
      $wallet_address = $_POST['address'];
      $user_id = $_SESSION['uid'];


      $sql = "SELECT * FROM spuser WHERE wallet_address='$wallet_address' LIMIT 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $response->code = 1;
          $response->output = $row;
          echo json_encode($response);
          die();
        }
      } 

     die();
  }

  /*-------------------------------------------------*/

  if ($_POST['action']=="get_nft_category") {

      $response = (object) array('code'=>0,'error'=>'','output'=>array());

      $sql = "SELECT * FROM nft_category";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $response->code = 1;
          $response->output[] = $row;
          
        }
      } 
      echo json_encode($response);
         

     die();
  }

  /*-------------------------------------------------*/

  if ($_POST['action']=="update_nft_category") {


    if ($_POST['id']!=0) {
      $sql = "UPDATE nft_category SET name='".$_POST['name']."' WHERE id=".$_POST['id'];
      $result = $conn->query($sql);
    }else{
      $sql = "INSERT INTO nft_category (name) VALUES ('".$_POST['name']."')";
      $result = $conn->query($sql);
    }

     die();
  }

  /*-------------------------------------------------*/

  if ($_POST['action']=="delete_nft_category") {


    if ($_POST['id']!=0) {
      $sql = $sql = "DELETE FROM nft_category WHERE id=".$_POST['id'];
      $result = $conn->query($sql);
    }

     die();
  }

  /*-------------------------------------------------*/


}





print_r($_SESSION);
print_r($_POST);



?>