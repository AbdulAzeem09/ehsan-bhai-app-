<?php 
class _spproductoptionsvalues
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("spproduct_opton_values");
		$this->tad = new _tableadapter("spproduct_opton_name"); 
		$this->taat = new _tableadapter("spproduct_attributes");
		$this->ta->dbclose = false;
		$this->tad->dbclose = false;
		$this->taat->dbclose = false;
	}

	// CREATE FLAG




    function deleteoption($id){
			$this->ta->remove("WHERE idsopv= " . $id);
	}

    function deletecolor($id){
        $this->ta->remove("WHERE idsopv= " . $id);
}

	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}

	function create_atrib($data){
		$id = $this->taat->create($data);
		return $id; 
	}
	
 function read($uid, $pid)
    {
       
        return $this->ta->read("WHERE spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."'");
    }

function readattribbyid($itemId,$itemType,$uid, $pid)
    {
       
        return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."'");
    }


function read_by_temp_id($itemId)
    {
       
        return $this->taat->read("WHERE item_id ='".$itemId."' "); 
    }
	
	
	function read_by_temp_id_size($itemId,$size)
    {
       
        return $this->taat->read("WHERE item_id ='".$itemId."' AND size_idsopv ='".$size."' "); 
    }


function update_by_temp_id_size($data,$itemId,$size)
    {
       
        return $this->taat->update($data ,"WHERE item_id ='".$itemId."' AND size_idsopv ='".$size."' "); 
    }


function readattribopnamebyid($itemId,$itemType)
    {
       
		 return $this->tad->read("WHERE idsop in(1,2)","ORDER BY t.opton_name ASC"," t.idsop,t.opton_name");

    }

function readattribopvaluebyid($itemId,$itemType,$optId)
    {
       
        return $this->ta->read("WHERE spa.item_id ='".$itemId."' and spa.item_type ='".$itemType."' and spa.idsop ='".$optId."' and t.idsop=spa.idsop ","ORDER BY t.opton_values ASC","DISTINCT t.idsopv,t.opton_values, spa.opt_qty,spa.opt_price,spa.opt_price_prefix","left join spproduct_attributes spa on t.idsopv=spa.idsopv");
    }


	function readattribopvaluebyidcolor($itemId,$itemType,$optId)
    {
        $itemId = $this->taat->escapeString($itemId);
        return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and color_idsop ='".$optId."' and opt_qty>0 ","ORDER BY color_idsopv  ASC","DISTINCT color_idsopv ");
    }

	function readattribopvaluebyidsize($itemId,$itemType,$optId,$colorId)
    {
      $itemId = $this->taat->escapeString($itemId);
       if($colorId>0)
		{
			return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and size_idsop ='".$optId."' and color_idsopv ='".$colorId."' and opt_qty>0 ","ORDER BY size_idsopv  ASC","DISTINCT size_idsopv ");
		}else
		{
        return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and size_idsop ='".$optId."' and opt_qty>0 ","ORDER BY size_idsopv  ASC","DISTINCT size_idsopv ");
		}
    }



function readattribprice($itemId,$itemType,$sizeId,$colorId)
    {
      
		return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and color_idsop='1' and size_idsop ='2' and color_idsopv ='".$colorId."' and size_idsopv='".$sizeId."'","ORDER BY size_idsopv  ASC","opt_price ");
		
    }

	function readminmaxprice($itemId,$itemType)
    {
        $itemId = $this->taat->escapeString($itemId);
        return $this->taat->read("WHERE item_id ='".$itemId."' and item_type ='".$itemType."'","ORDER BY opt_price  ASC"," min(opt_price) as minip,max(opt_price) as maxp ,max(opt_qty) as maxqty");
    }

 function readbyoptionid($uid, $pid,$idsop)
    {
       
        return $this->ta->read("WHERE spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."' and idsop='".$idsop."' ORDER BY opton_values ASC");
       // echo  $this->taaa->sql;
    }

function readopnname($uid, $pid)
    {
       
        return $this->tad->read("WHERE spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."'");
    }

 function singleread($idsop)
    {
        return $this->ta->read("WHERE idsopv =".$idsop);
    }

 function singleopnameread($idsop)
    {
        return $this->tad->read("WHERE idsop =".$idsop);
    }

function delopvalue($idsopv){
		$this->ta->remove("WHERE idsopv= " . $idsopv);
	}



function delepro_attrib($itemId,$itemType,$uid, $pid)
    {
       
        return $this->taat->remove("WHERE item_id ='".$itemId."' and item_type ='".$itemType."' and spBuyeruserId ='".$uid."' and spByuerProfileId='".$pid."'");
    }


  function updateopvalue($idsop, $optonvale, $idsopv){
		return $this->ta->update(array("idsop" => $idsop, "opton_values"=>$optonvale), "WHERE idsopv ='".$idsopv."'");
	}




	
}
?>
