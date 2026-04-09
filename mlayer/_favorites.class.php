<?php
class _favorites
{

	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spfavorites");
		$this->tapp = new _tableadapter("spfreelancerfavorites");

		$this->tb = new _tableadapter("realstate_favorites");
		$this->train = new _tableadapter("sptraining_favorites");
		$this->art = new _tableadapter("artandcraft_favorites");
		$this->tav = new _tableadapter("sppostingmedia");
		$this->nav = new _tableadapter("spprofiles");
		$this->nar = new _tableadapter("spmessaging");
		
		

		$this->ta->dbclose = false;
	}

	/*function addfavorites($data)	
	{
		$this->ta->create($data);
	}*/

    
	function share_post($data)
	{
		 return  $this->nar->read('where t.spPostings_idspPostings ='.$data);
		 echo $this->nar->sql;
		 die('==');
	}


	function likes($data)
	{
		return  $this->ta->read('where t.spPostings_idspPostings ='.$data);
		// $this->ta->sql;
		//die('==');
	}


	function read_profile($id)
	{
		return $this->nav->read('where idspProfiles ='.$id);
		//echo $this->nav->sql;
		//die('============');
	}


	function read_share($id)
	{
		 $this->nav->read('where idspProfiles ='.$id);
		echo $this->nav->sql;
		die('============');
	}




	function addfavorites_training($data)
	{
		$this->train->create($data);
	}
	function addfavorites_f($data)
	{
		$this->ta->create($data);
		//echo $this->ta->sql;
		//die('==');
	}

	function addfavorites_realstate($data)
	{
		$this->tb->create($data);
	}


	function remove_unfav_realstate1111($postid)
	{
		$this->tb->remove("WHERE spPostings_idspPostings=" . $postid);

		//echo $this->tb->sql; die("???????????????");     
	}

	function addfavorites_artandcraft($data)
	{
		$this->art->create($data);
	}

	// READ ALL FAVOURITE POST
	function read($postid)
	{
		return $this->tapp->read("WHERE spPostings_idspPostings=" . $postid);
		//echo $this->ta->sql;

	}



	function remove1($id)
	{
		return $this->train->remove("WHERE id=$id"); 
		//echo $this->train->sql;
		//die("jhfuysd");
	}



	function read_fav($postid, $uid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings=" . $postid . " AND spUserid=" . $uid);
		//echo $this->ta->sql;
	}

	function read_fav_count($postid1)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = '$postid1'");
		//echo $this->ta->sql;
	}

	function readcount($postid1)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = '$postid1'");
		//echo $this->ta->sql;
	}


	function readcountdel($postid11)
	{
		return $this->ta->read("WHERE t.spPostings_idspPostings = '$postid11'");
		//echo $this->ta->sql;
	}



	function readfav()
	{
		return $this->ta->read();
	}


	function remove_favPost($postid)
	{
		return $this->ta->remove("WHERE id=" . $postid);
	}

	/*function removefavorites($postid,$uid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings=" .$postid. " AND spUserid=" .$uid);
	}*/

	function removefavorites_training($postid, $uid)
	{
		return $this->train->remove("WHERE sppostings_idsppostings=" . $postid . " AND spuser_idspuser=" . $uid);
	}

	function removetimelinefav($postid, $pid, $uid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}

	function removefavorites_art($postid, $uid)
	{
		return $this->art->remove("WHERE sppostings_idsppostings=" . $postid . " AND spUserid=" . $uid);

		//echo  $this->art->sql;
		//die('======');
	}
	function removefavorites_f($postid, $uid, $pid)
	{
		return $this->ta->remove("WHERE sppostings_idsppostings=" . $postid . " AND spUserid=" . $uid . " AND spProfiles_idspProfiles=" . $pid);
	}

	function favorite_data($pid, $uid)
	{
		return $this->art->read("WHERE spProfiles_idspProfiles=" . $pid . " AND spUserid=" . $uid);

		//echo  $this->art->sql;
		//die('======');
	}




	function remove($id)
	{
		return $this->art->remove("WHERE id = $id");

		//echo  $this->art->sql;
		//die('======');
	}








	function removevideofavorites_del($postid, $uid)
	{
		return $this->tav->remove("WHERE sppostings_idsppostings=" . $postid . " AND spUserid=" . $uid);

		//echo  $this->art->sql;
		//die('======');
	}






	//check favourite realstate is add or not
	function chekFavourite($postid, $pid, $uid)
	{	  
    $postid = $this->tb->escapeString($postid);
		return	$this->tb->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
	}
	function chekFavourite_art($postid, $pid, $uid)
	{
	  $postid = $this->art->escapeString($postid);
		return	$this->art->read("WHERE spPostings_idspPostings= '$postid ' AND spUserid= '$uid' AND spProfiles_idspProfiles = '$pid'");
		//echo $this->tb->sql;
		//die('++++');
	}


	function chekFavourite_training($postid, $uid, $pid)
	{
		return $this->train->read("WHERE sppostings_idsppostings= '$postid ' AND spuser_idspuser= '$uid' AND spprofiles_idspprofiles = '$pid'");
	}

	function chekFavourite_training_post($uid, $pid)
	{
		return $this->train->read("WHERE spuser_idspuser= '$uid' AND spprofiles_idspprofiles = '$pid'");
		//echo $this->train->sql;
	}
	// read my all favourite posts
	function readFavourt($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfiles = $pid ORDER BY id DESC");
	}
	// DELETE FAVOURITES FROM THE STORE
	function removeFavProfile($postid, $pid)
	{
		return $this->ta->remove("WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $pid");
	}

	function singletimelinefav($postid, $pid)
	{
		return $this->ta->read("WHERE spPostings_idspPostings== $postid AND spProfiles_idspProfiles = $pid");
	}
}
