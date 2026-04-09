
<?php
class _sprealEwallet
{
	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("sprealstate_wallet");
		$this->tvw = new _tableadapter("spvideo_wallet");

		$this->ta->dbclose = false;
	}


	function read($uid)
	{

		return	 $this->ta->read("Where seller_userid = $uid");
		//echo $this->ta->sql; die("------------------");
	}
	function read_videos($uid)
	{

		return	 $this->tvw->read("Where seller_userid = $uid order by id desc");
		//echo $this->ta->sql; die("------------------");
	}

	function create($data)
	{

		return	$this->ta->create($data);
	}

	function imageInsert($imgdata)
	{

		$this->tab->create($imgdata);
	}

	function readid($uid)
	{
		return $this->ta->read("WHERE seller_userid = $uid");
	}
	function readid_videos($uid)
	{
		return $this->tvw->read("WHERE seller_userid = $uid");
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
?>