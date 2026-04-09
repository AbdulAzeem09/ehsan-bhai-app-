<?php

class _save_job {

// select t.idspPostings, ca.spCategoryname, t.spPostingtitle, t.spPostingDate, t.spPostingExpDt, t.spPostingNotes, t.spPostingPrice, s.idspProfiles, spPostingVisibility, p.spPostingPic
    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;
    public $ca;
    public $uid;

    function __construct() {
        $this->ta = new _tableadapter("jobboard_save");
     //   $this->ta->join = "LEFT JOIN spjobboard ON jobboard_save.spProfiles_idspProfiles = spjobboard.spProfiles_idspProfiles";
        $this->ca = new _tableadapter("spjobboard");
         $this->fa = new _tableadapter("spfavorites");
      //  $this->ta->dbclose = false;
        
    }
    function chekJobSave($postid, $pid){
        $postid = $this->ta->escapeString($postid);
        return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid' AND spPostings_idspPostings = '$postid' AND save_status = 1 ");
    }
    //get all shortlist canidate
    function getshortlist($postid){
        return $this->ta->read("WHERE spposting_idspPostings = '$postid' ");
    }
    
    function grtAllSveJob($uid){
             return $this->ta->read(" WHERE spPostings_idspPostings = '$uid' AND save_status = 1 ");
  //  $query = "LEFT JOIN spjobboard 
      //        ON jobboard_save.spProfiles_idspProfiles = spjobboard.spProfiles_idspProfiles
       //       WHERE jobboard_save.spPostings_idspPostings = '".$uid."'
       //       AND jobboard_save.save_status = 1";
        //      echo $query;
        //      return $this->ta->read($query);
    
    }
     function countSveJob($uid){
        // Use COUNT in the SQL query to get the number of saved jobs
        $result = $this->ta->read("SELECT COUNT(*) as total FROM jobboard_save WHERE spPostings_idspPostings = '$uid' AND save_status = 1");
        
        // Assuming $this->ta->read() returns an array, extract the count value
        return isset($result[0]['total']) ? $result[0]['total'] : 0;
    }







 
    function countSavedJobs($uid) {
        $result = $this->ta->read("WHERE spPostings_idspPostings = '$uid' AND save_status = 1");
        return $result ? $result->num_rows : 0;
    }

    function countFavorites($uid) {
        $result = $this->fa->read("WHERE spProfiles_idspProfiles = '$uid'");
        return $result ? $result->num_rows : 0;
    }
}

?>
