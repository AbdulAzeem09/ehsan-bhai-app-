<?php

class _postlike {

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("splike");
        $this->ta->join = "INNER JOIN spPostings as d ON t.spPostings_idspPostings = d.idspPostings";
        $this->ta->dbclose = false;
    }

    function addlike($data) {
        $this->ta->create($data);
	}

    function read($postid) {
        return $this->ta->read("WHERE spPostings_idspPostings=" . $postid);
    }

    function likeread($postid, $profileid, $userid) {
        return $this->ta->read("WHERE t.spPostings_idspPostings = $postid  AND t.spProfiles_idspProfiles =  '$profileid' AND t.uid = $userid");
    }

    function readnojoin($postid ) {
        return $this->ta->read("WHERE spPostings_idspPostings=" . $postid, "", "*", "");
    }

    function unlike($postid, $profileid) {
        return $this->ta->remove("WHERE spPostings_idspPostings=" . $postid . " AND spProfiles_idspProfiles=" . $profileid);
    }

    function mostlikedpost($uid) {
        return $this->ta->read("WHERE spPostings_idspPostings in(select idspPostings from spPostings WHERE spProfiles_idspProfiles in(select idspProfiles from spProfiles WHERE spUser_idspUser =" . $uid . "))", "GROUP BY spPostings_idspPostings ORDER BY count DESC limit 3", "spPostings_idspPostings, count(spPostings_idspPostings) as count");
    }

    function admininfo() {
        return $this->ta->read("GROUP BY spPostings_idspPostings ORDER BY count DESC limit 5", "", "spPostings_idspPostings, count(spPostings_idspPostings) as count");
    }

    function readcount($profileId) {
        $connection = _data::getConnection();
        $query = mysqli_query($connection, "select count(*) as totalLikes from splike where spProfiles_idspProfiles = '" . $profileId . "'");
        $row = mysqli_fetch_assoc($query);
        return $row['totalLikes'];
		 
		
    }

}

?>