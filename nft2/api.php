<?php
session_start();
include '../mlayer/_data.class.php';
echo "<pre>";

echo time();
$conn = _data::getConnection();


$wallet_address = $_POST['address'];
$user_id = $_SESSION['uid'];

$sql = "UPDATE spuser SET wallet_address='$wallet_address' WHERE idspUser=$user_id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


print_r($_SESSION);
print_r($_POST);



?>