<?php
   include("univ/baseurl.php");
   include "common.php";
   
if(isset($_POST['submit']) && $_POST['submit']=='Submit'){
  $email=isset($_POST['email']) ? $_POST['email'] : "";
  $template_id=isset($_POST['temp_id']) ?  $_POST['temp_id'] : "";
  if($_POST['user_id']==''){
    $user_id='0'; 
  }else{
    $user_id= isset($_POST['user_id']) ?  $_POST['user_id'] : "";
  }
     if(isset($_POST['unsub_reason']) && $_POST['unsub_reason']=='OTHER')
      {
        $reason=isset($_POST['unsub_reason_textarea']) ?  $_POST['unsub_reason_textarea'] : "";
      }
      else{
      $reason=isset($_POST['unsub_reason']) ?  $_POST['unsub_reason'] : "";
     }
   
    $result = insertQ("insert into newsletter_unsubscribe(template_id, user_id, email,reason,date_time) values(?, ?, ?,?,?)", "sssss", [$template_id, $user_id,$email,$reason, date("Y-m-d H:i:s")]); 
      header('Location:'.$BaseUrl.'');
    
     }
   ?>
<html>
   <head>
      <link rel="stylesheet" href="<?php echo $BaseUrl ?>/css/unsuscribre.css";?/>
      <script src="<?php echo $BaseUrl ?>/js/TweenMax.min.js"></script>
      <script src="<?php echo $BaseUrl ?>/js/MorphSVGPlugin.min.js"></script>
   </head>
   <body>
      <table class="unsubscribed-page">
         <tr>
            <td>
               <table class="email-body">
                  <tr>
                     <td class="email-header" align="center">
                        <a href="#">
                           <img src="<?php echo $BaseUrl ?>/assets/images/logo/tsp_trans.png" alt="The SharePage" title="Logo" style="width: 100px;" >
                           <h2>The Share Page</h2>
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td class="news-section">
                        <div id="templateBody" class="bodyContent rounded6">
                           <h2> Why you want to  Unsubscribe here? </h2>
                           <div>You will no longer receive email marketing from this list.
                           </div>
                           <form  action="" id="unsubscribe-reason-form" method="POST" style="">
                              <input type="hidden" name="email" value="<?php echo $_GET['email']?>">
                              <input type="hidden" name="temp_id" value="<?php echo $_GET['template_id'];?>">
                              <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>">
                              <div class="groups">
                                 <div id="unsub-reason-success" style="display:none;" class="alert">
                                    Thanks for the feedback!
                                 </div>
                                 <div id="unsub-reason-error" class="error" style="display:none;">
                                    There were some errors, please try again later
                                 </div>
                                 <h3 class="unsub-title">If you have a moment, please let us know why you unsubscribed:</h3>
                                 <ul class="unsub-options">
                                    <li>
                                       <label class="radio" for="r1">
                                       <input type="radio" name="unsub_reason" value="I no longer want to receive these emails" id="r1" onclick="notextarea()">
                                       <span>I no longer want to receive these emails</span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="radio" for="r2">
                                       <input type="radio" name="unsub_reason" value="I never signed up for this mailing list" id="r2" onclick="notextarea()">
                                       <span>I never signed up for this mailing list</span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="radio" for="r3">
                                       <input type="radio" name="unsub_reason" value="The emails are inappropriate" id="r3" onclick="notextarea()">
                                       <span>The emails are inappropriate</span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="radio" for="r4">
                                       <input type="radio" name="unsub_reason" value="The emails are spam and should be reported" id="r4" onclick="notextarea()">
                                       <span>The emails are spam and should be reported</span>
                                       </label>
                                    </li>
                                    <li>
                                       <label class="radio" for="r5">
                                       <input type="radio" name="unsub_reason" value="OTHER" id="r5" onclick="showtextarea()">
                                       <span>Other (fill in reason below)</span>
                                       </label>
                                       <br>
                                       <textarea id="unsub-reason-desc" name="unsub_reason_textarea" style="" row="2" cols="20" class="required"></textarea>
                                    </li>
                                    <li>
                                       <input class="formEmailButton" type="submit" name="submit" value="Submit" style="cursor:pointer">
                                    </li>
                                 </ul>
                              </div>
                           </form>
                           <br>
                           <a href="<?php echo $BaseUrl;?>">« Return to our website</a>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td class="footer">
                        You're receiving this email because you subscribed this newsletter. You can <a href="#">Unsubscribe</a> any time.
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
   <script>
      function showtextarea(){
        document.getElementById('unsub-reason-desc').style.display = 'block';
      }
      function notextarea() {
        document.getElementById('unsub-reason-desc').style.display = 'none';
      }
      
        
   </script>
</html>