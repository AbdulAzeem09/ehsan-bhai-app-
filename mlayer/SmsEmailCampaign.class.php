<?php


class SmsEmailCampaign 
{
    public $dbclose = false;
	public $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sms_email_campaigns");
		$this->ta->dbclose = false;
	}
	
    function getsmmEmailCampaign($userid , $type){
        return $this->ta->read("WHERE user_id = '$userid' AND type = '$type'");
    }
    function getSmsEmailCampaignJobId($jobid, $type){
    	return $this->ta->read("WHERE job_id = '$jobid' AND type = '$type'");
    }

    function SmsStatsAdd($jobid){
    	
        $user = "thethe-share-page";
        $password = "Jouple!2211";
        $obj = new SmsEmailCampaign;
        $result = $obj->getSmsEmailCampaignJobId($jobid,'Sms');
       	if($result != false){
       		$row = mysqli_fetch_assoc($result);
       		$date = $row['date'];
       	}

        $date = date('d/m/Y', strtotime($date));
        $from_date =  date($date.'%2000:00:00');
        $to_date =  date($date.'%2023:59:59');

        //curl request to get data.
        $url="http://api.smscountry.com/smscwebservices_bulk_reports.aspx?user=thethe-share-page&passwd=Jouple!2211&fromdate=$from_date&todate=$to_date&jobid=$jobid";  //callbackURL=http://www.jouple.com/marketing/public/save/sms
        $ch = curl_init();
        if (!$ch){
            die("Couldn't initialize a cURL handle");
        }
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $curlresponse = curl_exec($ch); // execute
        if(curl_errno($ch))
        echo 'curl error : '. curl_error($ch);
        if (empty($ret)) {
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
        } else {
            $info = curl_getinfo($ch);

            curl_close($ch); // close cURL handler

        } 
        
        if ( $curlresponse && $curlresponse != '"0 "'){
            $response = explode("#",$curlresponse);
        }
        if ( $response && $response[0] != 0) {
            foreach ($response as $value) {
                $data[] = explode('~', $value);
            }
            
            $delete = SmsStats::truncate();
            foreach ($data as $row) {
                if( isset($row[2]) && $row[2] == 11){
                    $status = 'Invalid Nubmer';
                }
                if( isset($row[2]) && $row[2] == 2 || $row[2] == 1 || $row[2] == 4 || $row[2] == 8 || $row[2] == 10){
                    $status = 'UnDelivered';
                }
                if( isset($row[2]) && $row[2] == 3){
                    $status = 'Delivered';
                }
                $smsStats = new SmsStats();
                $smsStats->jobno = $row[0];
                $smsStats->mobilenumber = $row[1];
                $smsStats->status = isset($status) ? $status : '';
                $smsStats->messagepart = $row[5];
                $smsStats->save();
            }

            //Get Invalid count.
            $t = 0;
            foreach ($data as $row) {
                if( $row[2] == 11)
                {
                    $t = $t+1; 
                }
                $totalInvalid = $t;
            }

            //Get Delivered count.
            $t = 0;
            foreach ($data as $row) {
                if( $row[2] == 3)
                {
                    $t = $t+1; 
                }
                $totalDelivered = $t;
            }
            //Get Undelivered count.
            $t = 0;
            foreach ($data as $row) {
                if( $row[2] == 2 || $row[2] == 1 || $row[2] == 4 || $row[2] == 8 || $row[2] == 10)
                {
                    $t = $t+1; 
                }
                $totalUnDelivered = $t;
            }
            //$per_page = \Config::get('app.sms_campaign_report_per_page');

            //$reportData = SmsStats::orderBy('id', 'ASC')->paginate($per_page);
        }
        //return \View::make('sms_campaign/smsCampaignReport', compact('reportData', 'totalInvalid', 'totalDelivered', 'totalUnDelivered'));


    }

}
