<?php 
class _spproductoptionsname
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spproduct_opton_name");
		$this->ta->dbclose = false;
	}

	// CREATE FLAG
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
 function read($uid, $pid)
    {
       
        return $this->ta->read("WHERE spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."'");
    }

 function singleread($idsop)
    {
        return $this->ta->read("WHERE idsop =".$idsop);
    }


function delopname($idsop){
		$this->ta->remove("WHERE idsop= " . $idsop);
	}

  function updateopname($optonname, $idsop){
		return $this->ta->update(array("opton_name"=>$optonname), "WHERE idsop ='".$idsop."'");
	}




	
}
?>