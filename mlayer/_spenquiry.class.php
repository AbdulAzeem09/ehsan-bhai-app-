<?php

class _spenquiry {

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("spenquiry");
        //$this->ta->join = "INNER JOIN spPost_has_spOrder as d ON t.idspOrder = d.spOreder_idspOreder INNER JOIN spPostings as p ON d.spPostings_idspPostings = p.idspPostings";
        $this->ta->dbclose = false;
    }

    function create($data) {
        $this->ta->create($data);
    }

    function read($uid) {
        $conn = _data::getConnection();        
        $sql = "select count(*) from spenquiry where spuser_idspUser = $uid";
        $result = mysqli_query($conn, $sql);
        return $result;
        //return $this->ta->read($uid);
    }

}

?>