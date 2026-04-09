<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
?>
<?php
    session_start();
    include('../../mlayer/SmsEmailCampaign.php');
    include('../../mlayer/_data.class.php');

     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    


    if(isset($_POST['name'])){
        $conn = _data::getConnection();

        function getLastCampgainId($conn){
            $sql2 = "SELECT * FROM sms_email_campaigns ORDER BY id DESC LIMIT 1";
            $result2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2) >0){
                $row2 = mysqli_fetch_assoc($result2);
                return $row2['id'];
            }
        }
        

/*        if ($_POST['name'] == "") {
            return "Name required";
        }
        if ($_POST['date'] == "") {
            return "Date required";
        }
        if ($_POST['time'] == "") {
            return "Time required";
        }
        if ($_POST['text'] == "") {
            return "Message required";
        }*/
        
            /*
             * Creating new campaign.
             *
             * */
            $name = $_POST['name'];
            $type = $_POST['type'];
            $text = $_POST['text'];
           /* $date = $_POST['date'];
            $time = $_POST['time'];*/
            $user_id = $_SESSION['uid'];
            $user_or_group = $_POST['user_or_group'];
            $status = 'Ok';
            $created_at_date = date('Y-m-d');
            $time =  date("h:i:s");

            $sql = "INSERT INTO sms_email_campaigns (type, name, text, date, time, user_id, status, user_or_group, created_at, updated_at) VALUES('$type', '$name', '$text', '$created_at_date', '$time', '$user_id', '$status', '$user_or_group', '$created_at_date', '$created_at_date')";
            $result = mysqli_query($conn, $sql);

            if( $user_or_group == 'user' ){
                $userIds = $_POST['Ids'];
                $ids = rtrim($userIds, ',');
                $users = explode(',', $ids);

                foreach ($users as $value) {
                    $user_id = $value;

                      $prosql ="SELECT * FROM `spprofiles` WHERE idspProfiles ='$user_id'";
                     $resultpro = mysqli_query($conn, $prosql);
                        $rowpro = mysqli_fetch_assoc($resultpro);
                      
                       $mobilenumbers = $rowpro['spProfilePhone'];
                       $proname = $rowpro['spProfileName']; 


                       $msg= "Hello ".$proname." ".$name." ".$text;
					   		
                        $sm = new _sms;
					
                      //  $sm->sendsms($mobilenumbers, urlencode($randCode));
							//die('===========');
				
                    $campaign_id = getLastCampgainId($conn);
                    $created_by = $_SESSION['uid'];
                    $created_at = date('Y-m-d');
                    $sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id,file_user_id, created_by, created_at, updated_at) VALUES('$campaign_id', '0', '$user_id','0', '$created_by', '$created_at', '$created_at')";
                    $result3 = mysqli_query($conn, $sql3);
                }
            }

/*            if( $user_or_group == 'group' ){
                $groupIds = $_POST['Ids'];
                $ids = rtrim($groupIds, ',');
                $groups = explode(',', $ids);
                foreach ($groups as $value) {
                    $campaign_id = getLastCampgainId($conn);
                    $group_id = $value;
                    $created_by = $_SESSION['uid'];
                    $created_at = date('Y-m-d');
                    $sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id, file_user_id, created_by, created_at, updated_at) VALUES
                    ('$campaign_id', '$group_id', '0', '0', '$created_by', '$created_at', '$created_at')";
                    $result3 = mysqli_query($conn, $sql3);
                }
            }

            if( $user_or_group == 'importuser' ){
                $fileuserIds = $_POST['Ids'];
                $ids = rtrim($fileuserIds, ',');
                $fileusers = explode(',', $ids);
                foreach ($fileusers as $value) {
                    $campaign_id = getLastCampgainId($conn);
                    $file_user_id = $value;
                    $created_by = $_SESSION['uid'];
                    $created_at = date('Y-m-d');
                    $sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id, file_user_id, created_by, created_at, updated_at) VALUES
                    ('$campaign_id', '0', '0', '$file_user_id', '$created_by', '$created_at', '$created_at')";
                    $result3 = mysqli_query($conn, $sql3);
                }
            }
*/


            
            echo "success";
        
    }else{
        $re = new _redirect;
        $location = "../";
        $re->redirect($location);
        
    }

    
    
?>