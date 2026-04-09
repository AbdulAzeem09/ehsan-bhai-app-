<?php


class SmsEmailCampaign 
{
    public $dbclose = false;
	private $conn;
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
    	
        $user = "jouple";
        $password = "Xendxb!5544";
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
        $url="http://api.smscountry.com/smscwebservices_bulk_reports.aspx?user=jouple&passwd=Xendxb!5544&fromdate=$from_date&todate=$to_date&jobid=$jobid";  //callbackURL=http://www.jouple.com/marketing/public/save/sms
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
			$count = 0;
			$invalidnum = 0;
			$undelivered = 0;
			$delivered = 0;
			
			foreach ($data as $row) {
                if( isset($row[2]) && $row[2] == 11){
                   $status = 'Invalid Nubmer';
					$invalidnum++;
                }
                if( isset($row[2]) && $row[2] == 2 || $row[2] == 1 || $row[2] == 4 || $row[2] == 8 || $row[2] == 10){
                    $status = 'UnDelivered';
					$undelivered++;
                }
                if( isset($row[2]) && $row[2] == 3){
                    $status = 'Delivered';
					$delivered++;
                }
				$count++;
            }
        }
		$datasms = array(
			'total' => $count,
			'invalidnum' => $invalidnum,
			'undelivered' => $undelivered,
			'delivered' => $delivered
		);
		return $datasms;

    }

	//GET EMAIL REPORT ON SERVER
    function getemailReport($job_id){
    	try{
            $api_key="key-2664c40f3b1c2991fb51e72fa4ecd13a";
            $domain ="dev.thesharepage.com";
            $job_id = $job_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            
            //Get stats
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/events?limit=50&message-id='.trim($job_id).'');
            $data = curl_exec($ch);
            curl_close($ch);
            $reportData = json_decode($data);
            $reportData = $reportData->items;
            
            $delete = EmailCampaignStats::truncate();
            //echo $data; return;
            foreach ($reportData as $key => $value) {
                if($value->recipient=='support@ondotz.com'){
                    unset($reportData[$key]);
                }
            }
                foreach ($reportData as $value) {
                    $record = EmailCampaignStats::where('email', $value->recipient)->first();
                    $results = [];
                    foreach ($reportData as $row) {
                        if (isset($row->event) && $row->recipient == $value->recipient) {
                            $results[] = $row->event;
                        }
                    }
                    $counts = array_count_values($results);
                    if ( isset($counts['delivered']) && $counts['delivered'] > 0) {
                        $delivered = 1;
                    } else {
                        $delivered = 0;
                    }
                    
                    if ( isset($counts['opened']) && $counts['opened'] > 0) {
                        $opened = 1;
                    } else {
                        $opened = 0;
                    }
                   
                    if ( isset($counts['failed']) && $counts['failed'] > 0) {
                        $failed = 1;
                    } else {
                        $failed = 0;
                    }

                    if ( isset($counts['clicked']) && $counts['clicked'] > 0) {
                        $clicked = 1;
                    } else {
                        $clicked = 0;
                    }

                    if ( isset($counts['complained']) && $counts['complained'] > 0) {
                        $spam = 1;
                    } else {
                        $spam = 0;
                    }

                    if( !$record ) {
                        $smsStats = new EmailCampaignStats();
                        $smsStats->email = $value->recipient;
                        $smsStats->delivered = $delivered;
                        $smsStats->opened = $opened;
                        $smsStats->clicked = $clicked;
                        $smsStats->failed = $failed;
                        $smsStats->spam = $spam;
                        $smsStats->save();
                    }
                }
            //Get grand total count.
            $t = 0;
            foreach ($reportData as $value) {
                if( $value->event == 'delivered' || $value->event == 'failed' || $value->event == 'complained' ){
                    $t = $t+1; 
                }
                $total = EmailCampaignStats::count();
            }

            //Get delivered emails count.
            $totalDelivered = EmailCampaignStats::where('delivered', '=', 1)->count();

            //Get falied count.
            $totalFailed = EmailCampaignStats::where('failed', '=', 1)->count();

            //Get opened count.
            $totalOpened = EmailCampaignStats::where('opened', '=', 1)->count();

            //Get clicked count.
            $totalClicked = EmailCampaignStats::where('clicked', '=', 1)->count();
           
            //Get clicked count.
            $totalSpam = EmailCampaignStats::where('spam', '=', 1)->count();

            $per_page = \Config::get('app.email_campaign_report_per_page');
            $response = EmailCampaignStats::orderBy('id', 'ASC')->paginate($per_page);
            return view('email_campaign/emailCampaignReport', compact('response', 'total',  'totalDelivered', 'totalFailed', 'totalOpened', 'totalClicked', 'totalSpam'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




}
