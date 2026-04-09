<?php
class _artandcraftWallet
{
    
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("artandcraft_wallet");
		
		$this->ta->dbclose = false;
	} 
	
		
	function readartandcraftWallet($pid){
		return $this->ta->read("WHERE user_id = $pid");
	}
		
	function createartandcraftWallet($user_id, $amount){
		return $this->ta->create(array( "user_id"=> $user_id, "amount"=> $amount));
	}
		
	function updateartandcraftWallet($user_id, $amount){
		return $this->ta->update(array( 'amount' => $amount), "WHERE user_id ='".$user_id."'");
	}
	
	
	
	
}
?>