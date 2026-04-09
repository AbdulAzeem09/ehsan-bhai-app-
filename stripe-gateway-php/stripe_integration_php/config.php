<?php 
@session_start();
$env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");

// Product Details 
// Minimum amount is $0.50 US 
$itemName = "Demo Product"; 
$itemNumber = "PN12345"; 
$itemPrice = 25; 
$currency = "USD"; 
 
// Stripe API configuration  
define('STRIPE_API_KEY', $env["SECRET_KEY"]);
define('STRIPE_PUBLISHABLE_KEY', $env["PUBLIC_KEY"]);
  
// Database configuration  
define('DB_HOST', $env["DB_HOST"]); 
define('DB_USERNAME', $env["DB_USER"]); 
define('DB_PASSWORD', $env["DB_PASS"]); 
define('DB_NAME', $env["DB_NAME"]);