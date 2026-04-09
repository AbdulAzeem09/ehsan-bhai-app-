<?php
    session_start();
    include('../univ/baseurl.php');
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_POST['txtMulTimeEmail'])){

        $txtGroupId = $_POST['txtGroupId'];
        $txtGroupName = $_POST['txtGroupName'];
        $txtPostId = $_POST['txtPostId'];

        $u = new _spprofiles;
        $result2 = $u->profilestore($_SESSION['pid']);
        if($result2){
            $row = mysqli_fetch_assoc($result2);
            $ProfileName = $row['spProfileName'];
            $ProfileEmail = $row['spProfileEmail'];
        }

        $txtMulTimeEmail = $_POST['txtMulTimeEmail'];
        $emailMulti = rtrim($txtMulTimeEmail, ',');
        $groups = explode(',', $emailMulti);
        if(!empty($txtGroupId) && !empty($txtGroupName)){
            $sendUrl = $BaseUrl."/grouptimelines/?groupid=".$txtGroupId."&groupname=".$txtGroupName."&post-detail=".$txtPostId;    
        }else{
            $sendUrl = $BaseUrl."/timeline/?post-detail=".$txtPostId;
        }
        
        
        foreach ($groups as $value) {
            //here code of send email of each person
            $to = $value; // this is your Email address
            $from = $ProfileName; // this is the sender's Email address / name
            
            $subject = "The SharePage Group Timeline";
            
            $message = "Hi ".$to.",

            Your friend ".$ProfileName." has shared a post with you on TheSharePage.com Click on the link below to view the post: ".$sendUrl."


            -
            TheSharePage Team";

            $headers = "From:" . $ProfileEmail;
            mail($to,$subject,$message,$headers);
            
        }
        
        
    }

?>