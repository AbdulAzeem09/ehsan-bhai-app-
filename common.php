<?php
//error_reporting(E_ALL);
//ini_set("display_errors", "On");

$env = parse_ini_file(__DIR__ . '/.env');
// require_once $_SERVER["DOCUMENT_ROOT"].'/SHAREPAGE_CODES/mlayer/_data.class.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/mlayer/_data.class.php';
$encryptAlgorithm = 'AES-256-CBC';

$connObj = _data::getConnection();

/**
 * To exit with an error
 *
 * @param String - $error - Error to be displayed
 */
function errorOut($error){
  echo json_encode(["error" => $error]);exit; 
}

/**
 * To exit if user is not logged in
 *
 */
function sessionCheck(){
  if(!isset($_SESSION['uid'])){
    die("Invalid login");
    exit();
  }
}


/**
 * To exit with a success
 *
 * @param String - $out - Success to be displayed
 * @param Bool - $success - Flag to send success flag. success keyword cannot be sent for certain auto-complete APIs
 */
function successOut($out, $success = true){
  if($success){
    $out["success"] = 1; 
  }
  echo json_encode($out);exit; 
}

/**
 * To do select query from Mysql
 *
 * @param String - $sql -- The main query 
 * @param String - $types -- Data type of all fields
 * @param Array - $params -- Data value
 * @param String - $action -- Custom action to be done
 *
 * @return  - Array -- All data
 */

function debugQ($sql, $params){
  $debug_sql = $sql;
  foreach ($params as $key => $value) {
      $debug_sql = preg_replace('/\?/',$value , $debug_sql, 1);
  }
  return $debug_sql;
}

function selectQ($sql, $types, $params, $action = ""){
  
  global $connObj;
  if($connObj === null){
    $connObj = _data::getConnection();
  }
  
  $stmt = $connObj->prepare($sql);
  if(!$stmt){
    var_dump($connObj->error);die;
  }
  if($params){
    $stmt->bind_param($types, ...$params);
  }
  $stmt->execute();
  $result = $stmt->get_result();
  
  if($action == "one"){
    $r = $result->fetch_all(MYSQLI_ASSOC);
    if($r){
      return $r[0];
    }
  }
  else{
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}

/**
 * To insert query from Mysql
 *
 * @param String - $sql -- The main query 
 * @param String - $types -- Data type of all fields
 * @param Array - $params -- Data value
 *
 * @return Int
 */
function insertQ($sql, $types, $params){
  global $connObj;
  if($connObj === null){
    $connObj = _data::getConnection();
  }
  $stmt = $connObj->prepare($sql);
  if(!$stmt){
    var_dump($connObj->error);die;
  }
  $stmt->bind_param($types, ...$params);
  $stmt->execute();  

  return $connObj->insert_id;

}

/**
 * To set or update session_id and auth_token in user_sessions. 
 * Used for SSO 
 *
 */
function sessionHandling(){
  $authToken = "";
  if(!empty($_SESSION['uid'])){
    $out = selectQ("select * from user_sessions where user_id=?", "i", [$_SESSION['uid']], "one");
    $authToken = md5($_SESSION['uid'].date("Ymdhis").rand(1000000000, 9999999999));
    if($out){
      insertQ("update user_sessions set php_session=?, auth_token=? where us_id=?", "ssi", [session_id(), $authToken, $out['us_id']]);
    }
    else{
      insertQ("insert into user_sessions(php_session, auth_token, user_id) values(?, ?, ?)", "ssi", [session_id(), $authToken, $_SESSION['uid']]);
    }
  }
  return ["authToken" => $authToken];
}

/**
 * To set all sessions
 *
 * @param Array - $rows - _spuser Array
 * @param Object - $p - _spprofiles Object
 *
 */
function setAllSessions($rows, $p){
	$_SESSION['login_user'] = $rows['spUserName'];
	$_SESSION['uid'] = $rows['idspUser'];
	$_SESSION['spUserEmail'] = $rows['spUserEmail'];
	$_SESSION['spPostCountry'] = $rows['spUserCountry'];
	$_SESSION['spPostState'] = $rows['spUserState'];
  $_SESSION['deactivateStatus'] = $rows['deactivate_status'];


	$rp = $p->readDefaultProfile($rows['idspUser']);


	if ($rp == false) {
		$rp = $p->readDefaultProfile_causal($rows['idspUser']);
	}

	if ($rp != false) {

		$row = mysqli_fetch_array($rp);

		$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

		$_SESSION['pid']             = $row['idspProfiles'];
    // $_SESSION['deactivateStatus'] = $row['deactivate_status'];
    
		$_SESSION['myprofile']         = $row["spProfileName"];
		$_SESSION['MyProfileName']     = $row["spProfileName"];
		$_SESSION['ptname']         = $row["spProfileTypeName"];
		$_SESSION['ptpeicon']         = $row["spprofiletypeicon"];
		$_SESSION['ptid']             = $row["spProfileType_idspProfileType"];
		$_SESSION['isActive']         = 1;
    $_SESSION['spProfilePic']     = $row["spProfilePic"] ?? null;
		$c = new _order;
		$res = $c->read($row['idspProfiles']);
		
		if ($res != false) {
			$_SESSION['cartcount'] = $res->num_rows;
      //echo $_SESSION['cartcount'];
		} else {
			$_SESSION['cartcount'] = 0;
		}
	}

}

/**
 * To encrypt encrypted texts
 *
 * @param String - $text -- Encrypted data 
 * @return String - $types -- Data type of all fields
 */
function decryptMessage($text){
  global $encryptAlgorithm, $env;
  $iv = substr($env['CARD_PASSWORD'], 0, 16);
  return openssl_decrypt($text, $encryptAlgorithm, $env['CARD_PASSWORD'], 0, $iv);
}

/**
 * To decrypt encrypted texts
 */
function encryptMessage($text){
  global $encryptAlgorithm, $env;
  $iv = substr($env['CARD_PASSWORD'], 0, 16);
  return openssl_encrypt($text, $encryptAlgorithm, $env['CARD_PASSWORD'], 0, $iv);
}

/**
 * To send an output to HTML
 *
 * @param Bool - $status -- Status of API 
 * @param String - $msg -- The content which user sees 
 * @return Array - $data -- Data type of all fields
 */
function response($status = 0, $msg = "", $data = []){
  echo json_encode(["status" => $status, "message" => $msg, 'data' => $data]);
  die;
}

function sendMail($email_to, $subj, $message, $smtp_email = '', $name = "", $replyTo = ""){
  global $env;
  require_once $_SERVER["DOCUMENT_ROOT"].'/smtp17aug/smtp/PHPMailerAutoload.php';
  if(!$smtp_email){
    $smtp_email = $env['smtp_username'];
  }
  $mail = new PHPMailer;
  $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  
  // Determine which email credentials to use based on smtp_email parameter
  if (isset($smtp_email) && $smtp_email == "registration@thesharepage.com") {
    // REGISTRATION EMAIL - FROM REGISTRATION
    $mail->Username = trim($env['regmail_username'], " '\"");                            // regmail username
    $mail->Password = trim($env['regmail_password'], " '\"");                            // regmail password
    $mail->From = trim($env['regmail_username'], " '\"");
  }
  elseif (isset($smtp_email) && ($smtp_email == "nonoreply@thesharepage.com" || $smtp_email == "noreply@thesharepage.com")) {
    // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
    $mail->Username = trim($env['noreplymail_username'], " '\"");                            // noreplymail username
    $mail->Password = trim($env['noreplymail_password'], " '\"");                            // noreplymail password
    $mail->From = trim($env['noreplymail_username'], " '\"");
  }
  else{
    // CONTACT EMAIL - FROM CONTACT FORM (default)
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->Username = trim($env['smtp_username'], " '\"");                            // SMTP username
    $mail->Password = trim($env['smtp_password'], " '\"");                            // SMTP password
    $mail->From = trim($env['smtp_username'], " '\"");
  } 
  $mail->Host = trim($env['smtp_host'], " '\"");                              // Specify main and backup SMTP servers                     
  $mail->Port = (int)$env['smtp_port'];                              // TCP port to connect to
  if($name){
    $mail->FromName = $name;
  }
  else{
    $mail->FromName = 'The SharePage';
  }
  if($replyTo){
    $mail->AddReplyTo($replyTo, $name);
  }
  $mail->addAddress($email_to);                     // Name is optional
  $mail->isHTML(true);      
  $mail->addCustomHeader('Content-Type', 'text/html');                             // Set email format to HTML
  $mail->Subject = $subj;
  $mail->Body    = $message;
  $res = $mail->send();
  if(!$res){ //to debug failure cases
    $obj = [];
    $obj[] = !empty($smtp_email) ? $smtp_email : '';
    $obj[] = !empty($email_to) ? $email_to : '';
    $obj[] = !empty($subj) ? $subj : '';
    $obj[] = !empty($message) ? $message : '';
    $obj[] = !empty($res) ? 1 : 0;
    $obj[] = date('Y-m-d H:i:s');
    insertQ('insert into spemail_status (sender, receiver, subject, message, status, created_date) values (?, ?, ?, ?, ?, ?)', 'ssssis', $obj);
  }
}


function number_format_short( $n, $precision = 1 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}

  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}

	return $n_format . $suffix;
}

function getLocation($usercountry, $userstate, $usercity){
  $co = new _country;
  $result3 = $co->readCountry();
  if ($result3 != false) {
      while ($row3 = mysqli_fetch_assoc($result3)) {
          if (isset($usercountry) && $usercountry == $row3['country_id']) {
          $currentcountry = $row3['country_title'];
          $currentcountry_id = $row3['country_id'];
          }
      }
  }

  if (isset($userstate) && $userstate > 0) {
      $countryId = $currentcountry_id;
      $pr = new _state;
      $result2 = $pr->readState($countryId);
      if ($result2 != false) {
          while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
          //die('===');
          if (isset($userstate) && $userstate == $row2["state_id"]) {
              $currentstate_id = $row2["state_id"];
              $currentstate = $row2["state_title"];
          }
          }
      }
  }

  if (isset($usercity) && $usercity > 0) {
      $stateId = $currentstate_id;
      $co = new _city;
      $result3 = $co->readCity($stateId);
      //echo $co->ta->sql;
      if ($result3 != false) {
          while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
          if (isset($usercity) && $usercity == $row3['city_id']) {
              $currentcity = $row3['city_title'];
              $currentcity_id = $row3['city_id'];
          }
          }
      }
  }

  $currentLocation = '';
  if (isset($currentcity)) {
      $currentLocation .= $currentcity . ', ';
  }
  if (isset($currentstate)) {
      $currentLocation .= $currentstate . ', ';
  }
  if (isset($currentcountry)) {
      $currentLocation .= $currentcountry;
  }
  return $currentLocation;
}

class s3Class {
  
  private $s3;
  
  /**
   * Class init
   *
   *@param Int - $ids - The bucket were this needs to be stored
   */
  public function __construct($ids){
    $p = new _realstatepic;

    $result = $p->readawskey();

    $row = mysqli_fetch_array($result);
    $key_name = $row['key_name'];
    $secret_name = $row['secret_name'];	


    $result1 = $p->readawskeyagain($ids);

    $row1 = mysqli_fetch_array($result1);
    $this->region_name = $row1['region_name']; 
    $this->bucketName = $row1['bucketName'];	
    

    include_once $_SERVER["DOCUMENT_ROOT"].'/aws/aws-autoloader.php'; 

    $this->s3 = new Aws\S3\S3Client([
	    'version' => 'latest',
	    'region' => $this->region_name,
	    'credentials' => [
		    'key'    => $key_name,
		    'secret' => $secret_name
	    ]
    ]);

  }
  
  /**
   * To upload images
   *
   * @param String - $tmpPath - Local tmp path
   * @param String - $ext - File extension
   * @param Array
   */
  function addS3Image($tmpPath, $ext){
    $key = date("Ymdhis").random_int(1000000000, 9999999999).".$ext";

    try {
	    $result = $this->s3->putObject([
		    'Bucket' => $this->bucketName,
		    'Key'    => $key,  
		    'Body'   => fopen($tmpPath, 'r'),
		    'ACL'    => 'public-read',
	    ]);
    } catch (Aws\S3\Exception\S3Exception $e) {
	    return ['error' => 1, "message" => $e->getMessage()];
    }

    return ['url' => 'https://'.$this->bucketName.'.s3.'.$this->region_name.'.amazonaws.com/'.$key];
  }
  
  /**
   * To store all files based in key
   *
   * @param String - $key - The FILE key where the data is posted
   * @param Array - $validExts - The list of valida extensions
   * @return Array of S3 image links
   */
  function storeAllInS3($key, $validExts = ['png', 'jpg', 'jpeg', 'gif', 'wbmp', 'xpm']){
    $dat = [];
    if(!empty($_FILES[$key])){
      if(is_array($_FILES[$key]['tmp_name'])){
        foreach($_FILES[$key]['tmp_name'] as $k => $one){
          $ext = explode("/", $_FILES[$key]['type'][$k]);
          $ext = $ext[count($ext)-1];
          if($validExts){
            if(!in_array($ext, $validExts)){
              errorOut("Invalid image extension");  
            }
          }
          
          $status = $this->addS3Image($one, $ext);
          if(!empty($status['error'])){
            errorOut($status['message']);
          }
          $dat[] = ['url' => $status['url'], 'name' => $_FILES[$key]['name'][$k]];
        }
      }
      else{
        $ext = explode("/", $_FILES[$key]['type']);
        $ext = $ext[count($ext)-1];

        $status = $this->addS3Image($_FILES[$key]['tmp_name'], $ext);
        if(!empty($status['error'])){
          errorOut($status['message']);
        }
        $dat[] = ['url' => $status['url'], 'name' => $_FILES[$key]['name']];
      }
    }
    return $dat;  
  }

}

?>
