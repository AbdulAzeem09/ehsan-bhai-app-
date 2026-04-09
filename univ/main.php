<?php
//error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
define('ENV', $env['ENV']);

/*if(ENV === 'production' || ENV === 'dev'){
    require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
    \Sentry\init([
        'dsn' => $env['SENTRY_DNS'],
    ]);
}*/

$app_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"];

define ('BASE_URL', $app_url);
define ('DBNAME', $env['DB_NAME']);
define ('DBHOST', $env['DB_HOST']);
define ('UNAME', $env['DB_USER']);
define ('PASS', $env['DB_PASS']);

define ('JSFILE', $env['JS_FILE']); 
define ('CSSFILE', $env['CSS_FILE']); 
define ('COMPANY', $env['COMPANY']); 
define ('BRAND',   $env['BRAND']); 
define ('CONTACT', $env['CONTACT']); 
define ('COUNTRY', $env['COUNTRY']); 
define ('DOMAIN', $env['DOMAIN']); 
define ('PHONE', $env['PHONE']);

if(!defined('SECRET_KEY')){
    define('SECRET_KEY', $env["SECRET_KEY"]);
}
if(!defined('PUBLIC_KEY')){
    define('PUBLIC_KEY', $env["PUBLIC_KEY"]);
}

/*define ('Twilio_SID', $env['Twilio_SID']); 
define ('Twilio_TOKEN', $env['Twilio_TOKEN']); 
define ('Twilio_NUMBER', $env['Twilio_NUMBER']);*/

//define ('TELNYX_AUTH', $env['TELNYX_AUTH']); 
//define ('TELNYX_NUMBER', $env['TELNYX_NUMBER']); 

define ('sns_key', $env['sns_key']); 
define ('sns_secret', $env['sns_secret']);

$sns_key = $env['sns_key'];
$sns_secret = $env['sns_secret'];

$encrypt_iv = $env['encrypt_iv'];
$encrypt_key = $env['encrypt_key'];

define ('click_send_username', $env['click_send_username']); 
define ('click_send_api_key', $env['click_send_api_key']);

?>
