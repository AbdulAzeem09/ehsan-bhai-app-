<?php

    include('../../mlayer/_data.class.php');
    $conn = _data::getConnection();
    if(isset($_POST['emailCampaignId'])){
        $emailCampaignId = $_POST['emailCampaignId'];
        $sql = "DELETE FROM email_campaign_user WHERE id = '$emailCampaignId'";
        $result = mysqli_query($conn, $sql);
        if($result){
        	echo "success";
        }
        
        
    }

    
    
?>