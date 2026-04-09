<?php 
class _spauction_transection
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spauction_transection");
		$this->bid = new _tableadapter("spbid");
		$this->wall = new _tableadapter("spstorewallet");
		$this->ta->dbclose = false;
	}

	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	function create_bid_wallet($data){
		return $this->wall->create($data);
		
	}
	
	
 function read($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE sellid =".$pid);
    }

     function postread($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE postid =".$pid);
    }

     function mybooking($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE buyer_pid =".$pid);
		echo $this->ta->sql;
    }

	// DELETE ENQUIRY
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)

   function readauctiontransection($Buyer_uid){


   	return $this->ta->read("WHERE buyer_uid =".$Buyer_uid);

   }
 
 function update_bid_status($data,$id){
	return $this->bid->update($data,"WHERE id=$id");
 }

	/*function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}*/

	
}
?>