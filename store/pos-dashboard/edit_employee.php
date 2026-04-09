<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../../univ/baseurl.php');
session_start();

$_SESSION['msg']= 2;

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "store/";

  include_once("../../authentication/islogin.php");
} else {
  function sp_autoloader($class)
  {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  include("../../helpers/image.php");
  $active = 2;
  $p = new _pos;
  //$id = $_GET["id"];
  $id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
  $pid = $_SESSION['pid'];
  $uid = $_SESSION['uid'];

  if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $city = $_POST['spUserCity'];
    $country = $_POST['spPostCountry'];
    $state = $_POST['spUserState'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $address = $_POST['address'];
    $countryCode = $_POST['countryCode'];
    $base =  $_SERVER['DOCUMENT_ROOT'];
    $targetDir = $base . "/store/pos-dashboard/upload_pos/";
    
     $image = new Image();
     $image->validateFileImageExtensions($_FILES['image']);
     
    $temp = explode('.', $_FILES['image']['name']);
    $extension = end($temp);
    $imagename = time() . rand(10000, 99999) . '.' . $extension;
    $image = $targetDir . $imagename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    $data = array(
      "pid" => $pid,
      "uid" => $uid,
      "name" => $name,
      //"username" => $username,
      "department" => $department,
      "email" => $email,
      "phone" => $phone,
      "password" => $password,
      "city" => $city,
      "country" => $country,
      "state" => $state,
      "countryCode" => $countryCode,
      "DateOfBirth" => $DateOfBirth,
      "address" => $address,
      "image" => $imagename
    );

    $res = $p->update_employee($data, $id);

    header("Location: employee.php");
  }

if(isset($_GET["imgid"])){
  $imgid = $_GET["imgid"];
  $data = array(
    "image" => ""
    );
  $res = $p->update_employee($data, $imgid);
  header("Location: edit_employee.php?id=".$imgid);
  
}

?>




  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Account & Inventory | TheSharepage </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
    <script src="../../assets/js/validations.js"></script>
    <style>
      .me-3 {
        padding-left: 0px;
        padding-right: 0px;
        margin-right: 14rem !important;
        margin-bottom: 3px;
      }
    </style>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row flex-nowrap">

        <?php include('left_side_landing.php'); ?>
        <div class="col py-3">
          <div class="row mb-4">
            <div class="d-flex justify-content-between border-bottom mb-3">
              <h3>Update Employee</h3>
            </div>

            <div class="col-12">
              <?php
              $p = new _pos;
              $result2 = $p->read_employesData($id);
              if ($result2) {
                $row2 = mysqli_fetch_assoc($result2);
              }
              ?>


            </div>
            <div class="modal-body">

              <form action="edit_employee.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="employes" value="employes">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Full Name:</label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $row2['name']; ?>">
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Department:</label>
                      <select id="cars" name="department" id="department" class="form-control">
                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result = $p->read_department($pid, $uid);
                        if ($result) {
                          $i = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $row2['department']) {
                                                                        echo "selected";
                                                                      } ?>><?php echo $row['department_in']; ?></option>

                        <?php }
                        } ?>
                      </select>
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Email:</label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $row2['email']; ?>">
                    </div>

<div class="col-mb-3" style="width: 33% !important;">
  <label for="recipient-name" class="col-form-label">Phone:</label>
  <div class="input-group">
            <!-- country codes (ISO 3166) and Dial codes. -->
<select name="countryCode" class="form-select" id="countryCode">
	  <option <?php echo ($row2['countryCode'] == "44") ? "Selected" : ""; ?>  data-countryCode="GB" value="44" >UK (+44)</option>
	  <option <?php echo ($row2['countryCode'] == "1") ? "Selected" : ""; ?>  data-countryCode="US" value="1">USA (+1)</option>
		<option <?php echo ($row2['countryCode'] == "213") ? "Selected" : ""; ?>  data-countryCode="DZ" value="213">Algeria (+213)</option>
		<option <?php echo ($row2['countryCode'] == "376") ? "Selected" : ""; ?>  data-countryCode="AD" value="376">Andorra (+376)</option>
		<option <?php echo ($row2['countryCode'] == "244") ? "Selected" : ""; ?>  data-countryCode="AO" value="244">Angola (+244)</option>
		<option <?php echo ($row2['countryCode'] == "1264") ? "Selected" : ""; ?>  data-countryCode="AI" value="1264">Anguilla (+1264)</option>
		<option <?php echo ($row2['countryCode'] == "1268") ? "Selected" : ""; ?>  data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
		<option <?php echo ($row2['countryCode'] == "54") ? "Selected" : ""; ?>  data-countryCode="AR" value="54">Argentina (+54)</option>
		<option <?php echo ($row2['countryCode'] == "374") ? "Selected" : ""; ?>  data-countryCode="AM" value="374">Armenia (+374)</option>
		<option <?php echo ($row2['countryCode'] == "297") ? "Selected" : ""; ?>  data-countryCode="AW" value="297">Aruba (+297)</option>
		<option <?php echo ($row2['countryCode'] == "61") ? "Selected" : ""; ?>  data-countryCode="AU" value="61">Australia (+61)</option>
		<option <?php echo ($row2['countryCode'] == "43") ? "Selected" : ""; ?>  data-countryCode="AT" value="43">Austria (+43)</option>
		<option <?php echo ($row2['countryCode'] == "994") ? "Selected" : ""; ?>  data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
		<option <?php echo ($row2['countryCode'] == "1242") ? "Selected" : ""; ?>  data-countryCode="BS" value="1242">Bahamas (+1242)</option>
		<option <?php echo ($row2['countryCode'] == "973") ? "Selected" : ""; ?>  data-countryCode="BH" value="973">Bahrain (+973)</option>
		<option <?php echo ($row2['countryCode'] == "880") ? "Selected" : ""; ?>  data-countryCode="BD" value="880">Bangladesh (+880)</option>
		<option <?php echo ($row2['countryCode'] == "1246") ? "Selected" : ""; ?>  data-countryCode="BB" value="1246">Barbados (+1246)</option>
		<option <?php echo ($row2['countryCode'] == "375") ? "Selected" : ""; ?>  data-countryCode="BY" value="375">Belarus (+375)</option>
		<option <?php echo ($row2['countryCode'] == "32") ? "Selected" : ""; ?>  data-countryCode="BE" value="32">Belgium (+32)</option>
		<option <?php echo ($row2['countryCode'] == "501") ? "Selected" : ""; ?>  data-countryCode="BZ" value="501">Belize (+501)</option>
		<option <?php echo ($row2['countryCode'] == "229") ? "Selected" : ""; ?>  data-countryCode="BJ" value="229">Benin (+229)</option>
		<option <?php echo ($row2['countryCode'] == "1441") ? "Selected" : ""; ?>  data-countryCode="BM" value="1441">Bermuda (+1441)</option>
		<option <?php echo ($row2['countryCode'] == "975") ? "Selected" : ""; ?>  data-countryCode="BT" value="975">Bhutan (+975)</option>
		<option <?php echo ($row2['countryCode'] == "591") ? "Selected" : ""; ?>  data-countryCode="BO" value="591">Bolivia (+591)</option>
		<option <?php echo ($row2['countryCode'] == "387") ? "Selected" : ""; ?>  data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
		<option <?php echo ($row2['countryCode'] == "267") ? "Selected" : ""; ?>  data-countryCode="BW" value="267">Botswana (+267)</option>
		<option <?php echo ($row2['countryCode'] == "55") ? "Selected" : ""; ?>  data-countryCode="BR" value="55">Brazil (+55)</option>
		<option <?php echo ($row2['countryCode'] == "673") ? "Selected" : ""; ?>  data-countryCode="BN" value="673">Brunei (+673)</option>
		<option <?php echo ($row2['countryCode'] == "359") ? "Selected" : ""; ?>  data-countryCode="BG" value="359">Bulgaria (+359)</option>
		<option <?php echo ($row2['countryCode'] == "226") ? "Selected" : ""; ?>  data-countryCode="BF" value="226">Burkina Faso (+226)</option>
		<option <?php echo ($row2['countryCode'] == "257") ? "Selected" : ""; ?>  data-countryCode="BI" value="257">Burundi (+257)</option>
		<option <?php echo ($row2['countryCode'] == "855") ? "Selected" : ""; ?>  data-countryCode="KH" value="855">Cambodia (+855)</option>
		<option <?php echo ($row2['countryCode'] == "237") ? "Selected" : ""; ?>  data-countryCode="CM" value="237">Cameroon (+237)</option>
		<option <?php echo ($row2['countryCode'] == "1") ? "Selected" : ""; ?>  data-countryCode="CA" value="1">Canada (+1)</option>
		<option <?php echo ($row2['countryCode'] == "238") ? "Selected" : ""; ?>  data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
		<option <?php echo ($row2['countryCode'] == "1345") ? "Selected" : ""; ?>  data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
		<option <?php echo ($row2['countryCode'] == "236") ? "Selected" : ""; ?>  data-countryCode="CF" value="236">Central African Republic (+236)</option>
		<option <?php echo ($row2['countryCode'] == "56") ? "Selected" : ""; ?>  data-countryCode="CL" value="56">Chile (+56)</option>
		<option <?php echo ($row2['countryCode'] == "86") ? "Selected" : ""; ?>  data-countryCode="CN" value="86">China (+86)</option>
		<option <?php echo ($row2['countryCode'] == "57") ? "Selected" : ""; ?>  data-countryCode="CO" value="57">Colombia (+57)</option>
		<option <?php echo ($row2['countryCode'] == "269") ? "Selected" : ""; ?>  data-countryCode="KM" value="269">Comoros (+269)</option>
		<option <?php echo ($row2['countryCode'] == "242") ? "Selected" : ""; ?>  data-countryCode="CG" value="242">Congo (+242)</option>
		<option <?php echo ($row2['countryCode'] == "682") ? "Selected" : ""; ?>  data-countryCode="CK" value="682">Cook Islands (+682)</option>
		<option <?php echo ($row2['countryCode'] == "506") ? "Selected" : ""; ?>  data-countryCode="CR" value="506">Costa Rica (+506)</option>
		<option <?php echo ($row2['countryCode'] == "385") ? "Selected" : ""; ?>  data-countryCode="HR" value="385">Croatia (+385)</option>
		<option <?php echo ($row2['countryCode'] == "53") ? "Selected" : ""; ?>  data-countryCode="CU" value="53">Cuba (+53)</option>
		<option <?php echo ($row2['countryCode'] == "90392") ? "Selected" : ""; ?>  data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
		<option <?php echo ($row2['countryCode'] == "357") ? "Selected" : ""; ?>  data-countryCode="CY" value="357">Cyprus South (+357)</option>
		<option <?php echo ($row2['countryCode'] == "42") ? "Selected" : ""; ?>  data-countryCode="CZ" value="42">Czech Republic (+42)</option>
		<option <?php echo ($row2['countryCode'] == "45") ? "Selected" : ""; ?>  data-countryCode="DK" value="45">Denmark (+45)</option>
		<option <?php echo ($row2['countryCode'] == "253") ? "Selected" : ""; ?>  data-countryCode="DJ" value="253">Djibouti (+253)</option>
		<option <?php echo ($row2['countryCode'] == "1809") ? "Selected" : ""; ?>  data-countryCode="DM" value="1809">Dominica (+1809)</option>
		<option <?php echo ($row2['countryCode'] == "1809") ? "Selected" : ""; ?>  data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
		<option <?php echo ($row2['countryCode'] == "593") ? "Selected" : ""; ?>  data-countryCode="EC" value="593">Ecuador (+593)</option>
		<option <?php echo ($row2['countryCode'] == "20") ? "Selected" : ""; ?>  data-countryCode="EG" value="20">Egypt (+20)</option>
		<option <?php echo ($row2['countryCode'] == "503") ? "Selected" : ""; ?>  data-countryCode="SV" value="503">El Salvador (+503)</option>
		<option <?php echo ($row2['countryCode'] == "240") ? "Selected" : ""; ?>  data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
		<option <?php echo ($row2['countryCode'] == "291") ? "Selected" : ""; ?>  data-countryCode="ER" value="291">Eritrea (+291)</option>
		<option <?php echo ($row2['countryCode'] == "372") ? "Selected" : ""; ?>  data-countryCode="EE" value="372">Estonia (+372)</option>
		<option <?php echo ($row2['countryCode'] == "251") ? "Selected" : ""; ?>  data-countryCode="ET" value="251">Ethiopia (+251)</option>
		<option <?php echo ($row2['countryCode'] == "500") ? "Selected" : ""; ?>  data-countryCode="FK" value="500">Falkland Islands (+500)</option>
		<option <?php echo ($row2['countryCode'] == "298") ? "Selected" : ""; ?>  data-countryCode="FO" value="298">Faroe Islands (+298)</option>
		<option <?php echo ($row2['countryCode'] == "679") ? "Selected" : ""; ?>  data-countryCode="FJ" value="679">Fiji (+679)</option>
		<option <?php echo ($row2['countryCode'] == "358") ? "Selected" : ""; ?>  data-countryCode="FI" value="358">Finland (+358)</option>
		<option <?php echo ($row2['countryCode'] == "33") ? "Selected" : ""; ?>  data-countryCode="FR" value="33">France (+33)</option>
		<option <?php echo ($row2['countryCode'] == "594") ? "Selected" : ""; ?>  data-countryCode="GF" value="594">French Guiana (+594)</option>
		<option <?php echo ($row2['countryCode'] == "689") ? "Selected" : ""; ?>  data-countryCode="PF" value="689">French Polynesia (+689)</option>
		<option <?php echo ($row2['countryCode'] == "241") ? "Selected" : ""; ?>  data-countryCode="GA" value="241">Gabon (+241)</option>
		<option <?php echo ($row2['countryCode'] == "220") ? "Selected" : ""; ?>  data-countryCode="GM" value="220">Gambia (+220)</option>
		<option <?php echo ($row2['countryCode'] == "7880") ? "Selected" : ""; ?>  data-countryCode="GE" value="7880">Georgia (+7880)</option>
		<option <?php echo ($row2['countryCode'] == "49") ? "Selected" : ""; ?>  data-countryCode="DE" value="49">Germany (+49)</option>
		<option <?php echo ($row2['countryCode'] == "233") ? "Selected" : ""; ?>  data-countryCode="GH" value="233">Ghana (+233)</option>
		<option <?php echo ($row2['countryCode'] == "350") ? "Selected" : ""; ?>  data-countryCode="GI" value="350">Gibraltar (+350)</option>
		<option <?php echo ($row2['countryCode'] == "30") ? "Selected" : ""; ?>  data-countryCode="GR" value="30">Greece (+30)</option>
		<option <?php echo ($row2['countryCode'] == "299") ? "Selected" : ""; ?>  data-countryCode="GL" value="299">Greenland (+299)</option>
		<option <?php echo ($row2['countryCode'] == "1473") ? "Selected" : ""; ?>  data-countryCode="GD" value="1473">Grenada (+1473)</option>
		<option <?php echo ($row2['countryCode'] == "590") ? "Selected" : ""; ?>  data-countryCode="GP" value="590">Guadeloupe (+590)</option>
		<option <?php echo ($row2['countryCode'] == "671") ? "Selected" : ""; ?>  data-countryCode="GU" value="671">Guam (+671)</option>
		<option <?php echo ($row2['countryCode'] == "502") ? "Selected" : ""; ?>  data-countryCode="GT" value="502">Guatemala (+502)</option>
		<option <?php echo ($row2['countryCode'] == "224") ? "Selected" : ""; ?>  data-countryCode="GN" value="224">Guinea (+224)</option>
		<option <?php echo ($row2['countryCode'] == "245") ? "Selected" : ""; ?>  data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
		<option <?php echo ($row2['countryCode'] == "592") ? "Selected" : ""; ?>  data-countryCode="GY" value="592">Guyana (+592)</option>
		<option <?php echo ($row2['countryCode'] == "509") ? "Selected" : ""; ?>  data-countryCode="HT" value="509">Haiti (+509)</option>
		<option <?php echo ($row2['countryCode'] == "504") ? "Selected" : ""; ?>  data-countryCode="HN" value="504">Honduras (+504)</option>
		<option <?php echo ($row2['countryCode'] == "852") ? "Selected" : ""; ?>  data-countryCode="HK" value="852">Hong Kong (+852)</option>
		<option <?php echo ($row2['countryCode'] == "36") ? "Selected" : ""; ?>  data-countryCode="HU" value="36">Hungary (+36)</option>
		<option <?php echo ($row2['countryCode'] == "354") ? "Selected" : ""; ?>  data-countryCode="IS" value="354">Iceland (+354)</option>
		<option <?php echo ($row2['countryCode'] == "91") ? "Selected" : ""; ?>  data-countryCode="IN" value="91">India (+91)</option>
		<option <?php echo ($row2['countryCode'] == "62") ? "Selected" : ""; ?>  data-countryCode="ID" value="62">Indonesia (+62)</option>
		<option <?php echo ($row2['countryCode'] == "98") ? "Selected" : ""; ?>  data-countryCode="IR" value="98">Iran (+98)</option>
		<option <?php echo ($row2['countryCode'] == "964") ? "Selected" : ""; ?>  data-countryCode="IQ" value="964">Iraq (+964)</option>
		<option <?php echo ($row2['countryCode'] == "353") ? "Selected" : ""; ?>  data-countryCode="IE" value="353">Ireland (+353)</option>
		<option <?php echo ($row2['countryCode'] == "972") ? "Selected" : ""; ?>  data-countryCode="IL" value="972">Israel (+972)</option>
		<option <?php echo ($row2['countryCode'] == "39") ? "Selected" : ""; ?>  data-countryCode="IT" value="39">Italy (+39)</option>
		<option <?php echo ($row2['countryCode'] == "1876") ? "Selected" : ""; ?>  data-countryCode="JM" value="1876">Jamaica (+1876)</option>
		<option <?php echo ($row2['countryCode'] == "81") ? "Selected" : ""; ?>  data-countryCode="JP" value="81">Japan (+81)</option>
		<option <?php echo ($row2['countryCode'] == "962") ? "Selected" : ""; ?>  data-countryCode="JO" value="962">Jordan (+962)</option>
		<option <?php echo ($row2['countryCode'] == "7") ? "Selected" : ""; ?>  data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
		<option <?php echo ($row2['countryCode'] == "254") ? "Selected" : ""; ?>  data-countryCode="KE" value="254">Kenya (+254)</option>
		<option <?php echo ($row2['countryCode'] == "686") ? "Selected" : ""; ?>  data-countryCode="KI" value="686">Kiribati (+686)</option>
		<option <?php echo ($row2['countryCode'] == "850") ? "Selected" : ""; ?>  data-countryCode="KP" value="850">Korea North (+850)</option>
		<option <?php echo ($row2['countryCode'] == "82") ? "Selected" : ""; ?>  data-countryCode="KR" value="82">Korea South (+82)</option>
		<option <?php echo ($row2['countryCode'] == "965") ? "Selected" : ""; ?>  data-countryCode="KW" value="965">Kuwait (+965)</option>
		<option <?php echo ($row2['countryCode'] == "996") ? "Selected" : ""; ?>  data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
		<option <?php echo ($row2['countryCode'] == "856") ? "Selected" : ""; ?>  data-countryCode="LA" value="856">Laos (+856)</option>
		<option <?php echo ($row2['countryCode'] == "371") ? "Selected" : ""; ?>  data-countryCode="LV" value="371">Latvia (+371)</option>
		<option <?php echo ($row2['countryCode'] == "961") ? "Selected" : ""; ?>  data-countryCode="LB" value="961">Lebanon (+961)</option>
		<option <?php echo ($row2['countryCode'] == "266") ? "Selected" : ""; ?>  data-countryCode="LS" value="266">Lesotho (+266)</option>
		<option <?php echo ($row2['countryCode'] == "231") ? "Selected" : ""; ?>  data-countryCode="LR" value="231">Liberia (+231)</option>
		<option <?php echo ($row2['countryCode'] == "218") ? "Selected" : ""; ?>  data-countryCode="LY" value="218">Libya (+218)</option>
		<option <?php echo ($row2['countryCode'] == "417") ? "Selected" : ""; ?>  data-countryCode="LI" value="417">Liechtenstein (+417)</option>
		<option <?php echo ($row2['countryCode'] == "370") ? "Selected" : ""; ?>  data-countryCode="LT" value="370">Lithuania (+370)</option>
		<option <?php echo ($row2['countryCode'] == "352") ? "Selected" : ""; ?>  data-countryCode="LU" value="352">Luxembourg (+352)</option>
		<option <?php echo ($row2['countryCode'] == "853") ? "Selected" : ""; ?>  data-countryCode="MO" value="853">Macao (+853)</option>
		<option <?php echo ($row2['countryCode'] == "389") ? "Selected" : ""; ?>  data-countryCode="MK" value="389">Macedonia (+389)</option>
		<option <?php echo ($row2['countryCode'] == "261") ? "Selected" : ""; ?>  data-countryCode="MG" value="261">Madagascar (+261)</option>
		<option <?php echo ($row2['countryCode'] == "265") ? "Selected" : ""; ?>  data-countryCode="MW" value="265">Malawi (+265)</option>
		<option <?php echo ($row2['countryCode'] == "60") ? "Selected" : ""; ?>  data-countryCode="MY" value="60">Malaysia (+60)</option>
		<option <?php echo ($row2['countryCode'] == "960") ? "Selected" : ""; ?>  data-countryCode="MV" value="960">Maldives (+960)</option>
		<option <?php echo ($row2['countryCode'] == "223") ? "Selected" : ""; ?>  data-countryCode="ML" value="223">Mali (+223)</option>
		<option <?php echo ($row2['countryCode'] == "356") ? "Selected" : ""; ?>  data-countryCode="MT" value="356">Malta (+356)</option>
		<option <?php echo ($row2['countryCode'] == "692") ? "Selected" : ""; ?>  data-countryCode="MH" value="692">Marshall Islands (+692)</option>
		<option <?php echo ($row2['countryCode'] == "596") ? "Selected" : ""; ?>  data-countryCode="MQ" value="596">Martinique (+596)</option>
		<option <?php echo ($row2['countryCode'] == "222") ? "Selected" : ""; ?>  data-countryCode="MR" value="222">Mauritania (+222)</option>
		<option <?php echo ($row2['countryCode'] == "269") ? "Selected" : ""; ?>  data-countryCode="YT" value="269">Mayotte (+269)</option>
		<option <?php echo ($row2['countryCode'] == "52") ? "Selected" : ""; ?>  data-countryCode="MX" value="52">Mexico (+52)</option>
		<option <?php echo ($row2['countryCode'] == "691") ? "Selected" : ""; ?>  data-countryCode="FM" value="691">Micronesia (+691)</option>
		<option <?php echo ($row2['countryCode'] == "373") ? "Selected" : ""; ?>  data-countryCode="MD" value="373">Moldova (+373)</option>
		<option <?php echo ($row2['countryCode'] == "377") ? "Selected" : ""; ?>  data-countryCode="MC" value="377">Monaco (+377)</option>
		<option <?php echo ($row2['countryCode'] == "976") ? "Selected" : ""; ?>  data-countryCode="MN" value="976">Mongolia (+976)</option>
		<option <?php echo ($row2['countryCode'] == "1664") ? "Selected" : ""; ?>  data-countryCode="MS" value="1664">Montserrat (+1664)</option>
		<option <?php echo ($row2['countryCode'] == "212") ? "Selected" : ""; ?>  data-countryCode="MA" value="212">Morocco (+212)</option>
		<option <?php echo ($row2['countryCode'] == "258") ? "Selected" : ""; ?>  data-countryCode="MZ" value="258">Mozambique (+258)</option>
		<option <?php echo ($row2['countryCode'] == "95") ? "Selected" : ""; ?>  data-countryCode="MN" value="95">Myanmar (+95)</option>
		<option <?php echo ($row2['countryCode'] == "264") ? "Selected" : ""; ?>  data-countryCode="NA" value="264">Namibia (+264)</option>
		<option <?php echo ($row2['countryCode'] == "674") ? "Selected" : ""; ?>  data-countryCode="NR" value="674">Nauru (+674)</option>
		<option <?php echo ($row2['countryCode'] == "977") ? "Selected" : ""; ?>  data-countryCode="NP" value="977">Nepal (+977)</option>
		<option <?php echo ($row2['countryCode'] == "31") ? "Selected" : ""; ?>  data-countryCode="NL" value="31">Netherlands (+31)</option>
		<option <?php echo ($row2['countryCode'] == "687") ? "Selected" : ""; ?>  data-countryCode="NC" value="687">New Caledonia (+687)</option>
		<option <?php echo ($row2['countryCode'] == "64") ? "Selected" : ""; ?>  data-countryCode="NZ" value="64">New Zealand (+64)</option>
		<option <?php echo ($row2['countryCode'] == "505") ? "Selected" : ""; ?>  data-countryCode="NI" value="505">Nicaragua (+505)</option>
		<option <?php echo ($row2['countryCode'] == "227") ? "Selected" : ""; ?>  data-countryCode="NE" value="227">Niger (+227)</option>
		<option <?php echo ($row2['countryCode'] == "234") ? "Selected" : ""; ?>  data-countryCode="NG" value="234">Nigeria (+234)</option>
		<option <?php echo ($row2['countryCode'] == "683") ? "Selected" : ""; ?>  data-countryCode="NU" value="683">Niue (+683)</option>
		<option <?php echo ($row2['countryCode'] == "672") ? "Selected" : ""; ?>  data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
		<option <?php echo ($row2['countryCode'] == "670") ? "Selected" : ""; ?>  data-countryCode="NP" value="670">Northern Marianas (+670)</option>
		<option <?php echo ($row2['countryCode'] == "47") ? "Selected" : ""; ?>  data-countryCode="NO" value="47">Norway (+47)</option>
		<option <?php echo ($row2['countryCode'] == "968") ? "Selected" : ""; ?>  data-countryCode="OM" value="968">Oman (+968)</option>
		<option <?php echo ($row2['countryCode'] == "680") ? "Selected" : ""; ?>  data-countryCode="PW" value="680">Palau (+680)</option>
		<option <?php echo ($row2['countryCode'] == "680") ? "Selected" : ""; ?>  data-countryCode="PW" value="680">Palau (+680)</option>
		<option <?php echo ($row2['countryCode'] == "507") ? "Selected" : ""; ?>  data-countryCode="PA" value="507">Panama (+507)</option>
		<option <?php echo ($row2['countryCode'] == "675") ? "Selected" : ""; ?>  data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
		<option <?php echo ($row2['countryCode'] == "595") ? "Selected" : ""; ?>  data-countryCode="PY" value="595">Paraguay (+595)</option>
		<option <?php echo ($row2['countryCode'] == "51") ? "Selected" : ""; ?>  data-countryCode="PE" value="51">Peru (+51)</option>
		<option <?php echo ($row2['countryCode'] == "63") ? "Selected" : ""; ?>  data-countryCode="PH" value="63">Philippines (+63)</option>
		<option <?php echo ($row2['countryCode'] == "48") ? "Selected" : ""; ?>  data-countryCode="PL" value="48">Poland (+48)</option>
		<option <?php echo ($row2['countryCode'] == "351") ? "Selected" : ""; ?>  data-countryCode="PT" value="351">Portugal (+351)</option>
		<option <?php echo ($row2['countryCode'] == "1787") ? "Selected" : ""; ?>  data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
		<option <?php echo ($row2['countryCode'] == "974") ? "Selected" : ""; ?>  data-countryCode="QA" value="974">Qatar (+974)</option>
		<option <?php echo ($row2['countryCode'] == "262") ? "Selected" : ""; ?>  data-countryCode="RE" value="262">Reunion (+262)</option>
		<option <?php echo ($row2['countryCode'] == "40") ? "Selected" : ""; ?>  data-countryCode="RO" value="40">Romania (+40)</option>
		<option <?php echo ($row2['countryCode'] == "7") ? "Selected" : ""; ?>  data-countryCode="RU" value="7">Russia (+7)</option>
		<option <?php echo ($row2['countryCode'] == "250") ? "Selected" : ""; ?>  data-countryCode="RW" value="250">Rwanda (+250)</option>
		<option <?php echo ($row2['countryCode'] == "378") ? "Selected" : ""; ?>  data-countryCode="SM" value="378">San Marino (+378)</option>
		<option <?php echo ($row2['countryCode'] == "239") ? "Selected" : ""; ?>  data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
		<option <?php echo ($row2['countryCode'] == "966") ? "Selected" : ""; ?>  data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
		<option <?php echo ($row2['countryCode'] == "221") ? "Selected" : ""; ?>  data-countryCode="SN" value="221">Senegal (+221)</option>
		<option <?php echo ($row2['countryCode'] == "381") ? "Selected" : ""; ?>  data-countryCode="CS" value="381">Serbia (+381)</option>
		<option <?php echo ($row2['countryCode'] == "248") ? "Selected" : ""; ?>  data-countryCode="SC" value="248">Seychelles (+248)</option>
		<option <?php echo ($row2['countryCode'] == "232") ? "Selected" : ""; ?>  data-countryCode="SL" value="232">Sierra Leone (+232)</option>
		<option <?php echo ($row2['countryCode'] == "65") ? "Selected" : ""; ?>  data-countryCode="SG" value="65">Singapore (+65)</option>
		<option <?php echo ($row2['countryCode'] == "421") ? "Selected" : ""; ?>  data-countryCode="SK" value="421">Slovak Republic (+421)</option>
		<option <?php echo ($row2['countryCode'] == "386") ? "Selected" : ""; ?>  data-countryCode="SI" value="386">Slovenia (+386)</option>
		<option <?php echo ($row2['countryCode'] == "677") ? "Selected" : ""; ?>  data-countryCode="SB" value="677">Solomon Islands (+677)</option>
		<option <?php echo ($row2['countryCode'] == "252") ? "Selected" : ""; ?>  data-countryCode="SO" value="252">Somalia (+252)</option>
		<option <?php echo ($row2['countryCode'] == "27") ? "Selected" : ""; ?>  data-countryCode="ZA" value="27">South Africa (+27)</option>
		<option <?php echo ($row2['countryCode'] == "34") ? "Selected" : ""; ?>  data-countryCode="ES" value="34">Spain (+34)</option>
		<option <?php echo ($row2['countryCode'] == "94") ? "Selected" : ""; ?>  data-countryCode="LK" value="94">Sri Lanka (+94)</option>
		<option <?php echo ($row2['countryCode'] == "290") ? "Selected" : ""; ?>  data-countryCode="SH" value="290">St. Helena (+290)</option>
		<option <?php echo ($row2['countryCode'] == "1869") ? "Selected" : ""; ?>  data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
		<option <?php echo ($row2['countryCode'] == "1758") ? "Selected" : ""; ?>  data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
		<option <?php echo ($row2['countryCode'] == "249") ? "Selected" : ""; ?>  data-countryCode="SD" value="249">Sudan (+249)</option>
		<option <?php echo ($row2['countryCode'] == "597") ? "Selected" : ""; ?>  data-countryCode="SR" value="597">Suriname (+597)</option>
		<option <?php echo ($row2['countryCode'] == "268") ? "Selected" : ""; ?>  data-countryCode="SZ" value="268">Swaziland (+268)</option>
		<option <?php echo ($row2['countryCode'] == "46") ? "Selected" : ""; ?>  data-countryCode="SE" value="46">Sweden (+46)</option>
		<option <?php echo ($row2['countryCode'] == "41") ? "Selected" : ""; ?>  data-countryCode="CH" value="41">Switzerland (+41)</option>
		<option <?php echo ($row2['countryCode'] == "963") ? "Selected" : ""; ?>  data-countryCode="SI" value="963">Syria (+963)</option>
		<option <?php echo ($row2['countryCode'] == "886") ? "Selected" : ""; ?>  data-countryCode="TW" value="886">Taiwan (+886)</option>
		<option <?php echo ($row2['countryCode'] == "7") ? "Selected" : ""; ?>  data-countryCode="TJ" value="7">Tajikstan (+7)</option>
		<option <?php echo ($row2['countryCode'] == "66") ? "Selected" : ""; ?>  data-countryCode="TH" value="66">Thailand (+66)</option>
		<option <?php echo ($row2['countryCode'] == "228") ? "Selected" : ""; ?>  data-countryCode="TG" value="228">Togo (+228)</option>
		<option <?php echo ($row2['countryCode'] == "676") ? "Selected" : ""; ?>  data-countryCode="TO" value="676">Tonga (+676)</option>
		<option <?php echo ($row2['countryCode'] == "1868") ? "Selected" : ""; ?>  data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
		<option <?php echo ($row2['countryCode'] == "216") ? "Selected" : ""; ?>  data-countryCode="TN" value="216">Tunisia (+216)</option>
		<option <?php echo ($row2['countryCode'] == "90") ? "Selected" : ""; ?>  data-countryCode="TR" value="90">Turkey (+90)</option>
		<option <?php echo ($row2['countryCode'] == "7") ? "Selected" : ""; ?>  data-countryCode="TM" value="7">Turkmenistan (+7)</option>
		<option <?php echo ($row2['countryCode'] == "993") ? "Selected" : ""; ?>  data-countryCode="TM" value="993">Turkmenistan (+993)</option>
		<option <?php echo ($row2['countryCode'] == "") ? "Selected" : ""; ?>  data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
		<option <?php echo ($row2['countryCode'] == "688") ? "Selected" : ""; ?>  data-countryCode="TV" value="688">Tuvalu (+688)</option>
		<option <?php echo ($row2['countryCode'] == "256") ? "Selected" : ""; ?>  data-countryCode="UG" value="256">Uganda (+256)</option>
		<!-- <option <?php echo ($row2['countryCode'] == "") ? "Selected" : ""; ?>  data-countryCode="GB" value="44">UK (+44)</option> -->
		<option <?php echo ($row2['countryCode'] == "380") ? "Selected" : ""; ?>  data-countryCode="UA" value="380">Ukraine (+380)</option>
		<option <?php echo ($row2['countryCode'] == "971") ? "Selected" : ""; ?>  data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
		<option <?php echo ($row2['countryCode'] == "598") ? "Selected" : ""; ?>  data-countryCode="UY" value="598">Uruguay (+598)</option>
		<!-- <option <?php echo ($row2['countryCode'] == "") ? "Selected" : ""; ?>  data-countryCode="US" value="1">USA (+1)</option> -->
		<option <?php echo ($row2['countryCode'] == "7") ? "Selected" : ""; ?>  data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
		<option <?php echo ($row2['countryCode'] == "678") ? "Selected" : ""; ?>  data-countryCode="VU" value="678">Vanuatu (+678)</option>
		<option <?php echo ($row2['countryCode'] == "") ? "Selected" : ""; ?>  data-countryCode="VA" value="379">Vatican City (+379)</option>
		<option <?php echo ($row2['countryCode'] == "") ? "Selected" : ""; ?>  data-countryCode="VE" value="58">Venezuela (+58)</option>
		<option <?php echo ($row2['countryCode'] == "84") ? "Selected" : ""; ?>  data-countryCode="VN" value="84">Vietnam (+84)</option>
		<option <?php echo ($row2['countryCode'] == "1284") ? "Selected" : ""; ?>  data-countryCode="VG" value="1284">Virgin Islands - British (+1284)</option>
		<option <?php echo ($row2['countryCode'] == "1340") ? "Selected" : ""; ?>  data-countryCode="VI" value="1340">Virgin Islands - US (+1340)</option>
		<option <?php echo ($row2['countryCode'] == "681") ? "Selected" : ""; ?>  data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
		<option <?php echo ($row2['countryCode'] == "969") ? "Selected" : ""; ?>  data-countryCode="YE" value="969">Yemen (North)(+969)</option>
		<option <?php echo ($row2['countryCode'] == "967") ? "Selected" : ""; ?>  data-countryCode="YE" value="967">Yemen (South)(+967)</option>
		<option <?php echo ($row2['countryCode'] == "260") ? "Selected" : ""; ?>  data-countryCode="ZM" value="260">Zambia (+260)</option>
		<option <?php echo ($row2['countryCode'] == "263") ? "Selected" : ""; ?>  data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
</select>
<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row2['phone']; ?>" style="/* width: 40% !important; */">
</div>
</div>
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Date Of Birth:</label>
                      <input type="date" class="form-control" name="DateOfBirth" id="DateOfBirth" value="<?php echo $row2['DateOfBirth']; ?>">
                    </div>
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Password:</label>
                      <input type="password" class="form-control" name="password" id="password" value="<?php echo $row2['password']; ?>">
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="spPostCountry_" class="lbl_2">Country</label>
                    <select class="form-control form-select" name="spPostCountry" id="spUserCountry">
                    <option value="">Select Country </option>
                    <?php
                    $co = new _country;
                    $result13 = $co->readCountry();
                    if($result13 != false){
                    while ($row13 = mysqli_fetch_assoc($result13)) {
                    $usercountry = $row2['country'];
                    ?>
                    <option value='<?php echo $row13['country_id'];?>' <?php echo (isset($row2['country']) && $row2['country'] == $row13['country_id'])?'selected':''; ?>><?php echo $row13['country_title'];?></option>
                    <?php
                    }
                    }
                    ?>
                    </select>
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">                     
                      <div class="loadUserState">
                      <label for="spPostingCity"  class="lbl_3">State</label>
                      <select class="form-control form-select spPostingsState"  name="spUserState">
                      <option>Select State</option>
                      <?php 

                      // if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
                      $countryId = $usercountry;
                      $pr = new _state;
                      $result21 = $pr->readState($countryId);
                      if($result21 != false){
                      while ($row21 = mysqli_fetch_assoc($result21)) { 

                      $userstate = $row2['state'];
                      ?>
                      <option value='<?php echo $row21["state_id"];?>' <?php echo (isset($row2['state']) && $row2['state'] == $row21["state_id"] )?'selected':'';?>><?php echo $row21["state_title"];?> </option>
                      <?php
                      }
                      }
                      //  }
                      ?>
                      </select>
                    </div>
                    </div>

                  <div class="col-mb-3" style="width: 33% !important;">                   
                  <div class="loadCity">
                  <label for="spPostingCity"  class="control-label">City</label>
                  <select class="form-control form-select" name="spUserCity">
                  <option>Select City</option>
                  <?php 
                  $stateId = $userstate;

                  $co = new _city;
                  $result31 = $co->readCity($stateId);
                  //echo $co->ta->sql;
                  if($result31 != false){
                  while ($row31 = mysqli_fetch_assoc($result31)) { ?>
                  <option value='<?php echo $row31['city_id']; ?>' <?php echo (isset($row2['city']) && $row2['city'] == $row31['city_id'])?'selected':''; ?>><?php echo $row31['city_title'];?></option> <?php
                  }

                  } ?>
                  </select>
                    </div>
                </div>

                
                    <div class="col-mb-3" style="width: 100% !important;">
                      <label for="recipient-name" class="col-form-label">Address:</label>
                      <textarea class="form-control" id="message-text" name="address" id="address"><?php echo $row2['address']; ?> </textarea>

                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Image:</label>
                      <input type="file" class="form-control" name="image" id="image" value="<?php echo $row2['image']; ?>">
                      <span class="error_message" id="image_error"style="color: red;"></span>
                    </div>
                    <div class="col-mb-3" style="width: 33% !important;padding: 10px;">
                      <?php if ($row2['image']) { ?>
                        <img src="<?php echo $BaseUrl; ?>/store/pos-dashboard/upload_pos/<?php echo $row2['image']; ?>" height="150px" width="200px"><br>
                        <a onclick="deletefun(<?php echo $id; ?>)" class=" btn btn-danger"> <i class="fas fa-trash"></i></a>
                      <?php } ?>
                      
                    </div>


                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="employee.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>

          </div>
          <div class="row">
            <div class="col-lg-12 footer">
              <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>
            </div>
          </div>
        </div>
      </div>
    </div>











    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="js/data.js"></script>
    <script src="js/custom-chart.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#table_id').DataTable({
          buttons: {
            buttons: ['copy', 'csv', 'excel']
          }
        });
      });
    </script>
    <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
    <script type="text/javascript">
      function deletefun(id) {
        Swal.fire({
          title: 'Are You Sure You Want to Delete?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "edit_employee.php?imgid=" + id;

          }
        });

      }
    </script>
    <script>
      setTimeout(function() {
        $("#success").hide();
      }, 5000);
      setTimeout(function() {
        $("#no_member").hide();
      }, 5000);
      setTimeout(function() {
        $("#p_success").hide();
      }, 5000);
    </script>

    <script>
      <?php
      if (isset($_SESSION['conf'])) {
        unset($_SESSION['conf']);
      ?>
        Swal.fire({
          title: 'File uploaded successfully',
        });
        // swal('File uploaded successfully');

      <?php   }
      ?>
    </script>
<script>

$(document).ready(function(){

$("#spUserCountry").on("change", function () { 
var a = $("#spUserCountry").val();
$.post("../loadUserState.php", {countryId: a}, function (r) {
// alert(r);
$(".loadUserState").html(r);
});
});



}); 

document.getElementById("image").addEventListener("change", function() {
  validateImageFile("image", "image_error");
});

</script>
  </body>

  </html>

<?php } ?>
