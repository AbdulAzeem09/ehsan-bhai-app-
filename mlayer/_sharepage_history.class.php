<?php

class _sharepage_history {

// select t.idspPostings, ca.spCategoryname, t.spPostingtitle, t.spPostingDate, t.spPostingExpDt, t.spPostingNotes, t.spPostingPrice, s.idspProfiles, spPostingVisibility, p.spPostingPic
    // property declaration
    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("sharepage_history");
        $this->ta->dbclose = false;
        
    }
    
    //milestone read
    function readSharepageBlnc(){
        return $this->ta->read(" ORDER BY id_sharepage DESC LIMIT 1");
    }
    
}

?>