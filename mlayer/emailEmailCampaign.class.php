<?php


class emailEmailCampaign 
{
    public $dbclose = false;
	public $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sms_email_campaigns");
		$this->ta->dbclose = false;
	}
	
    function getemailEmailCampaign($userid , $type){
        return $this->ta->read("WHERE user_id = '$userid' AND type = '$type'");
    }

    //GET EMAIL REPORT ON SERVER
    function getemailReport($job_id){
    	try{
            $api_key="key-2664c40f3b1c2991fb51e72fa4ecd13a";
            $domain ="dev.thethe-share-page.com";
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
