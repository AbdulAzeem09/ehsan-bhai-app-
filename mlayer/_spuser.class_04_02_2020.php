<?php 
class _spuser
{
//	session_start();
	public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	
	function __construct() { 
		$this->ta = new _tableadapter("spUser");
		$this->tad = new _tableadapter("tbl_shipping");
		$this->ta->dbclose = false;
	} 
	// idspUser, spUserName, spUserPhone, spUserEmail, spUserAddress, spUserPassword, spUserRegDate, spUserCountry, spUserCity
	
	//UPDATE USER IP ADDRESS
	function updateIp($ip, $uid){
		$this->ta->update(array("spUserIpLastLogin" => $ip), "WHERE idspUser = '$uid'");
	}
	// get ip address
	function getip($uid){
		return $this->ta->read("WHERE idspUser = $uid");
	}
	// EMAIL VALIDATE TO CHEK EMAIL ALREADY EXIST OR NOT
	public function emailavailable($email){
		$r = $this->ta->read("WHERE t.spUserEmail = '" . $email . "'");
		if ($r != false)			
			return 0;
		else			
			return 1;
	}
	
	// USER REGISTER HERE.
	function register($data,$activationcade){

		//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
		$size = 6;
		$alpha_key = '';
		$keys = range('A', 'Z');
		for ($i = 0; $i < 2; $i++) {
			$alpha_key .= $keys[array_rand($keys)];
		}
		$length = $size - 2;
		$key = '';
		$keys = range(0, 9);
		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		$randCode = $alpha_key . $key;
		// ========================================
		// ===========Email Verification Code======
		// ========================================
		$size_email = 8;
		$alpha_key_email = '';
		$keys_email = range('A', 'Z');
		for ($j = 0; $j < 2; $j++) {
			$alpha_key_email .= $keys_email[array_rand($keys_email)];
		}
		$length_email = $size_email - 2;
		$key_email = '';
		$keys_email = range(0, 9);
		for ($j = 0; $j < $length_email; $j++) {
			$key_email .= $keys_email[array_rand($keys_email)];
		}
		$emailRandCode = "ESP".$alpha_key_email . $key_email;
		//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END

		// ===TESTING CLASS
		$mobilenumbers = $data['txtCountryCode'].$data["respUserEphone"];
		$sm = new _sms;
		$sm->sendsms($mobilenumbers, urlencode($randCode) );
		// ===END

		//$spUser_idspUser = $this->ta->create($data);
		//$spUser_idspUser = $this->ta->create(array("spUserName" => $data["spUserName"], "spUserEmail" => $data["spUserEmail"],"spUserActCode" => $activationcade, "spUserPassword" => hash("sha256", $data['spUserPassword'])  ));
		$userName = $data["spUserFirstName"]." ".$data["spUserLastName"];

		$spUser_idspUser = $this->ta->create(array("spUserName" => $userName, "spUserFirstName" => $data["spUserFirstName"], "spUserLastName" => $data["spUserLastName"], "spUserPhone" => $data["respUserEphone"], "spUserEmail" => $data["spUserEmail"],"spUserActCode" => $randCode, "spUserPassword" => hash("sha256", $data['spUserPassword']), "spUserCountry" => $data["spUserCountry"], "spUserState" => $data["spUserState"], "spUserCity" => $data["spUserCity"], "spUserGender" => $data["spUserGender"], "email_verify_code" => $emailRandCode, "phone_verify_code" => $randCode, "spUserDob" => $data["spUserDob"], "spUserCountryCode" => $data['txtCountryCode'], "spUserIpLastLogin" => $data["spUserIpLastLogin"] ));						
		
		$p = new _spprofiles;
		$p->create(array("spUser_idspUser" => $spUser_idspUser, 
				"spProfileName" 	=> $data["spUserFirstName"].' '.$data['spUserLastName'], 
				"spProfileEmail"	=> $data["spUserEmail"],
				"spProfilephone" 	=> $data["respUserEphone"],
				"spProfileCntryCode"=> $data["txtCountryCode"],
				"spProfilesDefault" => 1,
				"spProfilesCity"	=> $data["spUserCity"],
				"spProfilesState"	=> $data["spUserState"],
				"spProfilesCountry"	=> $data["spUserCountry"],
				"spProfileType_idspProfileType" => $data["spProfileType_idspProfileType_"]));

		// ===========SEND EMAIL==============
		$em = new _email;
		//$em->sendemail();
		// ===not complete
		$em->send_reg_email($_POST["spUserEmail"], $userName, $spUser_idspUser, $emailRandCode);
		
		// ==============END=================
		return $spUser_idspUser;
	}
	// READ USER ID AND USER DETAIL
	function read($uid){
		return $this->ta->read("WHERE idspUser =" .$uid);
	}
	// read profile id user detail
	function readProfile($pid){
		return $this->ta->read("INNER JOIN spprofiles AS p ON t.idspUser = p.spUser_idspUser WHERE idspProfiles = $pid");
	}
	// UPDATE USER CODE
	function updateCode($uid, $randCode){
		$this->ta->update(array("spUserActCode" => $randCode), "WHERE idspUser ='".$uid."'");
	}
	// UPDATE USER EMAIL CODE
	function updateEmailCode($uid, $randCode, $cod){
		if ($cod == 1) {
			// this is phone update
			$this->ta->update(array("phone_verify_code" => $randCode), "WHERE idspUser ='$uid' ");
		}else{
			// this is email update
			$this->ta->update(array("email_verify_code" => $randCode), "WHERE idspUser ='$uid' ");
		}
	}
	// IS CODE VALID WITH UID OR NOT
	function isvodevalid($uid, $cod){
		return $this->ta->read("WHERE idspUser =" .$uid." AND is_phone_verify = '$cod' ");
	}
	// UPDATE CODE WHEN CODE IS CORRECT
	function activeAcount($uid){
		$this->ta->update(array("spUserActive" => 1), "WHERE idspUser = $uid ");
	}
	// PHONE NUMBER IS ACTIVATED
	function activePhone($uid){
		$this->ta->update(array("is_phone_verify" => 1), "WHERE idspUser = $uid ");
	}
	// EMAIL IS ACTIVATED
	function activeEmail($uid){
		$this->ta->update(array("is_email_verify" => 1), "WHERE idspUser = $uid ");
	}
	// UPDATE DETAIL OF USER POST
	function update($data,$uid){
		$this->ta->update($data,$uid);
	}
	// USER LOGIN THROUGH EMAIL
	function login($email, $password) {		  
		return $this->ta->read("WHERE t.spUserEmail = '" . $email .  "' AND t.spUserPassword = '" . $password . "'");
	}
	// CHEK USER IS LOCKED OR UNLOCKED
	function chekLock($email){
		return $this->ta->read("WHERE t.spUserEmail = '" . $email .  "' AND spUserLock = 0 ");
	}

	// IS USER EMAIL AND PHONE IS VERIFY
	function isverify($uid){
		// IS PHONE IS VERIFIED?
		$result = $this->ta->read("WHERE idspUser = $uid AND is_phone_verify = 1");
		if ($result) {
			$phone = 1;
		}else{
			$phone = 0;
		}
		// IS EMAIL IS VERIFIED?
		$result2 = $this->ta->read("WHERE idspUser = $uid AND is_email_verify = 1");
		if ($result2) {
			$email = 1;
		}else{
			$email = 0;
		}
		// CHECK PROCESS
		if (isset($phone) AND $phone == 1 AND isset($email) AND $email == 1) {
			return 1;
		}else if(isset($phone) AND $phone == 1 AND isset($email) AND $email == 0){
			return 2;
		}else if(isset($phone) AND $phone == 0 AND isset($email) AND $email == 1){
			return 3;
		}else if(isset($phone) AND $phone == 0 AND isset($email) AND $email == 0){
			return 4;
		}else{
			return 4;
		}
	}
	function isPhoneVerify($uid){
		return $this->ta->read("WHERE idspUser = $uid AND is_phone_verify = 1");
	}
	function isEmailVerify($uid){
		return $this->ta->read("WHERE idspUser = $uid AND is_email_verify = 1");	
	}

	
	function totaluser()
	{
		return $this->ta->read();
	}
	function adminlogin($username, $password) 
	{		  
		return $this->ta->read("WHERE t.spUserName = '" . $username .  "' AND t.spUserPassword = '" . $password . "' AND spuserAdmin = 1");
	}
	public function useravailable($name){		
		$r = $this->ta->read("WHERE t.spUserName = '" . $name . "'");
		if ($r != false)			
			return 0;
		else			
			return 1;
	}		
	function changepassword($uid,$password)
	{
		$this->ta->update(array("spUserPassword" => $password), "WHERE idspUser ='".$uid."'");
	}
	
	public function activate($uid)	
	{
		return $this->ta->update(array("email_verify_code" => 0, "is_email_verify"=>1), "WHERE idspUser ='".$uid."'");
	}
	
	//Forget Password Testing
			
	public function resetcode($email,$recode)
	{
		return $this->ta->update(array("spUserResetCode" => $recode), "WHERE spUserEmail ='".$email."'");
	}
	
	public function regen($email) 
	{		
		return $this->ta->read("WHERE t.spUserEmail ='".$email."'");
	}	

	
	
	/*public function resetpassword($code) 
	{		
		return $this->ta->update("WHERE t.spUserReset = '" . $code . "'")
	}*/	
	// =======================SHIPPING==============================
	public function readship($uid){
		return $this->tad->read("WHERE spUser_idspUser = $uid"); 
	}
	// ===INSERT INTO TBL SHIP
	public function insertship($name, $mobile, $email, $country, $state, $city, $address, $uid){
		$this->tad->create(array("shipName" => $name, "shipEmail" => $email, "shipPhone" => $mobile, "country_id" => $country, "state_id" => $state,"city_id" => $city, "shipAddress" => $address, "spUser_idspUser" => $uid ));
	}
	// ===UPDATE 
	public function updateship($name, $mobile, $email, $country, $state, $city, $address, $uid){
		$this->tad->update(array("shipName" => $name, "shipEmail" => $email, "shipPhone" => $mobile, "country_id" => $country, "state_id" => $state,"city_id" => $city, "shipAddress" => $address ), "WHERE spUser_idspUser = $uid ");
	}
	// =======================END===================================
}
?>