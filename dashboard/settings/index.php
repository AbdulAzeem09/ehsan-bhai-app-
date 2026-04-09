<style type="text/css">
.p-box{
    margin: 0 0 10px;
    border: 1px solid #ddd;
    padding: 15px;
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
    border-radius: 5px;
}
</style>
<?php
/*	ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/

require_once("../../univ/baseurl.php");
include('../../helpers/image.php');
//include('../../backofadmin/library/config.php');
session_start();
require_once("../../backofadmin/library/config.php");





if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
unset($_SESSION['phone_otp_setting2']);
$pageactive = 26;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<style>
.sidebar {
padding-bottom: 70px;
}

textarea#if_email {
resize: none;
}

#if_message {
resize: none;
}

#car1 {
margin-top: 8px !important;
}

.right_head_top ul li {
padding-left: 2px !important;
}
</style>
</head>

<body class="bg_gray">

<!--modal code here-->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Time Zone</h4>
</div>
<?php
$commands = "select time_zone from spuser where idspuser='385'";
$cmd = mysqli_query($dbConn, $commands);
//var_dump($cmd);

$row = mysqli_fetch_array($cmd);
//print_r($row);


$time_zone = $row["time_zone"];

?>
<div class="modal-body">
<form method="post">
<!--<p>Please select time zone..</p>-->
<select name="timezone_offset" id="timezone-offset" class="form-control span5" value="<">
<option value="-12:00" <?php if ($time_zone == "-12:00") {
echo 'selected';
} ?>>(GMT -12:00) Eniwetok, Kwajalein</option>
<option value="-11:00" <?php if ($time_zone == "-11:00") {
echo 'selected';
} ?>>(GMT -11:00) Midway Island, Samoa</option>
<option value="-10:00" <?php if ($time_zone == "-10:00") {
echo 'selected';
} ?>>(GMT -10:00) Hawaii</option>
<option value="-09:50" <?php if ($time_zone == "-09::50") {
echo 'selected';
} ?>>(GMT -9:30) Taiohae</option>
<option value="-09:00" <?php if ($time_zone == "-09:00") {
echo 'selected';
} ?>>(GMT -9:00) Alaska</option>
<option value="-08:00" <?php if ($time_zone == "-08:00") {
echo 'selected';
} ?>>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
<option value="-07:00" <?php if ($time_zone == "-07:00") {
echo 'selected';
} ?>>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
<option value="-06:00" <?php if ($time_zone == "-06:00") {
echo 'selected';
} ?>>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
<option value="-05:00" <?php if ($time_zone == "-05:00") {
echo 'selected';
} ?>>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
<option value="-04:50" <?php if ($time_zone == "-04:50") {
echo 'selected';
} ?>>(GMT -4:30) Caracas</option>
<option value="-04:00" <?php if ($time_zone == "-04:00") {
echo 'selected';
} ?>>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
<option value="-03:50" <?php if ($time_zone == "-03:50") {
echo 'selected';
} ?>>(GMT -3:30) Newfoundland</option>
<option value="-03:00" <?php if ($time_zone == "-03:00") {
echo 'selected';
} ?>>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
<option value="-02:00" <?php if ($time_zone == "-02:00") {
echo 'selected';
} ?>>(GMT -2:00) Mid-Atlantic</option>
<option value="-01:00" <?php if ($time_zone == "-01:00") {
echo 'selected';
} ?>>(GMT -1:00) Azores, Cape Verde Islands</option>
<option value="+00:00" <?php if ($time_zone == "-00:00") {
echo 'selected';
} ?>>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
<option value="+01:00" <?php if ($time_zone == "+01:00") {
echo 'selected';
} ?>>(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
<option value="+02:00" <?php if ($time_zone == "+02:00") {
echo 'selected';
} ?>>(GMT +2:00) Kaliningrad, South Africa</option>
<option value="+03:00" <?php if ($time_zone == "+03:00") {
echo 'selected';
} ?>>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
<option value="+03:50" <?php if ($time_zone == "+03:50") {
echo 'selected';
} ?>>(GMT +3:30) Tehran</option>
<option value="+04:00" <?php if ($time_zone == "+04:00") {
echo 'selected';
} ?>>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
<option value="+04:50" <?php if ($time_zone == "+04:50") {
echo 'selected';
} ?>>(GMT +4:30) Kabul</option>
<option value="+05:00" <?php if ($time_zone == "+05:00") {
echo 'selected';
} ?>>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
<option value="+05:50" <?php if ($time_zone == "+05:50") {
echo 'selected';
} ?>>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
<option value="+05:75" <?php if ($time_zone == "+05:75") {
echo 'selected';
} ?>>(GMT +5:45) Kathmandu, Pokhara</option>
<option value="+06:00" <?php if ($time_zone == "+06:00") {
echo 'selected';
} ?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
<option value="+07:00" <?php if ($time_zone == "+07:00") {
echo 'selected';
} ?>>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
<option value="+08:00" <?php if ($time_zone == "+08:00") {
echo 'selected';
} ?>>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
<option value="+08:75" <?php if ($time_zone == "+08:75") {
echo 'selected';
} ?>>(GMT +8:45) Eucla</option>
<option value="+09:00" <?php if ($time_zone == "+09:00") {
echo 'selected';
} ?>>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
<option value="+09:50" <?php if ($time_zone == "+09:50") {
echo 'selected';
} ?>>(GMT +9:30) Adelaide, Darwin</option>
<option value="+10:00" <?php if ($time_zone == "+10:00") {
echo 'selected';
} ?>>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
<option value="+10:50" <?php if ($time_zone == "+10:50") {
echo 'selected';
} ?>>(GMT +10:30) Lord Howe Island</option>
<option value="+11:00" <?php if ($time_zone == "+11:00") {
echo 'selected';
} ?>>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
<option value="+11:50" <?php if ($time_zone == "+11:50") {
echo 'selected';
} ?>>(GMT +11:30) Norfolk Island</option>
<option value="+12:00" <?php if ($time_zone == "+12:00") {
echo 'selected';
} ?>>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
<option value="+12:75" <?php if ($time_zone == "+12:75") {
echo 'selected';
} ?>>(GMT +12:45) Chatham Islands</option>
<option value="+13:00" <?php if ($time_zone == "+13:00") {
echo 'selected';
} ?>>(GMT +13:00) Apia, Nukualofa</option>
<option value="+14:00" <?php if ($time_zone == "+14:00") {
echo 'selected';
} ?>>(GMT +14:00) Line Islands, Tokelau</option>
</select>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary" name="timebtn">Save</button>

</div>
</form>
</div>

</div>
</div>
<style>
.pointer {
cursor: pointer;
}
.inner_top_form button {

padding:9px 12px!important;
}
</style>

<!--close modal code-->


<?php
include_once("../../header.php");


$con = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);

if (!$con) {
die('Not Connected To Server');
}

//Connection to database
if (!$con) {
echo 'Database Not Selected';
}

$uid_img = $_SESSION["uid"];

$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";

if ($result = $con->query($selectimage)) {



$row = mysqli_fetch_assoc($result);
}




$p = new _spprofiles;
$rpvt = $p->readProfiles($_SESSION["uid"]);
if ($rpvt != false) {
$a = 0; //Business
$b = 0; //Freelacer
$c = 0; //Entertainment
$d = 0; //Personal
$e = 0; //Job seeker
$f = 0; //Dating
while ($rows = mysqli_fetch_assoc($rpvt)) {
if ($rows['idspProfileType'] == 1) //Business
{
$a++;
}

if ($rows['idspProfileType'] == 2) //Freelancer
{
$b++;
}

if ($rows['idspProfileType'] == 3) //Entertainment
{
$c++;
}

if ($rows['idspProfileType'] == 4) //Personal
{
$d++;
}

if ($rows['idspProfileType'] == 5) //Job seeker
{
$e++;
}

if ($rows['idspProfileType'] == 6) //Dating
{
$f++;
}
}
}

$pt = new _profiletypes;
$rpt = $pt->read();
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
//echo $u->ta->sql;
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);

//print_r($ruser);
$username = $ruser["spUserName"];
$userpnone = $ruser["phone_code"] . $ruser["spUserPhone"];
$useremail = $ruser["spUserEmail"];
$useraddress = $ruser["spUserAddress"];
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"];
$usercity = $ruser["spUserCity"];
$address = $ruser["address"];
$isPhoneVerify = $ruser["is_phone_verify"];
$twostep = $ruser["twostep"];
$userrefferalcode = $ruser["userrefferalcode"];
$cmpnyExt = $ruser["phone_code"];
$phone_no1 = $ruser["phone_no"];
$spUserPhone =$ruser["spUserPhone"];


}

?>


<div class="modal fade" id="changemobile" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">

<div class="modal-header br_radius_top bg-white">
<button type="button" id="update_close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Change Phone Number</b> </h3>
</div>

<div class="modal-body">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-9">

<div class="form-group">
<label for="">Current Phone Number</label>

<span class="phone-display"><?php echo '+'.$cmpnyExt. $spUserPhone ?></span>
<input type="hidden" class="form-control" id="old_number" name="" value="<?php echo $ruser["spUserPhone"]; ?>">
</div>

<div>
<label for="">Enter a new Phone Number</label>
<input type="hidden" class="form-control txtbox" id="hidden_phone" name="hidden_phone" value="<?php echo $spUserPhone;?>">
<input type="hidden" id="hiddenDialCode" name="dialCode" value="1">
<label for="respUserEphone" class="lbl_9"> <span style="color: #938b80;font-size: 10px;"> (select country code first)</span><span class="red">* </span></label><br/>
<input type="text" class="form-control txtbox" id="txtPhone" d name="spUserPhone" value=""><br>
<span id="err_phone_valid" class="red"></span>
<div class="row">
<br>
<div class="col-md-6" id="otpform" style="margin-left: -14px;display: none">
<label for="otp">Verify OTP</label>

<input type="hidden" class="form-control" id="otp_code" name="otp_code" placeholder="Enter Code here"   style="width: 90%;" value="<?php echo rand(); ?>">


<input type="text" class="form-control" id="otp_enter" name="otp" placeholder="Enter Code here" value="" style="width: 90%;">
<span id="success" style="color: green;"></span>
</div>
<div class="col-md-3" style="margin-top: 30px; margin-left: -40px;">
<span><a onclick="re_send_otp();" id="resend-button" style="cursor: pointer;display: none">Re-send</a></span>
</div>
</div>

<!-- <select class="form-control profilefield" name="companyExtNo" id="companyExtNo_" style="width: 100% !important; padding: 6px 0px !important;" <?php if($isPhoneVerify==1){echo 'disabled';} ?>>
<option data-countryCode="GB" value="44"  <?php if($cmpnyExt==44){echo 'selected';}?>>+44</option>
<option data-countryCode="US" value="1" <?php if($cmpnyExt==1){echo 'selected';}?> >+1</option>
<option data-countryCode="DZ" value="213" <?php if($cmpnyExt==213){echo 'selected';}?>>+213</option>
<option data-countryCode="AD" value="376" <?php if($cmpnyExt==376){echo 'selected';}?>>+376</option>
<option data-countryCode="AO" value="244" <?php if($cmpnyExt==244){echo 'selected';}?>>+244</option>
<option data-countryCode="AI" value="1264" <?php if($cmpnyExt==1264){echo 'selected';}?>>+1264</option>
<option data-countryCode="AG" value="1268" <?php if($cmpnyExt==1268){echo 'selected';}?>>+1268</option>
<option data-countryCode="AR" value="54" <?php if($cmpnyExt==54){echo 'selected';}?>>+54</option>
<option data-countryCode="AM" value="374" <?php if($cmpnyExt==374){echo 'selected';}?> >+374</option>
<option data-countryCode="AW" value="297" <?php if($cmpnyExt==297){echo 'selected';}?> >+297</option>
<option data-countryCode="AU" value="61" <?php if($cmpnyExt==61){echo 'selected';}?> >+61</option>
<option data-countryCode="AT" value="43" <?php if($cmpnyExt==43){echo 'selected';}?>>+43</option>
<option data-countryCode="AZ" value="994" <?php if($cmpnyExt==994){echo 'selected';}?>>+994</option>
<option data-countryCode="BS" value="1242" <?php if($cmpnyExt==1242){echo 'selected';}?>>+1242</option>
<option data-countryCode="BH" value="973" <?php if($cmpnyExt==973){echo 'selected';}?>>+973</option>
<option data-countryCode="BD" value="880" <?php if($cmpnyExt==880){echo 'selected';}?>>+880</option>
<option data-countryCode="BB" value="1246" <?php if($cmpnyExt==1246){echo 'selected';}?>>+1246</option>
<option data-countryCode="BY" value="375" <?php if($cmpnyExt==375){echo 'selected';}?>>+375</option>
<option data-countryCode="BE" value="32" <?php if($cmpnyExt==32){echo 'selected';}?>>+32</option>
<option data-countryCode="BZ" value="501" <?php if($cmpnyExt==501){echo 'selected';}?>>+501</option>
<option data-countryCode="BJ" value="229" <?php if($cmpnyExt==229){echo 'selected';}?>>+229</option>
<option data-countryCode="BM" value="1441" <?php if($cmpnyExt==1441){echo 'selected';}?>>+1441</option>
<option data-countryCode="BT" value="975" <?php if($cmpnyExt==975){echo 'selected';}?>>+975</option>
<option data-countryCode="BO" value="591" <?php if($cmpnyExt==591){echo 'selected';}?>>+591</option>
<option data-countryCode="BA" value="387" <?php if($cmpnyExt==387){echo 'selected';}?>>+387</option>
<option data-countryCode="BW" value="267" <?php if($cmpnyExt==267){echo 'selected';}?>>+267</option>
<option data-countryCode="BR" value="55" <?php if($cmpnyExt==55){echo 'selected';}?>>+55</option>
<option data-countryCode="BN" value="673" <?php if($cmpnyExt==673){echo 'selected';}?>>+673</option>
<option data-countryCode="BG" value="359" <?php if($cmpnyExt==359){echo 'selected';}?>>+359</option>
<option data-countryCode="BF" value="226" <?php if($cmpnyExt==226){echo 'selected';}?>>+226</option>
<option data-countryCode="BI" value="257" <?php if($cmpnyExt==257){echo 'selected';}?>>+257</option>
<option data-countryCode="KH" value="855" <?php if($cmpnyExt==855){echo 'selected';}?>>+855</option>
<option data-countryCode="CM" value="237" <?php if($cmpnyExt==237){echo 'selected';}?>>+237</option>
<option data-countryCode="CA" value="1" <?php if($cmpnyExt==1){echo 'selected';}?>>+1</option>
<option data-countryCode="CV" value="238" <?php if($cmpnyExt==238){echo 'selected';}?>>+238</option>
<option data-countryCode="KY" value="1345" <?php if($cmpnyExt==1345){echo 'selected';}?>>+1345</option>
<option data-countryCode="CF" value="236" <?php if($cmpnyExt==236){echo 'selected';}?>>+236</option>
<option data-countryCode="CL" value="56" <?php if($cmpnyExt==56){echo 'selected';}?>>+56</option>
<option data-countryCode="CN" value="86" <?php if($cmpnyExt==86){echo 'selected';}?>>+86</option>
<option data-countryCode="CO" value="57" <?php if($cmpnyExt==676){echo 'selected';}?>>+57</option>
<option data-countryCode="KM" value="269" <?php if($cmpnyExt==269){echo 'selected';}?>>+269</option>
<option data-countryCode="CG" value="242" <?php if($cmpnyExt==242){echo 'selected';}?>>+242</option>
<option data-countryCode="CK" value="682" <?php if($cmpnyExt==682){echo 'selected';}?>>+682</option>
<option data-countryCode="CR" value="506" <?php if($cmpnyExt==506){echo 'selected';}?>>+506</option>
<option data-countryCode="HR" value="385" <?php if($cmpnyExt==385){echo 'selected';}?>>+385</option>
<option data-countryCode="CU" value="53" <?php if($cmpnyExt==53){echo 'selected';}?>>+53</option>
<option data-countryCode="CY" value="90392" <?php if($cmpnyExt==90392){echo 'selected';}?>>+90392</option>
<option data-countryCode="CY" value="357" <?php if($cmpnyExt==357){echo 'selected';}?>>+357</option>
<option data-countryCode="CZ" value="42" <?php if($cmpnyExt==42){echo 'selected';}?>>+42</option>
<option data-countryCode="DK" value="45" <?php if($cmpnyExt==45){echo 'selected';}?>>+45</option>
<option data-countryCode="DJ" value="253" <?php if($cmpnyExt==253){echo 'selected';}?>>+253</option>
<option data-countryCode="DM" value="1809" <?php if($cmpnyExt==1809){echo 'selected';}?>>+1809</option>
<option data-countryCode="EC" value="593" <?php if($cmpnyExt==593){echo 'selected';}?>>+593</option>
<option data-countryCode="EG" value="20" <?php if($cmpnyExt==20){echo 'selected';}?>>+20</option>
<option data-countryCode="SV" value="503" <?php if($cmpnyExt==503){echo 'selected';}?>>+503</option>
<option data-countryCode="GQ" value="240" <?php if($cmpnyExt==240){echo 'selected';}?>>+240</option>
<option data-countryCode="ER" value="291" <?php if($cmpnyExt==291){echo 'selected';}?>>+291</option>
<option data-countryCode="EE" value="372" <?php if($cmpnyExt==372){echo 'selected';}?>>+372</option>
<option data-countryCode="ET" value="251" <?php if($cmpnyExt==251){echo 'selected';}?>>+251</option>
<option data-countryCode="FK" value="500" <?php if($cmpnyExt==500){echo 'selected';}?>>+500</option>
<option data-countryCode="FO" value="298" <?php if($cmpnyExt==298){echo 'selected';}?>>+298</option>
<option data-countryCode="FJ" value="679" <?php if($cmpnyExt==679){echo 'selected';}?>>+679</option>
<option data-countryCode="FI" value="358" <?php if($cmpnyExt==3589){echo 'selected';}?>>+358</option>
<option data-countryCode="FR" value="33" <?php if($cmpnyExt==33){echo 'selected';}?>>+33</option>


<option data-countryCode="GF" value="594" <?php if($cmpnyExt==549){echo 'selected';}?>>594</option>
<option data-countryCode="PF" value="689" <?php if($cmpnyExt==689){echo 'selected';}?>>+689</option>
<option data-countryCode="GA" value="241" <?php if($cmpnyExt==241){echo 'selected';}?>>+241</option>
<option data-countryCode="GM" value="220" <?php if($cmpnyExt==220){echo 'selected';}?>>+220</option>
<option data-countryCode="GE" value="7880" <?php if($cmpnyExt==7880){echo 'selected';}?>>+7880</option>
<option data-countryCode="DE" value="49" <?php if($cmpnyExt==49){echo 'selected';}?>>+49</option>
<option data-countryCode="GH" value="233" <?php if($cmpnyExt==233){echo 'selected';}?>>+233</option>
<option data-countryCode="GI" value="350" <?php if($cmpnyExt==350){echo 'selected';}?>>+350</option>
<option data-countryCode="GR" value="30" <?php if($cmpnyExt==376){echo 'selected';}?>>+30</option>
<option data-countryCode="GL" value="299" <?php if($cmpnyExt==299){echo 'selected';}?>>+299</option>
<option data-countryCode="GD" value="1473" <?php if($cmpnyExt==1473){echo 'selected';}?>>+1473</option>
<option data-countryCode="GP" value="590" <?php if($cmpnyExt==590){echo 'selected';}?>>+590</option>
<option data-countryCode="GU" value="671" <?php if($cmpnyExt==671){echo 'selected';}?>>+671</option>
<option data-countryCode="GT" value="502" <?php if($cmpnyExt==502){echo 'selected';}?>>+502</option>
<option data-countryCode="GN" value="224" <?php if($cmpnyExt==224){echo 'selected';}?>>+224</option>
<option data-countryCode="GW" value="245" <?php if($cmpnyExt==245){echo 'selected';}?>>+245</option>
<option data-countryCode="GY" value="592" <?php if($cmpnyExt==592){echo 'selected';}?>>+592</option>
<option data-countryCode="HT" value="509" <?php if($cmpnyExt==376){echo 'selected';}?>>+509</option>
<option data-countryCode="HN" value="504" <?php if($cmpnyExt==504){echo 'selected';}?>>+504</option>
<option data-countryCode="HK" value="852" <?php if($cmpnyExt==852){echo 'selected';}?>>+852</option>
<option data-countryCode="HU" value="36" <?php if($cmpnyExt==36){echo 'selected';}?>>+36</option>
<option data-countryCode="IS" value="354" <?php if($cmpnyExt==354){echo 'selected';}?>>+354</option>
<option data-countryCode="IN" value="91" <?php if($cmpnyExt==91){echo 'selected';}?>>+91</option>
<option data-countryCode="ID" value="62" <?php if($cmpnyExt==62){echo 'selected';}?>>+62</option>
<option data-countryCode="IR" value="98" <?php if($cmpnyExt==98){echo 'selected';}?>>+98</option>
<option data-countryCode="IQ" value="964" <?php if($cmpnyExt==964){echo 'selected';}?>>+964</option>
<option data-countryCode="IE" value="353" <?php if($cmpnyExt==353){echo 'selected';}?>>+353</option>
<option data-countryCode="IL" value="972" <?php if($cmpnyExt==972){echo 'selected';}?>>+972</option>
<option data-countryCode="IT" value="39" <?php if($cmpnyExt==39){echo 'selected';}?>>+39</option>
<option data-countryCode="JM" value="1876" <?php if($cmpnyExt==1876){echo 'selected';}?>>+1876</option>
<option data-countryCode="JP" value="81" <?php if($cmpnyExt==81){echo 'selected';}?>>+81</option>
<option data-countryCode="JO" value="962" <?php if($cmpnyExt==962){echo 'selected';}?>>+962</option>
<option data-countryCode="KZ" value="7" <?php if($cmpnyExt==7){echo 'selected';}?>>+7</option>
<option data-countryCode="KE" value="254" <?php if($cmpnyExt==254){echo 'selected';}?>>+254</option>
<option data-countryCode="KI" value="686" <?php if($cmpnyExt==686){echo 'selected';}?>>+686</option>
<option data-countryCode="KP" value="850" <?php if($cmpnyExt==850){echo 'selected';}?>>+850</option>
<option data-countryCode="KR" value="82" <?php if($cmpnyExt==82){echo 'selected';}?>>+82</option>
<option data-countryCode="KW" value="965" <?php if($cmpnyExt==965){echo 'selected';}?>>+965</option>
<option data-countryCode="KG" value="996" <?php if($cmpnyExt==996){echo 'selected';}?>>+996</option>
<option data-countryCode="LA" value="856"<?php if($cmpnyExt==856){echo 'selected';}?>>+856</option>
<option data-countryCode="LV" value="371"<?php if($cmpnyExt==371){echo 'selected';}?>>+371</option>
<option data-countryCode="LB" value="961"<?php if($cmpnyExt==961){echo 'selected';}?>>+961</option>
<option data-countryCode="LS" value="266"<?php if($cmpnyExt==266){echo 'selected';}?>>+266</option>
<option data-countryCode="LR" value="231"<?php if($cmpnyExt==231){echo 'selected';}?>>+231</option>
<option data-countryCode="LY" value="218"<?php if($cmpnyExt==218){echo 'selected';}?>>+218</option>
<option data-countryCode="LI" value="417"<?php if($cmpnyExt==417){echo 'selected';}?>>+417</option>
<option data-countryCode="LT" value="370"<?php if($cmpnyExt==370){echo 'selected';}?>>+370</option>
<option data-countryCode="LU" value="352"<?php if($cmpnyExt==352){echo 'selected';}?>>+352</option>
<option data-countryCode="MO" value="853"<?php if($cmpnyExt==853){echo 'selected';}?>>+853</option>
<option data-countryCode="MK" value="389"<?php if($cmpnyExt==389){echo 'selected';}?>>+389</option>
<option data-countryCode="MG" value="261"<?php if($cmpnyExt==261){echo 'selected';}?>>+261</option>
<option data-countryCode="MW" value="265"<?php if($cmpnyExt==265){echo 'selected';}?>>+265</option>
<option data-countryCode="MY" value="60"<?php if($cmpnyExt==60){echo 'selected';}?>>+60</option>
<option data-countryCode="MV" value="960"<?php if($cmpnyExt==960){echo 'selected';}?>>+960</option>
<option data-countryCode="ML" value="223"<?php if($cmpnyExt==223){echo 'selected';}?>>+223</option>
<option data-countryCode="MT" value="356"<?php if($cmpnyExt==356){echo 'selected';}?>>+356</option>
<option data-countryCode="MH" value="692"<?php if($cmpnyExt==692){echo 'selected';}?>>+692</option>
<option data-countryCode="MQ" value="596"<?php if($cmpnyExt==596){echo 'selected';}?>>+596</option>
<option data-countryCode="MR" value="222"<?php if($cmpnyExt==222){echo 'selected';}?>>+222</option>
<option data-countryCode="YT" value="269" <?php if($cmpnyExt==269){echo 'selected';}?>>+269</option>
<option data-countryCode="MX" value="52" <?php if($cmpnyExt==52){echo 'selected';}?>>+52</option>
<option data-countryCode="FM" value="691" <?php if($cmpnyExt==691){echo 'selected';}?>>+691</option>
<option data-countryCode="MD" value="373"<?php if($cmpnyExt==373){echo 'selected';}?>>+373</option>
<option data-countryCode="MC" value="377"<?php if($cmpnyExt==377){echo 'selected';}?>>+377</option>
<option data-countryCode="MN" value="976" <?php if($cmpnyExt==976){echo 'selected';}?>>+976</option>
<option data-countryCode="MS" value="1664"<?php if($cmpnyExt==1664){echo 'selected';}?>>+1664</option>
<option data-countryCode="MA" value="212" <?php if($cmpnyExt==212){echo 'selected';}?>>+212</option>
<option data-countryCode="MZ" value="258" <?php if($cmpnyExt==258){echo 'selected';}?>>+258</option>
<option data-countryCode="MN" value="95" <?php if($cmpnyExt==95){echo 'selected';}?>>+95</option>
<option data-countryCode="NA" value="264" <?php if($cmpnyExt==264){echo 'selected';}?>>+264</option>
<option data-countryCode="NR" value="674"<?php if($cmpnyExt==674){echo 'selected';}?>>+674</option>
<option data-countryCode="NP" value="977"<?php if($cmpnyExt==977){echo 'selected';}?>>+977</option>
<option data-countryCode="NL" value="31"<?php if($cmpnyExt==37316){echo 'selected';}?>>+31</option>
<option data-countryCode="NC" value="687"<?php if($cmpnyExt==687){echo 'selected';}?>>+687</option>
<option data-countryCode="NZ" value="64"<?php if($cmpnyExt==64){echo 'selected';}?>>+64</option>
<option data-countryCode="NI" value="505" <?php if($cmpnyExt==505){echo 'selected';}?>>+505</option>
<option data-countryCode="NE" value="227" <?php if($cmpnyExt==227){echo 'selected';}?>>+227</option>
<option data-countryCode="NG" value="234"<?php if($cmpnyExt==234){echo 'selected';}?>>+234</option>
<option data-countryCode="NU" value="683"<?php if($cmpnyExt==683){echo 'selected';}?>>+683</option>
<option data-countryCode="NF" value="672" <?php if($cmpnyExt==672){echo 'selected';}?>>+672</option>
<option data-countryCode="NP" value="670" <?php if($cmpnyExt==670){echo 'selected';}?>>+670</option>
<option data-countryCode="NO" value="47" <?php if($cmpnyExt==47){echo 'selected';}?>>+47</option>
<option data-countryCode="OM" value="968" <?php if($cmpnyExt==968){echo 'selected';}?>>+968</option>
<option data-countryCode="PW" value="680"<?php if($cmpnyExt==680){echo 'selected';}?>>+680</option>
<option data-countryCode="PA" value="507"<?php if($cmpnyExt==507){echo 'selected';}?>>+507</option>
<option data-countryCode="PG" value="675"<?php if($cmpnyExt==675){echo 'selected';}?>>+675</option>
<option data-countryCode="PY" value="595" <?php if($cmpnyExt==595){echo 'selected';}?>>+595</option>
<option data-countryCode="PE" value="51" <?php if($cmpnyExt==51){echo 'selected';}?>>+51</option>
<option data-countryCode="PH" value="63" <?php if($cmpnyExt==63){echo 'selected';}?>>+63</option>
<option data-countryCode="PL" value="48"<?php if($cmpnyExt==48){echo 'selected';}?>>+48</option>
<option data-countryCode="PT" value="351"<?php if($cmpnyExt==376){echo 'selected';}?>>+351</option>
<option data-countryCode="PR" value="1787"<?php if($cmpnyExt==1787){echo 'selected';}?>>+1787</option>
<option data-countryCode="QA" value="974"<?php if($cmpnyExt==974){echo 'selected';}?>>+974</option>
<option data-countryCode="RE" value="262"<?php if($cmpnyExt==262){echo 'selected';}?>>+262</option>
<option data-countryCode="RO" value="40"<?php if($cmpnyExt==40){echo 'selected';}?>>+40</option>
<option data-countryCode="RU" value="7"<?php if($cmpnyExt==7){echo 'selected';}?>>+7</option>
<option data-countryCode="RW" value="250"<?php if($cmpnyExt==250){echo 'selected';}?>>+250</option>
<option data-countryCode="SM" value="378"<?php if($cmpnyExt==378){echo 'selected';}?>>+378</option>
<option data-countryCode="ST" value="239"<?php if($cmpnyExt==239){echo 'selected';}?>>+239</option>
<option data-countryCode="SA" value="966"<?php if($cmpnyExt==966){echo 'selected';}?>>+966</option>
<option data-countryCode="SN" value="221"<?php if($cmpnyExt==221){echo 'selected';}?>>+221</option>
<option data-countryCode="CS" value="381"<?php if($cmpnyExt==381){echo 'selected';}?>>+381</option>
<option data-countryCode="SC" value="248"<?php if($cmpnyExt==248){echo 'selected';}?>>+248</option>
<option data-countryCode="SL" value="232"<?php if($cmpnyExt==232){echo 'selected';}?>>+232</option>
<option data-countryCode="SG" value="65"<?php if($cmpnyExt==65){echo 'selected';}?>>+65</option>
<option data-countryCode="SK" value="421"<?php if($cmpnyExt==421){echo 'selected';}?>>+421</option>
<option data-countryCode="SI" value="386"<?php if($cmpnyExt==386){echo 'selected';}?>>+386</option>
<option data-countryCode="SB" value="677"<?php if($cmpnyExt==677){echo 'selected';}?>>+677</option>
<option data-countryCode="SO" value="252"<?php if($cmpnyExt==252){echo 'selected';}?>>+252</option>
<option data-countryCode="ZA" value="27"<?php if($cmpnyExt==27){echo 'selected';}?>>+27</option>
<option data-countryCode="ES" value="34"<?php if($cmpnyExt==34){echo 'selected';}?>>+34</option>
<option data-countryCode="LK" value="94"<?php if($cmpnyExt==94){echo 'selected';}?>>+94</option>
<option data-countryCode="SH" value="290"<?php if($cmpnyExt==290){echo 'selected';}?>>+290</option>
<option data-countryCode="KN" value="1869"<?php if($cmpnyExt==1869){echo 'selected';}?>>+1869</option>
<option data-countryCode="SC" value="1758"<?php if($cmpnyExt==1758){echo 'selected';}?>>+1758</option>
<option data-countryCode="SD" value="249"<?php if($cmpnyExt==249){echo 'selected';}?>>+249</option>
<option data-countryCode="SR" value="597"<?php if($cmpnyExt==597){echo 'selected';}?>>+597</option>
<option data-countryCode="SZ" value="268"<?php if($cmpnyExt==268){echo 'selected';}?>>+268</option>
<option data-countryCode="SE" value="46" <?php if($cmpnyExt==46){echo 'selected';}?>>+46</option>
<option data-countryCode="CH" value="41"<?php if($cmpnyExt==41){echo 'selected';}?>>+41</option>
<option data-countryCode="SI" value="963"<?php if($cmpnyExt==963){echo 'selected';}?>>+963</option>
<option data-countryCode="TW" value="886"<?php if($cmpnyExt==886){echo 'selected';}?>>+886</option>

<option data-countryCode="TH" value="66"<?php if($cmpnyExt==66){echo 'selected';}?>>+66</option>
<option data-countryCode="TG" value="228"<?php if($cmpnyExt==228){echo 'selected';}?>>+228</option>
<option data-countryCode="TO" value="676"<?php if($cmpnyExt==676){echo 'selected';}?>>+676</option>
<option data-countryCode="TT" value="1868"<?php if($cmpnyExt==1868){echo 'selected';}?>>+1868</option>
<option data-countryCode="TN" value="216"<?php if($cmpnyExt==216){echo 'selected';}?>>+216</option>
<option data-countryCode="TR" value="90"<?php if($cmpnyExt==90){echo 'selected';}?>>+90</option>
<option data-countryCode="TM" value="7"<?php if($cmpnyExt==7001){echo 'selected';}?>>+7</option>
<option data-countryCode="TM" value="993"<?php if($cmpnyExt==993){echo 'selected';}?>>+993</option>
<option data-countryCode="TC" value="1649"<?php if($cmpnyExt==1649){echo 'selected';}?>>+1649</option>
<option data-countryCode="TV" value="688"<?php if($cmpnyExt==688){echo 'selected';}?>>+688</option>
<option data-countryCode="UG" value="256"<?php if($cmpnyExt==256){echo 'selected';}?>>+256</option>
<option data-countryCode="GB" value="44">UK (+44)</option> 
<option data-countryCode="UA" value="380"<?php if($cmpnyExt==380){echo 'selected';}?>>+380</option>
<option data-countryCode="AE" value="971"<?php if($cmpnyExt==971){echo 'selected';}?>>+971</option>
<option data-countryCode="UY" value="598"<?php if($cmpnyExt==598){echo 'selected';}?>>+598</option>
<option data-countryCode="US" value="1">USA (+1)</option> 
<option data-countryCode="VU" value="678"<?php if($cmpnyExt==678){echo 'selected';}?>>+678</option>
<option data-countryCode="VA" value="379"<?php if($cmpnyExt==379){echo 'selected';}?>>+379</option>
<option data-countryCode="VE" value="58"<?php if($cmpnyExt==58){echo 'selected';}?>>+58</option>
<option data-countryCode="VN" value="84"<?php if($cmpnyExt==84){echo 'selected';}?>>+84</option>
<option data-countryCode="VG" value="804"<?php if($cmpnyExt==804){echo 'selected';}?>>+1284</option>
<option data-countryCode="VI" value="8014" <?php if($cmpnyExt==8014){echo 'selected';}?>>+1340</option>
<option data-countryCode="WF" value="681" <?php if($cmpnyExt==681){echo 'selected';}?>>+681</option>
<option data-countryCode="YE" value="969" <?php if($cmpnyExt==969){echo 'selected';}?>>+969</option>
<option data-countryCode="YE" value="967"<?php if($cmpnyExt==967){echo 'selected';}?>>+967</option>
<option data-countryCode="ZM" value="260"<?php if($cmpnyExt==260){echo 'selected';}?>>+260</option>
<option data-countryCode="ZW" value="263"<?php if($cmpnyExt==263){echo 'selected';}?>>+263</option>
</optgroup>
</select> -->
</div>

<!-- <div class="form-group">
<label for="update_mobile" class="control-label">Enter New Phone Number <span class="red">* </span></label>
<input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" id="update_mobile" name="update_mobile" value="<?php echo $phone_no1;?> " <?php if($isPhoneVerify==1){echo 'disabled';} ?>>
<span id="err_phone" class="red"></span>
<?php if($isPhoneVerify==1){ ?>
<span style="color:red;">Your mobile number is already verified please contact sharepage to change it .</span>
<?php } ?>
</div> -->
</div>
</div>


<div class="row" id="enter_otp" style="display:none;">
<div class="col-md-8">
<div class="form-group">
<label for="otp" class="control-label">Enter OTP<span class="red">* </span></label>
<input type="text" class="form-control" id="otp" name="otp" value="">
</div>
</div>
<div class="col-md-2" style="padding-top:18px">
<div class="form-group">
<button type="button" id="re_send_otp" class="btn btn-submit db_btn db_primarybtn">Re-Send OTP</button>
</div>
</div>
</div>
</div>

<div class="modal-footer bg-white br_radius_bottom">
<div class="col-md-2"></div>
<div class="col-md-9">
<!--<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>-->
<span id="sendotp">
<button type="button" id="up_mobile_btn_otp" class="btn btn-submit db_btn db_primarybtn" disabled="disabled">Validate and Update</button>
</span>
<span id="change_number" >
<?php if($isPhoneVerify ==1){?>
<button type="button" id="verifynumber" class="btn btn-submit db_btn db_primarybtn" onclick="verifynumber();">Update Number</button>
<?php } else{?>
<button type="button" id="verifynumber" class="btn btn-submit db_btn db_primarybtn" onclick="verifynumber();">verify Phone Number</button>
<?php } ?>
</span>
</div>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Reason by admin</h5>
<button type="button" class="close" style="margin-top:-25px;" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<p><?php echo $row['remark']; ?></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>

<!--chage password modal complete col-md-1  col-md-10 -->
<!--Pop-up Box for contact form-->

<div class="modal fade" id="contactus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<span class="modal-title" id="exampleModalLabel">Enquiry Form</span>
</div>

<div class="modal-body">
<form action="../membership/addenquiry.php" method="post" class="profileform">

<input type="hidden" class="form-control" name="spuser_idspUser" value="<?php echo $_SESSION["uid"]; ?>">

<div class="row">
<div class="col-md-6 form-group">
<label for="spenquiryCompanyName" class="control-label contact">Company Name</label>
<input type="text" class="form-control inptradius" id="spenquiryCompanyName" name="spenquiryCompanyName">
</div>

<div class="col-md-6 form-group">
<label for="spenquiryCompanySize" class="control-label contact">Company Size</label>
<input type="text" class="form-control inptradius" id="spenquiryCompanySize" name="spenquiryCompanySize">
</div>
</div>
<div class="row">
<div class="col-md-6 form-group">
<label for="spenquiryFirstName" class="control-label contact">First Name</label>
<input type="text" class="form-control inptradius" id="spenquiryFirstName" name="spenquiryFirstName">
</div>

<div class="col-md-6 form-group">
<label for="spenquiryLastName" class="control-label contact">Last Name</label>
<input type="text" class="form-control inptradius" id="spenquiryLastName" name="spenquiryLastName">
</div>
</div>
<div class="row">
<div class="col-md-6 form-group">
<label for="spenquiryCity" class="control-label contact">City</label>
<input type="text" class="form-control inptradius" id="spenquiryCity" name="spenquiryCity">
</div>

<div class="col-md-6 form-group">
<label for="spenquiryTel" class="control-label contact">Tel</label>
<input type="text" class="form-control inptradius" id="spenquiryTel" name="spenquiryTel">
</div>
</div>
<div class="form-group">
<label for="spenquiryEmail" class="control-label contact">Email</label>
<input type="email" class="form-control inptradius" id="spenquiryEmail" name="spenquiryEmail">
</div>

<div class="form-group">
<label for="spenquiryAddress" class="control-label contact">Address</label>
<textarea class="form-control " rows="3" id="spenquiryAddress" name="spenquiryAddress"></textarea>
</div>

<div class="form-group">
<label for="spenquiryMessage" class="control-label contact">Message</label>
<textarea class="form-control " rows="5" id="spenquiryMessage" name="spenquiryMessage"></textarea>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Send</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- INVITE A FRIENDS -->
<div class="modal fade" id="inviteFriend" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form action="<?php echo $BaseUrl . '/my-profile/invitefriend.php'; ?>" method="post" class="" id="form_submit">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Invite Friends</b></h3>
</div>

<div class="modal-body">
<div class="form-group">
<label for="yourName" class="control-label contact">Your Name <span class="red">*</span></label>
<input type="text" class="form-control" id="yourName" value="<?php echo $_SESSION['MyProfileName']; ?>" readonly />
</div>

<div class="form-group">
<label for="sendTo" class="control-label contact">Send To <span style="font-size: 12px; color: red;">Add multiple emails by separating with Semicolon2 ;</span> <span class="red">*</span></label>
<textarea class="form-control" id="if_email" name="if_email" placeholder="" required=""></textarea>
</div>
<?php
$p = new _spprofiles;

$d = $p->inviteFrd_description(4);
if ($d) {
$ro = mysqli_fetch_array($d);
$notification_description = $ro['notification_description'];
//$subject = $ro['subject'];
}
?>
<div class="form-group">
<label for="txtmessage" class="control-label contact">Message <span class="red">*</span></label>
<textarea class="form-control" rows="7" id="if_message" name="if_message" required="">  <?php echo $notification_description ?>
   Thank you</textarea>
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<!--<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>-->
<button type="button" onclick="validateEmail()" class="btn btn-submit db_btn db_primarybtn"><i class="fa fa-user"></i> Invite Friends</button>
</div>
</form>
</div>
</div>
</div>
<script>
function validateEmail() {
var emailField = $('#if_email').val();
//alert(emailField)

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.;])+\.([A-Za-z]{2,4})$/;


/*if (reg.test(emailField.value) == false) 
{
alert('Invalid Email Address');
//return false;
}
else{
$('#form_submit').submit();

}*/
$('#form_submit').submit();
}
</script>
<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>My Settings</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Settings</li>
</ol>
</section>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>

<div class="content">

<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">								
<div class="container-fluid">
<form method="post">
<div class="row">
<h4>Verification</h4>												
<?php
$acccc = new _spuser;
$ac = $acccc->account_verification($_SESSION['uid']);
if ($ac != false) {
$acc = mysqli_fetch_assoc($ac);
if ($acc['is_email_verify'] && $acc['is_phone_verify']) {
?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#useraccountid"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Account Verification</a><span style="color:#00FA9A;">&nbsp;&nbsp;(Verified)</span></p>
</div>
</div>
<?php } else { ?>

<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#useraccountid"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Account Verification</a><span style="color:#ffc107;">&nbsp;&nbsp;(Pending)</span></p>
</div>
</div>

<?php 	}
} ?>

<?php

$con = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);

if (!$con) {
die('Not Connected To Server');
}
if (!$con) {
echo 'Database Not Selected';
}

$uid_img = $_SESSION["uid"];

$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";

if ($result = $con->query($selectimage)) {
$row = mysqli_fetch_assoc($result);

}

if ($row['status'] == "") {
?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Identity Verification</a><span style="color:red">&nbsp;&nbsp;(Not Verified)</span></p>
</div>
</div>
<?php
} else if ($row['status'] == 0) {
?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Identity Verification</a><span style="color:orange">&nbsp;&nbsp;(Pending)</span></p>
</div>
</div>
<?php } else if ($row['status'] == 1) { ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Identity Verification</a><span style="color:#00FA9A">&nbsp;&nbsp;(Approved)</span></p>
</div>
</div>
<?php } else { ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;User Identity Verification</a><span style="color:red">&nbsp;&nbsp;(Rejected)</span></p>
</div>
</div>
<?php } ?>

<?php $sp_pid = $_SESSION['pid'];
$sp_uid = $_SESSION['uid'];

$sprecord = "select * from spbuiseness_files where sp_pid='$sp_pid' and sp_uid='$sp_uid' order by id desc limit 1 ";
//echo $sprecord ;
$allrecord = mysqli_query($dbConn, $sprecord);
$spresult = mysqli_fetch_array($allrecord);
$userstatus = $spresult['status'];

$reject_reason = $spresult['reject_reason'];
?>

<?php if ($userstatus == 1) { ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#business"><i class="fa fa-cog"></i> &nbsp;&nbsp;Business Account Verification</a><span style="color:orange">&nbsp;&nbsp;(Pending)</span></p>
</div>
</div>
<?php } else if ($userstatus == 2) {  ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#business"><i class="fa fa-cog"></i> &nbsp;&nbsp;Business Account Verification</a><span style="color:#00FA9A">&nbsp;&nbsp;(Accepted)</span></p>
</div>
</div>
<?php } else if($userstatus == 3){ ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#business"><i class="fa fa-cog"></i> &nbsp;&nbsp;Business Account Verification</a>&nbsp;&nbsp;(<span style="color:red">Rejected</span>)</p>
</div>
</div>
<?php }else{ ?>
<div class="col-md-4">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#business"><i class="fa fa-cog"></i> &nbsp;&nbsp;Business Account Verification</a>&nbsp;&nbsp;(<span style="color:red">Not Verified</span>)</p>
</div>
</div>

<?php } ?>
</div>

<div class="row ">											
<h4>Address</h4>
<div class="col-md-12">
<div class="p-box">
<p> <a id="handle-user-address" href="<?php echo $BaseUrl . '/dashboard/settings/myAddress.php'; ?>"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;My Address</a></p>
</div>
</div>											
</div>
<div class="row">											
<h4>Security</h4>
<div class="col-md-3">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#chagePassword"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Change Password</a></p>
</div>
</div>
<div class="col-md-3">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#myModal"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Time Zone</a></p>
</div>
</div>
<div class="col-md-3">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#changemobile"><i class="fa fa-phone"></i>&nbsp;&nbsp;Change Phone</a></p>
</div>
</div>
<div class="col-md-3">
<div class="p-box">
<p> <a data-toggle="modal" class="pointer" data-target="#inviteFriend"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Invite Friends</a></p>
</div>
</div>
<!-- <div class="col-md-3">
<div class="p-box">
<p><a href="<?php echo $BaseUrl . '/my-profile/my-account.php'; ?>"><i class='fas fa-wallet'></i>&nbsp;&nbsp;&nbsp;My Account</a></p>
</div>
</div> -->
<div class="col-md-3">
<div class="p-box">
<p><a data-toggle="modal" data-target="#shipadd"><a href="<?php echo $BaseUrl . '/my-profile/add-shipping.php'; ?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;Add Shipping Address</a>
</a></p>
</div>
</div>
<div class="col-md-3">
<div class="p-box">
<p><a data-toggle="modal" data-target="#shipadd"><a href="<?php echo $BaseUrl . '/dashboard/currency/'; ?>"><i class="fa fa-money"></i>&nbsp;&nbsp;My Currency</a>
</a></p>
</div>
</div>
<div class="col-md-3">
<div class="p-box">
<p><a class="disable-btn pointer" data-work="delete" onclick="deactivate()"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;Deactivate Account</a>
</p>
</div>
</div>											
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div> <?php } ?>
</div>
</div>
</div>
</div>
<!-----form start-->
<?php
$sp = new _spuser;

//  print_r($_SESSION);
$uid = $_SESSION['uid'];
$data = $sp->readEmail($uid);
// die('=========');
if ($data) {
$row = mysqli_fetch_assoc($data);
// print_r ($row);
// echo $row['spUserEmail'];
// die('========');

}

// echo $uid;
//die('cccccccccc');

?>

<!-- Modal -->
<div class="modal fade" id="myModalName" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Email</h4>
</div>
<div class="modal-body">

<form action="updateEmail.php" method="POST">

<div class="form-group col-md-9">
<label for="exampleInputEmail">Email address</label>
<input type="email" value="<?php echo $row['spUserEmail']; ?>" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter email">
</div>
<div class="from-group">
<button type="submit" class="btn btn-primary" style="margin-top:20px; width:120px;margin-left: 10px;">Update</button>
</div>

</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
<!----- form close-->





</section>

<div class="modal fade" id="chagePassword" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form action="<?php echo $BaseUrl ?>/authentication/change.php" method="post" class="">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Change Password</b></h3>
</div>

<div class="modal-body">
<div class="form-group">
<label for="oldpassword" class="control-label contact">Old Password <span class="red" id="oldpwd">*</span></label>
<input type="password" class="form-control" id="oldpassword" name="oldpassword_">
</div>

<div class="form-group">
<label for="newpassword" class="control-label contact">New Password <span class="red" id="npass">*</span></label>
<input type="password" class="form-control" id="newpassword" name="spUserPassword" pattern="^(?=.{6,15})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$" title="Must contain at least one number and one uppercase and lowercase letter,one special symbol, and at least 6 or more 15 characters" required>
</div>

<div class="form-group">
<label for="typenewpassword" class="control-label contact">Confirm New Password <span class="red" id="cnpass">*</span></label>
<input type="password" class="form-control" id="typenewpassword" name="spUserPassword_">
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button type="submit" id="changepassword" class="btn btn-submit db_btn db_primarybtn">Change</button>
</div>
</form>
</div>
</div>
</div>
<!--use of business account verification-->
<?php
$sp_pid = $_SESSION['pid'];
$sp_uid = $_SESSION['uid'];
$sprecord = "select*from spbuiseness_files where sp_pid='$sp_pid' and sp_uid='$sp_uid' order by id desc limit 1 ";
$allrecord = mysqli_query($dbConn, $sprecord);
$spresult = mysqli_fetch_array($allrecord);
$businesname = $spresult['Business_Name'];
$spaddr = $spresult['Address'];
$spwebname = $spresult['bswebsite'];
$licenspic = $spresult['Profiles'];
$billpic = $spresult['upload_bills'];
$select_country = $spresult['Country'];
$select_state = $spresult['State'];
$select_city = $spresult['City'];
$userstatus = $spresult['status'];
$reject_reason = $spresult['reject_reason'];

$countscmd = "SELECT * FROM spbuiseness_files where sp_uid='$sp_uid'";
$spusercmd = mysqli_query($dbConn, $countscmd);
$counts = mysqli_num_rows($spusercmd);
$numcounts = $counts + 1;

if (isset($_POST["btns"])) {

//$spdelete="delete from spbuiseness_files where sp_pid=$sp_pid  and sp_uid=$sp_uid";
// $deletes=mysqli_query($dbConn,$spdelete);
$businame_name = $_POST['Business_Name'];
$address = $_POST['spaddress'];
$country = $_POST['Country'];
$state = $_POST['spUserState'];
$city = $_POST['spUserCity'];
$image = new Image;
$image->validateFileImageExtensions($_FILES['Profiles']);
 
$image->validateFileImageExtensions($_FILES['upload_bills']);

$profiles = $_FILES['Profiles']['name'];
if ($profiles == "") {
$profiles = $licenspic;
}
$profiles2 = $_FILES['Profiles']['tmp_name'];
$spdir = "profile_pic/" . $profiles;
move_uploaded_file($profiles2, $spdir);

$upload_bills = $_FILES['upload_bills']['name'];
if ($upload_bills == "") {
$upload_bills = $billpic;
}
$upload_bills2 = $_FILES['upload_bills']['tmp_name'];
$billdr = "profile_pic/" . $upload_bills;
move_uploaded_file($upload_bills2, $billdr);
$bswebsite = $_POST['bswebsite'];
$spcmd = "insert into spbuiseness_files(sp_pid,sp_uid,Business_Name,Address,Country,State,City,Profiles,upload_bills,bswebsite,counts) values('$sp_pid','$sp_uid','$businame_name','$address','$country','$state','$city','$profiles','$upload_bills','$bswebsite','$numcounts')";

$inserts = mysqli_query($dbConn, $spcmd);  ?>
<script>
location.replace("index.php")
</script>

<?php }
?>

<div class="modal" tabindex="-1" role="dialog" id="business">
<div class="modal-dialog" role="document">

<form action="" method="post" id="businessPr" enctype=multipart/form-data>

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" style="text-align:center;">Business profile verification</h4>
<h5 class="modal-title" style="text-align:center;">Submit the documents requested to verify your business</h5>
<button type="button" class="close" style="margin-top:-55px;" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Business Name<span class="red" id="err_businessN">*</span></label>
<input type="text" class="form-control" name="Business_Name" id="Business_Name" value="<?php echo $businesname; ?>">
<br>
<label>Address<span class="red" id="err_address">*</span></label>
<input type="text" class="form-control" name="spaddress" id="spaddress" value="<?php echo $spaddr; ?>">
<div class="row">
<br>
<div class="col-md-4">
<div class="form-group">
   
<label for="spPostCountry_" class="lbl_2">Country<span class="red">*</span></label>
<select class="form-control " name="Country" id="spUserCountry">
<option value="">Select Country </option>
<?php

$country = $select_country;
$state = $select_state;
$city = $select_city;
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {

//	echo $usercountry; die; 
?>

<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($country) && $country == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
<span class="red" id="err_country"></span>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>

<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" style="float:left; color: white;" class="lbl_3">State</label>
<select class="form-control spPostingsState" id="spUserState" name="spUserState">
<option>Select State</option>
<?php

if (isset($country) && $country > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($country);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($state) && $state == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
<span class="red" id="err_state"></span>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" style="float: left;color: white;" class="">City</label>
<select class="form-control" id="spUserCity" name="spUserCity">
<option>Select City</option>
<?php
// $stateId = $userstate;

$co = new _city;
$result3 = "";
if($state) {
    $result3 = $co->readCity($state);
}
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($city) && $city == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
} ?>
</select>
<span class="red" id="err_city"></span>
<!--													  <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
?>">   -->
</div>
</div>


</div>
</div>



<label>Business License<span class="red" id="err_businessL">*</span></label>
<input type="file" class="custom-file-input" style="display:block;" id="Profiles" name="Profiles">

<?php if ($licenspic == "") {

?><img src="profile_pic/no_image.jpg" style="height:200px;width:200px;" id="license"> <?php } else { ?><img src="profile_pic/<?php echo $licenspic;  ?>" style="height:200px;width:200px;" id="license"><?php } ?><br><br>

<label>Upload any bills addressed to the business Location<span class="red" id="err_bills">*</span></label>
<input type="file" class="custom-file-input" style="display:block;" id="upload_bills" name="upload_bills"> <?php if ($billpic == "") {

?><img src="profile_pic/no_image.jpg" style="height:200px;width:200px;" id="img_bills"> <?php } else { ?><img src="profile_pic/<?php echo $billpic;  ?>" style="height:200px;width:200px;" id="img_bills"><?php } ?><br></br>
<label>Business Website<span class="red" id="err_website">*</span></label>
<input type="text" class="form-control" name="bswebsite" id="bswebsite" value="<?php echo $spwebname; ?>"></br>
<?php
if ($userstatus == 1) {
?>
<label>Status : <span style="color:red">Pending</span></label>
<?php }
if ($userstatus == 2) {
?>
<label>Status : <span style="color:green">Accepted</span></label>
<?php
}
if ($userstatus == 3) {
?>
<label>Comments&nbsp;:<?php echo $reject_reason; ?></label>
<?php
?>
<label>Status :<span style="color:red"> Rejected</span></label>
<?php
}
?>

<br>


</div>
<div class="modal-footer">

<button <?php if ($userstatus == 1 || $userstatus == 2) {
echo "disabled";
} ?> type="submit" class="btn btn-primary" id="btnsubmit_b" name="btns">submit</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
<!--User Account Verification modal-->
<div class="modal" tabindex="-1" role="dialog" id="useraccountid">
<div class="modal-dialog" role="document">
<div class="modal-content ">
<div class="modal-header">
<h5 class="modal-title">Account Verification</h5>
<button type="button" class="close" style="margin-top:-30px;" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row">

<?php
$u = new _spuser;
$result2 = $u->isEmailVerify($_SESSION['uid']);

if ($result2) {
?>


<div class="col-md-6">
<div class="form-group">
<label for="spUserEmail" class="control-label">Email <span class="red">*</span>


</label>
<input type="email" class="form-control" id="spUserEmail" name="spUserEmail" value="<?php echo $useremail; ?>">
<p style="color: #2ba805;">Verified</p>
</div>
<p><a type="button" onclick="fun_close()" class="" data-toggle="modal" data-target="#myModalName"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Update Email</a></p>
</div>


<?php
} else {
?>

<div class="col-md-6">
<div class="form-group">
<label for="spUserEmail" class="control-label">Email <span class="red">*
<!-- <a href="" title="" class="red" style="text-decoration: underline;"> ( Verify Now ) </a> -->
</span>

</label>
<input type="email" class="form-control" id="spUserEmail" name="spUserEmail" value="<?php echo $useremail; ?>">
<p class="red"> Not Verified .</p>
</div>
</div>

<?php
} ?>
<?php
$u = new _spuser;
$result2 = $u->isPhoneVerify($_SESSION['uid']);

if ($result2) {
?>

<div class="col-md-6">
<div class="form-group">
<label for="spUserPhone" class="control-label">Phone <span class="red">* </span>  </label>
<input type="text" class="form-control" id="spUserPhone" maxlength="10" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" name="spUserPhone" value="<?php echo $userpnone; ?>" >
<?php //echo ($isPhoneVerify == 1) ? 'disabled' : ''; ?>  
<p style="color: #2ba805; padding-top: 10px;">Verified.</p>
</div>
</div>

<?php
} else {
?>

<div class="col-md-6">
<div class="form-group">
<label for="spUserPhone" class="control-label">Phone <span class="red">* 
<a href="" title="" class="red" style="text-decoration: underline;"> ( Verify Now ) </a> </span></label>


<input type="text" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone; ?>" readonly>
<?php //echo ($isPhoneVerify == 1) ? 'disabled' : ''; ?>  
<p class="red" style="padding-top: 10px;"> Not Verified .</p>
</div>
</div>

<?php
}
?>



<?php  if($isPhoneVerify == 0) {?>
<div class="col-md-6">

<div class="notificatontop">



<p class="no-margin">
<i class="fa fa-info-circle"></i> Your mobile number is not verified. <span style="margin-left: 20px;">Kindly verifiy your mobile number.</span><br>
<br>
<a href="#" data-toggle="modal" data-target="#mynumberVerify" id="vrify" data-dismiss="modal" aria-label="Close" onclick="abc()">Verify Now</a>
&nbsp;&nbsp;&nbsp;
<a data-toggle="modal" id="pointer" class="pointer" data-target="#changemobile">Change Phone</a>
<!--<br>
<a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=sms&code=<?php echo $_SESSION['uid']; ?>"> Verify Your Mobile Phone </a>-->

<?php
if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
?><span class="pull-right"><?php echo $_SESSION['msg']; ?></span> <?php
$_SESSION['count'] = 2;
unset($_SESSION['msg']);
}
?>
</p>
</div>

</div>
<?php } ?>
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
</div>
</div>
</div>
</div>

<!--User Details Setting  Modal-->
<div class="modal fade" id="userdetails" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">





<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form id="uploadidentityfrm" enctype="multipart/form-data" method="post" action="uploadidentity.php">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

<input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"]; ?>">



<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0px;"><span aria-hidden="true">&times;</span></button>


<h3 class="modal-title" id="changeModalLabel" style="text-align: center; font-size: 20px!important;">User Identity Verification </h3>
</div>



<!-- <div class="modal-body" style="background-color:white;">

<input type="hidden" name="idspUser" value="<?php //echo $_SESSION["uid"];
?>">


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserEmail" class="control-label">Email <span class="red">*</span></label>
<input type="email" class="form-control" id="spUserEmail" 
name="spUserEmail" value="<?php //echo $useremail;
?>" disabled>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spUserPhone" class="control-label">Phone <span class="red">*</span></label>
<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php //echo $userpnone;
?>"<?php //echo ($isPhoneVerify == 1)?'disabled':'';
?> >
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">

<div class="form-group">
<label for="spProfilesCountry">Address</label>

<input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php //echo $address;
?>"  >

<datalist id="suggested_address"></datalist>

<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">
</div>
</div>

</div>


</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-submit db_btn db_primarybtn">Save</button>
</div>
</form> -->

<div class="modal-body">










<?php

$con = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
//echo DBNAME;


if (!$con) {
die('Not Connected To Server');
}

//Connection to database
if (!$con) {
echo 'Database Not Selected';
}

$uid_img = $_SESSION["uid"];
//echo $uid;
$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";

if ($result = $con->query($selectimage)) {

// print_r($result);
//$row = $result -> fetch_row(); 

$row = mysqli_fetch_assoc($result);


//	 print_r($row);

$timestamp = strtotime($row['created_on']);
}


?>

<div class="form-group">
<span><b>STEP 1:</b> &nbsp;<span><label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload Passport or Driver's Licence)</span></label>
<?php if (!empty($row['uid'])) { ?>
<input type="hidden" name="isupdate" value="1">
<input type="hidden" name="up_id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="idimage" value="<?php echo $row['idimage']; ?>">
<?php } ?>

<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity" <?php if ($row['idimage'] == "") {
echo "required";
} ?> />
<?php   //echo $row['idimage'];
//echo '====';
if ($row['idimage']) {
?>
<img id="preview_img" src="<?php echo $BaseUrl; ?>/upload/user/user_id/<?php echo $row['idimage']; ?>" height=150px width=150px <?php if (!empty($row['uid'])) {
echo "disabled";
} ?> style="margin-top: 25px;" />
</br></br>
<?php
} else {
?>
<img src="<?php echo $BaseUrl; ?>/img/no.png" height=150px width=150px style="margin-top: 25px;" id="preview_img"/>
</br></br>
<?php  } ?>
<span><b>STEP 2: </b>&nbsp;</span><label>Upload a Selfie with your ID</label>
<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity1" id="uploadidentity1" <?php if ($row['upload_spfile'] == "") {
echo "required";
} ?> />

<p style="font-size:15px;font-weight:500;font-family:system-ui;padding:7px 12px 0px 15px;"><span style="color:red;">*</span>Write your full name and today's date with your signature on a white paper, hold it in with your ID and take a selfie and upload it here.</p>
 

<?php

if ($row['upload_spfile']) {    
?>
<img id="preview_img1" src="<?php echo $BaseUrl; ?>/upload/user/user_id/<?php echo $row['upload_spfile']; ?>" height=150px width=150px <?php if (!empty($row['uid'])) {
echo "disabled";
} ?> style="margin-top: 25px;" />
<?php } else { ?>
<img id="preview_img1" src="<?php echo $BaseUrl; ?>/img/no.png" height=150px width=150px <?php if (!empty($row['uid'])) {
echo "disabled";
} ?> style="margin-top: 25px;" />
<?php } ?>
<?php if ($row['status'] == 0) { ?>
<h5 style="position: absolute!important;
bottom: 80px!important;
left: 195px!important;">Waiting for Approval.</h5>

<?php } else if ($row['status'] == 1) { ?>
<h5 style="position: absolute!important;
bottom: 80px!important;
left: 195px!important;">Approved</h5>

<?php } else { ?>
<div style="position: absolute!important;bottom: 50px!important;color: #000;margin-right: 4px;width: 250px;
    right: 30px;    padding: 20px;border: 1px solid;">
<h5 >The documents you submitted on <?php if($timestamp != ''){ echo date('d/m/Y', $timestamp); } ?> were rejected. Please resubmit your documents.</h5>
<a href="javascript:void(0);" title="" id="reason" style="text-decoration-line: underline!important;
">View Reason</a>
</div>



<?php }


?>

<!-- <?php print_r($row['remark']);
echo "<br>"; ?> 
<?php print_r($row['status']); ?> 
-->
<!--  <h5 style="position: absolute!important;
bottom: 80px!important;
left: 195px!important;">Uploaded Document (Unverified)<a href="" title="">View Reason</a></h5> -->

<h5 style="position: absolute!important;
bottom: -5px!important;
left: 16px!important;">Date of Upload : <?php 
if($timestamp != ''){
echo date('d/m/Y', $timestamp); 
}?></h5>




</div>












</div>





<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>



<button  type="submit" id="subuploadids" class="btn btn-submit db_btn db_primarybtn"> <?php if ($row['status'] == 2) {
echo "Re-Submit for Approval";
}else{
   echo "Submit for Approval";
} ?></button>





</div>
</form>


</div>
</div>
</div>
<?php
if (isset($_POST['timebtn'])) {

$time = $_POST['timezone_offset'];
$_SESSION['times'] = $time;
$updatecom = "update spuser set time_zone='$time' where idspUser='385'";

$cmd2 = mysqli_query($dbConn, $updatecom);
//echo ("<script>alert('Time zone updated successfully')</script>");
?>
<script>
swal({
title: "Time zone updated successfully",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "ok",
//cancelButtonClass: "sweet_cancel",
//cancelButtonText: "Cancel",
//showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
//window.location.href = 'processRegUser.php?action=delete&userId=' + userId;
}
});
</script>
<?php

}
?>

<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>



</body>

</html>
<?php
} ?>

<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION["uid"]; ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<script src=' https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

<script type="text/javascript" src="https://dev.thesharepage.com/assets/js/intlTelInput-jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
</body>

</html>
<script>
$(function() {
$("#country").change(function() {
let countryCode = $(this).find('option:selected').data('country-code');
let value = "+" + $(this).val();
$('#txtPhone').val(value).intlTelInput("setCountry", countryCode);
});

var code = $('#hidden_phone').val();
$('#txtPhone').val('').intlTelInput();
});
</script>



<script>

function deactivate(id){

swal({
title: "Do you want to Deactivate this account?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactivate!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
}, function (isConfirm) {
if (isConfirm) {
window.location.href = 'deactivate_account.php';   
}
});
}
</script>




<!-- 

<script>
function deactivate() {
//alert('====');
swal({
title: "Do you want to Deactivate this account?",

type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactivate!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'deactivate_account.php';
}
});

} -->


<script>

/*
$(".disable-btn").click(function(){
alert('===');

});
$(document).ready(function(){

$(document).on("click",".disable-btn",function() {
alert('======');
//var dataId = $(this).attr("data-id");

//var work = $(this).attr("data-work");
//alert(work);
//if(work=='delete'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
/* type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'deactivate_account.php';
} 
});


}
} */
//<?php echo $BaseUrl . '/dashboard/settings/deactivate_account.php'; ?>


function abc(){

$.ajax({
url: "<?php echo $BaseUrl . '/phone_sms/send_setting_sms.php'; ?>",
type: "POST",
data: {},
success: function(html){


}
});
}



</script>
<script>
$("#pointer").click(function() {
$("#btn_close").click();
});
</script>
<script>
$("#btnsubmit_b").click(function() {
    var Business_Name = $("#Business_Name").val();
    var spaddress = $("#spaddress").val();
    var spUserCountry = $("#spUserCountry").val();
    var spUserState = $("#spUserState").val();
    var spUserCity = $("#spUserCity").val();
    var Profiles = $("#Profiles")[0].files[0];
    var upload_bills = $("#upload_bills")[0].files[0];
    var bswebsite = $("#bswebsite").val();

    // Reset error messages
    $(".error").text("");

    // Check for empty fields
    if (
        Business_Name == "" ||
        spaddress == "" ||
        spUserCountry == "" ||
        spUserState == "" ||
        spUserCity == "" ||
        Profiles == undefined ||
        upload_bills == undefined ||
        bswebsite == ""
    ) {
        // Display error messages for empty fields
        if (Business_Name == "") {
            $("#err_businessN").text("This is a required field.");
        }
        if (spaddress == "") {
            $("#err_address").text("This is a required field.");
        }
        if (spUserCountry == "") {
            $("#err_country").text("This is a required field.");
        }
        if (spUserState == "") {
            $("#err_state").text("This is a required field.");
        }
        if (spUserCity == "") {
            $("#err_city").text("This is a required field.");
        }
        if (Profiles == undefined) {
            $("#err_profiles").text("Please select an image file for Profiles.");
        }
        if (upload_bills == undefined) {
            $("#err_bills").text("Please select an image file for upload bills.");
        }
        if (bswebsite == "") {
            $("#err_website").text("This is a required field.");
        }
        return false;
    } else {
        // Check if the selected files are images
        var validImageTypes = ["image/jpeg", "image/png", "image/gif",'image/jpg','image/tif', 'image/tiff', 'image/bmp', 'image/svg', 'image/webp', 'image/heic', 'image/heif'];
        if ($.inArray(Profiles.type, validImageTypes) === -1) {
            $("#err_businessL").text("Please select a valid image file for Profiles.");
            return false;
        }
        if ($.inArray(upload_bills.type, validImageTypes) === -1) {
            $("#err_bills").text("Please select a valid image file for upload bills.");
            return false;
        }
        // If all checks pass, submit the form
        $("#businessPr").submit();
        
        // Additional check after submission for non-image files
        $("#businessPr").on('submit', function(e) {
            if ($.inArray(Profiles.type, validImageTypes) === -1 || $.inArray(upload_bills.type, validImageTypes) === -1) {
                e.preventDefault(); // Prevent form submission
                alert("Please select valid image files.");
                return false;
            }
        });
    }
});
</script>





<script>
$(document).ready(function() {
$('#twostep').click(function() {

var userid = $("#userid").val();
/*alert();*/
if ($(this).is(':checked')) {

var twostep = 1;

} else {

var twostep = 0;

}

$.ajax({
type: "POST",
url: "updatetwostep.php",
cache: false,
data: {
'userid': userid,
'twostep': twostep
},
success: function(data) {



}
});

});
});
</script>

<script>
$(".change_mobile").click(function() {
$("#userdetails").modal('hide');
$('#changemobile').modal('show');
});

$("#reason").click(function() {
$("#userdetails").modal('hide');
$('#exampleModal').modal('show');
});





</script>



<script>
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
$('#bluh').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}



$(".showimg").change(function() {
//alert(".showimg");
readURL(this);
console.log(this);
});
</script>

<script type="text/javascript">
function getaddress() {

var address = $("#address").val();

$.ajax({
type: "POST",
url: "../address.php",
cache: false,
data: {
'address': address
},
success: function(data) {

var obj = JSON.parse(data);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);

}
});
}

$(".op_address").on("click", function() {

var addre = $(this).val();

$("#address").val(addre);

});



/*$("form#uploadidentityfrm").submit(function(e) {*/
//e.preventDefault();
// var formData = new FormData(this);   
//var formData = $('#uploadidentityfrm').serialize(); 
/*   e.preventDefault();    
var formData = new FormData(this);*/
//var formData = new FormData(this.form);
//alert($(this).attr("action"));
//$('#stuff').serialize()

/*  $.post($(this).attr("action"), formData, function(data) {
alert(data);
});*/
/* $.ajax({
type: "POST",
url: "uploadidentity.php",
data: formData,
success: function(data) {

alert(data);



} 
}); */
/*});*/


$(document).ready(function(e) {
// Submit form data via Ajax
$("#bankdetailform").on('submit', function(e) {
e.preventDefault();

var Bankuser = $("#spBankuser").val()

var Bankname = $("#spBankname").val()
var Banknumber = $("#spBanknumber").val()
var Branchnumber = $("#spBranchnumber").val()
var Accountnumber = $("#spAccountnumber").val()
var Bankcode = $("#spBankcode").val()

//alert(Bankuser);


if (Bankuser == "" && Bankname == "" && Banknumber == "" && Branchnumber == "" && Accountnumber == "" && Bankcode == "") {

/* $("#shipadd_error").text("Please Enter Address.");*/

$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();

$("#spBankname_error").text("Please Enter Bank Name.");
$("#spBankname").focus();

$("#spBanknumber_error").text("Please Enter Bank Number.");
$("#spBanknumber").focus();


$("#spBranchnumber_error").text("Please Enter Branch Number.");
$("#spBranchnumber").focus();

$("#spAccountnumber_error").text("Please Enter Account Number.");
$("#spAccountnumber").focus();


$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
} else if (Bankuser == "") {

$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();


return false;
} else if (Bankname == "") {

$("#spBankname_error").text("Please Enter Bank Name.");
$("#spBankname").focus();

return false;
} else if (Banknumber == "") {
$("#spBanknumber_error").text("Please Enter Bank Number.");
$("#spBanknumber").focus();

return false;
} else if (Branchnumber == "") {
$("#spBranchnumber_error").text("Please Enter Branch Number.");
$("#spBranchnumber").focus();

return false;
} else if (Accountnumber == "") {

$("#spAccountnumber_error").text("Please Enter Account Number.");
$("#spAccountnumber").focus();


return false;
} else if (Bankcode == "") {
$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
} else {

$.ajax({
type: 'POST',
url: 'addbankdetail.php',
data: new FormData(this),
processData: false,
contentType: false,


success: function(response) {

//  console.log(data);



}
});

}



});
});
</script>

<script type="text/javascript">

$( document ).ready(function() {
$('li').click(function () {

var clickedValue = $(this).data('dial-code');

//alert(clickedValue);
$('#hiddenDialCode').val(clickedValue);

});
});


</script>


<script type="text/javascript">
function keyupBankfun() {

var Bankuser = $("#spBankuser").val()

var Bankname = $("#spBankname").val()
var Banknumber = $("#spBanknumber").val()
var Branchnumber = $("#spBranchnumber").val()
var Accountnumber = $("#spAccountnumber").val()
var Bankcode = $("#spBankcode").val()


if (Bankuser != "") {
$('#spBankuser_error').text(" ");

}
if (Bankname != "") {
$('#spBankname_error').text(" ");
}
if (Banknumber != "") {
$('#spBanknumber_error').text(" ");

}
if (Branchnumber != "") {
$('#spBranchnumber_error').text(" ");

}
if (Accountnumber != "") {
$('#spAccountnumber_error').text(" ");
}
if (Bankcode != "") {
$('#spBankcode_error').text(" ");

}


}
</script>

<script type="text/javascript">
    $(document).ready(function(e) {
        // Submit form data via Ajax
        $("#uploadidentityfrm").on('submit', function(e) {
            e.preventDefault();

            var vidFileLength = $("#uploadidentity")[0].files.length;
            var vidFileLength1 = $("#uploadidentity1")[0].files.length;
            var address = $("#address").val();
            var email = $("#spUserEmail").val();
            var phone = $("#spUserPhone").val();
            if (email == "") {
                swal({
                    title: "Invalid Email!",
                    type: 'warning',
                    showConfirmButton: true
                });
            }
            if (phone == "") {
                swal({
                    title: "Invalid Phone!",
                    type: 'warning',
                    showConfirmButton: true
                });
            }
            if (address == "") {
                swal({
                    title: "Please Enter Address!",
                    type: 'warning',
                    showConfirmButton: true
                });
            } else if (vidFileLength === 0) {
                swal({
                    title: "Please Select Upload ID!",
                    type: 'warning',
                    showConfirmButton: true
                });
            } else {
                // Check if all uploaded files are images
                var allFilesAreImages = true;
                var files1 = $("#uploadidentity")[0].files;
                var files2 = $("#uploadidentity1")[0].files;

                // Checking files for uploadidentity
                for (var i = 0; i < files1.length; i++) {
                    var fileType = files1[i].type;
                    if (!fileType.startsWith('image/')) {
                        allFilesAreImages = false;
                        break;
                    }
                }

                // Checking files for uploadidentity1
                for (var i = 0; i < files2.length; i++) {
                    var fileType = files2[i].type;
                    if (!fileType.startsWith('image/')) {
                        allFilesAreImages = false;
                        break;
                    }
                }

                if (!allFilesAreImages) {
                    swal({
                        title: "Please upload only images!",
                        type: 'warning',
                        showConfirmButton: true
                    });
                    return; // Stop further processing
                }
                var form_data = new FormData(this);
                form_data.append('spUserEmail', email);
                form_data.append('spUserPhone', phone);
                // Proceed with Ajax request
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $BaseUrl ?>/my-profile/uploadidentity.php',
                    data: form_data,
                    processData: false,
                    contentType: false,

                    beforeSend: function() {
                        $('#subuploadids').attr("disabled", "disabled");
                        $('#uploadidentityfrm').css("opacity", ".5");
                    },
                    success: function(response) {
                        swal({
                            title: "Identity Uploaded Successfully!",
                            type: 'success',
                            showConfirmButton: true
                        }, function() {
                            window.location.reload();
                        });
                    }
                });
            }
        });
    });
</script>




<script type="text/javascript">
/*$(document).ready(function(e){
// Submit form data via Ajax
$("#shipaddfrm").on('submit', function(e){
e.preventDefault();



// var shipadd= $("#shipping_address").val()

var Bankuser= $("#spBankuser").val()

var Bankname = $("#spBankname").val()
var Banknumber = $("#spBanknumber").val()
var Branchnumber = $("#spBranchnumber").val()
var Accountnumber = $("#spAccountnumber").val()
var Bankcode = $("#spBankcode").val()


if(Bankuser == "" &&  Bankname == "" && Banknumber == "" && Branchnumber == "" && Accountnumber == "" && Bankcode == ""){


$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();

$("#spBankname_error").text("Please Enter Your Bank Name.");
$("#spBankname").focus();

$("#spBanknumber_error").text("Please Enter Your Bank Number.");
$("#spBanknumber").focus();


$("#spBranchnumber_error").text("Please Enter Your Branch Number.");
$("#spBranchnumber").focus();

$("#spAccountnumber_error").text("Please Enter Your Account Number.");
$("#spAccountnumber").focus();


$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
}else if (Bankuser == "") {

$("#spBankuser_error").text("Please Enter Name of Account Holder .");
$("#spBankuser").focus();


return false;
}else if (Bankname == "") {

$("#spBankname_error").text("Please Enter Your Bank Name.");
$("#spBankname").focus();

return false;
}else if (Banknumber == "") {
$("#spBanknumber_error").text("Please Enter Your Bank Number.");
$("#spBanknumber").focus();

return false;
}else if (Branchnumber == "") {
$("#spBranchnumber_error").text("Please Enter Your Branch Number.");
$("#spBranchnumber").focus();

return false;
}else if (Accountnumber == "") {

$("#spAccountnumber_error").text("Please Enter Your Account Number.");
$("#spAccountnumber").focus();


return false;
}else if (Bankcode == "") {
$("#spBankcode_error").text("Please Enter IFSC Code.");
$("#spBankcode").focus();

return false;
}



else{


$.ajax({
type: 'POST',
url: 'addusershippingaddr.php',
data: new FormData(this),
processData: false,
contentType: false,

beforeSend: function(){
$('#subaddshipadd').attr("disabled","disabled");
$('#shipaddfrm').css("opacity",".5");
},
success: function(response){ 


swal({

title: "Shipping Address Added  Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});


}
});








}



});
});*/
</script>

<script>
$(".myprofiles li").click(function() {

$(".myprofiles li").removeClass('active_profile');
$(this).addClass('active_profile');

});

$(".change_mobile").click(function() {
$("#userdetails").modal('hide');
$('#changemobile').modal('show');
});

$("#reason").click(function() {
$("#userdetails").modal('hide');
$('#exampleModal').modal('show');
});


/*var countryCode = "";

$("#country-listbox li").on("click", function(){ 
countryCode = $(this).attr('data-dial-code');
});*/

$("#up_mobile_btn_otp").click(function(e) {
//var str1 = "+";
//var str2 = countryCode;
//var res = str1.concat(str2);



var otp_code = $("#otp_code").val();
var otp = $("#otp_enter").val();

if(otp_code != otp){

$("#success").text('Wrong OTP! Please enter Correct ');
$("#success").css("color", "red");
$("#otp_enter").val("");
e.preventDefault()

}


var mobile = $("#update_mobile").val();
var hiddenDialCode = $("#hiddenDialCode").val();
var companyExtNo_ = $("#companyExtNo_").val();

var txtPhone = $("#txtPhone").val();
var old_number = $("#old_number").val();
var selectedValue = $('#companyExtNo_ option:selected').val();

if (mobile == "") {
swal({
title: "Please enter phone number!",
type: 'warning',
showConfirmButton: true
},
function() {

});
return false;
} else if (old_number == mobile) {
$("#err_phone").text("Please enter different number.")
return false;
} else {


//alert('ddddddddd');

var otp_code = $("#otp_code").val();
var otp = $("#otp_enter").val();

if(otp_code != otp){
//alert(otp_code);
//	alert(otp);
//	alert('wwwwwwwwwwww');
$("#success").text('Wrong OTP! Please enter Correct ');
//e.preventDefault()

}

else{
//alert('qqqqqqqqqqqqqq');
$.ajax({
type: 'POST',
url: 'update_mobile.php',
cache: false,
data: {
'phone_no': txtPhone,
'phoneno': txtPhone,
'phone_code': hiddenDialCode,
'companyExtNo':companyExtNo_,
'mobile1':mobile,
'send_otp': 1
},				
beforeSend: function() {
$('#up_mobile_btn_otp').attr("disabled", "disabled");

},
success: function(response) {
$("#up_mobile_btn_otp").removeAttr("disabled");
var respomses=response.trim();
if (respomses=='success') {
$("#msg").html(response.msg);
$("#smsg").css("color", "black");
$("#smsg").css("display", "block");
$("#enter_otp").css("display", "block");
$("#sendotp").css("display", "none");
$("#change_number").css("display", "inline");

$("#update_close").click();

window.location.href = BASE_URL+"/dashboard/settings/";


} else {

$("#msg").html(response.msg);
$("#smsg").css("display", "block");
$("#smsg").css("color", "red");
}


}

});
}
}
});

$("#re_send_otp").click(function() {
//var str1 = "+";
//var str2 = countryCode;
//var res = str1.concat(str2);
var mobile = $("#update_mobile").val();
//alert(res);

/*if(str2 == "")
{
swal({
title: "Please Select Country Code!",
type: 'warning',
showConfirmButton: true
},
function() { 

});
}*/
if (mobile == "") {
swal({
title: "Please Enter Phone Number!",
type: 'warning',
showConfirmButton: true
},
function() {

});
} else {
var spProfile_idspProfile = "997";
var idspUser = "385";

$.ajax({
type: 'POST',
url: 'update_mobile.php',
cache: false,
data: {
'phone_no': mobile,
'spProfile_idspProfile': spProfile_idspProfile,
'idspUser': idspUser,
'send_otp': 1,
're_send_otp': 1
},
dataType: 'json',
beforeSend: function() {
$('#re_send_otp').attr("disabled", "disabled");
},
success: function(response) {
//alert(response);
$("#re_send_otp").removeAttr("disabled");
if (response.status) {
$("#msg").html(response.msg);
$("#smsg").css("display", "block");
}
}
});
}
});

$("#verifynumber").click(function() {

//location.reload(); 
//var str1 = "+";
//var str2 = countryCode;
//var res = str1.concat(str2);
var mobile = $("#update_mobile").val();
var otp = $("#otp").val();
//alert(res);

/*if(str2 == "")
{
swal({
title: "Please Select Country Code!",
type: 'warning',
showConfirmButton: true
},
function() { 

});
}*/
if (mobile == "") {
swal({
title: "Please Enter Phone Number!",
type: 'warning',
showConfirmButton: true
},
function() {

});
} else if (otp == "") {
// swal({
// title: "Please Enter OTP!",
// type: 'warning',
// showConfirmButton: true
// },

} else {
var spProfile_idspProfile = "997";
var idspUser = "385";

$.ajax({
type: 'POST',
url: 'update_mobile.php',
cache: false,
data: {
'phone_no': mobile,
'spProfile_idspProfile': spProfile_idspProfile,
'idspUser': idspUser,
'send_otp': 2,
'otp': otp
},
dataType: 'json',
beforeSend: function() {
$('#up_mobile_btn_otp_2').attr("disabled", "disabled");
},
success: function(response) {
//alert(response);  
$("#up_mobile_btn_otp_2").removeAttr("disabled");
if (response.status) {
$("#msg").html(response.msg);
setInterval(function() {
window.location.reload();
}, 3000);      
} else {
$("#msg").html(response.msg);
$("#smsg").css("display", "block");
$("#enter_otp").css("display", "block");
}

}
//alert("success");

});
}

//location.reload(); 
});
</script>

<script type="text/javascript">
function myFunction() {

location.reload();
}
</script>

<script>
function onlyNumberKey(evt) {

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}

$('#update_mobile').keypress(function() {
//alert('1');
var phone = $('#update_mobile').val();
var cou = phone.length;
//alert(cou);
if (cou == 10) {
//alert('Can not Enter More Than 10 Digits');
swal("10 Digit Allowed");
return false;
}
});
</script>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>







<script>
uploadidentity.onchange = evt => {
const [file] = uploadidentity.files
if (file) {
//preview_img.src = URL.createObjectURL(file)
var output = document.getElementById('preview_img');
                    output.src = URL.createObjectURL(file)
}
}
</script>

<script>
uploadidentity1.onchange = evt => {
const [file] = uploadidentity1.files
if (file) {
   var output = document.getElementById('preview_img1');

   output.src = URL.createObjectURL(file)
}
}
</script>
<script>
Profiles.onchange = evt => {
const [file] = Profiles.files
if (file) {
//preview_img.src = URL.createObjectURL(file)
var output = document.getElementById('license');
                    output.src = URL.createObjectURL(file)
}
}
</script>

<script>
upload_bills.onchange = evt => {
const [file] = upload_bills.files
if (file) {
   var output = document.getElementById('img_bills');

   output.src = URL.createObjectURL(file)
}
}
</script>
<script>
function fun_close() {
$('#btn_close').click();
}
</script>

<script type="text/javascript">

function verifynumber() {


var otp_code = document.getElementById("otp_code").value;

var hiddenDialCode = $("#hiddenDialCode").val();

var otpValue = document.getElementById("txtPhone").value;

var otp_length = ($("#txtPhone").val().length);  


if(otp_length < 5 ){

$("#err_phone_valid").text('Please enter a valid phone number');
//alert('Please Enter Phone Number');
}
else{
  $("#err_phone_valid").text('');
  $.ajax({
    type: 'POST',
    cache: false,
    url: 'verifyotp.php',
    data: {
    'phone_no': '+'+hiddenDialCode+otpValue,
    'otp': otp_code, 
    'send_otp': 1
    },
    success: function(response) {

    // Handle success response here, if needed
    document.getElementById("success").innerHTML = "Code has been sent to your phone please enter";
    /*      $('#verifynumber').css("display","none !important");
    */  
    $('#verifynumber').attr('disabled','disabled');


    $('#otpform').css("display","block");
    $("#up_mobile_btn_otp").prop('disabled', false);

    /*   $('#up_mobile_btn_otp').css("display","block");
    */
    $('#resend-button').css("display","block");

    },
    error: function(xhr, status, error) {
    // Handle error here, e.g., display an error message
    console.error("Error:", error);
    }
  });
}
}
function re_send_otp() {
var otp_code = document.getElementById("otp_code").value;

var otpValue = document.getElementById("txtPhone").value;
$.ajax({
type: 'POST',
cache: false,
url: 'verifyotp.php',
data: {
'phone_no': '+'+hiddenDialCode+otpValue,
'otp': otp_code, 
'send_otp': 1
},
success: function(response) {

// Handle success response here, if needed
document.getElementById("success").innerHTML = " Code Resent Successfully ";
$("#success").css("color", "green");
$("#otp_enter").val("");
},
error: function(xhr, status, error) {
// Handle error here, e.g., display an error message
console.error("Error:", error);
}
});
}
</script>
