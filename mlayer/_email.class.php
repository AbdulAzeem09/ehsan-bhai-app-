<?php
//require_once '../library/config.php';
require_once($_SERVER["DOCUMENT_ROOT"]."/common.php");
require($_SERVER["DOCUMENT_ROOT"]. '/smtp17aug/smtp/PHPMailerAutoload.php');

//require_once("../univ/baseurl.php");
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$BaseUrl = $actual_link;

class _email
{
  public $dbclose = false;
  public $conn;
  public $ta;
  //public $BaseUrl = "https://dev.thesharepage.com/";

  // SEND SMS TO SINGLE USER AT THE TIME OF REGISTTATION
  function sendemail()
  {
  
    return false;  
    $emails = 'info@thesharepage.com';
    $api_key = "ae6e0fc1f1fcf9db61dfc51f1d4831a8-9c988ee3-65f27b72"; /* Api Key got from https://mailgun.com/cp/my_account */
    $domain = "dev.thesharepage.com";

    $subject = "Developer";
    $message = "Hi this is my first email";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    //'X-Mailgun-Recipient-Variables' => $myJSON,
      'from'      => 'Thesharepage <info@thesharepage.com>',
      'to'        =>  $emails,
      'subject'   => $subject,
      'html'      => $message,
      'o:tracking-clicks' => FALSE
    ));
    $result = curl_exec($ch);
    curl_close($ch);
  }

  // ===MAIL FUNCTION FOR SENDING ALL
  function send_all_email_old($email_to, $subj, $message)
  {

    $email_test = array();
    if ($email_to != '') {
      $emails = $email_to;
      if (isset($subj) && $subj != '') {
        $subject = $subj;
      } else {
        $subject = "The SharePage";
      }

      $txt = $message;

      $api_key = "ae6e0fc1f1fcf9db61dfc51f1d4831a8-9c988ee3-65f27b72"; /* Api Key got from https://mailgun.com/cp/my_account */
      $domain = "dev.thesharepage.com"; 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
      curl_setopt($ch, CURLOPT_POSTFIELDS, array(
      //'X-Mailgun-Recipient-Variables' => $myJSON,
        'from'      => 'The SharePage <info@thesharepage.com>',
        'to'        => $emails,
        'subject'   => $subject,
        'html'      => $txt,
        'o:tracking-clicks' => FALSE
      ));
      $result = curl_exec($ch); 
      curl_close($ch);
      //$string = '{ "id": "<20170424074159.23658.65668.63B3D50D@www.ondotz.com>", "message": "Queued. Thank you." }';
      //$output = explode(',', $result);
      $output = explode(',', $result);
      $messageId = $output[0];
      $string2 = ltrim($messageId, '{');
      $string3 = ltrim($string2, ' "id": "<');
      $string4 = trim($string3);
      $string5 = ltrim($string4, '"id": "<');
      $job_id = rtrim($string5, '>"');

      return $job_id;
    }
  }

  function sendCommonMail($name, $email, $subject, $message){
    $BaseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  
    $html = '<!DOCTYPE html>
      <html>
        <head>
          <title>The SharePage</title>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <style type="text/css">
            .mmaintab{
              background: #FFF;
              margin: 0 auto;
              padding: 15px;
              width: 640px;
            }
            .mmaintab td{
              padding:0 15px;
            }
            .logo h1{
              color: #000;
              margin: 20px 0px 25px;;
          
            }
            .letstart{
              background: #fb8308;
              font-size: 20px;
              color: #fff !important;
              margin: 15px 0px;
              text-align: center;
            }
            .letstart h1{
              font-size: 20px;
              margin: 0px;
            }
            .btn{
              background: #fb8308;
              color: #FFF!important;
              padding: 8px 15px;
              display: inline-block;
              margin-bottom: 15px;
              text-decoration: none;
              margin-top: 15px;
            }
            .foot{
              border-top: 1px solid;
              text-align: center;
            }
            .foot p{
              margin: 0px;
              color: #808080;
              padding: 10px
            }
            .no-margin{
              margin: 0px;
            }                   
          </style>
        </head>
        <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
          <table style="padding:10px;" class="mmaintab" border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td align="center" class="logo" >
                  <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
                  <h1>The SharePage</h1>
                </td>
              </tr>
              <tr>
                <td class="letstart">
                  <p style="padding:5px;margin:0px;"><b>'.$subject.'</b></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p><br></p>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Hi ' . ucfirst(strtolower($name)) . ',</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p>' . $message. '</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p class="left-margin" >
                    Regards,<br>
                    The SharePage Team<br>
                    www.TheSharePage.com
                  </p>
                </td>
              </tr>   
            </tbody>
          </table>
          <div style="width: 640px;text-align: center;margin: 0 auto">
            <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
          </div>      
        </body>
      </html>';

    $this->send_all_email($email, $subject, $html);
  }

  function send_all_email($email_to, $subj, $message, $smtp_email = '', $name = "", $replyTo = "", $fromEmail = "")
  {
    $env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
    if(!$smtp_email){
      $smtp_email = $env['smtp_username'];
    }
    $mail = new PHPMailer;
    $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->SMTPAuth = true;

    // Determine which email credentials to use based on smtp_email parameter
    if (isset($smtp_email) && $smtp_email == "registration@thesharepage.com") {
      // REGISTRATION EMAIL - FROM REGISTRATION
      $mail->Username = trim($env['regmail_username'], " '\""); // regmail username
      $mail->Password = trim($env['regmail_password'], " '\""); // regmail password
      $mail->From = trim($env['regmail_username'], " '\"");
    }
    elseif (isset($smtp_email) && ($smtp_email == "noreply@thesharepage.com")) {
      // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
      $mail->Username = trim($env['noreplymail_username'], " '\""); // noreplymail username
      $mail->Password = trim($env['noreplymail_password'], " '\""); // noreplymail password
      $mail->From = trim($env['noreplymail_username'], " '\"");
    }
    else {
      // CONTACT EMAIL - FROM CONTACT FORM (default)
      // Enable debug only in development (comment out for production)
      // $mail->SMTPDebug = 2; // Enable verbose debug output (2 = client and server messages)
      // $mail->Debugoutput = function($str, $level) {
      //   error_log("PHPMailer Debug: $str");
      // };
      $mail->Username = trim($env['smtp_username'], " '\""); // SMTP username (remove quotes if any)
      $mail->Password = trim($env['smtp_password'], " '\""); // SMTP password (remove quotes if any)
      $mail->From = trim($env['smtp_username'], " '\"");
    } 
    
    $mail->SMTPSecure = (!empty($env['smtp_secure'])) ? trim($env['smtp_secure'], " '\"") : "ssl";
    $mail->Host = trim($env['smtp_host'], " '\""); // Specify main and backup SMTP servers (remove quotes if any)
    $mail->Port = (int)$env['smtp_port']; // TCP port to connect to

    if($name){
      $mail->FromName = $name;
    }
    else{
      $mail->FromName = 'The SharePage';
    }
    if($replyTo){
      $mail->AddReplyTo($replyTo, $name);
    }

    $mail->addAddress($email_to); // Name is optional
    $mail->isHTML(true);      
    $mail->addCustomHeader('Content-Type', 'text/html'); // Set email format to HTML
    $mail->Subject = $subj;
    $mail->Body    = $message;
    
    // Capture any errors
    $errorMsg = '';
    $res = $mail->send();
    if (!$res) {
      $errorMsg = 'Mailer Error: ' . $mail->ErrorInfo;
      error_log("Email send failed: " . $errorMsg);
      error_log("SMTP Config - Host: " . $mail->Host . ", Port: " . $mail->Port . ", Username: " . $mail->Username);
    }
    
    if(!$res){
      //to debug failure cases
      $obj = [];
      $obj[] = !empty($smtp_email) ? $smtp_email : '';
      $obj[] = !empty($email_to) ? $email_to : '';
      $obj[] = !empty($subj) ? $subj : '';
      $obj[] = !empty($message) ? $message : '';
      $obj[] = !empty($res) ? 1 : 0;
      $obj[] = date('Y-m-d H:i:s');
      // Store error message if available
      if(function_exists('insertQ')) {
        insertQ('insert into spemail_status (sender, receiver, subject, message, status, created_date) values (?, ?, ?, ?, ?, ?)', 'ssssis', $obj);
      }
    }
    
    if (!$res) {
      error_log("Email sending failed for: " . $email_to . " - " . $errorMsg);
      return 0;
    } else {
      return 1;
    }
  }

  function mail_sender($email ,$name , $message)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;

      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr>
    <td class="letstart" style="color:#3e2048">
    <p><b>TICKET CANCELLATION ACTION TAKEN</b></p>
    </td>
    </tr>
    <tr>

    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    </td>
    </tr>



    <tr>
    <td>
    <p><br>' . $message. '</p>

    </td>
    </tr>


    <tr>
    <td>
    <p class="left-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com
    </p>
    </td>
    </tr>


    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';




    $subject = "The SharePage [Ticket Cancellation Action]";
    //echo $msg;die("+=======");
    $this->send_all_email($email, $subject, $msg);
  }

  function send_job_alert($email, $cname,$title, $message)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #2F6230;
        padding: 15px;
        font-size: 20px;
        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #2F6230;
        color: #FFF!important;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{
        border-top: 1px solid;
        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }
      .no-margin{
        margin: 0px;
      }                   
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
      <h1>The SharePage</h1>
      </td>
      </tr>

      <tr>
      <td>
      <p>Hi ' . ucfirst(strtolower($cname)) . ',</p>

      </td>
      </tr>

      <tr>
      <td>
        <p>Job Title : '.$title.'!</p>
      </td>
      </tr>

      <tr>
      <td>
      <p> ' . ucfirst(strtolower($message)) . '</p>

      </td>
      </tr>

      </tbody>

      </table>
      <div style="width: 640px;text-align: center;margin: 0 auto">
      <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

      </div>

      </body>
      </html>
    ';
    $subject = "Job Alert for : ". $title;
    // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
    $this->send_all_email($email, $subject, $msg, "noreply@thesharepage.com");
  }

  function send_contact_email($email, $cname, $message)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($cname)) . ',</p>

    </td>
    </tr>

    <tr>
    <td>
    <p> Email-' . ucfirst(strtolower($cemail)) . '</p>

    </td>
    </tr>

    <tr>
    <td>
    <p> Message-' . ucfirst(strtolower($message)) . '</p>

    </td>
    </tr>

    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';
    $subject = "The SharePage Store Contact Information.";

    $this->send_all_email($email, $subject, $msg);
  }

  function send_backofadmin_mail($email,$massage,$user_name)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1 style="background-color:#0d3e0d;color:white;padding-bottom: 10px;"><span style="font-size:20px">Email Verification for Back Admin</span></h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi'." " . ucfirst(strtolower($user_name)) . ', </p>
    </td>
    </tr>
    <tr>
    <td>
    <p>' . $massage . '</p>
    </td>
    </tr>
    <tr>
    <td>
    </td>
    </tr>
    <tr>
    <td>
    <p class="left-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </p>
    </td>
    </tr>
    </tbody>
    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
    </div>

    </body>
    </html>

    ';
    $subject = " OTP to Login Backofadmin.";
  
    $this->send_all_email($email, $subject, $msg);
  }

  function send_invite_email_1($email, $message, $msg)
  {
    $subject = "Invite To Join TheSharePage";
    $this->send_all_email($email, $subject, $message);
  }

  function send_invite_email($email, $message, $subject)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $link = $BaseUrl . "/authentication/activate.php?me=" . $uid . "&email=" . $email . "&username=" . $userName;

    $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #032350;


        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #032350;
        color: #FFF;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{

        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }



      table {

        margin-left:10px;
        margin-right:10px;

      }

      table td {

      }

      .row > div {
        margin-top:10px;
        margin-left:10px;
        margin-right:10px;
        flex: 1;
        border: 1px solid grey;
      }
      .left-margin{

        margin-left:10px;

      }
      .btnhover:hover{
        color:white!important;

      }
      .btnhover{
        color:#fff!important;
      }
      .tablecontent{
        padding-left: 10px;
        padding-right: 10px;
        text-align: justify;

      }
      .paracontent{
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
        padding-top: 10px;
        text-align: justify;

      }
      p b{
        margin-left: 10px;
      }
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="javascript:void(0)">

      <img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >
      <!--<img src="' . $BaseUrl . '/images/thesharepage.png" alt="logo" style="height: 60px;width: 160px;margin-top: 5px;margin-left: 80px;" class="img-responsive" >-->


      </a>

      <h1>The SharePage</h1>
      </td>
      </tr>

      <tr>
      <td class="letstart" style="background:#3e2048">
      <p><b>INVITE FRIENDS TO THE SHAREPAGE</b></p>
      </td>
      </tr>
      <tr>


      <td>

      <p class="left-margin" style=" text-transform: capitalize;">Hey ' . ucfirst(strtolower($userName)) . ',</p>

      <p class="left-margin" style="font-weight: bold;color: #6c085b;">
      <b style="    font-weight: 100;color: grey;"> ' . $message . ' </b></p>
      <p class="left-margin" >Regards,<br>
      The SharePage Team<br>
      www.TheSharePage.com<br></p>


      </td>
      </tr>
      <tr>
      <td  align="center" class="foot">
      <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
      </td>
      </tr>
      </tbody>

      </table>
      <div style="width: 640px;text-align: center;margin: 0 auto;font-size: 13px;">
      <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

      <div style="font-size: 13px;">
      <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
      </div>
      </div>

      </body>
      </html>

      ';
    $this->send_all_email($email, $subject, $msg);
  }

  function share_weblink_email($email, $message, $subject)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $link = $BaseUrl . "/authentication/activate.php?me=" . $uid . "&email=" . $email . "&username=" . $userName;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #032350;


      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #032350;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }



    table {
      border-collapse: collapse;
      border: 2px solid black;
      margin-left:10px;
      margin-right:10px;

    }

    table td {
      border: 2px solid black;

    }

    .row > div {
      margin-top:10px;
      margin-left:10px;
      margin-right:10px;
      flex: 1;
      border: 1px solid grey;
    }
    .left-margin{

      margin-left:10px;

    }
    .btnhover:hover{
      color:white!important;

    }
    .btnhover{
      color:#fff!important;
    }
    .tablecontent{
      padding-left: 10px;
      padding-right: 10px;
      text-align: justify;

    }
    .paracontent{
      padding-left: 10px;
      padding-right: 10px;
      padding-bottom: 10px;
      padding-top: 10px;
      text-align: justify;

    }
    p b{
      margin-left: 10px;
    }
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="javascript:void(0)">

    <img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >
    <!--<img src="' . $BaseUrl . '/images/thesharepage.png" alt="logo" style="height: 60px;width: 160px;margin-top: 5px;margin-left: 80px;" class="img-responsive" >-->


    </a><h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="color:#3e2048">
    <td class="letstart" style="padding: 0px;" style="color:#3e2048">
    <p><b>BUSINESS SPACE ON THE SHAREPAGE<b></p>
    </td>
    </tr>
    <tr>


    <td>

    <!-- <p class="left-margin" style=" text-transform: capitalize;">' . ucfirst(strtolower($userName)) . ',</p>-->

    <p class="left-margin" style="font-weight: bold;color: #6c085b;">
    <b style="    font-weight: 100;color: grey;"> ' . $message . ' </b></p>
    <p class="left-margin" >Regards,<br>
    The SharePage<br> 
    www.TheSharePage.com 
    <br></p>


    </td>
    </tr>
    <tr>
    <td  align="center" class="foot">
    <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
    </td>
    </tr>
    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto;font-size: 13px;">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div style="font-size: 13px;">
    <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
    </div>
    </div>

    </body>
    </html>

    ';


    //  $subject = "Invite To Join TheSharePage";  
    //echo $msg;die("===============");
    $this->send_all_email($email, $subject, $msg);
  }


  function send_email_d($email, $name, $quantity, $address, $logo, $c_name, $c_phone, $paragraph1, $paragraph2, $subject)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="font-family:arial, "helvetica neue", helvetica, sans-serif">
      <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta name="x-apple-disable-message-reformatting">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="telephone=no" name="format-detection">
      <title>New email template 2022-11-06</title>
      <style type="text/css">
      /* cyrillic-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xFIzIFKw.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xMIzIFKw.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xEIzIFKw.woff2) format("woff2");
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xLIzIFKw.woff2) format("woff2");
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xHIzIFKw.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xGIzIFKw.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xIIzI.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic3CsTKlA.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic-CsTKlA.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic2CsTKlA.woff2) format("woff2");
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic5CsTKlA.woff2) format("woff2");
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic1CsTKlA.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic0CsTKlA.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic6CsQ.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu72xKOzY.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu5mxKOzY.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu7mxKOzY.woff2) format("woff2");
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu4WxKOzY.woff2) format("woff2");
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu7WxKOzY.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu7GxKOzY.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu4mxK.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfCRc4EsA.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfABc4EsA.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* greek-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfCBc4EsA.woff2) format("woff2");
        unicode-range: U+1F00-1FFF;
      }
      /* greek */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfBxc4EsA.woff2) format("woff2");
        unicode-range: U+0370-03FF;
      }
      /* vietnamese */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfCxc4EsA.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfChc4EsA.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfBBc4.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      /* cyrillic-ext 2222222222222222*/
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* vietnamese */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      /* cyrillic-ext */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format("woff2");
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
      }
      /* cyrillic */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format("woff2");
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
      }
      /* vietnamese */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format("woff2");
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
      }
      /* latin-ext */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format("woff2");
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
      }
      /* latin */
      @font-face {
        font-family: "Montserrat";
        font-style: normal;
        font-weight: 800;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format("woff2");
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
      }
      .rollover div {
        font-size:0;
      }
    #outlook a {
      padding:0;
    }
    .es-button {
      mso-style-priority:100!important;
      text-decoration:none!important;
    }
    a[x-apple-data-detectors] {
      color:inherit!important;
      text-decoration:none!important;
      font-size:inherit!important;
      font-family:inherit!important;
      font-weight:inherit!important;
      line-height:inherit!important;
    }
    .es-desk-hidden {
      display:none;
      float:left;
      overflow:hidden;
      width:0;
      max-height:0;
      line-height:0;
      mso-hide:all;
    }
    [data-ogsb] .es-button {
      border-width:0!important;
      padding:15px 30px 15px 30px!important;
    }
    @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:30px!important; text-align:left } h2 { font-size:24px!important; text-align:left } h3 { font-size:20px!important; text-align:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important; text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:24px!important; text-align:left } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important; text-align:left } .es-menu td a { font-size:12px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:12px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:18px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
    </style>  
    </head>
    <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <div class="es-wrapper-color" style="background-color:#ECE4E4"><!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
    <v:fill type="tile" color="#ece4e4"></v:fill>
    </v:background>
    <![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#ECE4E4">
    <tr>
    <td valign="top" style="padding:0;Margin:0">
    <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
    <tr>
    <td align="center" style="padding:0;Margin:0">
    <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#2A3C51;width:600px">

    <!-----<tr>
    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-image:url(' . $BaseUrl . '/images/topbar.png);background-repeat:no-repeat;background-position:left top" background="images/topbar.png">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;line-height:18px;color:#000000;font-size:12px"><a style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#000000;font-size:12px" href="#">View online</a></p></td>  
    </tr>
    <tr>
    <td align="center" height="20" style="padding:0;Margin:0"></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    <tr>-->
    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:180px" valign="top"><![endif]-->
    <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
    <tr>
    <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:180px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:0;Margin:0;font-size:0px">';
    if ($logo) {
      $msg .= '<img class="adapt-img" src="' . $BaseUrl . '/store/pos-dashboard/upload_pos/' . $logo . '" alt style="display:block;border:0;outline:none;text-decoration:none;width:100px;height:100px;margin-top: 30px;">';
    } else {
      $msg .= '<img class="adapt-img" src="' . $BaseUrl . '/assets/images/logo/tsplogo.PNG" alt style="display:block;border:0;outline:none;text-decoration:none;width:100px;height:100px;margin-top: 30px;">';
    }
    $msg .= '</td>
    </tr>
    </table></td>
    </tr>
    </table><!--[if mso]></td><td style="width:20px"></td><td style="width:360px" valign="top"><![endif]-->
    <table cellpadding="0" cellspacing="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="left" style="padding:0;Margin:0;width:360px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:20px;Margin:0;font-size:0">
    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
    </tr>
    </table></td>
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0">
    <p style="color:white;"><strong><span style="font-size:20px;font-family:roboto, "helvetica neue", helvetica, arial, sans-serif">' . $c_name . '</span></strong><br>' . $address . '<br>' . $c_phone . '</p></td>
    </tr>
    <tr>
    <td align="center" style="padding:20px;Margin:0;font-size:0">
    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table><!--[if mso]></td></tr></table><![endif]--></td>
    </tr>


    <tr>
    <td align="left" style="Margin:0">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td style="padding:0;Margin:0">
    <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <!--<tr class="links">
    <td align="center" valign="top" width="25%" id="esd-menu-id-0" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="https://thesharepage.com" style="text-decoration: none;
    display: block;
    color: #FFFFFF;
    font-size: 12px;">Home</a></td>
    <td align="center" valign="top" width="25%" id="esd-menu-id-1" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="https://thesharepage.com/login.php" style="text-decoration: none;
    display: block;
    color: #FFFFFF;
    font-size: 12px;">Login</a></td>
    <td align="center" valign="top" width="25%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="https://dev.thesharepage.com/timeline/" style="text-decoration: none;
    display: block;
    color: #FFFFFF;
    font-size: 12px;">Timeline</a></td>
    <td align="center" valign="top" width="25%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0"><a target="_blank" href="https://thesharepage.com/contact.php" style="text-decoration: none;
    display: block;
    color: #FFFFFF;
    font-size: 12px;">Contact</a></td>
    </tr>-->
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
    <tr>
    <td align="center" style="padding:0;Margin:0">
    <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
    <tr>
    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>

    <td align="center" style="padding:0;Margin:0;font-size:0px"><a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration: none;color:#2A3C51;font-size:14px">
    <!-- <img src="' . $BaseUrl . '/images/untitled1.png" alt="Giving tuesday" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="265" title="Giving tuesday">-->
    <h1>Welcome to the ' . $c_name . '</h1>
    </a></td>
    </tr>
    <tr>
    <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:15px"><h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#2A3C51">Hello ' . $name . ',</h1></td>
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:30px">
    <!--<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;line-height:21px;color:#2A3C51;font-size:14px">You are receiving this email because you are a customer of TheSharePage. <br>This is to notify you that we have added your account in our business page on The SharePage website ( SharePage website)<br>You can now login to the SharePage and view your account balances as well as all transactions from our store!</p>-->
    <p>' . $paragraph1 . '</p>
    </td>
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0"><!--[if mso]><a href="thesharepage.com" target="_blank" hidden>
    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="thesharepage.com" 
    style="height:51px; v-text-anchor:middle; width:245px" arcsize="50%" stroke="f"  fillcolor="#f1c232">
    <w:anchorlock></w:anchorlock>
    <center style="color:#ffffff; font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px">Login to SharePage</center>
    </v:roundrect></a>
    <![endif]--><!--[if !mso]><!-- -->
    <!--<span class="msohide es-button-border" style="border-style:solid;border-color:#2CB543;background:#f1c232;border-width:0px;display:inline-block;border-radius:30px;width:auto;mso-hide:all">
    <a  href="thesharepage.com" class="es-button" target="_blank" style="color: #FFFFFF;
    font-size: 18px;
    border-style: solid;
    border-color: #f1c232;
    border-width: 11px 30px 15px 30px;
    display: inline-block;
    background: #f1c232;
    border-radius: 30px;">Login to SharePage</a></span>--><!--<![endif]--></td>
    </tr>
    </table></td>
    </tr>
    <tr>
    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:0px">
    <h1 style="font-size:30px;color:#2A3C51;margin-top:-50px!important;">Your current balance is : ' . $quantity . '</h1></td>
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:30px">
    <!-- <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;line-height:21px;color:#2A3C51;font-size:14px">&nbsp;How to view your account:<br>1. To view your account balance you will have to login to your account on the SharePage. (link)<br>2. Go to store module<br>3 go to the dashboard<br>4. Go to the subscription page from the menu<br>5. Select company and click on view And the account balances as well as transactions will show.<br>Thanks for your business!<br>Regards,<br>Admin<br>TheSharePage<br>(' ./*$address.*/ ' )</p>-->
    <p>' . $paragraph2 . '<br>Thanks for your business!<br>Regards,<br>Admin<br>TheSharePage<br>( ' . $address . ' )</p>
    </td> 
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0"><!--[if mso]><a href="thesharepage.com" target="_blank" hidden>
    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="thesharepage.com" 
    style="height:51px; v-text-anchor:middle; width:180px" arcsize="50%" stroke="f"  fillcolor="#f1c232">
    <w:anchorlock></w:anchorlock>
    <center style="color:#ffffff; font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px">Visit to Login</center>
    </v:roundrect></a>
    <![endif]--><!--[if !mso]><!-- --><span class="msohide es-button-border" style="border-style:solid;border-color:#2CB543;background:#f1c232;border-width:0px;display:inline-block;border-radius:30px;width:auto;mso-hide:all"><a href="thesharepage.com" class="es-button" target="_blank" style="color: #FFFFFF;
    font-size: 18px;
    color:black;
    border-style: solid;
    border-color: #f1c232;
    border-width: 15px 30px 15px 30px;
    display: inline-block;
    background: #f1c232;
    border-radius: 30px;">Login to your Account</a></span><!--<![endif]--></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
    <tr>
    <td align="center" style="padding:0;Margin:0">
    <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
    <tr>
    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#2a3c51" bgcolor="#2a3c51">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:0;Margin:0;padding-bottom:15px;font-size:0px"><img class="adapt-img" src="' . $BaseUrl . '/images/main_logo.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="220"></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
    <tr>
    <td align="center" style="padding:0;Margin:0">
    <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
    <tr>
    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:25px">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:25px"><h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333">Follow Us</h1></td>
    </tr>
    <tr>
    <td align="center" style="padding:0;Margin:0;font-size:0">
    <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>

    <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://facebook.com/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px"><img src="' . $BaseUrl . '/images/facebook-rounded-black.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
    <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://tiwtter.com/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px"><img src="' . $BaseUrl . '/images/twitter-rounded-black.png" alt="Tw" title="Twitter" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
    <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="https://instagram.com/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px"><img src="' . $BaseUrl . '/images/instagram-rounded-black.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
    <td align="center" valign="top" style="padding:0;Margin:0"><a target="_blank" href="https://youtube.com/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px"><img src="' . $BaseUrl . '/images/youtube-rounded-black.png" alt="Yt" title="Youtube" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    <tr>
    <td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="left" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Montserrat, "Google Sans", "Segoe UI", Roboto, Arial, Ubuntu, sans-serif;line-height:18px;color:#2A3C51;font-size:12px"><a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px">Privacy Policy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px">Terms of Use</a><br><br>No longer want to receive these emails?&nbsp;<a href="" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2A3C51;font-size:12px">Unsubscribe</a><br>661 Crystal Canyon, Skytop, Oregon</p></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
    <tr>
    <td class="es-info-area" align="center" style="padding:0;Margin:0">
    <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
    <tr>
    <td align="left" style="padding:20px;Margin:0">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="left" style="padding:0;Margin:0;width:560px">
    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    <tr>
    <td align="center" style="padding:0;Margin:0;display:none"></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table></td>  
    </tr>
    </table>
    </div>
    </body>
    </html>

    ';
    //$subject = "The SharePage Store Contact Information.";


    $this->send_all_email($email, $subject, $msg);
  }

  // public rfq email
  function send_publicrfq_email($sellerEmailid, $buyerEmailid, $spTitle, $sellerName, $buyerName, $idspRfq)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $link = $BaseUrl . "/store/dashboard/quotation_list.php?idspRfq=" . $idspRfq;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($buyerName)) . ',</p>

    </td>
    </tr>



    <tr>
    <td>
    <p>' . ucfirst(strtolower($sellerName)) . ' quote on your ' . ucfirst(strtolower($spTitle)) . ' product.</p>

    </td>
    </tr>

    <tr>
    <td>
    <a href="' . $link . '">See your quoted list</a>

    </td>
    </tr>
    <tr>
    <td>
    <P class="left-margin">Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </td>
    </tr>


    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';
    $subject = "The SharePage Public RFQ Information.";

    $this->send_all_email($buyerEmailid, $subject, $msg);
  }

  //new private email 
  function send_privaterfq_email($sellerEmailid, $buyerEmailid, $spTitle, $sellerName, $buyerName,$productlink, $buyerlink)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $link = $BaseUrl . "/store/dashboard/myprivate_rfq.php";

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>
    <tr style="color:#3e2048">
    <td class="letstart" style="color:#3e2048">
    <h1>PRIVATE RFQ REQUEST</h1>

    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($sellerName)) . ',</p>

    </td>
    </tr>



    <tr>
    <td>
    <p>Your product <a href="'.$productlink.'">' . ucfirst(strtolower($spTitle)) . '</a> quoted by <a href="'.$buyerlink.'"> ' . ucfirst(strtolower($buyerName)) . '</a>.</p>

    <!---<p>Your product ' . ucfirst(strtolower($spTitle)) . ' quoted by  ' . ucfirst(strtolower($buyerName)) . '</p>---->


    </td>
    </tr>

    <tr>
    <td>
    <a href="' . $link . '">See your quoted list</a>.

    </td>
    </tr>
    <tr>
    <td>
    <P class="left-margin">Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </td>
    </tr>


    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';
    $subject = "The SharePage [Private RFQ]";
    //echo $sellerEmailid;echo $msg; die("=============");
    $this->send_all_email($sellerEmailid, $subject, $msg);
  }

  function ip_details($ip) 
  {
    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details;
  }

  // SEND USER EMAIL WHEN USER REGISTERED
  function send_reg_email($email, $userName, $uid, $code, $additionalSubject = null)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $link = $BaseUrl . "/authentication/activate.php?me=" . $uid . "&active=" . $code . "&email=" . $email . "&username=" . $userName;
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $uc = new _city;
    $details = $this->ip_details("$ip");
    $country = $details->country; 
    $check_country = $uc->readCityName_country($country);
    if ($check_country) {
        $row_c = mysqli_fetch_assoc($check_country);
        $row_country = $row_c['countryname'];
    }
    $country = $row_country ?? "NA";
    $date_time = date("Y-m-d H:i:s") ;
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
        .mmaintab{
          background: #FFF;
          margin: 0 auto;
          padding: 15px;
          width: 640px;
        }
        .logo h1{
          color: #000;
          margin: 20px 0px 25px;;

        }
        .letstart{
          background: #032350;
          padding: 15px;
          font-size: 20px;
          color: #FFF;
          margin: 15px 0px;
          text-align: center;
        }
        .letstart h1{
          font-size: 20px;
          margin: 0px;
        }
        .btn{
          background: #032350;
          color: #FFF;
          padding: 8px 15px;
          display: inline-block;
          margin-bottom: 15px;
          text-decoration: none;
          margin-top: 15px;
        }
        .foot{
          border-top: 1px solid;
          text-align: center;

        }
        .foot p{
          margin: 0px;
          color: #808080;
          padding: 10px
        }



        table {
          border-collapse: collapse;
          border: 2px solid black;
          margin-left:10px;
          margin-right:10px;

        }

        table td {
          border: 2px solid black;

        }

        .row > div {
          margin-top:10px;
          margin-left:10px;
          margin-right:10px;
          flex: 1;
          border: 1px solid grey;
        }
        .left-margin{

          margin-left:10px;

        }
        .btnhover:hover{
          color:white!important;

        }
        .btnhover{
          color:#fff!important;
        }
        .tablecontent{
          padding-left: 10px;
          padding-right: 10px;
          text-align: justify;

        }
        .paracontent{
          padding-left: 10px;
          padding-right: 10px;
          padding-bottom: 10px;
          padding-top: 10px;
          text-align: justify;

        }

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
      <span>"' . $code . '"</span></p>
          
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
      <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
      </div>
      </div>

      </body>
      </html>
    ';

    $subject = "The SharePage [Registration Email Verification]";
    if($additionalSubject){
      $subject = $subject.$additionalSubject;
    }
    $this->send_all_email($email, $subject, $msg, 'registration@thesharepage.com', '', '','contact@thesharepage.com');
  }


  function send_reg_email_pos($email, $userName, $paragraph, $logo, $companyname)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $link = $BaseUrl . "/authentication/activate.php?me=" . $uid . "&email=" . $email . "&username=" . $userName;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #032350;

      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #032350;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }



    table {
      border-collapse: collapse;
      border: 2px solid black;
      margin-left:10px;
      margin-right:10px;

    }

    table td {
      border: 2px solid black;

    }

    .row > div {
      margin-top:10px;
      margin-left:10px;
      margin-right:10px;
      flex: 1;
      border: 1px solid grey;
    }
    .left-margin{

      margin-left:10px;

    }
    .btnhover:hover{
      color:white!important;

    }
    .btnhover{
      color:#fff!important;
    }
    .tablecontent{
      padding-left: 10px;
      padding-right: 10px;
      text-align: justify;

    }
    .paracontent{
      padding-left: 10px;
      padding-right: 10px;
      padding-bottom: 10px;
      padding-top: 10px;
      text-align: justify;

    }
    p b{
      margin-left: 10px;
    }
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="javascript:void(0)">';
    if ($logo) {
      $msg .= '<img src="' . $BaseUrl . '/store/pos-dashboard/upload_pos/' . $logo . '" alt="logo" style="height: 100px;width: 100px;margin-top: 5px;" class="img-responsive" > ';
    } else {
      $msg .= '<img src="' . $BaseUrl . '/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >';
    }



    $msg .=  ' </a>

    <!--<h1>The SharePage</h1>-->
    </td>
    </tr>

    <tr>
    <td class="letstart" >
    <h4>Welcome to the ' . $companyname . '</h4>
    </td>
    </tr>
    <tr>


    <td>

    <p class="left-margin" style=" text-transform: capitalize;">Hey ' . ucfirst(strtolower($userName)) . ',</p>

    <p class="left-margin" style="font-weight: bold;color: #6c085b;">
    <b style="    font-weight: 100;color: grey;"> ' . $paragraph . ' </b></p>
    <p class="left-margin" >Regards,</p>
    <p class="left-margin" >The SharePage</p>
    <p class="left-margin" >A solution for an ad-free site where you can actually get value for your time.</p>
    <p   style="min-height: 50px;"></p>

    </td>
    </tr>
    <tr>
    <td>
    <P class="left-margin">Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </td>
    </tr>
    <tr>
    <td  align="center" class="foot">
    <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
    </td>
    </tr>
    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto;font-size: 13px;">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div style="font-size: 13px;">
    <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
    </div>
    </div>

    </body>
    </html>

    ';
    $to = "info@thesharepage.com";
    $subject = $companyname . " [POS]";
    $this->send_all_email($email, $subject, $msg);
  }

  // second function create end //////////

  function send_welcome_email($message, $subject, $email, $userName, $uid = "", $code = "")
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    
    $msg = '<!DOCTYPE html>

      <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
      <head>
      <title></title>
      <meta charset="utf-8"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
      <!--[if !mso]><!-->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css"/>
      <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css"/>
      <!--<![endif]-->
      <style>
      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        padding: 0;
      }

      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: inherit !important;
      }

      #MessageViewBody a {
      color: inherit;
      text-decoration: none;
      }

      p {
        line-height: inherit
      }

      @media (max-width:700px) {
        .icons-inner {
          text-align: center;
        }

        .icons-inner td {
          margin: 0 auto;
        }

        .row-content {
          width: 100% !important;
        }

        .image_block img.big {
          width: auto !important;
        }

        .mobile_hide {
          display: none;
        }

        .stack .column {
          width: 100%;
          display: block;
        }

        .mobile_hide {
          min-height: 0;
          max-height: 0;
          max-width: 0;
          overflow: hidden;
          font-size: 0px;
        }
      }
      </style>
      </head>
      <body style="background-color: #ffffff; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
      <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #3e2048;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;padding-bottom:0px;text-align:center;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Company Logo" class="icon" height="64" src="' . $BaseUrl . '/images/logo_without_text.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6dcf9; background-position: center top;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <div class="spacer_block" style="height:35px;line-height:35px;font-size:1px;"> </div>
      <div class="spacer_block mobile_hide" style="height:35px;line-height:35px;font-size:1px;"> </div>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:20px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #3e2048; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 45px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Welcome to The SharePage</strong></h1>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:15px;padding-left:20px;padding-right:20px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 18px; color: #3e2048; line-height: 1.5; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px; mso-line-height-alt: 21px;"><span style="font-size:14px;">Hey ' . ucfirst(strtolower($userName)) . ', </span></p>
      <p style="margin: 0; font-size: 14px; mso-line-height-alt: 21px;">'.$message.'</p>
      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><span style="font-size:14px;"> </span></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="10" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td>
      <div align="center">
      <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://thesharepage.com/" style="height:50px;width:176px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#3E2048" fillcolor="#3e2048"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Verdana, sans-serif; font-size:14px"><![endif]--><a href="https://thesharepage.com/" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#3e2048;border-radius:5px;width:auto;border-top:1px solid #3E2048;border-right:1px solid #3E2048;border-bottom:1px solid #3E2048;border-left:1px solid #3E2048;padding-top:10px;padding-bottom:10px;font-family:Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:14px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 1.8; word-break: break-word; mso-line-height-alt: 29px;"><span data-mce-style="font-size: 14px; line-height: 25px;" style="font-size: 14px; line-height: 25px;">Visit The SharePage<br/></span></span></span></a>
      <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
      </div>
      </td>
      </tr>
      </table>
      <div class="spacer_block mobile_hide" style="height:35px;line-height:35px;font-size:1px;"> </div>
      <table border="0" cellpadding="0" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-left:10px;padding-right:10px;padding-top:10px;">
      <div align="center">
      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="60%">
      <tr>
      <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 5px solid #39427F;"><span> </span></td>
      </tr>
      </table>
      </div>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="width:100%;padding-right:0px;padding-left:0px;padding-bottom:35px;">
      <div align="center" style="line-height:10px"><img alt="social" class="big" src="' . $BaseUrl . '/images/people-network-social-media-3108155.jpg" style="display: block; height: auto; border: 0; width: 680px; max-width: 100%;" title="social" width="680"/></div>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <div class="spacer_block" style="height:35px;line-height:35px;font-size:1px;"> </div>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Hope" class="icon" height="64" src="' . $BaseUrl . '/images/stores.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Store</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Prayers" class="icon" height="64" src="' . $BaseUrl . '/images/freelancer.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Freelance</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Peace" class="icon" height="64" src="' . $BaseUrl . '/images/jobboard_icon.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Jobs</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/real-estate.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Real Estate</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/events_icon.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Events</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/art_gallery_icon.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Art & Craft</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Hope" class="icon" height="64" src="' . $BaseUrl . '/images/classified-ads.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Classified</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Prayers" class="icon" height="64" src="' . $BaseUrl . '/images/videos.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Videos</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Peace" class="icon" height="64" src="' . $BaseUrl . '/images/services.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Directory</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/news.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>News / Views</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/timeline512.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Timeline</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="16.666666666666668%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#000000;font-family:inherit;font-size:14px;text-align:center;padding-top:5px;">
      <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
      <tr>
      <td style="text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;"><img align="center" alt="Donation" class="icon" height="64" src="' . $BaseUrl . '/images/comingsoon100.png" style="display: block; height: auto; border: 0;" width="64"/></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-bottom:20px;padding-top:10px;text-align:center;width:100%;">
      <h1 style="margin: 0; color: #1c1c1c; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Coming Soon</strong></h1>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <div class="spacer_block" style="height:35px;line-height:35px;font-size:1px;"> </div>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #3e2048;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <div class="spacer_block" style="height:30px;line-height:30px;font-size:1px;"> </div>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #3e2048;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
      <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>About Us</strong></h1>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:15px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 24px; color: #ffffff; line-height: 2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;">Explore the opportunities that are waiting for you here and find out the hidden treasures within you...</p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
      <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>Links</strong></h1>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;"><a href="' . $BaseUrl . '/page/?page=privacy_policy" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Privacy Policy</a></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;"><a href="' . $BaseUrl . '/page/?page=copyrights" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Copyrights</a></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:15px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;"><a href="' . $BaseUrl . '/page/?page=investment_opportunities" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Investment Opportunities</a></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      </td>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
      <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
      <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>Contact</strong></h1>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;"><a href="' . $BaseUrl . '/contact" rel="noopener" style="text-decoration: none; color: #ffffff;" target="_blank">Get in Touch With US</a></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
      <tr>
      <td style="padding-bottom:15px;padding-left:20px;padding-right:20px;padding-top:10px;">
      <div style="font-family: sans-serif">
      <div style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: Lucida Sans Unicode, Lucida Grande, Lucida Sans, Geneva, Verdana, sans-serif;">
      <p style="margin: 0; font-size: 14px;"><a href="' . $BaseUrl . '/page/howtos.php?page=howtos" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Q AND A</a></p>
      </div>
      </div>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-9" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #3e2048;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <div class="spacer_block" style="height:15px;line-height:15px;font-size:1px;"> </div>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tbody>
      <tr>
      <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
      <tbody>
      <tr>
      <td class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
      <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;">
      <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
      <tr>
      <td style="text-align:center;"></td>
      </tr>
      </table>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table><!-- End -->
      </body>
      </html>
    ';
    $this->send_all_email($email, $subject, $msg, 'registration@thesharepage.com', '', '', 'registration@thesharepage.com');
  }


  //FORGET PASSWORD SEND TO THE USER LINK
  function forgotpass($name, $email, $link, $notification_description, $subject)
  {
      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
      $BaseUrl = $actual_link;
      $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #2F6230;
        padding: 15px;
        font-size: 20px;
        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #2F6230;
        color: #FFF!important;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{
        border-top: 1px solid;
        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }
      .no-margin{
        margin: 0px;
      }                   
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr> 
      <td align="center" class="logo" >
      <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
      <h1>The SharePage</h1>
      </td>
      </tr>

      <tr style="background:#3e2048">
      <td class="letstart" style="background:#3e2048">
      <h1>RESET PASSWORD</h1>
      </td>
      </tr>
      <tr>
      <td>
      <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

      <p>' . $notification_description . '</p>
      <p style="color:#808080">To reset your password, please click on the button below:</p>

      <a href="' . $link . '" class="btn" style="background:#3e2048">Reset Link</a>

      <p class="no-margin" style="color:#808080">Regards,<br>
      The SharePage Team<br>
      www.TheSharePage.com
      </p>
      <p></p>

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
    <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
    </div>
    </div>

    </body>
    </html>

    ';
    $this->send_all_email($email, $subject, $msg);
  }

  function login_emailotp($email, $randomnumber, $name, $subject)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #2F6230;
        padding: 15px;
        font-size: 20px;
        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #2F6230;
        color: #FFF!important;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{
        border-top: 1px solid;
        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }
      .no-margin{
        margin: 0px;
      }                   
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
      <h1>The SharePage</h1>
      </td>
      </tr>

      <tr style="background:#3e2048">
      <td class="letstart" style="background:#3e2048">
      <h1>CODE TO LOGIN</h1>
      </td>
      </tr>
      <tr>
      <td>
      <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

      <p> This is your code to login: <br><br> ' . $randomnumber . '</p>

      <p class="no-margin" >Regards,</p>
      The SharePage Team<br>
      www.TheSharePage.com<br>
      If you have not requested this email, please ignore this.
      </p>
      <p></p>

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
    <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
    </div>
    </div>

    </body>
    </html>

    ';

    $this->send_all_email($email, $subject, $msg);
  }




  function event_reminder($email_data, $event_id, $event_name, $username, $eventstartdate)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $notification_descrption = "We want to remind that your event<a href='$BaseUrl/events/event-detail.php?postid=$event_id'> ($event_name) </a> start date ($eventstartdate) ";

    $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title> The SharePage. </title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #2F6230;
        padding: 15px;
        font-size: 20px;
        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #2F6230;
        color: #FFF!important;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{
        border-top: 1px solid;
        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }
      .no-margin{
        margin: 0px;
      } 
      a{
        text-decoration:none;
      }                  
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a><h1>The SharePage</h1>
      </td>
      </tr>

      <tr style="background:#3e2048">
      <td class="letstart" style="background:#3e2048">
      <h1>EVENT REMINDER</h1>
      </td>
      </tr>
      <tr>
      <td>
      <p>Hi ' . ucfirst(strtolower($username)) . ',</p>

      <p>' . $notification_descrption . '</p>


      <p class="no-margin" >Regards,<br>
      The SharePage Team<br>
      www.TheSharePage.com
      <br></p>
      <p   style="min-height: 0px;"></p>

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
      <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
      </div>
      </div>

      </body>
      </html>
    ';

    $subject = "The SharePage [Event Reminder]";

    $this->send_all_email($email_data, $subject, $msg);
  }


  function mail_property($txtemail, $name, $link)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    '
    <!DOCTYPE html>
    <html>
    <head>
    <title> The SharePage. </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a><h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PROPERTY SHARED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi '.$username.',</p>

    <p>' . $notification_descrption . '<a href="' . $link . '/">Click here to view property</a></p>


    <p class="no-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com
    <br></p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage";

  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($txtemail, $subject, $msg, "noreply@thesharepage.com");
  }

  function sendeventbooked($name, $posteduseremail, $eventname, $bokkedbyname, $qty, $totalprice)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #f15c80;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #f15c80;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="color:#3e2048">
    <td class="letstart" style="color:#3e2048">
    <h1>EVENT BOOKED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>Your Event has been booked.</p>
    <br>

    <p><label>Event : </label>' . ucfirst($eventname) . '</p>
    <p><label>Booked By : </label>' . ucfirst($bokkedbyname) . '</p>
    <p><label>Quantity : </label>' . $qty . '</p>
    <p><label>Total : </label>$' . $totalprice . '</p>



    <p class="no-margin" >Regards,</p>
    The SharePage Team<br>
    www.TheSharePage.com
    <br></p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Event Booked]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }


  function sendeventbookednew($name, $posteduseremail, $eventname, $bokkedbyname, $qty, $totalprice, $emailtext, $notification_description, $subject)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #f15c80;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #f15c80;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="color:#3e2048">
    <td class="letstart" style="color:#3e2048">
    <h1>EVENT BOOKED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>' . $notification_description . '</p>
    <br>

    <p><label>Event : </label>' . ucfirst($eventname) . '</p>
    <p><label>Booked By : </label>' . ucfirst($bokkedbyname) . '</p>
    <p><label>Quantity : </label>' . $qty . '</p>
    <p><label>Total : </label>$' . $totalprice . '</p>
    </td>
    </tr> 
    <tr>
    <td>' . $emailtext . '</td>
    </tr>

    <tr>
    <td>
    <p class="no-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com
    <br></p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  // $subject = "The SharePage [Event Booked]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }

  function sendgroupeventbooked($name, $posteduseremail, $eventname, $bokkedbyname, $qty, $totalprice)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;


    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #f15c80;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #f15c80;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>EVENT BOOKED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>Your Event has been booked.</p>
    <br>

    <p><label>Event : </label>' . ucfirst($eventname) . '</p>
    <p><label>Booked By : </label>' . ucfirst($bokkedbyname) . '</p>
    <p><label>Quantity : </label>' . $qty . '</p>
    <p><label>Total : </label>$' . $totalprice . '</p>



    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Group Event Booked]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }

  function sendproductsold($posteduseremail, $spname, $product_title,$orderQty,$total_pricemail,$postid)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PRODUCT SOLD</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($spname)) . ',</p>

    <p>Your Product ' . ucfirst($product_title) . ' has Been sold.<br>Please login to <a href="' . $BaseUrl . '" style="color: ##3338d4;"> The SharePage</a> to see details.</p>
    <p>Product Name: <a href="'. $BaseUrl.'/store/detail.php?postid= '.$postid. '" style="font-size: 21px; margin-left: -6px;"> ' . ucfirst($product_title). '</a></p>

    </p>
    <p>Product Quantity:  ' . $orderQty . '</p>
    <p>Product Price:  ' . $total_pricemail . '</p>
    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';
  //echo $posteduseremail; echo $msg;echo $postid;//die("-==========");
  $subject = "The SharePage [Product Sold]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }


  function sendproductsold_customer( $posteduseremail,$customerFname,$product_title,$orderQty,$total_pricemail,$postid)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>ORDER PLACED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($customerFname)) . ',</p>


    <p>You have successfully placed order for ' . ucfirst($product_title) . ' .<br><br> Please login to <a href="' . $BaseUrl . '" style="color: ##3338d4;"> The SharePage</a> to see details.</p>


    <p>Product Name: <a href="'. $BaseUrl.'/store/detail.php?postid= '.$postid. '" style="font-size: 21px; margin-left: -6px;">'. ucfirst($product_title). '</a></p>

    </p>
    <p>Product Quantity:  ' . $orderQty . ' </p>
    <p>Product Price:   ' . $total_pricemail . ' </p>
    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';
  // echo $msg;
  // echo $posteduseremail;
  // die("-==========");
  $subject = "The SharePage [Order Placed]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }


  function sendhire($name, $posteduseremail)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>HIRED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

  <p>You got a direct hiring!.Please login to <a href="' . $BaseUrl . '/freelancer/dashboard/freelancer_requested_project.php" style="color: ##3338d4;"> The SharePage</a> to see detail</p>


  <p class="no-margin" >Regards,</p>
  <p class="no-margin" >The SharePage Team</p>
  <p class="no-margin" >www.TheSharePage.com</p>
  <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Hired by Employer]";

  // $this->send_all_email($posteduseremail, $subject, $msg);
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  }

  function sendaward($name, $posteduseremail, $project_name)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PROJECT AWARDED! : ' . ucfirst($project_name) . '</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>
  <p>Congratulations! You have won the project! <br>Please login to <a href="' . $BaseUrl . '/freelancer/dashboard/freelancer_requested_project.php" style="color: ##3338d4;"> The SharePage</a> to see the details of the project,and start your project.<br>All the best!</p>
  <p class="no-margin" >Regards,</p>
  <p class="no-margin" >The SharePage Team</p>
  <p class="no-margin" >www.TheSharePage.com</p>
  <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Project Awarded]";
  // NOREPLY EMAIL - FROM ALL NOTIFICATIONS
  $this->send_all_email($posteduseremail, $subject, $msg, "noreply@thesharepage.com");
  /*$this->send_all_email($posteduseremail, $subject, $msg);*/
  }



  function sendmilestonecreated($name, $posteduseremail, $link)
  {


    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;


    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px; 
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>MILESTONE</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>New Milestone created!.<a href="' . $link . '">Click here to see detail</a></p>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Milestone Created]";
  $this->send_all_email($posteduseremail, $subject, $msg);
  /*$this->send_all_email($posteduseremail, $subject, $msg);*/
  }

  function sendprojectpostacept($name, $posteduseremail, $link, $project_name)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PROJECT :' ." ". ucfirst($project_name) . '</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p> ' . $link . '</p>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Freelancer project Accepted]";
  $this->send_all_email($posteduseremail, $subject, $msg);
  /*$this->send_all_email($posteduseremail, $subject, $msg);*/
  }

  function sendrealstateenquery($name, $posteduseremail, $link)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '<!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>REAL ESTATE</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p> ' . $link . '</p>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  //print_r($posteduseremail);
  //echo $msg;die("===========");

  $subject = "The SharePage [Enquiry]";
  $this->send_all_email($posteduseremail, $subject, $msg);
  /*$this->send_all_email($posteduseremail, $subject, $msg);*/
  }

  function sendproductplaced($name, $posteduseremail)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>ORDER PLACED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>Your product placed  successfully for more detail.<br><br> Login to <a href="' . $BaseUrl . '" style="color: ##3338d4;"> The SharePage.</a>.</p>
    <br>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Product Booked]";
  $this->send_all_email($posteduseremail, $subject, $msg);
  }




  function bussiness_send_mail($message,$name, $posteduseremail, $enqu, $custemail,$phone)
  {



    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>ENQUIRY BUSINESS SPACE</h1>
    </td>
    </tr>
    <tr>
    <td class="no-margin" style="padding-top:5px;padding-bottom:10px;">
    <p>Hi '.$name.',</p>
    </td>
    </tr>
    <tr>
    <td>
    <p>' . $message . '</p>

    <p>Name: ' . ucfirst(strtolower($name)) . '</p>

    <p>Enquiry message: ' . $enqu . '</p>
    <p>Email: ' . $custemail . '</p>

    <p>Phone No: ' . $phone . '</p>


    <br>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 10px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  //print_r($posteduseremail);
  //$subject = 'Enquiry from Business Space :';
  //$this->send_all_email($posteduseremail, $subject, $msg);

  //print_r($posteduseremail);die("=========23455");
  //echo $msg;die("====fdffddffd====");
  $subject = 'The SharePage [Enquiry Business Space ]';
  $this->send_all_email($posteduseremail,$subject, $msg);
  }





  function reset_send_mail($name, $posteduseremail,$heading,$subject)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PASSWORD CHANGED SUCCESSFULLY</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hello ' . ucfirst(strtolower($name)) . ',</p>
    </td>
    </tr>
    <tr>
    <td>
    <p>' . $heading . '</p>

    <br>

    <p class="no-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com
    </p>
    <p></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  //print_r($posteduseremail);die("=========23455");
  //echo $msg;die("========");
  $subjects =  ucfirst(strtolower($subject));

  $this->send_all_email($posteduseremail,$subjects, $msg);
  }





  function send_newsletter_mail($email, $subject,$message,$template_id,$user_id)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }


      input[type="text"] {
      display: none !important;
  }

    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;" >
    <h1>The SharePage</h1>
    </td>
    </tr>
    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>'. $subject .'</h1>
    </td>
    </tr>
    
    <tr>
    <td>
    <p>'.$message.'</p>

    <br>

    <p class="no-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com
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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>&emsp;|
  <a href="'.$BaseUrl.'/unsubscribe.php?email='.$email.'&template_id='.$template_id.'&user_id='.$user_id.'">Click here to Unsubscribe</a>
  </div>
  </div>

  </body>
  </html>

  ';

  //print_r($posteduseremail);die("=========23455");
  $msg= str_replace("<input","<span",$msg);

  $subjects =  ucfirst(strtolower($subject));

  $this->send_all_email($email,$subjects, $msg);
  }
  
  function sendmybookedticket($name, $email, $link)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>EVENT BOOKED</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>You have requested to reset your password on <a href="' . $BaseUrl . '/">The SharePage</a></p>
    <a href="' . $link . '" class="btn" style="background:#3e2048">RESET LINK</a>

    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $subject = "The SharePage [Event Booked]";

  $this->send_all_email($email, $subject, $msg);
  }



  // ===END
  // UPDATE PASSWORD EMAIL SEND TO THE USERS
  function update_password_email($name, $email, $password, $notification_description, $subject)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >

    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>


    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>CHANGED PASSWORD</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>' . $notification_description . '<a href="' . $BaseUrl . '/">The SharePage</a></p>

    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';
  // $subject = "The SharePage [Security alert]";


  $subject = "The SharePage [Forgot Password]";
  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);

  }


  function pos_password_email($name, $email, $password)
  { 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '<!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >


    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>


    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>PASSWORD</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hi ' . ucfirst(strtolower($name)) . ',</p>

    <p>Your Password is<b> ' . $password . '</b>.<br><br> Please login to <a href="' . $BaseUrl . '">The SharePage</a> with this password. </p>



    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';
  $subject = "The SharePage [Security alert]";

  //echo $msg;die('=====================');
  $subject = "The SharePage [Password]";
  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);


  }





  function send_mail_onid_email($name, $email, $id)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>


    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>DEAR CUSTOMER</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hi ' . ucfirst(strtolower($name)) . ',</p>


    <p> Please Click on  Link to  <a href="' . $BaseUrl . '/pos_payment/pos_payment_request.php?id=' . $id . '">make payment.</a></p>      
    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';
  $subject = "The SharePage [Security alert]";


  $subject = "The SharePage [Payment]";
  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);

  }


  function send_mail_onid_email_code($name, $email, $id)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg ='
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>


    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>DEAR CUSTOMER</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hi ' . ucfirst(strtolower($name)) . ',</p>


    <p>Here is the code ' . $id . '</p>    
    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';
  $subject = "The SharePage [Security alert]";


  $subject = "The SharePage [Payment Code]";
  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);

  }

  function pos_forgot_pass_email($email, $ranad)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>  


    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>RESET PASSWORD</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hi '.$name.',</p>

    <p>You have sent a request because you forgot your POS password.<br>Please click on  link to  <a href="' . $BaseUrl . '/pos_forgot_password.php?email=' . $email . '&rand=' . $ranad . '">reset POS password.</a></p>

    <p class="no-margin" >Thanks,</p>
    <p class="no-margin" >Regards</p>
    <p class="no-margin" >The SharePage</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p>

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';
  $subject = "The SharePage [Security alert]";


  $subject = "The SharePage [Pos Forgot Password]";
  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);

  }


  function course_request_email($subject,$message,$email, $modulename)
  {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;
    $msg ='
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" ><a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/thesharepage.png" alt="The SharePage" title="Logo" style="margin-left:127px; width: 230px;" height:230px;></a>  



    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048">
    <td class="letstart" style="background:#3e2048">
    <h1>NEW ENQUIRY ' . $modulename . ' - The SharePage</h1>
    </td>
    </tr>
    <tr>
    <td>
    <p style="text-transform: capitalize;" >Hello '.$name.',</p>

    <p>'.$message.'<a href="' . $BaseUrl . '/">The SharePage</a></p>

    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
    <p style="margin-bottom: 10px;">© Copyright' . date('Y') . ' The SharePage. All rights reserved.</p> 

    <div >
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>
  ';

  $this->send_all_email($email, $subject, $msg);
  // $this->send_all_email($to, $subject, $msg);

  }



  function refund_mail_send($subject,$message,$email,$profilename,$link)
  {

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg =  '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;

      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048;">
    <td class="letstart" style="background:#3e2048">
    <p><b>NEW TICKET CANCELLATION REQUEST</b></p>
    </td>
    </tr>
    <tr>

    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($profilename)) . ',</p>

    </td>
    </tr>
    <tr>
    <td>


    '.$message.' <a href="'.$link.'">click here</a> to view.
    </td>
    </tr>
    <tr>
    <td>
    <p class="left-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </p>
    </td>
    </tr>


    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';




    // echo $msg;
    // echo $email;
    // die("+=======");
    $this->send_all_email($email, $subject, $msg );
  }





  function sendemailplacebid($subject,$message,$posteduseremail,$spprofileName,$spPostingTitle,$freelancer_name,$bidlink,$Nlink)
  {


    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;


    $logo = '' . $BaseUrl . '/assets/images/logo/tsp_trans.png';
    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #0b241e;
      padding: 15px;
      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #0b241e;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <img  alt="The SharePage" src="' . $logo . '" style="width: 100px;">
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048;">
    <td class="letstart" style="background:#3e2048;">
    <h1>NEW BID: '. $spPostingTitle .' </h1>
    </td>
    </tr>
    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($spprofileName)) . ',</p>

    <p>'.$message.' By Freelancer <a href="'  . $Nlink .  '">'.$freelancer_name.'</a> .  <a href="' . $bidlink . '">Click Here </a>to See Details</p>


    <p class="no-margin" >Regards,</p>
    <p class="no-margin" >The SharePage Team</p>
    <p class="no-margin" >www.TheSharePage.com</p>
    <p   style="min-height: 0px;"></p>

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
  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
  </div>
  </div>

  </body>
  </html>

  ';

  $this->send_all_email($posteduseremail, $subject, $msg);
  /*$this->send_all_email($posteduseremail, $subject, $msg);*/

  }

  function send_newsletter($email)
  {

    $name="shubham";
    $message="message";
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $BaseUrl = $actual_link;

    $msg = '
    <!DOCTYPE html>
    <html>
    <head>
    <title>The SharePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
    .mmaintab{
      background: #FFF;
      margin: 0 auto;
      padding: 15px;
      width: 640px;
    }
    .logo h1{
      color: #000;
      margin: 20px 0px 25px;;

    }
    .letstart{
      background: #2F6230;

      font-size: 20px;
      color: #FFF;
      margin: 15px 0px;
      text-align: center;
    }
    .letstart h1{
      font-size: 20px;
      margin: 0px;
    }
    .btn{
      background: #2F6230;
      color: #FFF!important;
      padding: 8px 15px;
      display: inline-block;
      margin-bottom: 15px;
      text-decoration: none;
      margin-top: 15px;
    }
    .foot{
      border-top: 1px solid;
      text-align: center;

    }
    .foot p{
      margin: 0px;
      color: #808080;
      padding: 10px
    }
    .no-margin{
      margin: 0px;
    }                   
    </style>
    </head>
    <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
    <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td align="center" class="logo" >
    <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
    <h1>The SharePage</h1>
    </td>
    </tr>

    <tr style="background:#3e2048;">
    <td class="letstart" style="background:#3e2048;">
    <p><b>TICKET CANCELLATION ACTION TAKEN</b></p>
    </td>
    </tr>
    <tr>

    <tr>
    <td>
    <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

    </td>
    </tr>
    <tr>
    <td>
    <p>' . $message. '</p>

    </td>
    </tr>


    <tr>
    <td>
    <p class="left-margin" >Regards,<br>
    The SharePage Team<br>
    www.TheSharePage.com<br>
    </p>
    </td>
    </tr>


    </tbody>

    </table>
    <div style="width: 640px;text-align: center;margin: 0 auto">
    <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>

    </div>

    </body>
    </html>

    ';




    $subject = "The SharePage [Ticket Cancellation Action]";
    //echo $msg;die("+=======");
    $this->send_all_email($email, $subject, $msg);
    }

    function withdraw_emailotp($email, $randomnumber, $name, $subject)
    {

      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
      $BaseUrl = $actual_link;
      $msg = '
      <!DOCTYPE html>
      <html>
      <head>
      <title>The SharePage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      <style type="text/css">
      .mmaintab{
        background: #FFF;
        margin: 0 auto;
        padding: 15px;
        width: 640px;
      }
      .logo h1{
        color: #000;
        margin: 20px 0px 25px;;

      }
      .letstart{
        background: #2F6230;
        padding: 15px;
        font-size: 20px;
        color: #FFF;
        margin: 15px 0px;
        text-align: center;
      }
      .letstart h1{
        font-size: 20px;
        margin: 0px;
      }
      .btn{
        background: #2F6230;
        color: #FFF!important;
        padding: 8px 15px;
        display: inline-block;
        margin-bottom: 15px;
        text-decoration: none;
        margin-top: 15px;
      }
      .foot{
        border-top: 1px solid;
        text-align: center;

      }
      .foot p{
        margin: 0px;
        color: #808080;
        padding: 10px
      }
      .no-margin{
        margin: 0px;
      }                   
      </style>
      </head>
      <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
      <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td align="center" class="logo" >
      <a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
      <h1>The SharePage</h1>
      </td>
      </tr>

      <tr style="background:#3e2048">
      <td class="letstart" style="background:#3e2048">
      <h1>CODE TO LOGIN</h1>
      </td>
      </tr>
      <tr>
      <td>
      <p>Hi ' . ucfirst(strtolower($name)) . ',</p>

      <p> This is your withdrawalrequest emailverfication code: <br><br> ' . $randomnumber . '</p>

      <p class="no-margin" >Regards,</p>
      The SharePage Team<br>
      www.TheSharePage.com<br>
      If you have not requested this email, please ignore this.
      </p>
      <p></p>

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
    <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
    </div>
    </div>

    </body>
    </html>

    ';

    $this->send_all_email($email, $subject, $msg);
  }

}