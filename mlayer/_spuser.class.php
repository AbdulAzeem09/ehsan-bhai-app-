<?php
class _spuser
{
//    session_start();
    public $dbclose = false;
    private $conn;
    public $ta;
    public $tad;

    public $ba;

    public function __construct()

    {

        $this->ca         = new _tableadapter("close_friend");
        $this->ka         = new _tableadapter("commission_level");
        $this->ta          = new _tableadapter("spUser");
        $this->tat          = new _tableadapter("spprofiles");
        $this->tr  = new _tableadapter("realstate_favorites");
        $this->tr1  = new _tableadapter("sprealstate");
        $this->ip         = new _tableadapter("user_ip");
        $this->taf          = new _tableadapter("spbuiseness_files");
        $this->tabl          = new _tableadapter("notification_temp");

        $this->tad         = new _tableadapter("tbl_shipping");
        $this->ba          = new _tableadapter("tbl_user");
        $this->cu          = new _tableadapter("spvideo");
        $this->ph_1          = new _tableadapter("spphone_otplist");
        $this->address         = new _tableadapter("addshipping_address");
        $this->bonus         = new _tableadapter("spbonuswallet");
        $this->tb         = new _tableadapter("tbl_setting");
        $this->tbcom         = new _tableadapter("tbl_set_commission");
        $this->tblCommSet         = new _tableadapter("tbl_commission_setting");
        $this->te         = new _tableadapter("eventgallery");
        $this->tc         = new _tableadapter("spevent");
        $this->mem_bar = new _tableadapter("pos_membership_barcode");
        $this->mem_bar_d = new _tableadapter("pos_membership_barcode_manually");
        $this->pro = new _tableadapter("spprofiles");
        $this->spjob = new _tableadapter("spjobboard");

        $this->adcom = new _tableadapter("tbl_admcommission");
        $this->ucom = new _tableadapter("tbl_usercommisonm");
        $this->pro = new _tableadapter("tbl_spproduct");
        $this->ta->dbclose = false;
    }
//send otp
    function getuserphonenumber($uid){
        return $this->ta->read("WHERE idspUser=" .$uid);
    }
//otp
    public function get_amount($id){
        return $this->ucom->read("WHERE refred_user = " . $id);
// echo $this->ucom->sql;
    }


    function insert_api($data){
        $id= $this->ta->create($data);
        return $id;
//echo $this->ta->sql;die;
    }

    function insert_api_to($data){
        $this->tat->create($data);
//echo $this->ta->sql;die;
    }

    public function fetchamount($id){
        return $this->ucom->read("WHERE refred_user = " . $id);
//  echo $this->ucom->sql;
    }

    public function getcom($id){
        return  $this->ca->read("WHERE friend_id = " . $id);
// echo $this->ca->sql;
// die('---1111111111111111');

    }

    public function getcode($id){

        return $this->ta->read("WHERE idspUser = " . $id);
// echo $this->ta->sql;die('yyyyyyyy');
    }

    public function remove3($id){

        return $this->tr->remove("WHERE id = " . $id);
// echo $this->ta->sql;die('yyyyyyyy');
    }




    public function getrefrecode($mycode){

        return $this->ta->read("WHERE refferalcodeused ='$mycode'" );
//  echo $this->ta->sql;die('yyyyyyyy');
    }



    public function getcom1(){
        return $this->ka->read("WHERE id = " ."1");

//      echo $this->ka->sql;
//    die('=====');
    }

// read data
    public function readdatabybuyerid($bid)
    {
        return $this->ta->read("WHERE idspUser = " . $bid);
// echo $this->ta->sql;
//    die('=====');

    }
    public function readdataSp($pid)
    {
        return  $this->tat->read("WHERE idspProfiles = " . $pid);
// echo $this->tat->sql;
//  die('=====');

    }
    public function readdataAdd($data,$pid)
    {

        return $this->tat->update(array("post_pay"=>$data),"WHERE idspProfiles =" . $pid);
// echo $this->ta->sql;
//    die('=====');

    }
    public function read_currency($uid)
    {
        return $this->ta->read("WHERE idspUser = " . $uid);

    }

    public function get_super_vip()
    {
        return $this->tb->read("WHERE idspSetting = 1");
//echo $this->tb->sql;die('=====');

    }

    public function get_super_vip_comm()
    {
        return $this->tbcom->read("WHERE id = 1");
//echo $this->tb->sql;die('=====');
    }
    public function get_sub_comm()
    {
        return $this->tbcom->read("WHERE id = 1");
//echo $this->tb->sql;die('=====');
    }


    public function get_admin_commission()
    {
        return $this->adcom->read("WHERE comm_id = 1");
//echo $this->tb->sql;die('=====');

    }

    public function read_pos_rand($email,$rand)
    {
        return $this->ta->read("WHERE spUserEmail = '$email' AND sprand_no= $rand");

    }
    public function read_accountvarification($uid)
    {
        return $this->ta->read("WHERE idspUser  ='$uid' AND is_email_verify=1");

    }
    function add_quantity($data)
    {
        return $this->mem_bar->create($data);
    }
    function add_quantity_manually($data)
    {
        return $this->mem_bar_d->create($data);
//echo $this->mem_bar_d->sql;
//  die('=====');
    }
    function add_duration($data)
    {
        return $this->mem_bar->create($data);
    }
    function readlogo($data){
        return $this->tb->read("WHERE spCategory_idspCategory='$data' ");

    }
    function readimage($data){
        return $this->te->read("WHERE eventPostid='$data' ");

    }
    function read_data(){
        return $this->tr->read();
//echo $this->tr->sql;
//die('==');
    }
    function read_data1($data1){
        return $this->tr1->read("WHERE idspPostings='$data1' ");
//echo $this->tr1->sql; die('========');

    }

    function uploadimg($data){
        $this->te->create($data);
    }

    function updatepassword($data,$id){
        $this->tc->update($data,"WHERE idspPostings='$id'");
//echo $this->tc->sql;
//die('=====');
    }
    function readUid($data){
        return $this->tc->read("WHERE idspPostings='$data' ");

    }
    function read_reffer($pid){
        return $this->ta->read("WHERE idspUser=$pid ");
//echo $this->ta->sql;die('=======');
    }

    function getreferelcodeused($pid){
        return $this->ta->read("WHERE idspUser=$pid ");
    }

    function getUserRefferalsFromMainUser($code){
        return $this->ta->read("WHERE refferalcodeused = '$code'");
    }

    function getAllTier1Commissions($ids){
        return $this->ucom->read("WHERE tier1_userid IN ($ids)");
//echo $this->ta->sql;die('=======')
    }
    function getAllTier1CommissionsFilter($ids,$start,$end){
        return $this->ucom->read("WHERE tier1_userid IN ($ids) and date BETWEEN '$start 00:00:00'  AND '$end 00:00:00'");
    }
    function getAllTier2Commissions($ids){
        return $this->ucom->read("WHERE tier2_userid IN ($ids)");
    }
    function getAllTier2CommissionsFilter($ids,$start,$end){
        return $this->ucom->read("WHERE tier2_userid IN ($ids) and date BETWEEN '$start 00:00:00'  AND '$end 00:00:00'");
    }
    function getAllTier3Commissions($ids){
        return $this->ucom->read("WHERE tier3_userid IN ($ids)");
    }
    function getAllTier3CommissionsFilter($ids,$start,$end){
        return $this->ucom->read("WHERE tier3_userid IN ($ids) and date BETWEEN '$start 00:00:00'  AND '$end 00:00:00'");
    }

    function read_name($pid){
        return $this->ta->read("WHERE idspUser=$pid ");
//echo $this->ta->sql;die('=======');
    }


    function user_reffer_code($code){
        return $this->ta->read("WHERE userrefferalcode='$code' ");
// echo $this->ta->sql;die('=======44');

    }

    function used_reffer_code($usedcode){
        return $this->ta->read("WHERE userrefferalcode='$usedcode' ");
// echo $this->ta->sql;die('=======44');
    }


    function scondused_reffer_code($refrelcode){
        return $this->ta->read("WHERE userrefferalcode='$refrelcode' ");
// echo $this->ta->sql;die('=======44');
    }

    function thirdused_reffer_code($thiredrerelcode){
        return $this->ta->read("WHERE userrefferalcode='$thiredrerelcode' ");
//  echo $this->ta->sql;die('=======44');
    }

    function user_reffer_code_2($code){
        return $this->ta->read("WHERE userrefferalcode='$code' ");
// echo $this->ta->sql;die('=======44');

    }


    function readUid1($data,$pass){
        return $this->tc->read("WHERE idspPostings='$data' AND gallery_password='$pass'");
//echo $this->tc->sql;
//die('==');
    }



    function create_ip($data){
        $this->ip->create($data);

    }

    function read_ip($uid,$ip){
        return $this->ip->read("WHERE spuser_idspuser=$uid AND users_ip= '$ip' ");
        echo $this->ip->sql;die;
    }

    public function readduserid($bid)
    {
        return $this->ta->read("WHERE idspUser = " . $bid);
        echo $this->ta->sql;
    }


    public function update_login_status($bid)
    {
        return $this->ta->update(array("deactivate_status" => 0 , "deactivate_date" => null ),"WHERE idspUser =" . $bid);
    }



    public function update_duration($bid)
    {
        return $this->ta->update(array("duration"=>1,"recurring_duration"=>1),"WHERE idspUser =" . $bid);
    }

    public function deactivate_account($bid)
    {
//echo $bid;
//die("==");
        return $this->ta->update(array("deactivate_status"=>1,"deactivate_date"=>date('Y-m-d H:i:s')),"WHERE idspUser =" . $bid);
//echo $this->ta->sql;
//die('==');
    }
    public function reactivate_account($bid)
    {
        return $this->ta->update(array("deactivate_status"=>0,"deactivate_date"=>date('Y-m-d H:i:s')),"WHERE idspUser =" . $bid);

    }

    function read_ref_code($id){
//$idd=strtoupper($id);
        return $this->ta->read(" WHERE userrefferalcode ='$id' ORDER BY idspUser DESC");
        echo $this->ta->sql;
    }

    function read_user_ref_code($id){
//$idd=strtoupper($id);
        return $this->ta->read(" WHERE refferalcodeused ='$id' ORDER BY idspUser DESC");
        echo $this->ta->sql;
    }
    function read_bonus_uid($uid){
        return $this->bonus->read("WHERE uid=$uid");

    }
    public function account_verification($uid)
    {
        return $this->ta->read("WHERE idspUser =" . $uid);
    }
    public function readEmail($uid)
    {
        return $this->ta->read("WHERE idspUser =" . $uid);
    }
    public function updateEmail($data,$id)
    {
        return $this->ta->update($data,"WHERE idspUser = $id");

        echo $this->ta->sql; die("---------");

    }


    function updatecarddetails($arr,$uid){
        return $this->ta->update($arr,"WHERE idspUser=$uid");

    }
    function updateaddress($arr,$uid,$pid){
        return $this->address->update($arr, "WHERE uid=$uid AND pid=$pid");


    }

    function update_random($arr,$uid,$email){
        return $this->ta->update($arr, "WHERE idspUser =$uid AND spUserEmail= '$email'");
//echo $this->ta->sql; die("dddddd");


    }

    function readcarddetails($uid){
        return $this->ta->read("WHERE idspUser=$uid");

    }
    function readaddress($uid,$pid){
        return $this->address->read("WHERE uid=$uid AND pid=$pid");

    }

    public function account_phone($data)
    {
        return  $this->ph_1->create($data);
//echo $this->ph_1->sql; die("---------");
    }

    public function account_phone_check($pho)
    {
        return  $this->ph_1->read("WHERE phone_no =" . $pho );
//echo $this->ph_1->sql; die("---------");
    }

    public function phone_check_1($pho)
    {
        return $this->ta->read("WHERE spUserPhone =" . $pho . " AND is_phone_verify = 1 ");
//echo $this->ta->sql; die("---------");
    }
    public function phone($id){

        return $this->ta->read("WHERE idspUser = " . $id);
// echo $this->ta->sql;die('yyyyyyyy');
    }


    public function readdcurrency($uid)
    {
        return $this->cu->read("WHERE spUserid =$uid");
    }


//read data end

    public function readcurrency($uid)
    {
        return $this->ta->read("WHERE idspUser =$uid");
// echo $this->ta->sql; die('------------');
    }

    public function read_state($postid)
    {
        return $this->spjob->read("WHERE idspPostings =$postid");
// echo $this->ta->sql; die('------------');
    }

// idspUser, spUserName, spUserPhone, spUserEmail, spUserAddress, spUserPassword, spUserRegDate, spUserCountry, spUserCity


    public function updatepersonal($data,$pid)
    {
        $pid = (int)$pid;

//          return $this->taf->read("WHERE idspUser =" . $pid);
        return $this->ta->update($data, "WHERE idspUser = '$pid'");
//echo $this->ta->sql; die('------------');

    }

    public function updatephone($data,$pid)
    {

//          return $this->taf->read("WHERE idspUser =" . $pid);
        return $this->ta->update($data, "WHERE idspUser = '$pid'");

    }

    public function checkPhoneInDatabase($phone) {
        $phone = $this->ta->escapeString($phone);
        $result = $this->ta->read("WHERE spUserPhone = '$phone'");
        return !empty($result);
    }

    function updatemailstatus($data,$pid)
    {
//          return $this->taf->read("WHERE idspUser =" . $pid);
        return  $this->ta->update($data, "WHERE idspUser = '$pid'");

    }


    function de(){
        return $this->pro->read();
//echo  $this->pro->sql;die('------');
    }
    public function com_message_pump($id)
    {
        return $this->tabl->read("WHERE id =".$id);
//echo $this->taf->sql; die("--------------");
    }
    public function read1($pid)
    {
        return $this->taf->read("WHERE sp_pid =" . $pid);
//echo $this->taf->sql; die("--------------");
    }
//UPDATE USER IP ADDRESS
    public function updateIp($ip, $uid)
    {
        $this->ta->update(array("spUserIpLastLogin" => $ip), "WHERE idspUser = '$uid'");
    }
//UPDATE USER IP ADDRESS
    public function updatetwostep($twostep, $uid)
    {
        $this->ta->update(array("twostep" => $twostep), "WHERE idspUser = '$uid'");
    }
// get ip address
    public function getip($uid)
    {
        return $this->ta->read("WHERE idspUser = $uid");
    }

    public function getcurrency($userid)
    {
        return $this->ta->read("WHERE idspUser = $userid");
    }

// EMAIL VALIDATE TO CHEK EMAIL ALREADY EXIST OR NOT
    public function emailavailable($email)
    {
        $r = $this->ta->read("WHERE t.spUserEmail = '" . $email . "'");
// echo $r;
        if ($r != false) {
            die('false');
// return 0;
        } else {
            die('true');
        }
    }

    public function emailavailablecheck($email)
    {
        $r = $this->ta->read("WHERE t.spUserEmail = '" . $email . "'");
        if ($r != false) {
            return 0;
        } else {
            return 1;
        }

    }

    public function phoneavailablecheck($phone)
    {
        $phone = $this->ta->escapeString($phone);
        return $this->ta->read("WHERE t.phone_no = '" . $phone . "'");
    }

    // USER REGISTER HERE.
    public function register($data, $activationcade)
    {
        //GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
        $size      = 6;
        $alpha_key = '';
        $keys      = range('A', 'Z');
        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }
        $length = $size - 2;
        $key    = '';
        $keys   = range(0, 9);
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $randCode = $alpha_key . $key;
        // ========================================
        // ===========Email Verification Code======
        // ========================================
        $size_email      = 8;
        $alpha_key_email = '';
        $keys_email      = range('A', 'Z');
        for ($j = 0; $j < 2; $j++) {
            $alpha_key_email .= $keys_email[array_rand($keys_email)];
        }
        $length_email = $size_email - 2;
        $key_email    = '';
        $keys_email   = range(0, 9);
        for ($j = 0; $j < $length_email; $j++) {
            $key_email .= $keys_email[array_rand($keys_email)];
        }
        $emailRandCode = "ESP" . $alpha_key_email . $key_email;

        $_SESSION['email_otp'] = $emailRandCode;
        //GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END

        // ===TESTING CLASS
        // $mobilenumbers = $data['txtCountryCode'].$data["respUserEphone"];
        // //$sm = new _sms;
        // //$sm->sendsms($mobilenumbers, urlencode($randCode) );

        //             // Include the bundled autoload from the Twilio PHP Helper Library

        //     require '../twilio-php-main/src/Twilio/autoload.php';

        //     //use Twilio\Rest\Client;

        //     // Your Account SID and Auth Token from twilio.com/console
        //     $account_sid = 'AC133edde2cd4eb04a187b23785b9acf65';
        //     $auth_token = 'c34c43a63c60436330b906ebf35a75c7';
        //     // In production, these should be environment variables. E.g.:
        //     // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
        //     // A Twilio number you own with SMS capabilities
        //     $twilio_number = "+16042002975";
        //     $client = new Twilio\Rest\Client($account_sid, $auth_token);
        //     $client->messages->create(
        //         // Where to send a text message (your cell phone?) +917769899889
        //         $mobilenumbers,
        //         array(
        //             'from' => $twilio_number,
        //             'body' => 'Verification code for The SharePage registration is:'.$randCode
        //         )
        //     );
        // ===END

        $promocode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);

        //$spUser_idspUser = $this->ta->create($data);
        //$spUser_idspUser = $this->ta->create(array("spUserName" => $data["spUserName"], "spUserEmail" => $data["spUserEmail"],"spUserActCode" => $activationcade, "spUserPassword" => hash("sha256", $data['spUserPassword'])  ));
        $userName = $data["spUserFirstName"] . " " . $data["spUserLastName"];
        $spUserEmail = $this->ta->escapeString($data["spUserEmail"]);

        $spUserData = array(
            "spUserName" => $userName,
            "spUserFirstName" => $data["spUserFirstName"],
            "spUserLastName" => $data["spUserLastName"],
            "spUserPhone"=>$data["spphone"],
            "spUserEmail" => $spUserEmail,
            "spUserActCode" => $randCode,
            "spUserPassword" => hash("sha256", $data['spUserPassword']),
            "spUserCountry" => $data["spUserCountry"] ?? 0,
            "spUserState" => $data["spUserState"] ?? 0,
            "spUserCity" => $data["spUserCity"] ?? 0,
            "spUserGender" => $data["spUserGender"],
            "email_verify_code" => $emailRandCode,
            "currency"=>$data["currency"],
            "spUserIpLastLogin" => $data["spUserIpLastLogin"],
            "address" => $data["address"],
            "spUserzipcode" => $data["zipcode"],
            "latitude" => $data["latitude"],
            "longitude" => $data["longitude"],
            "refferalcodeused" => $data["refferalcodeused"],
            'phone_code'=>$data["txtCountryCode"],
            'phone_no'=>$data["spUserPhone"],
            "userrefferalcode" => strtoupper($promocode)
        );

        // echo "<pre>";print_r($spUserData);die();
        $spUser_idspUser = $this->ta->create($spUserData);

        $_SESSION['last_user']= $spUser_idspUser;
        $p = new _spprofiles;
        $p->create(array("spUser_idspUser" => $spUser_idspUser,
            "spProfileName"     => $data["spUserFirstName"].' '.$data['spUserLastName'],
            "spProfileEmail"    => $data["spUserEmail"],
            "spProfilephone"     => $data["spUserPhone"],
            "spProfileCntryCode"=> $data["txtCountryCode"],
            "spProfilesDefault" => 1,
            "spProfilesCity"    => $data["spUserCity"] ?? 0,
            "spProfilesState"    => $data["spUserState"] ?? 0,
            "profile_status" =>  "public",
            "spProfilesCountry"    => $data["spUserCountry"] ?? 0,
            "spProfileType_idspProfileType" => $data["spProfileType_idspProfileType_"],
            "address"=>  $data["address"] ?? null,
            "spUserzipcode"=>$data["zipcode"] ?? null,
            "latitude"=> $data["latitude"] ?? null,
            "longitude"=> $data["longitude"] ?? null,
        ));


        $_SESSION['new_email']=$data["spUserEmail"];
        $_SESSION['new_username']=$userName;

        $em = new _email;

        $em->send_reg_email($data["spUserEmail"], $userName, $spUser_idspUser, $emailRandCode);

        $em->send_reg_email("thesharepage.com@gmail.com", $userName, $spUser_idspUser, $emailRandCode, " | ".$data["spUserEmail"]);

        // ==============END=================
        return $spUser_idspUser;
    }







    public function resend_email_otp()
    {


        session_start();
// ===========SEND EMAIL==============
        $em = new _email;
        $em->sendemail();
        //print_r($_SESSION); die;
        $em->send_reg_email($_SESSION['new_email'],$_SESSION['new_username'],$_SESSION['last_user'], $_SESSION['email_otp']);

    }

    public function sendMobileOtp($data, $uid)
    {
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
        $size      = 6;
        $alpha_key = '';
        $keys      = range('A', 'Z');
        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }
        $length = $size - 2;
        $key    = '';
        $keys   = range(0, 9);
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $randCode = $alpha_key . $key;

// ===TESTING CLASS
        $mobilenumbers = $data['txtCountryCode'] . $data["respUserEphone"];
//$sm = new _sms;
//$sm->sendsms($mobilenumbers, urlencode($randCode) );

// Include the bundled autoload from the Twilio PHP Helper Library

        require '../twilio-php-main/src/Twilio/autoload.php';

//use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'AC133edde2cd4eb04a187b23785b9acf65';
        $auth_token  = 'c34c43a63c60436330b906ebf35a75c7';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
        $twilio_number = "+16042002975";
        $client        = new Twilio\Rest\Client($account_sid, $auth_token);
        $client->messages->create(
// Where to send a text message (your cell phone?) +917769899889
            $mobilenumbers,
            array(
                'from' => $twilio_number,
                'body' => 'Verification code for The Dev SharePage New Registration is: ' . $randCode,
            )
        );
// ===END

        $this->ta->update(array("spUserPhone" => $data["respUserEphone"], "spUserCountryCode" => $data['txtCountryCode'], "phone_verify_code" => $randCode), "WHERE idspUser ='" . $uid . "'");

        echo 1;
    }

    public function sendMobileOtpcall($data, $uid)
    {
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
        $size      = 6;
        $alpha_key = '';
        $keys      = range('A', 'Z');
        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }
        $length = $size - 2;
        $key    = '';
        $keys   = range(0, 9);
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $randomCode = $alpha_key . $key;

        $mobilenumbers = $data['txtCountryCode'] . $data["respUserEphone"];
        require '../twilio-php-main/src/Twilio/autoload.php';
        $sid = "AC133edde2cd4eb04a187b23785b9acf65";
        $token = "c34c43a63c60436330b906ebf35a75c7";
        $twilio = new Twilio\Rest\Client($sid, $token);

        $call = $twilio->calls
            ->create($mobilenumbers, // to
                "+16042002975", // from
                [

                    "twiml" => "<Response><Say><prosody rate = '65%'><w>Verification code for The Sharepage Registration is:
	<say-as interpret-as='telephone'>".$randomCode."</say-as></w></prosody></Say></Response>"
                ]
            );

        $this->ta->update(array("spUserPhone" => $data["respUserEphone"], "spUserCountryCode" => $data['txtCountryCode'], "phone_verify_code" => $randomCode), "WHERE idspUser ='" . $uid . "'");

        echo 1;
    }

    public function verifyMobileOtp($data, $uid)
    {
        $user = $this->ta->read("WHERE phone_verify_code = '" . $data['phone_verify_code'] . "' AND spUserPhone = " . $data["respUserEphone"] . " AND idspUser =" . $uid);
// $user = $this->ta->read($uid);

        if ($user != false) {
            $this->ta->update(array("is_phone_verify" => 1,"spUserLock" => 0), "WHERE idspUser ='" . $uid . "'");

            while ($row3 = mysqli_fetch_assoc($user)) {

// ===========SEND EMAIL==============
//   $em = new _email;
//$em->sendemail();
// ===not complete
// $em->send_reg_email($row3["spUserEmail"], $row3["spUserName"], $uid, $row3["email_verify_code"]);

                $p = new _spprofiles;
                $p->create(array("spUser_idspUser" => $uid,
                    "spProfileName"                    => $row3["spUserName"],
                    "spProfileEmail"                   => $row3["spUserEmail"],
                    "spProfilephone"                   => $row3["spUserPhone"],
                    "spProfileCntryCode"               => $row3["spUserCountryCode"],
                    "spProfilesDefault"                => 1,
                    "spProfilesDob"                    => $row3["spUserDob"],
                    "spProfilesCity"                   => $row3["spUserCity"],
                    "spProfilesState"                  => $row3["spUserState"],
                    "spProfilesCountry"                => $row3["spUserCountry"],
                    "spProfileType_idspProfileType"    => 4,
                    "address"                          => $row3["address"],
                    "spUserzipcode"                    => $row3["spUserzipcode"],
                    "latitude"                         => $row3["latitude"],
                    "longitude"                        => $row3["longitude"],
                ));
            }

            echo 1;

        } else {
            echo 0;
        }

    }

    public function registerapi($data, $activationcade)
    {

//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
        $size      = 6;
        $alpha_key = '';
        $keys      = range('A', 'Z');
        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }
        $length = $size - 2;
        $key    = '';
        $keys   = range(0, 9);
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $randCode = $alpha_key . $key;
// ========================================
// ===========Email Verification Code======
// ========================================
        $size_email      = 8;
        $alpha_key_email = '';
        $keys_email      = range('A', 'Z');
        for ($j = 0; $j < 2; $j++) {
            $alpha_key_email .= $keys_email[array_rand($keys_email)];
        }
        $length_email = $size_email - 2;
        $key_email    = '';
        $keys_email   = range(0, 9);
        for ($j = 0; $j < $length_email; $j++) {
            $key_email .= $keys_email[array_rand($keys_email)];
        }
        $emailRandCode = "ESP" . $alpha_key_email . $key_email;
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END

// ===TESTING CLASS
        $mobilenumbers = $data['txtCountryCode'] . $data["respUserEphone"];
//$sm = new _sms;
//$sm->sendsms($mobilenumbers, urlencode($randCode) );

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Include the bundled autoload from the Twilio PHP Helper Library

        require '../twilio-php-main/src/Twilio/autoload.php';

//use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'AC133edde2cd4eb04a187b23785b9acf65';
        $auth_token  = 'c34c43a63c60436330b906ebf35a75c7';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
        $twilio_number = "+16042002975";
        $client        = new Twilio\Rest\Client($account_sid, $auth_token);
        $client->messages->create(
// Where to send a text message (your cell phone?) +917769899889
            $mobilenumbers,
            array(
                'from' => $twilio_number,
                'body' => 'Verification code for The SharePage registration is:' . $randCode,
            )
        );

// ===END

        $promocode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);



//$spUser_idspUser = $this->ta->create($data);
//$spUser_idspUser = $this->ta->create(array("spUserName" => $data["spUserName"], "spUserEmail" => $data["spUserEmail"],"spUserActCode" => $activationcade, "spUserPassword" => hash("sha256", $data['spUserPassword'])  ));
        $userName = $data["spUserFirstName"] . " " . $data["spUserLastName"];

        $spUser_idspUser = $this->ta->create(array("spUserName" => $userName, "spUserFirstName" => $data["spUserFirstName"], "spUserLastName" => $data["spUserLastName"], "spUserPhone" => $data["respUserEphone"], "spUserEmail" => $data["spUserEmail"], "spUserActCode" => $randCode, "spUserPassword" => hash("sha256", $data['spUserPassword']), "spUserCountry" => $data["spUserCountry"], "spUserState" => $data["spUserState"], "spUserCity" => $data["spUserCity"], "spUserGender" => $data["spUserGender"], "email_verify_code" => $emailRandCode, "phone_verify_code" => $randCode, "spUserDob" => $data["spUserDob"], "spUserCountryCode" => $data['txtCountryCode'], "spUserIpLastLogin" => $data["spUserIpLastLogin"], "address" => $data["address"], "spUserzipcode" => $data["zipcode"], "latitude" => $data["latitude"], "longitude" => $data["longitude"], "refferalcodeused" => $data["refferalcodeused"], "userrefferalcode" => $data["userrefferalcode"]));

        $p = new _spprofiles;
        $p->create(array("spUser_idspUser" => $spUser_idspUser,
            "spProfileName"                    => $data["spUserFirstName"] . ' ' . $data['spUserLastName'],
            "spProfileEmail"                   => $data["spUserEmail"],
            "spProfilephone"                   => $data["respUserEphone"],
            "spProfileCntryCode"               => $data["txtCountryCode"],
            "spProfilesDefault"                => 1,
            "spProfilesCity"                   => $data["spUserCity"],
            "spProfilesState"                  => $data["spUserState"],
            "spProfilesCountry"                => $data["spUserCountry"],
            "spProfileType_idspProfileType"    => $data["spProfileType_idspProfileType_"],
            "address"                          => $data["address"],
            "spUserzipcode"                    => $data["zipcode"],
            "latitude"                         => $data["latitude"],
            "longitude"                        => $data["longitude"],
        ));

// ===========SEND EMAIL==============
        $em = new _email;
//$em->sendemail();
// ===not complete
        $em->send_reg_email($data["spUserEmail"], $userName, $spUser_idspUser, $emailRandCode);

// ==============END=================
        return $spUser_idspUser;
    }

// READ USER ID AND USER DETAIL
    public function read($uid)
    {
        return $this->ta->read("WHERE idspUser =" . $uid);
//echo $this->ta->sql;die('=====');
    }
    public function read_pro($pid1)
    {
        return $this->pro->read("WHERE t.idspProfiles =" . $pid1);
        echo $this->pro->sql;die('=====');
    }

// Check user phone number with code by uid
    public function checkUserPhoneByUID($uid, $countryCode, $number)
    {
        return $this->ta->read("WHERE spUserPhone = " . $number . " AND spUserCountryCode = " . $countryCode . " AND idspUser =" . $uid);
    }

    public function back_read($uid)
    {
        return $this->ba->read("WHERE user_id =" . $uid);
    }

    public function readrefferaluser($refferalcodeused)
    {
        return $this->ta->read("WHERE refferalcodeused = '" . $refferalcodeused . "' AND refferalcodeused != '' ORDER BY idspUser ASC");
//echo $this->ta->sql;die('=====');

    }
// read profile id user detail
    public function readProfile($pid)
    {
        return $this->ta->read("INNER JOIN spprofiles AS p ON t.idspUser = p.spUser_idspUser WHERE idspProfiles = $pid");
    }
// UPDATE USER CODE
    public function updateCode($uid, $randCode)
    {
        $this->ta->update(array("spUserActCode" => $randCode), "WHERE idspUser ='" . $uid . "'");
    }
// UPDATE USER EMAIL CODE
    public function updateEmailCode($uid, $randCode, $cod)
    {
        if ($cod == 1) {
// this is phone update
            $this->ta->update(array("phone_verify_code" => $randCode), "WHERE idspUser ='$uid' ");
        } else {
// this is email update
            $this->ta->update(array("email_verify_code" => $randCode, "verification_email_sent_at" => date("Y-m-d H:i:s")), "WHERE idspUser ='$uid' ");
        }
    }

    public function loginverifycode($uid)
    {
        return $this->ta->read("WHERE idspUser =" . $uid);
    }

// IS CODE VALID WITH UID OR NOT
    public function isvodevalid($uid, $cod)
    {
        return $this->ta->read("WHERE idspUser =" . $uid . " AND phone_verify_code = '$cod' ");
    }
// UPDATE CODE WHEN CODE IS CORRECT
    public function activeAcount($uid)
    {
        $this->ta->update(array("spUserActive" => 1), "WHERE idspUser = $uid ");
    }
// PHONE NUMBER IS ACTIVATED
    public function activePhone($uid)
    {
        $this->ta->update(array("is_phone_verify" => 1), "WHERE idspUser = $uid ");
    }
// EMAIL IS ACTIVATED
    public function activeEmail($uid)
    {
        $this->ta->update(array("is_email_verify" => 1), "WHERE idspUser = $uid ");
    }
// UPDATE DETAIL OF USER POST
    public function update($data, $uid)
    {
        $this->ta->update($data, "WHERE idspUser = $uid ");
    }

// Api LOGIN THROUGH EMAIL
    public function login_api($email, $password)
    {
        return $this->ta->read("WHERE t.spUserEmail = '" . $email . "' AND t.spUserPassword = '" . $password . "'");
    }

// CHEK Api USER IS LOCKED OR UNLOCKED
    public function chekLock_api($email)
    {
        return $this->ta->read("WHERE t.spUserEmail = '" . $email . "' AND spUserLock = 0 ");
//echo $this->ta->sql;die;
    }

    public function chekEmail($email)
    {
        return $this->ta->read("WHERE t.spUserEmail = '" . $email . "' AND is_email_verify = 1 ");
//echo $this->ta->sql;die;
    }






// USER LOGIN THROUGH EMAIL
    public function login($email, $password)
    {
        $email = $this->ta->escapeString($email);
        return $this->ta->read("WHERE t.spUserEmail = '" . $email . "' AND t.spUserPassword = '" . $password . "'");
    }
// CHEK USER IS LOCKED OR UNLOCKED
    public function chekLock($email)
    {
        return $this->ta->read("WHERE t.spUserEmail = '" . $email . "' AND spUserLock = 0 ");
//echo $this->ta->sql;die;
    }

// IS USER EMAIL AND PHONE IS VERIFY
    public function isverify($uid)
    {
// IS PHONE IS VERIFIED?
        $result = $this->ta->read("WHERE idspUser = $uid AND is_phone_verify = 1");
//echo $this->ta->sql;die;
        if ($result) {
            $phone = 1;
        } else {
            $phone = 0;
        }
// IS EMAIL IS VERIFIED?
        $result2 = $this->ta->read("WHERE idspUser = $uid AND is_email_verify = 1");
        if ($result2) {
            $email = 1;
        } else {
            $email = 0;
        }
// CHECK PROCESS
        if (isset($phone) and $phone == 1 and isset($email) and $email == 1) {
            return 1;
        } else if (isset($phone) and $phone == 1 and isset($email) and $email == 0) {
            return 2;
        } else if (isset($phone) and $phone == 0 and isset($email) and $email == 1) {
            return 3;
        } else if (isset($phone) and $phone == 0 and isset($email) and $email == 0) {
            return 4;
        } else {
            return 4;
        }
    }
    public function isPhoneVerify($uid)
    {
        return $this->ta->read("WHERE idspUser = $uid AND is_phone_verify = 1");
    }
    public function read_phoneNo($uid)
    {
        return $this->ta->read("WHERE idspUser = $uid");
    }
    public function isEmailVerify($uid)
    {
        return $this->ta->read("WHERE idspUser = $uid AND is_email_verify = 1");
    }

    public function totaluser()
    {
        return $this->ta->read();
    }
    public function adminlogin($username, $password)
    {
        return $this->ta->read("WHERE t.spUserName = '" . $username . "' AND t.spUserPassword = '" . $password . "' AND spuserAdmin = 1");
    }
    public function useravailable($name)
    {
        $r = $this->ta->read("WHERE t.spUserName = '" . $name . "'");
        if ($r != false) {
            return 0;
        } else {
            return 1;
        }

    }
    public function changepassword($uid, $password)
    {
        $this->ta->update(array("spUserPassword" => $password), "WHERE idspUser ='" . $uid . "'");
    }

    public function changepassword_ba($uid, $password)
    {
        $this->ba->update(array("user_password" => $password), "WHERE user_id ='" . $uid . "'");
    }

    public function activate($uid)
    {
        return $this->ta->update(array("email_verify_code" => 0, "is_email_verify" => 1, "spUserLock" => 0), "WHERE idspUser ='" . $uid . "'");
    }

//Forget Password Testing

    public function resetcode($email, $recode)
    {
        return $this->ta->update(array("spUserResetCode" => $recode), "WHERE spUserEmail ='" . $email . "'");
    }

    public function resetcodenum($number, $recode)
    {
        return $this->ta->update(array("spUserResetCode" => $recode), "WHERE phone_no ='" . $number . "'");
    }


    public function resetcode_ba($email, $recode)
    {
        return $this->ba->update(array("user_reset_code" => $recode), "WHERE user_email ='" . $email . "'");
    }

    public function regen($email)
    {
        return $this->ta->read("WHERE t.spUserEmail ='" . $email . "'");
    }



    public function regennum($number)
    {
        return $this->ta->read("WHERE t.phone_no ='" . $number . "'");
    }

    public function checkemail($email)
    {
        return  $this->ta->read("WHERE t.spUserEmail ='$email'");
//echo $this->ta->sql;
// die("++++");
    }

    public function checkphone($phone)
    {
        return $this->ta->read("WHERE t.phone_no ='$phone'");
//echo $this->ta->sql;
//die("++++");
    }

    public function checkuseiotp($userid)
    {
        return $this->ta->read("WHERE t.idspUser ='$userid'");
// echo $this->ta->sql;
// die("++++");
    }




    public function regen_back($email)
    {
        return $this->ba->read("WHERE user_email ='" . $email . "'");
    }

    /*public function resetpassword($code)
    {
    return $this->ta->update("WHERE t.spUserReset = '" . $code . "'")
    }*/
// =======================SHIPPING==============================
    public function readship($uid)
    {
        return $this->tad->read("WHERE spUser_idspUser = $uid");
    }
// ===INSERT INTO TBL SHIP
    public function insertship($name, $mobile, $email, $country, $state, $city, $address, $uid)
    {
        $this->tad->create(array("shipName" => $name, "shipEmail" => $email, "shipPhone" => $mobile, "country_id" => $country, "state_id" => $state, "city_id" => $city, "shipAddress" => $address, "spUser_idspUser" => $uid));
    }
// ===UPDATE
    public function updateship($name, $mobile, $email, $country, $state, $city, $address, $uid)
    {
        $this->tad->update(array("shipName" => $name, "shipEmail" => $email, "shipPhone" => $mobile, "country_id" => $country, "state_id" => $state, "city_id" => $city, "shipAddress" => $address), "WHERE spUser_idspUser = $uid ");
    }

    public function readrefferaluserPaginated($userrefferalcode, $limit, $offset) {
        $conn = _data::getConnection();
        $sql = "SELECT * FROM spuser WHERE refferalcodeused = '$userrefferalcode' 
            ORDER BY spUserRegDate DESC 
            LIMIT $limit OFFSET $offset";
        return mysqli_query($conn, $sql);
    }


// =======================END===================================
}
