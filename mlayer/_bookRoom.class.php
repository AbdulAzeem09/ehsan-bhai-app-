<?php 
class _bookRoom
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("room_booking");
		$this->trw = new _tableadapter("sprealstate_wallet");
		$this->ta->dbclose = false;
	}
	//add all fields
	function create($data){
		return $this->ta->create($data);
	}
	
	function creat_wallet($data){
		return $this->trw->create($data);
	}
	//read all enquery of specific profile
	function chekBook($pid, $postid){
	  $postid = $this->ta->escapeString($postid);
		return  $this->ta->read("WHERE spProfile_idspProfile = $pid AND spPosting_idspPosting = $postid");
	}
	
	function read_row($postid){
		return  $this->ta->read("WHERE spPosting_idspPosting = $postid");
	
	//echo $this->ta->sql; die("-------------------");
	}
	// //read single enquiry
	// function read($iae){
	// 	return $this->ta->read("WHERE idartenquiry = $iae");
	// }
	function readMyBooking($pid , $type){
		return $this->ta->read("WHERE spProfile_idspProfile = $pid  AND rs_roomType = '$type'");
	}
	// APPROVE ANY PROPERTY
	function approve($bokId){
		return $this->ta->update(array("spStatus" => 1), "WHERE idspRoomBook = $bokId ");
	}
	// REJECTED ANY SINGLE PROPERTY
	function reject($bokId){
		return $this->ta->update(array('spStatus' => 2), "WHERE idspRoomBook = $bokId");
	}
	// UPDATE THE PRICE
	function updateDiscount($bokId, $spDiscountPrice, $spDiscountPer){
		return $this->ta->update(array("spStatus" => 1, 'spDiscountPrice' => $spDiscountPrice, 'spDiscountPer' => $spDiscountPer), "WHERE idspRoomBook = $bokId");
	}
	
}
?>
