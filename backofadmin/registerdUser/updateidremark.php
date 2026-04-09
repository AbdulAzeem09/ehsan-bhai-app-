<?php
	
require_once '../library/config.php';
require_once '../library/functions.php';



/*	if (!defined('WEB_ROOT')) {
		exit;
	}*/
	

//print_r($_POST);
$identityid=$_POST['identityid'];
$remark=$_POST['remark'];


$update_sql = "UPDATE useridentity SET status='2',remark='$remark' WHERE id= '$identityid'";

//print_r($update_sql);exit;
	$result = dbQuery($dbConn, $update_sql);


	if($result){


     /*   $msg = '
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
                                    <a href="https://thesharepage.com/"><img src="https://thesharepage.com/assets/images/logo/logo.png" alt="The SharePage" style="width: 100px;"></a>
                                    <h1>The SharePage</h1>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="letstart" >
                                    <h1>Reset Password</h1>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Hi '.ucfirst(strtolower($name)).',</p>
                                    
                                    <p>You have requested to reset your password on <a href="https://thesharepage.com/">The SharePage</a></p>
                                    <a href="'.$link.'" class="btn">Reset Link</a>

                                    <p class="no-margin" >Regards,</p>
                                    <p class="no-margin" >The SharePage</p>
                                    <p class="no-margin" >A solution for an ad-free site where you can actually get value for your time.</p>
                                    <p   style="min-height: 50px;"></p>

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
                            <a href="https://thesharepage.com/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="https://thesharepage.com/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
                        </div>
                    </div>

                </body>
            </html>

        ';
        
        $subject = "The SharePage [Account Verification]";
        //$to = "adnanghouri97@gmail.com";
        $this->send_all_email($email, $subject, $msg);*/
   
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] ="Remark Added Successfully.";

	}else{

        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] ="Something went wrong.";
	
	}

	
redirect('index.php?view=vaccount');
 //print_r($result);
/*if ($result = $con -> query($update_sql)) {

   // print_r($result);
  $row = $result -> fetch_row(); 

  print_r($row);
*/
  
   





	

	//while($row = dbFetchAssoc($result)) {
        

        ?>
