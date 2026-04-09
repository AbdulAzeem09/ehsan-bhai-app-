 <?php
// Include the configuration file  
require_once 'config.php'; 
 
// Include the database connection file  
require_once 'dbConnect.php'; 
 
$payment_id = $statusMsg = ''; 
$status = 'error'; 
 
// Check whether the payment ID is not empty 
if(!empty($_GET['pid'])){ 
    $payment_id  = base64_decode($_GET['pid']); 
    // Fetch transaction info from the database 
    $sqlQ = "SELECT * FROM transactions WHERE id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $stmt->bind_param("i", $db_id); 
    $db_id = $payment_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
     
    if($result->num_rows > 0){ 
        // Transaction details 
        $transData = $result->fetch_assoc(); 
        $transactionID = $transData['txn_id']; 
        $paidAmount = $transData['paid_amount']; 
        $paidCurrency = $transData['paid_amount_currency']; 
        $payment_status = $transData['payment_status']; 
         
        $customerName = $transData['customer_name']; 
        $customerEmail = $transData['customer_email']; 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
    }else{ 
        $statusMsg = "Transaction has been failed!"; 
    } 
}else{ 
    header("Location: index.php"); 
    exit; 
} 
?>

<?php if(!empty($payment_id)){ ?>
<h1 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h1>
    
<h4>Payment Information</h4>
<p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

<h4>Customer Information</h4>
<p><b>Name:</b> <?php echo $customerName; ?></p>
<p><b>Email:</b> <?php echo $customerEmail; ?></p>

<h4>Product Information</h4>
<p><b>Name:</b> <?php echo $itemName; ?></p>
<p><b>Price:</b> <?php echo $itemPrice.' '.$currency; ?></p>
<?php }else{ ?>
<h1 class="error">Your Payment been failed!</h1>
<p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>