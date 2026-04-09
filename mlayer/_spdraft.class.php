<?php
class _spdraft {
    public $dbclose = false;
    private $conn;
    public $ta;
    public $pic;
    public $tad;
    public $pid; 
    public $spuid;

    function __construct() {
        $this->spmessagedraft = new _tableadapter("spdraftmessage");
        $this->job_forword = new _tableadapter("jb_forwardjob_details");
        $this->job_app = new _tableadapter("job-apply");
       
    }

  public function read_message($spuid, $offset = 0, $limit = 10, $searchKeyword = '') {
    $query = "WHERE recieverid = $spuid";
    if ($searchKeyword) {
        $query .= " AND draft_message LIKE '%$searchKeyword%'";
    }
    $query .= " LIMIT $offset, $limit";
    return $this->spmessagedraft->read($query);
}


    public function jobforword($spuid) {
        $condition = "WHERE recieverid = '$spuid'";
        $result = $this->spmessagedraft->read($condition);

        if ($result) {
            return $result[0]['count']; // Assuming `read` returns an associative array with the count
        } else {
            return 0;
        }
    }

    public function apply($spuid) {
        $condition = "WHERE uid = '$spuid'";
        $result = $this->job_app->read($condition);

        if ($result) {
            return $result[0]['count']; // Assuming `read` returns an associative array with the count
        } else {
            return 0;
        }
    }

    public function get_draft_count($spuid) {
        $query = "WHERE recieverid='$spuid'";
        $result = $this->spmessagedraft->read($query);
        return $result ? $result->num_rows : 0;
    }
     
	function remove($draftid) {

       $this->spmessagedraft->remove("WHERE id =".$draftid);
	  
    }
	 public function updatedraft($data,$id){ 

        return $this->spmessagedraft->update($data, "WHERE id = '$id'"); 
   }
}
?>









