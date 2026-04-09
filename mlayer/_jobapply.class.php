<?php

class _jobapply {

    private $conn;
    public $jobforapply;

    function __construct() {
        // Assuming _tableadapter handles database connection internally    
        $this->jobforapply = new _tableadapter("job_apply");
        $this->state = new _tableadapter("tbl_state");
    }

    function remove($postid) {
		
       $this->jobforapply->remove("WHERE id =".$postid);
	  
    }
    function alradyapply($postid , $pid ='') {
	
      // $this->jobforapply->read("WHERE pid =".$postid);
	  
	  $query = "WHERE job_id='$postid' and pid='$pid'";
        $result = $this->jobforapply->read($query);
        return $result ? $result->num_rows : 0;
	  
    }
	function statename($postid) {
	
      // $this->jobforapply->read("WHERE pid =".$postid);
	  
	    $query = "WHERE state_id='$postid'";
        $result = $this->state->read($query);
     
	  
    }
}
?>
