<?php 
class _groupdiscussreply

{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("group_discussionreply");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}


function readdiscussmsg($msgid)
	{
		return $this->ta->read("WHERE comment_id =".$msgid,"ORDER BY id DESC");
	}

    function getsellercomment($comid)
    {
    	return $this->ta->read("WHERE comment_id = $comid");
    }


     function spreplyPostingDate($firstTime,$lastTime = ''){
        date_default_timezone_set('Asia/Karachi');
        
        if ($lastTime) {
            $now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
        }else{
            $now = new DateTime(date('Y-m-d h:i:s'));
        }
        $then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
        $diff = $then->diff($now);
        $time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);
        
        if ($time_ago['years'] > 0) {
            return $time_ago['years']. ' year ago';
        }else if ($time_ago['months'] > 0) {
            return $time_ago['months']. ' month ago';
        }else if ($time_ago['days'] > 0) {
            if($time_ago['days'] == 1){
                return $time_ago['days']. ' day ago';
            }else{
                return $time_ago['days']. ' days ago';
            }
        }else if ($time_ago['hours'] > 0) {
            return $time_ago['hours']. ' hours ago';
        }else if ($time_ago['minutes'] > 0) {
            return $time_ago['minutes']. ' min ago';
        }else{
            return $time_ago['seconds']. ' sec just now';
        }
    }


/*
	function getbuyerproduct($pid){
		return $this->ta->read("WHERE spByuerProfileId = $pid ORDER BY id DESC");
	}

	
    function getMysellerproduct($sellerid)
    {
    	return $this->ta->read("WHERE spSellerProfileId = $sellerid ORDER BY id DESC");
    }


    function updatereqstatus($data,$reqid)
	{
		 $did = $this->ta->update($data, $reqid);
	}
*/
	
  
/*
function addsellercomment($data)
	{
		$id = $this->ta->create($data);
	}*/

	

}
?>