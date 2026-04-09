<?php
class _notification
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $tra;
	public $tr;
	
	function __construct() { 
		$this->ta = new _tableadapter("notification_table");
		
		$this->ta->dbclose = false;
	} 
	
	function noti_create($data){
		return $this->ta->create($data); 
	//echo $this->ta->sql; die("-------------------------");
	}	
		
	function createCreatenotification($from_id,$to_id,$message,$module,$by_seller_or_buyer){

	return $this->ta->create(array( "from_id"=> $from_id, "to_id"=> $to_id, "message"=> $message, "module"=> $module, "by_seller_or_buyer"=> $by_seller_or_buyer));
	
	}
		
	function createCreatenotificationchart($from_id,$to_id,$message,$module,$by_seller_or_buyer){

	return $this->ta->create(array( "from_id"=> $from_id, "to_id"=> $to_id, "message"=> $message, "module"=> $module, "by_seller_or_buyer"=> $by_seller_or_buyer));
	
	}
	
	function readNotification($to_id,$module,$by_seller_or_buyer){
   return $this->ta->read("WHERE to_id = $to_id  AND show_notification = 1 AND module = '$module'  AND by_seller_or_buyer = $by_seller_or_buyer ORDER BY date_and_time DESC");
		echo $this->ta->sql;
	}	
	
	function readNotificationcount($to_id,$module,$by_seller_or_buyer){
		return $this->ta->read("WHERE to_id = $to_id AND read_count = 0 AND module = '$module'  AND by_seller_or_buyer = $by_seller_or_buyer ");
	}	
	
	function updatereadCreatenotification($id){
		 return $this->ta->update(array('read_msg' => 1,'show_notification'=>0), "WHERE id = $id");
		//echo $this->ta->sql;die;
	}	
	
	function updatereadAllCreatenotification($to_id,$by_seller_or_buyer,$module){
		 
		return $this->ta->update(array('read_msg' => 1,"show_notification"=>0), "WHERE by_seller_or_buyer = $by_seller_or_buyer AND module='$module' AND to_id ='".$to_id."'");
		echo $this->ta->sql;die;
		
	}
	
	function updatereadAllCreatenotificationcount($to_id,$by_seller_or_buyer,$module){
	return	 $this->ta->update(array('read_msg' => 1,"show_notification"=>0), "WHERE by_seller_or_buyer = $by_seller_or_buyer AND module='$module' AND to_id ='".$to_id."'");
	
	}	



	
}
?>
