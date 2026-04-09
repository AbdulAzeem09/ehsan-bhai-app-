<?php 
class _spwithdraw
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("withdraw_amount");
		$this->ta->dbclose = false;
	}

	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
 function read($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE sellid =".$pid);
    }

     function withdrawreadstore($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'store' ");
    }

      function withdrawreadgroupevent($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'GroupEvents' ");
    }


     function withdrawreadevent($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'event' ");
    }

      function withdrawreadprivate($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'private' ");
    }

      function withdrawreadpublic($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'public' ");
    }

  function withdrawreadreferral($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE userid = ".$uid. " AND module = 'referral' ");
    }


     function mybooking($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE buyer_pid =".$pid);
    }



	// DELETE ENQUIRY
	function delEnq($enqid){
		$this->ta->remove("WHERE enquiry_id= " . $enqid);
	}
	// READ MY FLAG (I AM FLAGGER)

   function readeventtransection($Buyer_uid){


   	return $this->ta->read("WHERE buyer_uid =".$Buyer_uid);

   }

function readtransaction($uid){


   	return $this->ta->read("WHERE userid =".$uid);

   }
    

	/*function readmyflag($pid){
		return $this->ta->read("INNER JOIN spcategories AS c ON t.spCategory_idspCategory = c.idspCategory INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings WHERE spProfile_idspProfile = $pid AND flag_status = 0");
	}*/

	
}
?>