<?php
	include('../univ/baseurl.php');
	session_start();

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _contact;
	$re = new _redirect;
	$em = new _email;

	$topic 		= $_POST['spConTopic'];
	$name 		= $_POST['spConName'];
	$email 		= $_POST['spConEmail'];
	$spConSubj 	= $_POST['spConSubj'];
	$subject 	= $_POST['spConName'];;
	$message 	= $_POST['spConDesc'];

	$redirctUrl = $BaseUrl . "/contact.php";
	
	if(isset($_POST["spConName"])){
		$id = $p->create($_POST);
		if (isset($id)) {
			// EMAIL SENT TO THE SPECEFIC EMAILS
			$msg = '
			<!DOCTYPE html>
				<html>
				<head>
					<title>The SharePage11</title>
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
				    		margin: 20px 0px 25px;
				    		
				    	}
				    	.logo a{
				    		width: 80px;
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
						h3{
							margin: 0px;
							font-size: 18px;
						}			    	
				    </style>
				</head>
				<body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
					<table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
						        <td align="center" class="logo" >
						          	<a href="https://thesharepage.com"><img src="https://thesharepage.com/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
						          	<h1>The SharePage</h1>
						        </td>
					      	</tr>
					      	
					      	<tr>
					      		<td class="letstart" >
					      			<h1>Contact Us</h1>
					      		</td>
					      	</tr>
					      	<tr>
					      		<td>
					      			<p>Dear '.$name.',</p>
					      			
									<p>Thank you for contacting us with your query below:</p>
									<h3>Topic</h3>
									<p>'.$topic.'</p>
									<h3>Subject</h3>
									<p>'.$spConSubj.'</p>
									<h3>Email</h3>
									<p>'.$email.'</p>
									<h3>Message</h3>
									<p>'.$message.'</p>
									

					      		</td>
					      	</tr>
							<tr>
								<td  align="center" class="foot">
									<p style="margin-bottom: 0px;">This is an automated message to confirm the receipt of your query, we will get back to you as soon as possible.</p>
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
			// SEND THIS COPY OF MESSAGE TO USER
			// CONTACT EMAIL - FROM CONTACT FORM
			// $send_email = 'contactus@thesharepage.com';
			// //$send_email = 'akhiltulip@gmail.com';
			// $em->send_all_email($send_email, $spConSubj, $msg, "contact@thesharepage.com", $name, $email);
			$adminemail = "contact@thesharepage.com";
			$em->send_all_email($adminemail, $spConSubj, $msg, "contact@thesharepage.com", $name, $email);
			$em->send_all_email("thesharepage.com@gmail.com", $spConSubj, $msg, "contact@thesharepage.com", $name, $email);



			// END
			$_SESSION['err'] = "Your message is successfully sent. Thank you for contacting us. One of our colleagues will get back to you soon. Have an awesome time at The SharePage!";
			$_SESSION['count'] = 0;
			$re->redirect($redirctUrl);
		}
	}else{
		
		$re->redirect($redirctUrl);
	}
	
?>
