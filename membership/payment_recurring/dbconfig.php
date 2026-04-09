
<?php 
@session_start();
$env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
// Subscription plans 
$plans = array( 
    '1' => array( 
        'name' => 'Weekly Subscription', 
        'price' => 25, 
        'interval' => 'week' 
    ), 
    '2' => array( 
        'name' => 'Monthly Subscription', 
        'price' => 80, 
        'interval' => 'month' 
    ), 
    '3' => array( 
        'name' => 'Yearly Subscription', 
        'price' => 850, 
        'interval' => 'year' 
    ) 
); 

//Currency code
$currency = "usd";  

define ('SECRET_KEY', $env["SECRET_KEY"]);
define ('PUBLIC_KEY', $env["PUBLIC_KEY"]);

// Connect with the database  
$db = new mysqli($env["DB_HOST"], $env["DB_USER"], $env["DB_PASS"], $env["DB_NAME"]);  
// Display error if failed to connect  
if ($db->connect_errno) {  
    printf("Connect failed: %s\n", $db->connect_error);  
    exit();  
}
