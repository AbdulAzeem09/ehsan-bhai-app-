<?php

class _postbanner {

    public $dbclose = false;
    private $conn;
    public $ta;
    public $pic;
    public $tad;

    function __construct() {
        $this->ta = new _tableadapter("sppostingbanner");
        $this->ta->dbclose = false;

    }
    //chek banner already added or not
    function chek_banner($pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid' ");
    }
    //read banner from database
    function read_banner($pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = '$pid'");
    }
    

}

?>