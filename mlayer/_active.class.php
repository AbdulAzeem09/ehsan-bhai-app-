<?php 
class _active
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	public $ts;
	
	function __construct() { 

		$this->ta = new _tableadapter("spbid");
	
		$this->ta->dbclose = false;
	}




    function updateactive($data,$id){
         $this->ta->update($data,"WHERE id=$id and status=3");

        echo  $this->ta->sql; die('---------------------');
        }









}