<?php 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['sponsor_user'] = [
        'sponsor_id' => $_POST['sponsor_id'],
        'sponsor_name' => $_POST['sponsor_name'],
        'price' => $_POST['price'],
        'gst' => $_POST['gst'],
        'total_price' => $_POST['total_price'],
        'description' => $_POST['description']
    ];

    // Redirect to a success page or handle further processing
    // header("Location: success.php");
    // exit;
}
?>