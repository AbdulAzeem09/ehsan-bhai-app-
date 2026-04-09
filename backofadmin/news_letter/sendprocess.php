<?php
   session_start(); 
   require_once '../library/config.php';
   require_once '../library/functions.php';
   
   
    function sp_autoloader($class)
   {
    require_once '../../mlayer/' . $class . '.class.php';
   }
   spl_autoload_register("sp_autoloader");
    
   $email = new _email;
   
   $newletter_id =  isset($_POST['id']) ?  $_POST['id'] : "";
   
   $send_date_time=date("Y-m-d H:i:s");
     
   if(isset($_POST['send_to_all']) && $_POST['send_to_all']=='on')
   {
    $result = selectQ("select * from spuser  where is_email_verify=1","s","");
   
    $user_ids=[];
    $emails = [];
          
           foreach ($result as $row) {
            $user_ids[]=$row['idspUser'];
               $emails[] = $row['spUserEmail'];
           }
   }
   else
   {
    $user_ids=0;
    $emails = explode(';', $_POST['if_email']);
   }
    
   $totalCount = count($emails);
   
   $i = 0;
   while ($i < $totalCount) {
   
   insertQ("insert into sentnewslteller_history(newsletter_id, newsletter_name,email,newslettercontent,sentdatetime) values(?, ?, ?,?,?)", "sssss", [$newletter_id,$_POST['txtSubject'],$emails[$i],$_POST['txtMessage'],$send_date_time]);
   
   
    $getdata = selectQ("select * from newsletter_unsubscribe","s","");
   
    if($getdata[0]['email']==$emails[$i])
    {
       $result='';
    }
    else{
   $email = new _email;
   $result = $email->send_newsletter_mail($emails[$i], $_POST['txtSubject'], $_POST['txtMessage'],$newletter_id,$user_ids[$i]);
      $_SESSION['mail_send']='Mail Sent Successfully!';
   }
   
   $i++;
   echo "success";
   }
   ?>