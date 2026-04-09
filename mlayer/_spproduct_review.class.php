<?php 
class _spproduct_review

{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spproduct_review"); 
	   $this->pr = new _tableadapter("spproduct");

		$this->ta->dbclose = false;
	}
	
	function read_product($idposting_new)
	{
		
		return $this->pr->read("WHERE idspPostings=$idposting_new");
		//echo $this->pr->sql;
		//die('======');
	}
	
	
	function create($data)
	{
		$id = $this->ta->create($data);
		return $id;
	}
	function read_review($id)
	{
	  $id = $this->ta->escapeString($id);
		//return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
		return $this->ta->read("WHERE product_id =$id");
	}

	function read($pid,$postid){
		return $this->ta->read("WHERE spProfile_idspProfile = " . $pid ." AND idspOrder =".$postid);
	}

	function readstorerating($postid){
		return $this->ta->read("WHERE spPostings_idspPostings = $postid ORDER By id DESC");
	}


      function readstorerating_for_review($postid){
		return $this->ta->read("WHERE product_id = $postid ORDER By id DESC"); 
	}

    
function readstorerating_for_review_store($postid,$selltype){
    return $this->ta->read("WHERE product_id = $postid AND product_type='$selltype' ORDER By review_star DESC"); 
}


        function readrating($uid,$pid,$prtid){

        return $this->ta->read("WHERE user_userid = " . $uid ." AND user_profileid =".$pid ." AND product_id =".$prtid);
    }

    function readallrating($product_id,$selltype){
        $product_id = $this->ta->escapeString($product_id);
        return  $this->ta->read("WHERE product_id = $product_id AND product_type='$selltype' ORDER By review_star DESC");
		echo $this->ta->sql;
    }


     function spstorePostingDate($firstTime,$lastTime = ''){
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
