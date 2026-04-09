<?php

class _commentlike {

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("spcommentslike"); 
		$this->tac = new _tableadapter("spcommentslike");
        $this->ta->join = "INNER JOIN spPostings as d ON t.post_id = d.idspPostings";
        $this->ta->dbclose = false;
    }

    function addlike($data) {
        $this->ta->create($data);
    }

    function getTotalLikes($commentId) {
        $totalLikes = 0;
        $qGetLikes = $this->ta->read("WHERE t.comment_id=" . $commentId);
        if($qGetLikes != false) {
            $totalLikes =  $qGetLikes->num_rows;
        }
        return $totalLikes;
    }
	
	
	
	function readLike($posiid,$commentid,$likeby) {
        return $this->tac->read("WHERE t.comment_id=" . $commentid. " AND t.liked_by = ". $likeby." AND t.post_id =" . $posiid);
		echo  $this->tac->sql;
		//echo '-----------';
    }

	
	

    function isCommentLikedByUser ($commentId, $userId) {
        $isLiked = false;
        $qGetLikes = $this->ta->read("WHERE t.comment_id=" . $commentId . " AND t.liked_by = ". $userId);
        if($qGetLikes != false && $qGetLikes->num_rows > 0) {
            $isLiked = true;
        }
        return $isLiked;
    }

    function unlike($postid, $commentId, $userId) {
        return $this->ta->remove("WHERE t.post_id=" . $postid . " AND t.comment_id =" . $commentId." AND t.liked_by = ". $userId);
    }

}

?>