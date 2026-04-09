<?php
class _spstorewallet
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{

		$this->taa = new _tableadapter("spwalletartandcraft");

		$this->ta = new _tableadapter("	spstorewallet");

		$this->ta->dbclose = false;
	}


	function read($uid)
	{

		return $this->ta->read("Where seller_userid = $uid ORDER BY date_txn DESC");
	}

	//artandcraft
	function readartandcraft($uidd)
	{
		return $this->taa->read("Where seller_userid = $uidd order by id desc");
	}


	function readartandcraft_order($oid)
	{
		return $this->taa->read("Where orderid = $oid ");
	}


	function readstore_order($oid)
	{
		return $this->ta->read("Where orderid = $oid ");
	}


	 function updateorder($data, $oid){
	
      return   $this->taa->update($data,"WHERE orderid = $oid");
	
		
    }


function updatestoreorder($data, $oid){
	
      return   $this->ta->update($data,"WHERE orderid = $oid");
	
		
    }
	//artandcraft end

	function create($data)
	{

		return	$this->ta->create($data);
	}

	function imageInsert($imgdata)
	{

		$this->tab->create($imgdata);
	}

	function readimg($portid)
	{

		return	$this->tab->read("WHERE portfolio_id = $portid ");
	}

	function readimg_limit($portid)
	{

		return	$this->tab->read("WHERE portfolio_id = $portid LIMIT 1");
	}

	function delete_img($imgid)
	{

		return	$this->tab->remove("WHERE id = $imgid ");
	}

	function readport($pid, $uid)
	{

		return $this->ta->read("WHERE spPid = $pid AND spUid = $uid ORDER BY id DESC ");
	}



	function get_profile_portfolio($id, $profile)
	{

		return $this->ta->read(" WHERE spPid = $id AND $profile	= 1 ");
	}
}
