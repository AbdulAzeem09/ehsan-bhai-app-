<?php 
class _trainingrating
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("sptrainingrating");
		$this->pa = new _tableadapter("spperchase_rate");
		$this->ta->dbclose = false;
	} 

	function readrating($postid){
		return $this->ta->read("WHERE spTrainId = $postid ORDER By id DESC");
		 //echo $this->ta->sql;die('===--000');
	}
	function read_purchase($postid){
		return $this->pa->read("WHERE postid = $postid ORDER By id DESC");
		 //echo $this->ta->sql;die('===--000');
	}
	function update_purchase($data, $pid){
		return $this->pa->update($data, "WHERE postid = $pid");   
	}
	
	function addTrainingRating($data){
		$this->ta->create($data);
	}
	function addPerchaseRating($data){
		$this->pa->create($data);
	}
	
	function checkRatingAlready($postid, $userId) {
		$isAlreadyRated = false;
		$result = $this->ta->read("WHERE spTrainId = $postid AND spProfileId = $userId");
		if ($result != false && $result->num_rows > 0) {
			$isAlreadyRated = true;
		}
		return $isAlreadyRated;
	}
	
	function removeRating($postid, $userId){
		return $this->ta->remove("WHERE spTrainId = $postid AND spProfileId = $userId");
	}
	
	function getRatingOfTraining($postid, $userId){
		$totalRating = 0;

		$result = $this->ta->read("WHERE spTrainId = $postid AND spProfileId = $userId");
		if ($result != false && $result->num_rows > 0) {
			$qGet = mysqli_fetch_assoc($result);
			$totalRating = $qGet["rating"];
		}

		return $totalRating;
	}
}
?>