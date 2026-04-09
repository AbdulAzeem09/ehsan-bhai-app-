<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    //idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings

    $em = new _email;
    $txtlink  = $_POST['txtlink'];
    $email_to =  $_POST['txtemail'];
    $friends = $_POST['txtFriend'];

    if(!empty($email_to)){
        $p = new _spprofiles;
        $fwrd = new _forwardjobs;
        $profiles = $p->readByEmail($email_to);
        if ($profiles) {
            while ($rows = mysqli_fetch_assoc($profiles)) {
                $data = array(
                    'frwSenderId' => $_POST['sender_id'],
                    'frwReciverId' => $rows['idspProfiles'],
                    'frwJobId' => $_POST['postid']
                );
                $fwrd->create($data);
            }
        }else{
            $data = array(
                'frwSenderId' => $_POST['sender_id'],
                'frwEmail' => $email_to,
                'frwJobId' => $_POST['postid']
            );
            $fwrd->create($data);
        }
    }
        
    if(!empty($friends))
    {
        $fwrd = new _forwardjobs;
        foreach ($friends as $key => $value) {
            $data = array(
                'frwSenderId' => $_POST['sender_id'],
                'frwReciverId' => $value,
                'frwJobId' => $_POST['postid']
            );

            $fwrd->create($data);
        }
    }

    if(!empty($email_to))
    {
        $txtmsg =  $_POST['txtmsg'];
        $subj = "The SharePage [Job Invitation]";
        $p = new _jobpostings;
        $res = $p->singletimelines($_POST['postid']);

        if($res){
            $row = mysqli_fetch_assoc($res);
            $title      = $row['spPostingTitle'];
            $overview   = $row['spPostingNotes'];
            $country    = $row['spPostingsCountry'];
            $city       = $row['spPostingsCity'];
            $dt         = new DateTime($row['spPostingDate']);
            $postingDate = $p->spPostingDate($row["spPostingDate"]);
            $clientId   = $row['spProfiles_idspProfiles'];
            $postedPerson = $row['spUser_idspUser'];
            $CloseDate  = $row['spPostingExpDt'];

            if ($row['spPostingSlryRngFrm'] > 0) {
                $salaryyy = $row['job_currency'] . ' ' . $row['spPostingSlryRngFrm'] . ' - ' . $row['job_currency'] . ' ' . $row['spPostingSlryRngTo'] . '';
            }

            $skill      = explode(',', $row['spPostingSkill']);
            $jobType    = $row['spPostingJobType'];
            $jobLevel   = $row['spPostingJoblevel'];
            $location   = $row['spPostingLocation'];
            $salaryStrt = $row['spPostingSlryRngTo'];
            $salaryEnd  = $row['spPostingSlryRngFrm'];
            $Experience = $row['spPostingExperience'];
            $howAply    = $row['spPostingApply'];
            $noOfPos    = $row['spPostingNoofposition'];


            // company profile information
            $u = new  _spbusiness_profile;
            $result3 = $u->read($clientId);
            //echo $u->ta->sql;
            if ($result3) {
                $CmpnyName = "";
                $CmpnyDesc  = "";
                $CmpSize    = "";
                $row3 = mysqli_fetch_assoc($result3);
                //print_r($row3);
                $CmpSize = $row3['CompanySize'];
                //$CmpnyDesc = $row3['skill'];
                $CmpnyName = ucfirst($row3['companyname']);
            }
            // ========================END======================
            $pf = new _postfield;
            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf == false){
                /*$skill      = "";
                $jobType    = "";
                $jobLevel   = "";
                $location   = "";
                $salaryStrt = "";
                $salaryEnd  = "";
                $Experience = "";
                $howAply    = "";
                $noOfPos    = "";*/
                date_default_timezone_set("Asia/Karachi");
                $postingDate = $p->get_timeago(strtotime($row["spPostingDate"]));
                //$postingDate = $p-> spPostingDate($row["spPostingDate"]);
            }
        }

        $message = '<!DOCTYPE html>
            <html>

            <head>

            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="format-detection" content="telephone=no">
            <meta name="format-detection" content="date=no">
            <meta name="format-detection" content="address=no">
            <meta name="format-detection" content="email=no">
            <title></title>
            <style type="text/css">
            #outlook a {
            padding: 0;
            }
            body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            }
            table,
            td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            }
            img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
            }
            p {
            display: block;
            margin: 13px 0;
            }
            </style>

            <style type="text/css">
            @import url("https://b2b.share.com/rs/280-QDK-215/images/Helvetica-Neue.css");
            </style>

            <style type="text/css">
            @media only screen and (min-width:670px) {
            .pl-column-per-70 {
            width: 70% !important;
            max-width: 70%;
            }
            .pl-column-per-30 {
            width: 30% !important;
            max-width: 30%;
            }
            .pl-column-per-100 {
            width: 100% !important;
            max-width: 100%;
            }
            .pl-column-per-65 {
            width: 65% !important;
            max-width: 65%;
            }
            .pl-column-per-35 {
            width: 35% !important;
            max-width: 35%;
            }
            .pl-column-per-60 {
            width: 60% !important;
            max-width: 60%;
            }
            /* .pl-column-per-40 {
            width: 40% !important;
            max-width: 40%;
            } */
            .pl-column-per-33-333333333333336 {
            width: 33.333333333333336% !important;
            max-width: 33.333333333333336%;
            }
            }
            </style>
            <style type="text/css">
            @media only screen and (max-width:670px) {
            table.pl-full-width-mobile {
            width: 100% !important;
            }
            td.pl-full-width-mobile {
            width: auto !important;
            }
            }
            </style>
            <style type="text/css">
            p {
            margin: 0 0;
            }
            ul {
            display: block;
            }
            ul li {
            list-style: disc;
            }
            body a {
            text-decoration: none;
            color: #3399ff;
            }
            .image-highlight {
            transition: 0.3s;
            }
            .image-highlight:hover {
            filter: brightness(1.2);
            }
            .button-highlight {
            transition: 0.3s;
            }
            .button-highlight:hover {
            filter: brightness(1.5);
            }
            @media only screen and (min-width: 670px) {
            .hide-on-mobile {
            display: block !important;
            }
            }
            @media only screen and (max-width: 670px) {
            .hide-on-mobile {
            display: none !important;
            }
            .hide-on-desktop {
            display: block !important;
            max-height: none !important;
            }
            .hide-on-desktop td {
            display: table-cell !important;
            max-height: none !important;
            }
            }
            .hide-on-desktop,
            .hide-on-desktop td {
            mso-hide: all;
            display: none;
            max-height: 0px;
            overflow: hidden;
            }
            </style>
            <style>
            /*startcommon*/
            @media only screen and (max-width: 800px) {
            table#boxing{
            width: 100% !important;
            }
            }
            /*endcommon*/
            @media only screen and (max-width:635px) {
            .div-width{
            max-width: 100%!important;
            }
            .full-width {
            width: 100% !important;
            }
            }
            </style>
            </head>

            <body style="background-color:#f2f2f2;">
            <div style="background-color:#f2f2f2;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse;">
            <tbody>
            <tr>
            <td class="outer" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word; -webkit-hyphens: none; -moz-hyphens: none; hyphens: none; border-collapse: collapse; background-color: #f2f2f2;">
            <table width="800" align="center" id="boxing" border="0" cellpadding="0" cellspacing="0" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0; border-collapse: collapse;">
            <tbody>
            <tr>
            <td class="boxedbackground shareContainer" id="template-wrapper" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word; -webkit-hyphens: none; -moz-hyphens: none; hyphens: none; border-collapse: collapse;">
            <table class="shareModule section-masthead" id="Masthead" sharename="Masthead2" shareaddbydefault="true" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f2f2f2;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center">

            <div style="background:#d92231;background-color:#d92231;Margin:0px auto;max-width:650px;">
            <table align="center" bgcolor="#032350" border="0" cellpadding="0" cellspacing="0" class="display-width" style="max-width:800px;" width="100%">
            <tbody>
            <tr>
            <td align="center" class="">

            <div class="main-width" style="display:inline-block; width:100%; max-width:600px; vertical-align:top;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%">
            <tbody>
            <tr>
            <td class="height30" height="15" style="mso-line-height-rule: exactly; line-height: 15px;">&nbsp;</td>
            </tr>
            <tr>
            <td align="center" style="font-size:0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; max-width:100%;" width="100%">
            <tbody>
            <tr>
            <td align="center" style="font-size:0; width:100%; max-width:100%;" class="">

            <div class="div-column" style="display:inline-block; max-width:600px; width:100%; vertical-align:top;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; max-width:100%; width:100%;" width="100%">
            <tbody>
            <tr>
            <td align="center">
            <div class="shareText" id="plLogo" shareName="share-Logo">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:auto !important;">
            <tbody>
            <tr>
            <td align="center" style="color:#333333; padding-top: 10px; padding-bottom: 10px;" width="250" class="">
            <a href="#" style="color:#333333; text-decoration:none;" target="_blank">
            <img alt="sharepage" src="https://ci3.googleusercontent.com/proxy/WfqH940okJYEwfVnk0RW3dXznt5A9epV0EJA6jaoWwW-ZHsW0r2pMFad4bE6cyQW3oo5bPjneTE_ULDOkTtYcaHAGfpqZGCgrOGalobSdHoPrE0=s0-d-e1-ft#https://dev.thesharepage.com/assets/images/logo/thesharepage.png" style="margin:0; border:0; padding:0; display:block; height: auto;" width="250">
            </a>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
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
            <tr>
            <td class="height30" height="15" style="mso-line-height-rule: exactly; line-height: 15px;">&nbsp;</td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>

            <table class="shareModule Webinars-body" id="webinarbody" sharename="Webinars body text area" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f2f2f2;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center">

            <div style="background:#ffffff;background-color:#ffffff;Margin:0px auto;max-width:650px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ffffff;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center" class="res-padding" style="padding-left: 15px; padding-right: 15px; border-bottom: 3px solid #032350;">

            <div class="width630" style="display:inline-block; width:100%; max-width:650px; vertical-align:top;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width-inner" style="max-width:650px;" width="100%">
            <tbody>
            <tr>
            <td align="center" class="MsoNormal" style="color:#333333; font-weight:400; font-size:30px; line-height:36px; letter-spacing:1px; padding-left: 15px; padding-right: 15px;">
            <div class="shareTxt" id="webinar-text" shareName="NL paragraph" style="font-size: 18px; font-weight: 600; font-family: italic;"><i>A place where you can discover Yourself</i></div>
            </td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>
            <table class="shareModule section-body" id="sectionBody" sharename="Email body area" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f2f2f2;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center">

            <div class="c-body" style="background:#f5f6fa;background-color:#f5f6fa;Margin:0px auto;max-width:650px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f6fa;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center" class="res-padding">

            <div class="width630" style="display:inline-block; width:100%; max-width:630px; vertical-align:top;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width-inner" style="max-width:630px;" width="100%">
            <tbody>
            <tr>
            <td height="30" style="mso-line-height-rule:exactly; line-height:30px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td align="left" class="text center-text" style="font-size:15px; line-height:22px; font-weight:normal;font-style:normal; color:#000000;text-decoration:none;letter-spacing: 0px; padding-left: 15px; padding-right: 15px; text-align: left;" valign="middle">
            <div class="shareText" id="updateBody" shareName="Update Body text">
            <p><strong>Hi ,</strong>
            </p>
            <p>'.$txtmsg.'</p>
            <p style="padding-top: 6px;">See the details of the job:</p>
            </div>
            </td>
            </tr>
            <tr>
            <td align="left" class="MsoNormal" style="color:#000000;  font-weight:400; font-size:30px; line-height:36px; letter-spacing:1px; padding-left: 15px; padding-right: 15px;">
            <div class="shareText" id="nl-head" style="font-size: 20px; padding-top: 20px; color: #d92231;">'. ucfirst($title).'</div>
            </td>
            </tr>
            <tr>
            <td height="30" style="mso-line-height-rule:exactly; line-height:30px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td align="left" class="text center-text" style=" font-size:15px; line-height:22px; font-weight:normal;font-style:normal; color:#000000;text-decoration:none;letter-spacing: 0px; padding-left: 15px; padding-right: 15px; text-align: left;" valign="middle">
            <div class="shareText" id="updateBody" shareName="Update Body text">
            <p style="font-size: 18px; padding-bottom: 8px;"><strong>Job Description:</strong>
            </p>
            <p>'. $overview.'</p>
            </div>
            </td>
            </tr>
            <tr>
            <td height="30" style="mso-line-height-rule:exactly; line-height:30px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td align="left" class="text center-text" style=" font-size:15px; line-height:22px; font-weight:normal;font-style:normal; color:#000000;text-decoration:none;letter-spacing: 0px; padding-left: 15px; padding-right: 15px; text-align: left;" valign="middle">
            <div class="shareText" id="updateBody" shareName="Update Body text">
            <p style="font-size: 18px; padding-bottom: 8px;"><strong>Job Details:</strong>
            </p>
            <div class="table-responsive">
            <table border="1" width="100%" cellpadding="5" cellspacing="5">
            <tr>
            <th>Company Name</th>
            <th>'. $CmpnyName.'</th>
            </tr>

            <tr>
            <td>Total Positions:  </td>
            <td>'. $noOfPos .'</td>

            </tr>

            <tr>
            <td>Job Type: </td>
            <td>'.$jobType .'</td>
            </tr>

            <tr>
            <td>Salary: </td>
            <td>'. $salaryyy.'</td>
            </tr>
            <tr>
            <td>Closing Date: </td>
            <td>'. $CloseDate.'</td>
            </tr>
            <tr>
            <td>Experience: </td>
            <td>'. $Experience.' Yrs</td>
            </tr>
            <tr>
            <td>Location: </td>
            <td>'. $location. '</td>
            </tr>
            </table>
            </div>
            </div>
            </td>
            </tr>
            <tr>
            <td align="left" class="MsoNormal" style="color:#000000;  font-weight:400; font-size:30px; line-height:26px; letter-spacing:1px; padding-left: 15px; padding-right: 15px;">


            <div class="shareText" id="nl-head" style="font-size: 20px; padding-top: 20px;">If you want to apply or learn more about this job, click the link below.
            </div>
            <a href="'.$txtlink.'" style="font-size: 16px; margin-top: 0px; color: #FB4D53; font-weight: 600; border-bottom: 2px solid #FB4D53;"> Visit Website</a>
            </td>
            </tr>
            <tr>
            <td height="30" style="mso-line-height-rule:exactly; line-height:30px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td align="left" class="MsoNormal" style="color:#000000;  font-weight:400; font-size:30px; line-height:26px; letter-spacing:1px; padding-left: 15px; padding-right: 15px;">
            <div class="shareText" id="nl-head" style="font-size: 16px; padding-top: 20px;">
            <p><strong>Regards,</strong>
            </p>
            <p>The SharePage</p>
            <p style="font-size: 15x;">A solution for an ad-free site where you can actually get value for your time.</p>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td height="34" style="mso-line-height-rule:exactly; line-height:34px;" class="">&nbsp;</td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>

            <table class="shareModule Webinars-body" id="webinarbody" sharename="Webinars body text area" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f2f2f2;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center">

            <div style="background:#ffffff;background-color:#ffffff;Margin:0px auto;max-width:650px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ffffff;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center" class="res-padding" style="padding-left: 15px; padding-right: 15px; border-top: 3px solid #032350;">

            <div class="width630" style="display:inline-block; width:100%; max-width:650px; vertical-align:top;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width-inner" style="max-width:650px;" width="100%">
            <tbody>
            <tr>
            <td height="25" style="mso-line-height-rule:exactly; line-height:25px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td align="center" class="MsoNormal" style="color:#333333;  font-weight:400; font-size:30px; line-height:36px; letter-spacing:1px; padding-left: 10px; padding-right: 10px;">
            <div class="shareTxt" id="webinar-text" shareName="NL paragraph" style="font-size: 18px; font-weight: 600;">
            <div class="shareTxt" id="webinar-text" shareName="NL paragraph" style="font-size: 15px;">This email was sent from a notification-only address. Please do not reply.</div>
            </div>
            </td>
            </tr>
            <tr>
            <td height="25" style="mso-line-height-rule:exactly; line-height:25px;" class="">&nbsp;</td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>
            </div>

            </td>
            </tr>
            </tbody>
            </table>

            <table class="shareModule pl-footer" id="plFooter" shareName="Rich text area" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f2f2f2;background-position:center center;background-size:contain;background-repeat:no-repeat;width:100%;">
            <tbody>
            <tr>
            <td align="center">

            <div style="background:#000000;background-color:#000000;Margin:0px auto;max-width:650px;">
            <table border="0" cellpadding="0" cellspacing="0" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; border-collapse: collapse !important; border-top-color: #FFFFFF; border-top-style: solid; border-top-width: 0px; mso-table-lspace: 0pt; mso-table-rspace: 0pt" width="100%">
            <tbody>
            <tr>
            <td align="left" class="footerContent" style="text-size-adjust: 100%; color: rgb(255, 255, 255);  font-size: 10px; line-height: 15px; text-align: left; padding: 20px 20px 20px; background: rgb(0, 0, 0);" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #000000; border-collapse: collapse !important; border-top-color: #FFFFFF; border-top-style: solid; border-top-width: 0px; mso-table-lspace: 0pt; mso-table-rspace: 0pt" width="100%">
            <tbody>
            <tr>
            <td height="20" style="font-size:0; mso-line-height-rule: exactly; line-height:20px;" class="">&nbsp;</td>
            </tr>
            <tr>
            <td style="text-size-adjust: 100%;color: rgb(255, 255, 255);font-size: 10px;line-height: 15px;text-align: left;">
            <div class="shareText" id="body-copy" shareName="footer Text 1" style="text-align: center; padding:0px ;">
            <a href="" style="display: inline-block; mso-line-height-rule: exactly;line-height:50%">
            <img alt="share" border="0" height="" src="https://ci3.googleusercontent.com/proxy/WfqH940okJYEwfVnk0RW3dXznt5A9epV0EJA6jaoWwW-ZHsW0r2pMFad4bE6cyQW3oo5bPjneTE_ULDOkTtYcaHAGfpqZGCgrOGalobSdHoPrE0=s0-d-e1-ft#https://dev.thesharepage.com/assets/images/logo/thesharepage.png" style="border:none;display:block;outline:none;text-decoration:none;height:auto;width: 150px;font-size:13px;" width="94">
            </a>
            <br>&nbsp;
            <table align="center" border="0" cellpadding="1" cellspacing="1" class="pd-table" style="width:120px; padding: 5px;">
            <tbody></tbody>
            </table>
            <div style="text-align: center;">&nbsp;</div>© Copyright 2023 The SharePage
            <br>All rights reserved.</div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td align="left" class="footerContent original-only" style="text-size-adjust: 100%; color: rgb(255, 255, 255);  font-size: 12px; line-height: 15px; text-align: left; padding: 0px 20px 40px; background: rgb(0, 0, 0);" valign="top">
            <div class="shareText" id="body-copy144" shareName="footer Text 2" style="text-align: center;"> <a href="'.$BaseUrl.'/page/?page=privacy_policy" style="text-size-adjust: 100%; color: rgb(255, 255, 255); font-weight: 300; text-decoration: underline;">Privacy Policy</a>&nbsp;&nbsp;&nbsp; <a href="'.$BaseUrl.'/page/?page=copyrights" style="text-size-adjust: 100%; color: rgb(255, 255, 255); font-weight: 300; text-decoration: underline;">Terms & Conditions</a>&nbsp;</div>
            </td>
            </tr>
            </tbody>
            </table>
            </div>

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
            </table>
            </div>
            </body>

            </html>
        ';
        $em->send_all_email($email_to, $subj, $message);
    }

    if(!empty($email_to) || !empty($friends)){        
        $_SESSION['email_status'] = 'success';
        $_SESSION['email_msg_forword']='Job forwarded Successfully';
    }else{
        $_SESSION['email_status'] = 'error';
        $_SESSION['email_msg_forword'] = 'Please select friends or enter email to forward job.';
    }

    $re = new _redirect;
    if(!empty($txtlink)){
        header("Location: ". $txtlink);
    }else{
        $re->redirect('index.php');
    }
}
