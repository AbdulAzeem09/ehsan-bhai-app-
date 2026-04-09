<?php
class _businessrating
{

	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spbusinessrating");
		$this->tar = new _tableadapter("spbuisnesssale");
		$this->pst = new _tableadapter("spbuisnesspostings");
		$this->fil = new _tableadapter("spbusinessfiles "); 
		$this->enq = new _tableadapter("spbusiness_enquiry ");
		$this->en = new _tableadapter("spbusinessenquiry ");
		$this->fav = new _tableadapter("spbusiness_favorite ");
		$this->em = new _tableadapter("spbuisness_subscriber ");
		$this->flag = new _tableadapter("flagpost ");
		$this->sup = new _tableadapter("spbusiness_support ");
		$this->spp = new _tableadapter("spprofiles");
		$this->ta->dbclose = false;
	}

	

	function read_id_sess($s_pid, $id)
	{
		return $this->flag->read('WHERE spProfile_idspProfile = ' . $s_pid . ' AND spPosting_idspPosting = ' . $id);
		// echo $this->flag->sql;die("================");
	}


	function rea_postid($pid)
	{
		return $this->spp->read('where idspProfiles='.$pid);
	}
	  


	function read_postid($postid)
	{
		return $this->pst->read('where idspbusiness='.$postid);
	}

	function addBussinessRating($data)
	{
		return $this->ta->create($data);
	}
	function addBussinessflag($data)
	{
		return $this->flag->create($data);
	}

	function read_flag_business($pid, $uid)
	{
		return $this->flag->read("WHERE  spProfile_idspProfile=$pid AND admin_userId=$uid AND spCategory_idspCategory=20 AND flag_status=0 ");
		echo $this->flag->sql;
		//die('ssssssssssssssss');
	}

	function add_business_fav($data)
	{
		return $this->fav->create($data);
	}
	function add_subscriber($data)
	{
		return $this->em->create($data);
	}

	function remove_business_fav($uid, $pid, $postid)
	{
		return $this->fav->remove("WHERE uid= $uid AND pid=$pid AND postid= $postid");
	}

	function read_fav_business($id)
	{
		return $this->fav->read("WHERE  postid=$id ");
	}
	function read_all_subscriber()
	{
		return $this->em->read();
	}

	function read_fav_business_all($uid, $pid)
	{
		return $this->fav->read("WHERE  uid=$uid  AND pid=$pid AND status=1 ");
	}


	function create_business($data)
	{
		return $this->pst->create($data);
	}

	function create_business_enquiry($data)
	{
		return $this->enq->create($data);
	}

	function create_enquiry($data)
	{
		return $this->en->create($data);
	}

	function read_enquiry_id($id)
	{
		return $this->en->read("WHERE  enquiry_id=$id ");
	}

	function read_business_enquiry($pid)
	{
		return $this->enq->read("WHERE  sellerprofile_id=$pid ");
	}
	function read_business_sent_enquiry($pid)
	{
		return $this->enq->read("WHERE  pid=$pid ");
	}

	function read_enquiry($id)
	{
		return $this->enq->read("WHERE  id=$id ");
	}
	
	function delete_business($id)
	{
		return $this->pst->remove("WHERE idspbusiness=$id");
	}
	function InactiveBusiness($data, $inactId)
	{
		return $this->pst->update($data, "WHERE idspbusiness=$inactId");
	}
	function ActiveBusiness($data, $inactId)
	{
		return $this->pst->update($data, "WHERE idspbusiness=$inactId");
	}
	function delete_files($id)
	{
		return $this->fil->remove("WHERE id=$id");
	}

	function delete_support_files($id)
	{
		return $this->sup->remove("WHERE id=$id");
	}


	function delete_files_postid($id)
	{
		return $this->fil->remove("WHERE postid=$id");
	}
	function read_business($uid, $pid)
	{
		return $this->pst->read("WHERE uid=$uid AND pid=$pid  AND exp_date >= CURDATE() AND status=1 ORDER BY idspbusiness DESC ");
		echo $this->pst->sql;
	}
	function myposted_service_b($postid)
	{
		//die('==111');
		return $this->pst->read("WHERE idspbusiness=$postid");
		//echo $this->pst->sql;
		//die('==111');
	}

	function read_business_active($uid, $pid)
	{
		return $this->pst->read("WHERE uid=$uid AND pid=$pid  AND exp_date >= CURDATE() AND status=1 ORDER BY idspbusiness DESC");
	}

	function read_business_tab($pid)
	{
		return $this->pst->read("WHERE  pid=$pid AND exp_date >= CURDATE() AND status=1 ORDER BY idspbusiness DESC ");
	}

	function read_business_draft($uid, $pid)
	{
		return $this->pst->read("WHERE uid=$uid AND pid=$pid  AND exp_date >= CURDATE() AND status=4  ORDER BY idspbusiness DESC");
		//echo $this->pst->sql;
	}

	function read_business_expired($uid, $pid)
	{
		return $this->pst->read("WHERE uid=$uid AND pid=$pid  AND exp_date < CURDATE() AND status=1 ORDER BY idspbusiness DESC");
	}


	function read_all_business_limit()
	{
		return $this->pst->read(" WHERE exp_date >= CURDATE() AND status=1 ORDER BY idspbusiness DESC LIMIT 9");
		echo $this->pst->sql;
	}
	function read_all_business($start, $limitaa)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND status=1 LIMIT $start,$limitaa");
		//echo $this->pst->sql;
		//die('====+++++++');
	}
	function read_search_business($data)
	{
		return  $this->pst->read("WHERE listing_headline LIKE '$data%' AND exp_date >= CURDATE() AND   status=1 LIMIT 10");
		// echo $this->pst->sql;
		 //die('====+++++++');
	}

	function read_search_business1($data)
	{
		return  $this->pst->read("WHERE listing_headline LIKE '$data%' AND exp_date >= CURDATE() AND   status=1 LIMIT 10");
		// echo $this->pst->sql;
		 //die('====+++++++');
	}

	function read_searchCat_business($data, $cat)
	{
		return $this->pst->read("WHERE listing_headline LIKE '$data%' AND business_category=$cat AND exp_date >= CURDATE() AND  status=1 LIMIT 10");
		//echo $this->pst->sql;
		//die('====+++++++');
	}

	function read_location($id, $start, $limitaa)
	{
	  $id = $this->pst->escapeString($id);
		return $this->pst->read("WHERE exp_date >= CURDATE() AND country=$id AND status=1 LIMIT $start,$limitaa");
	}

	function read_business_status($id, $start, $limitaa)
	{
		return $this->pst->read("WHERE business_status=$id AND exp_date >= CURDATE() AND status=1 LIMIT $start,$limitaa");
	}
	function read_business_status_id($id)
	{
		return $this->pst->read("WHERE business_status=$id AND exp_date >= CURDATE() AND status=1 ");
	}


	function read_all_business_manufacturing($start,$limitaa)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=1 AND status=1 LIMIT $start,$limitaa");
	}


	function read_all_business_manufacturing1($start,$limitaa,$categoryid)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=$categoryid AND status=1 LIMIT $start,$limitaa");
	}



	function read_all_business_manufacturingcount($categoryid)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=$categoryid AND status=1");
	}



	function read_all_business_hotel($start, $limitaa)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=2 LIMIT $start,$limitaa");
	}
	function read_all_business_website_desing($start, $limitaa)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=3 AND status=1 LIMIT $start,$limitaa");
	}

	function read_all_business_like($category, $headline)
	{
		if ($category != '10') {
			return $this->pst->read("WHERE (business_category=$category) AND (listing_headline LIKE '%$headline%' ) AND exp_date >= CURDATE() AND status=1");
			echo $this->pst->sql;
			die;
		} else {
			return  $this->pst->read("WHERE listing_headline LIKE '%$headline%' AND exp_date >= CURDATE() AND status=1 ");
		}
		echo $this->pst->sql;
		die;
	}
	function read_id_business($id)
	{
		return  $this->pst->read("WHERE idspbusiness=$id ");
		//echo $this->pst->sql;
		//die('==');
	}
	function read_category_id_business($id)
	{
		return $this->pst->read("WHERE exp_date >= CURDATE() AND business_category=$id AND status=1 LIMIT 4");
		//echo $this->pst->sql;
		//die("bbbb");
	}

	function update_business($data, $id)
	{
		return $this->pst->update($data, "WHERE idspbusiness=$id");
	}

	function save_as_draft($data)
	{
		return $this->pst->create($data);
		//echo $this->pst->sql;
	}


	function create_business_files($data)
	{
		return $this->fil->create($data);
	}
	function create_business_support_files($data)
	{
		return $this->sup->create($data);
	}

	function read_files($id)
	{
		return $this->fil->read("WHERE postid=$id ORDER BY postid ASC");
		echo $this->pst->sql;
	}
	function read_support_files($id)
	{
		return $this->sup->read("WHERE postid=$id ORDER BY postid ASC");
		echo $this->sup->sql;
	}

	function read_duration()
	{
		return  $this->tar->read();
		echo $this->tar->sql;
	}

	function read_duration_price($id)
	{
		return  $this->tar->read("WHERE id=$id");
		echo $this->tar->sql;
	}

	function read_duration_price_payment($id)
	{
		return  $this->tar->read("WHERE id=$id");
		echo $this->tar->sql;
	}



	function checkRatingAlready($bussinessId, $userId)
	{
		$isAlreadyRated = false;
		$result = $this->ta->read("WHERE idspProfiles_spProfileCompany = $bussinessId AND spProfiles_idspProfiles = $userId");
		if ($result != false && $result->num_rows > 0) {
			$isAlreadyRated = true;
		}
		return $isAlreadyRated;
	}

	function removeRatingByBusiness($bussinessId, $userId)
	{
		return $this->ta->remove("WHERE idspProfiles_spProfileCompany = $bussinessId AND spProfiles_idspProfiles = $userId");
	}

	function getRatingOfBusiness($bussinessId, $userId)
	{
		$totalRating = 0;

		$result = $this->ta->read("WHERE idspProfiles_spProfileCompany = $bussinessId AND spProfiles_idspProfiles = $userId");
		if ($result != false && $result->num_rows > 0) {
			$qGet = mysqli_fetch_assoc($result);
			$totalRating = $qGet["rating"];
		}

		return $totalRating;
	}
}
