<?php

class _abhishek1
{
    public $dbclose = false;
	private $conn;
	public $abhi;
	public $radio;
	public $ad;
	function __construct() { 
		$this->abhi = new _tableadapter("art_category");
		$this->abhi->dbclose = false;
		
		$this->radio = new _tableadapter("art_sold_by");
		$this->radio->dbclose = false;
		$this->ad = new _tableadapter("user_register");
		
	} 
      function read0(){

            return  $this->abhi->read(); 
        }
	  function read1(){

		return $this->radio->read();

	  }
	  function insert($a){
 return $this->ad->Create($a);

	  }
	  function read2(){
		return $this->ad->read();
	  }
	  function delete($id){
		return $this->ad->remove("where id=$id");  
	  }
	  function read_edit($id){
		return $this->ad->read("where id=$id");
		
				}
	  function update_data($data,$id){
		return $this->ad->update($data,"where id=$id");
	}

	  }
