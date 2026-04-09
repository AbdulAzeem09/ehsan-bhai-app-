<?php

class _video
{
	public $dbclose = false;
	private $conn;
	public $v;
	public $vl;
	public $vc;

	function __construct()
	{
		$this->v 	= new _tableadapter("spvideo");
		$this->vsu 	= new _tableadapter("spvideo_subscribe");
		$this->vl 	= new _tableadapter("video_like");
		$this->spp 	= new _tableadapter("spprofiles ");
		$this->vp 	= new _tableadapter("video_payment ");
		$this->vw 	= new _tableadapter("spvideo_wallet");
		$this->vc 	= new _tableadapter("video_comment");
		$this->maf 	= new _tableadapter("music_album_favorites");

		$this->vcon 	= new _tableadapter("video_contribution");
		$this->f 	= new _tableadapter("flagpost");
		$this->hc 	= new _tableadapter("video_homepage_category");

		$this->v->dbclose = false;
		$this->vl->dbclose = false;
		$this->vc->dbclose = false;
		$this->maf->dbclose = false;
		$this->vp->dbclose = false;
		$this->vcon->dbclose = false;
		//$this->vcat->dbclose = false;
		$this->f->dbclose = false;
		$this->hc->dbclose = false;
	}

	function delete_vid($vid)
{
	return $this->v->remove("WHERE video_id = $vid");
	// echo $this->v->sql;
	// die('ssssssss');
}
	function check_video_like_by_id($video_id, $pid, $uid)
	{
		return $this->vl->read("where video_id = $video_id AND pid = $pid AND uid = $uid");
	}
	function delete_like($video_id, $pid, $uid)
	{
		return $this->vl->remove("where video_id = $video_id AND pid = $pid AND uid = $uid");
	}

	function readid($id)
	{
	  $id = $this->spp->escapeString($id);
		return $this->spp->read("WHERE idspProfiles=$id");
	}

	function read_like($id)
	{
	 $id = $this->vl->escapeString($id);
		return $this->vl->read("WHERE video_id = $id AND like_status = 1 ");
	}

	function read_unlike($id)
	{
		$id = $this->vl->escapeString($id);
		return $this->vl->read("WHERE video_id = $id AND like_status = 0 ");
	}


	function removeProfiles($pid)
	{
		$this->v->remove("WHERE t.spProfiles_idspProfiles= " . $pid);
	}

	function readall($pid)
	{
		return  $this->vp->read("WHERE video_pid= $pid");
	}
	function readal22($id)
	{
		return $this->v->read("WHERE video_id=$id");
		//echo $this->v->sql;
         //die('ssssssss');
	}
	function readal223($id)
	{
		return $this->v->read("WHERE spProfiles_idspProfiles=$id");
	}
	function readviews($id)
	{
		$id = $this->v->escapeString($id);
		return $this->v->read("WHERE video_id=$id");
	}

	function read_now($pid)
	{
		return $this->v->read("where t.spProfiles_idspProfiles = " . $pid);
	}

	function readpayment($pid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile=$pid");
	}

	function readpaymentstatus($id, $v_id)
	{
	  $v_id = $this->vp->escapeString($v_id);
		return $this->vp->read("WHERE spProfile_idspProfile=$id AND video_id=$v_id AND payment_status='succeeded' ");
		//echo $this->vp->sql;
	}

	function add_video_like($data)
	{
		return	$this->vl->create($data);
	}

	function add_video_subscribe($data)
	{
		return	$this->vsu->create($data);
	}
	function readstatus($pid, $sid)
	{
		return $this->vsu->read("WHERE owner_id=$pid AND subscriber_id=$sid ");
		//echo $this->vsu->sql;die("======");
	}
	function readstatus1($pid)
	{
		return $this->vsu->read("WHERE subscriber_id=$pid ");
		//echo $this->vsu->sql; die("======");
	}


	function readsubscribe($pid)
	{
		return $this->vsu->read("WHERE owner_id=$pid ");
		//echo $this->vp->sql;die('=============');
	}


	function readsubscribe_filter($pid, $strdate, $enddate)
	{
		return $this->vsu->read("WHERE owner_id=$pid  and date_on between '$strdate'  and '$enddate'");
		echo $this->vsu->sql;
		die('=============');
	}

	function delete_status($pid, $id)
	{
		return $this->vsu->remove("WHERE owner_id=$pid AND subscriber_id=$id");
	}
	function delete_video1($vid, $pid, $uid)
	{
		//die('00000');
		//echo $vid.' '.$pid.' '.$uid;
		return $this->vl->remove("WHERE video_id=$vid AND pid=$pid AND uid=$uid ");
		//echo $this->vl->sql;die('============');
	}
	
	function ViewLike($vid)
	{
		//die('jjjjjjjjjjj');
		 return $this->vl->read("WHERE video_id=$vid AND like_status = 1");
		// echo $this->vl->sql;die('============');
	}
	function ViewDislike($vid)
	{
		//die('jjjjjjjjjjj');
		 return $this->vl->read("WHERE video_id=$vid AND like_status = 0");
		// echo $this->vl->sql;die('============');
	}
	function add_video_transaction($data)
	{
		//return  $this->vw->create($data);
		//echo $this->vw->sql;

	}
	function insertInWallet($data)
	{
		return $this->vw->create($data);
		//echo $this->vw->sql;
		//die("++");
	}

	function update_like($data, $where)
	{
		return $this->vl->update($data, $where);
		//echo $this->vl->sql;
		//die('==');
	}

	function add_video_comment($data)
	{
		return	$this->vc->create($data);
	}
	function readdate($id)
	{
	  $id = $this->vc->escapeString($id);
		return $this->vc->read("WHERE video_id=$id");
	}
	function readdate1($id, $prev_date)
	{

		return $this->vp->read("WHERE video_pid=$id AND payment_date='$prev_date'", "", "sum(total_payment) as today_total_payment");
		//echo $this->vp->sql;

	}
	function readtodayvideopaymentforgraph($pid)
	{
		$date_t = date('Y-m-d');
		return $this->vp->read("WHERE video_pid =" . $pid . " AND payment_date='$date_t'", "", "sum(total_payment) as today_total_payment");
		//echo $this->vp->sql;

	}

	function get_video_comment_by_id($video_id)
	{
		return $this->vc->read("LEFT JOIN spprofiles as s ON s.idspProfiles = t.pid where video_id = $video_id ORDER By vc_id DESC");
	}

	function get_search_videos($searchField, $orderby)
	{
		return $this->v->read("WHERE video_status = 1 AND video_visibility = 1 AND (video_title like '%" . $searchField . "%') ORDER BY video_id " . $orderby);
	}

	function get_vid_module_search_results($record_index, $limit, $searchField, $orderby)
	{
		return $this->v->read("WHERE video_status != 2   AND (video_title like '%" . $searchField . "%') GROUP BY video_id ORDER BY video_id " . $orderby . " LIMIT $record_index, $limit");
		//echo   $this->v->sql; die("----------------");
	}

	function get_my_playlist_video($pid, $playlistid)
	{
		return $this->v->read("LEFT JOIN music_playlist as m ON m.mav_id = t.video_id WHERE t.video_status != 2 AND m.playlist_id = '$playlistid' ORDER By video_id DESC");
		///echo $this->v->sql;

		//die('====');

	}

	function get_my_playlist_video_limit($playlistid, $limit)
	{
		return $this->v->read("LEFT JOIN music_playlist as m ON m.mav_id = t.video_id WHERE t.video_status != 2 AND m.playlist_id = '$playlistid' ORDER By video_id DESC LIMIT $limit");

		// t.spProfiles_idspProfiles = '$pid' AND 
	}

	function countLikes($video_id)
	{
		return $this->vl->read("where video_id = $video_id AND like_status = 1");
	}

	function countDislike($video_id)
	{
		return $this->vl->read("where video_id = $video_id AND like_status = 0");
	}

	function myAlbumAllVideos($pid, $limit)
	{
		return $this->v->read("WHERE spProfiles_idspProfiles = '$pid' AND video_status != 2 AND video_albumID != 0 ORDER BY video_id DESC LIMIT $limit");
	}

	function myPlaylistAllVideos($pid, $limit)
	{
		return $this->v->read("LEFT JOIN music_playlist as m ON m.mav_id = t.video_id
		LEFT JOIN createplaylist as cp ON cp.list_id = m.playlist_id
		 WHERE cp.spProfile_idspProfile = '$pid' AND t.video_status != 2 GROUP BY t.video_id ORDER BY video_id DESC LIMIT $limit");
	}

	function getMyFavouriteVideo($pid, $uid)
	{
		return $this->maf->read("where t.pid = $pid and t.uid = $uid GROUP BY sv.video_id ORDER BY sv.video_id DESC", "", "t.*,sv.*", "INNER JOIN spvideo sv ON sv.video_id = t.ma_id");
	}

	function getMyFavouriteVideolimit($pid, $uid, $limit)
	{
		return $this->maf->read("where t.pid = $pid and t.uid = $uid GROUP BY sv.video_id ORDER BY sv.video_id DESC LIMIT $limit", "", "t.*,sv.*", "INNER JOIN spvideo sv ON sv.video_id = t.ma_id");
	}

	function createPayment($data)
	{
		$id = $this->vp->create($data);
		return $id;
	}
	function readPeyment_detail($id)
	{
		return $this->vp->read("Where payment_id=$id");
	}

	function get_payment($video_id, $pid, $uid, $limit)
	{
		return $this->vp->read("where video_id = $video_id and spProfile_idspProfile = $pid and spUserid = $uid ORDER By payment_id DESC LIMIT $limit");
	}




	function readTodaysVideoPayment($pid)
	{
		$date_t = date('Y-m-d');
		return $this->vp->read("WHERE video_pid =" . $pid . " AND payment_date ='$date_t'", "", "sum(total_payment) as today_total_payment");
		// echo $this->vp->sql;

	}

	function readYesterdayVideoPayment($pid)
	{
		$date_t = date('Y-m-d', strtotime("-1 days"));
		return $this->vp->read("WHERE video_pid =" . $pid . " AND payment_date ='$date_t'", "", "sum(total_payment) as yesterday_total_payment");
	}

	function readWeekVideoPayment($pid)
	{

		return $this->vp->read("WHERE video_pid =" . $pid . " AND Month(`payment_date`)= Month(CURDATE())", "", "sum(total_payment) as week_total_payment");
	}

	function readMonthVideoPayment($pid)
	{
		return $this->vp->read("WHERE video_pid =" . $pid . "  AND Year(`payment_date`)= Year(CURDATE())", "", "sum(total_payment) as month_total_payment");
	}

	function getMyPurchasedVideos($pid, $uid)
	{
		return $this->vp->read("where t.spProfile_idspProfile = $pid and t.spUserid = $uid and DATE(t.payment_last_date) >= DATE(NOW()) GROUP BY t.video_id ORDER BY payment_id DESC", "", "t.*,sv.*", "INNER JOIN spvideo sv ON sv.video_id = t.video_id");
	}

	function getMyPurchasedVideosLimit($pid, $uid, $limit)
	{
		return $this->vp->read("where t.spProfile_idspProfile = $pid and t.spUserid = $uid and DATE(t.payment_last_date) >= DATE(NOW()) GROUP BY t.video_id ORDER BY payment_id DESC LIMIT $limit", "", "t.*,sv.*", "INNER JOIN spvideo sv ON sv.video_id = t.video_id");
	}

	function getMyEarningVideos($pid)
	{
		return $this->vp->read("WHERE t.video_pid =" . $pid . " ORDER BY t.payment_id DESC ", "", "t.*,sv.*", "INNER JOIN spvideo sv ON sv.video_id = t.video_id");
	}

	function getSetPriceVideos($pid)
	{
		return $this->v->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND video_price_status = 1 AND video_status != 2 GROUP BY t.video_id ORDER BY t.video_id DESC ", "", "t.*,sum(vp.total_payment) as ttotal_payment,sum(vp.totalPoints) as ttotalPoints,count(vp.video_id) as vid", "LEFT JOIN video_payment vp ON vp.video_id = t.video_id");
	}

	function getSetPriceVideosFilter($pid, $fromDate, $toDate)
	{
		$from_date = date('Y-m-d', strtotime($fromDate));
		$to_date = date('Y-m-d', strtotime($toDate));

		return $this->v->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND video_price_status = 1 AND video_status != 2 AND t.video_posting_datetime BETWEEN '$from_date' AND '$to_date' GROUP BY t.video_id ORDER BY t.video_id DESC ", "", "t.*,sum(vp.total_payment) as ttotal_payment,sum(vp.totalPoints) as ttotalPoints,count(vp.video_id) as vid", "LEFT JOIN video_payment vp ON vp.video_id = t.video_id");
	}

	function readMonthVideoGraph($pid)
	{
		return $this->vp->read("WHERE video_pid =" . $pid . " AND Year(payment_date)>=Year(CURDATE() - INTERVAL 1 Year) GROUP BY Year(payment_date), Month(payment_date)", "", "sum(total_payment) as month_total_payment,payment_date");
	}

	function add_video_contribution($data)
	{
		return	$this->vcon->create($data);
	}

	function get_video_my_contribution($video_id, $pid, $uid, $limit)
	{
		return $this->vcon->read("where video_id = $video_id AND pid = $pid AND uid = $uid ORDER By contribution_id DESC LIMIT $limit");
	}

	function getContributionAllVideos($video_pid)
	{
		return $this->v->read("WHERE t.spProfiles_idspProfiles =" . $video_pid . " AND video_status != 2 GROUP BY t.video_id ORDER BY vc.contribution_id DESC ", "", "t.*,count(vc.video_id) as total_contribution,sum(vc.contribution_approve) as contribution_approve,sum(vc.contribution_disapprove) as contribution_disapprove", "INNER JOIN video_contribution vc ON t.video_id = vc.video_id");
	}
	function myContributionAllVideos($video_pid)
	{
		return $this->v->read("WHERE vc.pid =" . $video_pid . " AND video_status != 2 GROUP BY t.video_id ORDER BY vc.contribution_id DESC ", "", "t.*,count(vc.video_id) as total_contribution,sum(vc.contribution_approve) as contribution_approve,sum(vc.contribution_disapprove) as contribution_disapprove", "INNER JOIN video_contribution vc ON t.video_id = vc.video_id");
	}
	
	function readContribution($video_pid, $video_id)
	{
		return $this->vcon->read("WHERE video_id = $video_id AND video_pid = $video_pid ORDER By contribution_id DESC");
	}

	function readAllContribution($video_pid)
	{
		return $this->vcon->read("WHERE video_pid = $video_pid ORDER By contribution_id DESC");
	}

	function updateContribution($data, $where)
	{
		return $this->vcon->update($data, $where);
	}

	function get_category_video($pid, $uid, $categoryId)
	{
		return $this->v->read("where video_categoryID = $categoryId AND video_status != 2 ORDER BY video_id DESC");
		//echo $this->v->sql; die('===========');
	}

	function updateFlag($postid)
	{
		$this->v->update(array("video_status" => 3), "WHERE video_id = $postid ");
	}

	function myflagVideo($catid, $pid, $why_flag)
	{
		return  $this->f->read("WHERE t.spProfile_idspProfile = $pid AND t.spCategory_idspCategory = $catid AND sv.video_status = 3 AND t.why_flag = '$why_flag' GROUP BY t.spPosting_idspPosting ORDER BY flag_id DESC ", "", "t.*,sv.*", "LEFT JOIN spvideo as sv ON sv.video_id = t.spPosting_idspPosting");
		//echo 	$this->f->sql; die("---");
	}

	function myflagVideo_now($pid)
	{
		return $this->f->read("WHERE spProfile_idspProfile = $pid ");

		//echo $this->f->sql;
	}

	function createHome($data)
	{
		return $this->hc->create($data);
	}

	function update_category($data, $where)
	{
		return $this->hc->update($data, $where);
	}

	function readHomepage($pid, $uid)
	{
		// return $this->hc->read("where t.pid = $pid AND t.uid = $uid GROUP BY t.hc_id","","t.*,GROUP_CONCAT(vc.video_cat_title ORDER BY vc.video_id) as category_title","LEFT JOIN video_category as vc ON FIND_IN_SET(vc.video_id,t.video_categoryID) > 0");

		return $this->hc->read("where t.pid = $pid AND t.uid = $uid");
	}

	function readHomepage11($pid, $uid, $start, $limitaa)
	{
		// return $this->hc->read("where t.pid = $pid AND t.uid = $uid GROUP BY t.hc_id","","t.*,GROUP_CONCAT(vc.video_cat_title ORDER BY vc.video_id) as category_title","LEFT JOIN video_category as vc ON FIND_IN_SET(vc.video_id,t.video_categoryID) > 0");

		return $this->hc->read("where t.pid = $pid AND t.uid = $uid LIMIT $start,$limitaa");
	}

	function getMySpPoints($pid, $uid)
	{
		return $this->vp->read("where t.spProfile_idspProfile = $pid and t.spUserid = $uid", "", "sum(t.totalPoints) as totalspPoints");
	}

	function readTodaysSpPoints($pid, $uid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile =" . $pid . " AND spUserid = '$uid' AND DATE(payment_date) = DATE(NOW())", "", "sum(totalPoints) as today_totalPoints");
	}

	function readYesterdaySpPoints($pid, $uid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile =" . $pid . " AND spUserid = '$uid' AND DATE(payment_date) = DATE(NOW() - INTERVAL 1 DAY)", "", "sum(totalPoints) as yesterday_totalPoints");
	}

	function readWeekSpPoints($pid, $uid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile =" . $pid . " AND spUserid = '$uid' AND YEARWEEK(payment_date) = YEARWEEK(CURDATE())", "", "sum(totalPoints) as week_totalPoints");
	}

	function readMonthSpPoints($pid, $uid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile =" . $pid . " AND spUserid = '$uid' AND Year(payment_date)=Year(CURDATE()) AND Month(`payment_date`)= Month(CURDATE())", "", "sum(totalPoints) as month_totalPoints");
	}

	function readMonthSpPointsGraph($pid, $uid)
	{
		return $this->vp->read("WHERE spProfile_idspProfile =" . $pid . " AND spUserid = '$uid' AND Year(payment_date)>=Year(CURDATE() - INTERVAL 1 Year) GROUP BY Year(payment_date), Month(payment_date)", "", "sum(totalPoints) as month_totalPoints,payment_date");
	}

	function getSetPriceSpVideos($pid)
	{
		return $this->v->read("WHERE vp.spProfile_idspProfile =" . $pid . " AND video_price_status = 1 AND video_status != 2 GROUP BY t.video_id ORDER BY t.video_id DESC ", "", "t.*,sum(vp.total_payment) as ttotal_payment,sum(vp.totalPoints) as ttotalPoints,count(vp.video_id) as vid", "LEFT JOIN video_payment vp ON vp.video_id = t.video_id");
	}

	function getSetPriceSpVideosFilter($pid, $fromDate, $toDate)
	{
		$from_date = date('Y-m-d', strtotime($fromDate));
		$to_date = date('Y-m-d', strtotime($toDate));

		return $this->v->read("WHERE vp.spProfile_idspProfile =" . $pid . " AND video_price_status = 1 AND video_status != 2 AND t.video_posting_datetime BETWEEN '$from_date' AND '$to_date' GROUP BY t.video_id ORDER BY t.video_id DESC ", "", "t.*,sum(vp.total_payment) as ttotal_payment,sum(vp.totalPoints) as ttotalPoints,count(vp.video_id) as vid", "LEFT JOIN video_payment vp ON vp.video_id = t.video_id");
	}
}
