<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

session_start();

include '../univ/baseurl.php';


function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$Password = $_POST['spUserPassword'];
$spUserPassword = md5($Password);


$arr=array(
	"spUserName"=> $_POST['spUserName'],
    "spUserFirstName"=> $_POST['spUserFirstName'],
    "spUserLastName"=> $_POST['spUserLastName'],
	"spUserPhone"=> $_POST['spUserPhone'],
    "spUserPassword"=> $spUserPassword,
    "spUserCountry"=> $_POST['spUserCountry'],
    "spUserState"=> $_POST['spUserState'],
    "spUserCity"=> $_POST['spUserCity'],
    "refferalcodeused"=> $_POST['refferalcodeused'],
    "currency"=> $_POST['currency'],
    "spUserDob"=> $_POST['spUserDob'],

    "spUserEmail"=> $_POST['spUserEmail']
	
    );
	
	
	  
	//print_r ($arr);
    $api      = new _spuser;
    $res1=$api->insert_api($arr);
    //$id = mysql_insert_id($res);
    // echo $res;



$arr2=array(

    "spUser_idspUser"=> $res1,

    "spProfileType_idspProfileType"=> '4',

	"spProfileName"=> $_POST['spUserName'],
    
	"spProfilePhone"=> $_POST['spUserPhone'],

    "spProfilesCountry"=> $_POST['spUserCountry'],

    "spProfilesState"=> $_POST['spUserState'],

    "spProfilesCity"=> $_POST['spUserCity'],

    "spProfilesDob"=> $_POST['spUserDob'],

    "spProfileEmail"=> $_POST['spUserEmail']
	
    );
	
	
	  
	//print_r ($arr);
    $api_to      = new _spuser;
    $res=$api_to->insert_api_to($arr2);


?>
