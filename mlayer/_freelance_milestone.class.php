<?php

class _freelance_milestone {

// select t.idspPostings, ca.spCategoryname, t.spPostingtitle, t.spPostingDate, t.spPostingExpDt, t.spPostingNotes, t.spPostingPrice, s.idspProfiles, spPostingVisibility, p.spPostingPic
    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("freelance_milestone");
        $this->ta->dbclose = false;
        
    }
    function create($data){
        $id = $this->ta->create($data);
        return $id;
    }
    //get my post id milestone
    function readMymilestone($postid){
        return $this->ta->read("WHERE spposting_idspPostings = '$postid' ORDER BY id_milestone ASC");
    }
    //chek if it is last mile stone
    function aprove($milestone){
        return $this->ta->update(array("milestoneStatus" => 1), "WHERE id_milestone ='$milestone'");
    }
    //complete milestone
    function completeMymilestone($postid){
        return $this->ta->read("WHERE spposting_idspPostings = '$postid' AND milestoneStatus = 1 ORDER BY id_milestone ASC");
    }
    //milestone read
    function read($milestone){
        return $this->ta->read("WHERE id_milestone = $milestone AND milestoneStatus = 1");
    }
    
}

?>