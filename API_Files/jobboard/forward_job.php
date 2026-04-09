<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$txtemail = $_POST['txtemail'];
$postid = $_POST['postid'];
$txtlink =  $BaseUrl.'/job-board/job-detail.php?postid='.$postid;
 

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if(!empty($txtemail)){
           
     
$em = new _email; 


  $email_to =  $_POST['txtemail'];
  $subj = "The SharePage";

  $message = '
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
            .logo img{
              height: 100px;

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
                      <a href="javascript:void(0)"><img src="'.$BaseUrl.'/assets/images/logo/logo.png" alt="The SharePage" style=""></a>
                      <h1>The SharePage</h1>
                  </td>
                </tr>
                
                <tr>
                  <td class="letstart" >
                    <h1>Job Request</h1>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Hi,</p>
                    
                <p>You are receiving this mail because your friend has invite you.</p>
                <p>See More Details click on link</p>
                <a href="'.$txtlink.'" class="btn">Visit Website</a>
                    <p class="no-margin" >Regards,</p>
                    <p class="no-margin" >The SharePage</p>
                    <p class="no-margin" >A solution for an ad-free site where you can actually get value for your time.</p>
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
            <a href="'.$BaseUrl.'/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="'.$BaseUrl.'/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
          </div>
        </div>

      </body>
    </html>

  ';



  //$message = "Hi,<br>You are receiving this mail because the user has enquired you.\r\n\r\n";
  //$message .= "See More Details click on link ".$txtlink."/\r\n";

  $em->send_all_email($email_to, $subj, $message);        

          $data = array("status" => 200, "message" => "Email sent successfully");

        }else{

         $data = array("status" => 1, "message" => "Email is empty.");

        }



   echo json_encode($data);
	
?>  
