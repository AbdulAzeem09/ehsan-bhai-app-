<?php

class _shortlist {

// select t.idspPostings, ca.spCategoryname, t.spPostingtitle, t.spPostingDate, t.spPostingExpDt, t.spPostingNotes, t.spPostingPrice, s.idspProfiles, spPostingVisibility, p.spPostingPic
    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("freelance_shortlist");
        $this->ta->dbclose = false;
        
    }
    function chekShortlist($postid, $pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid' AND spposting_idspPostings = '$postid' AND shortlist_status = 1 ");
    }
    //get all shortlist canidate
    function getshortlist($postid){
        return $this->ta->read("WHERE spposting_idspPostings = '$postid' ");
    }
    
    
    
    
}

?>