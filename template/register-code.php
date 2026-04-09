<?php
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
                                    
<img src="'.$BaseUrl.'/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;" class="img-responsive" >

					    
					          	</a>

					          	<h1>The SharePage</h1>
					        </td>
				      	</tr>
				      	
				      	<tr>
				      		<td class="letstart" >
				      			<h1>Verify your email address</h1>
				      		</td>
				      	</tr>
				      	<tr>
				     

				      		<td>
				      			<p class="left-margin" style=" text-transform: capitalize;">Hey '.ucfirst(strtolower($name)).',</p>
				      			
								<p class="left-margin" >Congratulations!! You are all set now at the Sharepage!!<br>Login to your account and discover all the possibilities<br>Here is a glimps of what you can find at the SharePage!</p>


<table class="table" >
  
  <tbody>
    <tr>
      
      <td><img src="'.$BaseUrl.'/assets/images/logo/table1.PNG" alt="table" style="height: 100px;" class="img-responsive" >
</td>
      <td class="tablecontent">Business and pleasure is not going to mix any more! Now you can add your family and friends with confidence by creating different profiles! </td>
    
    </tr>
    <tr>
     
      <td><img src="'.$BaseUrl.'/assets/images/logo/table2.PNG" alt="table" style="height: 100px; padding-left: 8px;" class="img-responsive" ></td>
      <td class="tablecontent">You have a store that’s ready for you! All you have to do is upload the images of your items and start selling!</td>
      
    </tr>
    <tr>
     
      <td><img src="'.$BaseUrl.'/assets/images/logo/table3.PNG" alt="table" style="height: 100px; padding-left: 8px;" class="img-responsive" ></td>
      <td class="tablecontent">You think u can make some extra income from freelancing?? Here is an opportunity to find freelancer work as well as find freelancers!</td>
      
    </tr>
  </tbody>
</table>

<div class="row"> 
<div class="col-xs-12 paracontent">
This is just a glimpse of the world that’s waiting for you at The SharePage! Login now and discover the gems waiting for you!
</div>
</div>

								<a href="'.$link.'" class="btn left-margin btnhover">Verify your email address</a>
				      			<p class="left-margin" >Regards,</p>
				      			<p class="left-margin" >The SharePage</p>
				      			<p class="left-margin" >A solution for an ad-free site where you can actually get value for your time.</p>
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
					<p style="margin-bottom: 10px;">© Copyright '.date('Y').' The SharePage. All rights reserved.</p>
					
					<div >
						<a href="'.$BaseUrl.'/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="'.$BaseUrl.'/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
					</div>
				</div>

			</body>
		</html>

	';
	echo $msg = wordwrap($msg,70);
	$to = "adnanghouri97@gmail.com";
	//$tostr = "adnan@thesharepage.com";
	$subject = "The SharePage [Registration Successfully]";
	
	$headers = "From: The SharePage" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	
	mail($to,$subject,$msg,$headers);
;
?>

