<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include('../univ/baseurl.php');

function sp_autoloader($class)  
{
	include '../mlayer/' . $class . '.class.php';
}
require_once "../common.php";

spl_autoload_register("sp_autoloader");
session_start();

header('Content-Type: application/json');

// Allow both AJAX, direct POST, and GET requests (GET for testing)
$email = '';
if (isset($_POST['email']) && $_POST['email'] != '') {
    $email = trim($_POST['email']);
} elseif (isset($_GET['email']) && $_GET['email'] != '') {
    $email = trim($_GET['email']);
}

if ($email != '') {
    try {
        $u = new _spuser;
        
        // Find user by email
        $result = $u->checkemail($email);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['idspUser'];
            $userName = $row['spUserName'];
            $emailVerifyCode = $row['email_verify_code'];
            
            // Check if an email was sent within the last 10 minutes
            if (isset($row['verification_email_sent_at']) && $row['verification_email_sent_at'] != null && $row['verification_email_sent_at'] != '') {
                $lastSentTime = strtotime($row['verification_email_sent_at']);
                $currentTime = time();
                $timeDifference = $currentTime - $lastSentTime;
                $tenMinutes = 10 * 60; // 10 minutes in seconds
                
                if ($timeDifference < $tenMinutes) {
                    $remainingMinutes = ceil(($tenMinutes - $timeDifference) / 60);
                    echo json_encode([
                        'success' => false, 
                        'message' => 'Please wait ' . $remainingMinutes . ' minute(s) before requesting another verification email.',
                        'error_type' => 'cooldown',
                        'remaining_seconds' => $tenMinutes - $timeDifference
                    ]);
                    exit();
                }
            }
            
            // Always generate a new verification code when resending
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
            
            // Update email verification code (cod = 2 means email verification)
            $updateResult = $u->updateEmailCode($userId, $randCode, 2);
            
            // Send verification email - call send_reg_email which will handle the email template
            $em = new _email;
            
            // We'll call send_reg_email but also need to verify it worked
            // Since send_reg_email doesnoreplyn't return a value, we'll call send_all_email directly
            // after preparing the email content like send_reg_email does
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
            $BaseUrl = $actual_link;
            $link = $BaseUrl . "/authentication/activate.php?me=" . $userId . "&active=" . $randCode . "&email=" . $email . "&username=" . $userName;
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $uc = new _city;
            $details = $em->ip_details("$ip");
            $country = $details->country ?? 'NA';
            $check_country = $uc->readCityName_country($country);
            if ($check_country) {
                $row_c = mysqli_fetch_assoc($check_country);
                $row_country = $row_c['countryname'];
                $country = $row_country;
            }
            $date_time = date("Y-m-d H:i:s");
            $province = $details->region ?? "NA";
            $city = $details->city ?? "NA";
            
            $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <style type="text/css">
        .mmaintab{background: #FFF; margin: 0 auto; padding: 15px; width: 640px;}
        .logo h1{color: #000; margin: 20px 0px 25px;}
        .letstart{background: #032350; padding: 15px; font-size: 20px; color: #FFF; margin: 15px 0px; text-align: center;}
        .letstart h1{font-size: 20px; margin: 0px;}
        .btn{background: #032350; color: #FFF; padding: 8px 15px; display: inline-block; margin-bottom: 15px; text-decoration: none; margin-top: 15px;}
        .foot{border-top: 1px solid; text-align: center;}
        .foot p{margin: 0px; color: #808080; padding: 10px}
        .left-margin{margin-left:10px;}
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="javascript:void(0)">
      <img src="' . $BaseUrl . '/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >
      </a>
      </td>
      </tr>
      <tr>
      <td>
      <p class="left-margin" style=" text-transform: capitalize;text-align:center;">Hey there ' . ucfirst(strtolower($userName)) . ',</p>
      <p class="left-margin" style="text-align:center;">You have started registering at The SharePage!</p>
      <p class="left-margin" style="text-align:center;">Please confirm your email address by clicking the below button</p>
      <p style="width:100%;text-align:center;margin-top:30px; margin-bottom:30px;">
        <a style="color:#fff;background:#3e2048;padding:20px 100px;" href="'.$link.'">Verify My Email</a>
      </p>
      <p style="text-align:center;">Or</p>
      <p class="left-margin" style="text-align:center;" >Please copy and paste the verification code to move on to the next step of the registration. The verification code will expire in 15 minutes. </p>
      <p class="left-margin" style=" text-transform: capitalize;text-align:center;">
      <span>"' . $randCode . '"</span></p>
      <p class="left-margin" >
      The request for this access originated from:<br>
      IP Address:  '.$ip.'<br>
      Country: '.$country.'<br>
      Province: '.$province.'<br>
      City: '.$city.'<br>
      Date: '.$date_time.'<br>
      Thanks for registering with us!</p>
      <br><br>
      <p class="left-margin">Regards,<br>
      The SharePage Team<br>
      www.TheSharePage.com<br>
      </p>
      </td>
      </tr>
      <tr>
      <td  align="center" class="foot">
      <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
      </td>
      </tr>
      </tbody>
      </table>
      <div style="width: 640px;text-align: center;margin: 0 auto">
      <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
      <div >
      <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;">Terms & Conditions</a>
      </div>
      </div>
      </body>
      </html>
    ';
            
            $subject = "The SharePage [Registration Email Verification]";
            
            // Call send_all_email directly so we can check the return value
            $emailSent = $em->send_all_email($email, $subject, $msg, 'noreply@thesharepage.com', '', '', 'noreply@thesharepage.com');
            
            if ($emailSent == 1) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Verification email has been sent successfully. Please check your inbox.',
                    'debug' => [
                        'userId' => $userId,
                        'userName' => $userName,
                        'email' => $email,
                        'codeGenerated' => $randCode,
                        'codeUpdated' => true,
                        'emailSent' => true
                    ]
                ]);
            } else {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to send verification email. Please check your SMTP configuration or try again later.',
                    'debug' => [
                        'userId' => $userId,
                        'userName' => $userName,
                        'email' => $email,
                        'codeGenerated' => $randCode,
                        'codeUpdated' => true,
                        'emailSent' => false,
                        'emailResult' => $emailSent
                    ]
                ]);
            }
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'User not found with this email address.',
                'debug' => ['email' => $email, 'userFound' => false]
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false, 
            'message' => 'An error occurred: ' . $e->getMessage(),
            'debug' => ['error' => $e->getMessage()]
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Email address is required.',
        'debug' => ['postData' => $_POST]
    ]);
}
?>

