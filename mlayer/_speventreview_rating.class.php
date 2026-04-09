<?php 
class _speventreview_rating
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("speventreviewrating");
		$this->ta->dbclose = false;
	}
	
	function create($data)
	{
		$id = $this->ta->create($data);
	}

	function read($pid,$postid){
		return $this->ta->read("WHERE spProfile_idspProfile = " . $pid ." AND idspPostings =".$postid);
	}

	function readeventrating($postid){
		return $this->ta->read("WHERE idspPostings =".$postid);
	}


     function speventPostingDate($firstTime,$lastTime = ''){
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

    function readsumeventrating($postid){
        return $this->ta->read("SUM (rating) WHERE idspPostings =".$postid);
    }



}
?>