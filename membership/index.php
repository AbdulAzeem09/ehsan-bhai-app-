<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
   $_SESSION['afterlogin'] = "membership/";
   include_once("../authentication/check.php");
} else {

   function sp_autoloader($class)
   {
      include '../mlayer/' . $class . '.class.php';
   }
   spl_autoload_register("sp_autoloader");
   //print_r($_SESSION);die('===22');
   $pr = new _spprofiles;
   $m = new _spmembership;
   $result = $pr->profileforresume($_SESSION["uid"]);
   if ($result != false) {
      while ($rows = mysqli_fetch_assoc($result)) {
         if ($rows["idspProfileType"] == 1) {
            $profileid = $rows["idspProfiles"];
            $subdate = $rows["spProfileSubscriptionDate"];
         }
         $res = $m->readmember($rows["spMembership_idspMembership"]);
         if ($res != false) {
            $row = mysqli_fetch_assoc($res);
            //echo $row["spMembershipName"]."<br>";
            $count = $row["spMembershipPostlimit"] . "<br>";
            $duration = $row["spMembershipDuration"];
         }
      }
      //Details Code testing	
      if (isset($profileid)) {
         $p = new _postings;
         $res = $p->businesspost($profileid);
         if ($res != false) {
            $postconsumed = $res->num_rows;
         }
         // this is orignal - $remainpostlimit = $count - $postconsumed;
         $remainpostlimit = 0 - $postconsumed;
      }
      if (isset($subdate)) {
         $postdate = strtotime($subdate);
         $currentdate = strtotime(date('Y-m-d h:i:sa'));
         $Diff = abs($currentdate - $postdate);
         $numberDays = $Diff / 86400;
         $numberDays = intval($numberDays);
         // this is orignal - $remainingday  = $duration - $numberDays;

      } else {
         $numberDays = 0;
      }
      $remainingday  = 1 - $numberDays;
   }
?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <?php include('../component/f_links.php'); ?>
   </head>
<style>
   b, strong {

      text-align:center!important;
   }
</style>
   <body class="bg_gray">
      <?php include_once("../header.php"); ?>
      <div class="container">
         <div class="row">
            <?php
            if ($_SESSION['ptid'] == 1) {
               if ($_GET['msg'] == "notaccess") { ?>
                  <br>
                  <div class="alert alert-danger" role="alert">
                     <b>You have not purchased a subscription plan or your subscription plan has expired. Please purchase a plan to post in your business profile.<b>
                  </div>
            <?php } else if($_GET['msg'] == "noSubscriptionAccess") {?>
                  <br>
                  <div class="alert alert-danger" role="alert">
                     <b>You have not subscribed yet, Please SUBSCRIBE NOW to post unlimited in Wholesale, Job Board, Real estate modules.<b>
                  </div>
            <?php }
            } ?>

            <?php if (false) { //$_SESSION['ptid'] != 1?>
               <br>
               <div class="alert alert-danger" role="alert">
                  <b>Change Your Profile To Business Profile!<b>
               </div>
            <?php } ?>


            <div class="col-md-12">
               <div class="titlePage text-center">
               
                  <h2 style="padding:15px; color:black; background-color:skyblue;">BUSINESS ACCOUNT SUBSCRIPTION PLANS</h2>
               </div>
            </div>
         </div>
         <div class="row membrPage text" style="padding-right:75px">
            <?php
            $pr = new _spprofiles;
            $m = new _spmembership;
            $res = $m->read();

            //echo $m->ta->sql;
            if ($res != false) {
               while ($rows = mysqli_fetch_assoc($res)) {
                  //$rows = mysqli_fetch_assoc($res);
                  $flag = 0;

                  $result = $pr->checkmembership($rows["idspMembership"], $_SESSION["uid"]);
                  if ($result != false) {
                     $flag = 1;
                  }
                  
                  $reslt = $m->checksubscription($_SESSION["uid"],$_SESSION["pid"]);
                  if ($reslt != false) {
                    while ($row1 = mysqli_fetch_assoc($reslt)) {
                      $currentDate = date('Y-m-d H:i:s');
                      $createdDate = $row1["createdon"];
                      $duration = $row1["duration"];

                      // Calculating remaining days
                      $expireDate = date('Y-m-d H:i:s', strtotime($createdDate . ' + ' . $duration . ' days'));
                      $remainingDays = (strtotime($expireDate) - strtotime($currentDate)) / (60 * 60 * 24);
                      if ($row1["membership_id"] == $rows["idspMembership"] && $remainingDays > 0) {
                        $flag = 2; // Subscription is active
                      }
                    }
                  }
										     
            ?>
                  <div class="col-md-1"></div>
                  <div class="col-md-3 col-sm-6">
                  <?php if ($flag == 2): ?>
                    <div class="purchase-word">Purchased</div>
                      <?php endif; ?>
                     <div class="serviceBox">
                        <div class="service-icon">
                           <?php
                           //	 print_r($rows);
                           if ($rows["spMembershipAmount"] != 0) {
                              $amt = "$" . $rows["spMembershipAmount"];
                           } else {
                              $amt = "<i class='fa fa-envelope'></i>";
                           }
                           echo $amt;
                           ?>
                        </div>
                        <h3 class="title"><?php echo $rows["spMembershipName"]; ?></h3>
                        <p class="description">
                           Post Limit : <?php echo ($rows["spMembershipPostlimit"] != 0) ? $rows["spMembershipPostlimit"] : 'Unlimited'; ?><br>
                           <?php echo $rows["spMembershipDuration"]; ?> days<br>
                           Unlimited Posting In All Modules <br>Bulk Import Option In Store.
                        </p>
                        <?php
                        //echo $remainingday;
                        // ../finance/?membership=".$rows["idspMembership"]." this is href
                        if (false) { //$_SESSION['ptid'] == 1
                           if ($rows["idspMembership"] != 4)
                              echo "<a href='" . $baseurl . "member_buy.php?id=" . $rows["idspMembership"] . "'  class='btn btn-border-radius" . ($remainingday > 0 ? "" : "") . "'>" . ($flag == 1 && $remainingday > 0 ? "Member" : "Buy Now") . "</a>";
                           else
                              echo "<a href'javascript:void(0)' class='btn' data-toggle='modal' data-target='#contactus'>Contact Us</a>";
                        ?>
                           <a href="<?php echo  $baseurl . 'member_buy.php?id=' . $rows["idspMembership"]; ?>" class="btn btn-border-radius">TRY 30 DAYS FOR FREE</a>
                        <?php  } ?>
                     </div>
                  </div>
            <?php
               }
            }
            ?>
         </div>
        
         <h5 style="text-align:center; margin-top: -65px;font-weight: bold; font-size: 14px;">GREAT NEWS!</h5>
       <p>  Earn 15% referral commissions for each business referral and a free Subscription by referring 7 businesses. 
            Also you will earn 5% commissions from 2nd and 3rd tier referrals as well!
 
</p>



         <!--Pop-up Box for contact form-->
         <div class="modal fade" id="contactus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content no-radius sharestorepos">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <span class="modal-title" id="exampleModalLabel">Enquiry Form</span>
                  </div>
                  <form action="addenquiry.php" method="post">
                     <div class="modal-body">
                        <input type="hidden" class="form-control" name="spuser_idspUser" value="<?php echo $_SESSION["uid"]; ?>" />
                        <div class="row">
                           <div class="col-md-6">
                              <label for="spenquiryCompanyName" class="control-label contact">Company Name</label>
                              <input type="text" class="form-control inptradius" id="spenquiryCompanyName" name="spenquiryCompanyName">
                           </div>
                           <div class="col-md-6">
                              <label for="spenquiryCompanySize" class="control-label contact">Company Size</label>
                              <input type="text" class="form-control inptradius" id="spenquiryCompanySize" name="spenquiryCompanySize">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label for="spenquiryFirstName" class="control-label contact">First Name</label>
                              <input type="text" class="form-control inptradius" id="spenquiryFirstName" name="spenquiryFirstName">
                           </div>
                           <div class="col-md-6">
                              <label for="spenquiryLastName" class="control-label contact">Last Name</label>
                              <input type="text" class="form-control inptradius" id="spenquiryLastName" name="spenquiryLastName">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label for="spenquiryCity" class="control-label contact">City</label>
                              <input type="text" class="form-control inptradius" id="spenquiryCity" name="spenquiryCity">
                           </div>
                           <div class="col-md-6 ">
                              <label for="spenquiryTel" class="control-label contact">Tel</label>
                              <input type="text" class="form-control inptradius" id="spenquiryTel" name="spenquiryTel">
                           </div>
                        </div>
                        <div class="">
                           <label for="spenquiryEmail" class="control-label contact">Email</label>
                           <input type="email" class="form-control inptradius" id="spenquiryEmail" name="spenquiryEmail">
                        </div>
                        <div class="">
                           <label for="spenquiryAddress" class="control-label contact">Address</label>
                           <textarea class="form-control " rows="3" id="spenquiryAddress" name="spenquiryAddress"></textarea>
                        </div>
                        <div class="">
                           <label for="spenquiryMessage" class="control-label contact">Message</label>
                           <textarea class="form-control " rows="5" id="spenquiryMessage" name="spenquiryMessage"></textarea>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Enquiry</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!--Done-->
      </div>
      <?php
      include('../component/f_footer.php');
      include('../component/f_btm_script.php');
      ?>
   </body>

   </html>
<?php
}
?>
