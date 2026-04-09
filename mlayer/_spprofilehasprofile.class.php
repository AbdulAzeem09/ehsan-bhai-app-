<?php
class _spprofilehasprofile
{

	public $dbclose = false;
	private $conn;
	public $ta;

	function __construct()
	{
		$this->ta = new _tableadapter("spProfiles_has_spProfiles");
		//$this->ta->join = "INNER JOIN spProfiles as d ON t.spProfiles_idspProfileSender = d.idspProfiles OR t.spProfiles_idspProfilesReceiver = d.idspProfiles";
		
		$this->sp77 = new _tableadapter("spprofiletype");
		$this->ta->dbclose = false;
	}


	function read_friend($send,$res)
	{ 
		return $this->ta->read("WHERE spProfiles_idspProfileSender =$send And spProfiles_idspProfilesReceiver= $res");
		 echo $this->ta->sql;die('++++++++');
	}

	function read_friend_2($send,$res)
	{ 
		 return $this->ta->read("WHERE spProfiles_idspProfileSender =$res And spProfiles_idspProfilesReceiver=$send");
		 echo $this->ta->sql;die('=====');
	}

	function update_switch($data,$id)
	{  
		return $this->ta->update($data, "WHERE id = " . $id);
		echo $this->ta->sql;die('=====');
	}

	function shani44($profileid)
	{ 
		return $this->sp77->read("WHERE idspProfileType =$profileid");
		//echo $this->sp77->sql;die('=====');
	}



	function connectedprofile($sender, $reciver, $uid)
	{
		return $this->ta->read("WHERE (spProfiles_idspProfileSender in (Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND (spProfiles_idspProfilesReceiver =" . $sender . " OR spProfiles_idspProfilesReceiver =" . $reciver . ")) OR (spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND (spProfiles_idspProfileSender =" . $sender . " OR spProfiles_idspProfileSender =" . $reciver . " ))");
	}

	//chek friend request
	function checkfriend($sender, $receiver)
	{
		return $this->ta->read("WHERE (spProfiles_idspProfilesReceiver =" . $receiver . " AND spProfiles_idspProfileSender=" . $sender . ") OR (spProfiles_idspProfilesReceiver =" . $sender . " AND spProfiles_idspProfileSender=" . $receiver . ")");
	}

	function checkasfriend($sender, $receiver)
	{
		return $this->ta->read("WHERE (spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser in(select spUser_idspUser from spprofiles where idspProfiles =" . $receiver . ")) AND spprofiles_idspProfilesSender in (select idspProfiles from spprofiles where spUser_idspUser in(select spUser_idspUser from spprofiles where idspProfiles =" . $sender . "))) OR 
			(spProfiles_idspProfilesReceiver in (select idspProfiles from spprofiles where spUser_idspUser in(select spUser_idspUser from spprofiles where idspProfiles =" . $sender . ")) AND spprofiles_idspProfilesSender in (select idspProfiles from spprofiles where spUser_idspUser in(select spUser_idspUser from spprofiles where idspProfiles =" . $receiver . ")))");
	}


	//unfriend by user profile 
	function unfriend($profileid, $pid)
	{
		$this->ta->remove("WHERE spProfiles_idspProfilesReceiver = $pid AND spProfiles_idspProfileSender = $profileid");
		$this->ta->remove("WHERE spProfiles_idspProfilesReceiver = $profileid AND spProfiles_idspProfileSender = $pid");
	}

	
	//block user from my friends	
	function blockMember($profileid, $uid)
	{
		//return $this->ta->update(array("spProfiles_has_spProfileFlag" => 0), "WHERE (spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") OR spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.")) AND (spProfiles_idspProfilesReceiver = ".$profileid." OR spProfiles_idspProfileSender =".$profileid.")");
		return $this->ta->update(array("spProfiles_has_spProfileFlag" => 0), "WHERE (spProfiles_idspProfilesReceiver in(Select idspProfiles from spprofiles where spUser_idspUser=" . $uid . ") OR spProfiles_idspProfileSender in(Select idspProfiles from spprofiles where spUser_idspUser=" . $uid . ")) AND (spProfiles_idspProfilesReceiver = " . $profileid . " OR spProfiles_idspProfileSender =" . $profileid . ")");
	}
	//unblock user from my friends
	function unblockMember($profileid, $uid)
	{
		return $this->ta->update(array("spProfiles_has_spProfileFlag" => 1), "WHERE (spProfiles_idspProfilesReceiver in(Select idspProfiles from spprofiles where spUser_idspUser=" . $uid . ") OR spProfiles_idspProfileSender in(Select idspProfiles from spprofiles where spUser_idspUser=" . $uid . ")) AND (spProfiles_idspProfilesReceiver = " . $profileid . " OR spProfiles_idspProfileSender =" . $profileid . ")");
	}

	function myprofileidReciever($uid, $pid) //My profile as a Receiver
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND spProfiles_idspProfileSender = " . $pid . " AND spProfiles_has_spProfileFlag = 1");
	}

	function myprofileidSender($uid, $pid) //My profile as a sender
	{
		return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND spProfiles_idspProfilesReceiver = " . $pid . " AND spProfiles_has_spProfileFlag = 1");
	}
	//read profile randomly
	function readallfriendRand($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfileSender=" . $pid . " AND spProfiles_has_spProfileFlag = 1 ORDER BY RAND()");
	}

	

	function readallfriendWithReverse($pid) 
	{
		return $this->ta->read("JOIN spprofiles AS PROF ON PROF.idspProfiles = t.spProfiles_idspProfileSender 
						WHERE t.spProfiles_idspProfilesReceiver=" . $pid . " 
						AND t.spProfiles_has_spProfileFlag = 1 
						ORDER BY PROF.spProfileName ASC", "");
		// echo $this->ta->sql;die();
	}


	function readallfriend($pid)
	{
		return $this->ta->read("JOIN spprofiles AS PROF ON PROF.idspProfiles = t.spProfiles_idspProfilesReceiver 
					WHERE t.spProfiles_idspProfileSender=" . $pid . " 
					AND t.spProfiles_has_spProfileFlag = 1 
					ORDER BY PROF.spProfileName ASC", "");
		// echo $this->ta->sql;die();
	}

	
	function countTotalFrnd($pid)
	{
		$total = 0;
		$result = $this->ta->read("WHERE spProfiles_idspProfileSender = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL) AND (spProfiles_has_spProfileFlag != 0)", "GROUP BY spProfiles_idspProfilesReceiver");
		if (!empty($result)) {
			if ($result->num_rows > 0) {
				$total = $result->num_rows;
			} else {
				$total = 0;
			}
		} else {
			$total = 0;
		}

		$result2 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL) AND (spProfiles_has_spProfileFlag != 0)", "GROUP BY spProfiles_idspProfileSender");
		if (!empty($result2)) {
			if ($result2->num_rows > 0) {
				$total = $total + $result2->num_rows;
			} else {
				$total = $total + 0;
			}
		} else {
			$total = $total + 0;
		}

		return $total;
	}
	//as a sender show only single profile chat
	function friend_profile_sender($pid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)" ,"","DISTINCT spProfiles_idspProfilesReceiver,spProfiles_has_spProfileFlag,spProfiles_idspProfileSender");
		return $this->ta->read("WHERE spProfiles_idspProfileSender = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL) AND (spProfiles_has_spProfileFlag != 0)", "GROUP BY spProfiles_idspProfilesReceiver");
	}
	//as a Receiver show only single profile chat 
	function friends_profile($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL) AND (spProfiles_has_spProfileFlag != 0)", "GROUP BY spProfiles_idspProfileSender");
	}
	//as a Receiver
	function friends($uid)
	{
		// return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)","","DISTINCT spProfiles_idspProfileSender,spProfiles_has_spProfileFlag,spProfiles_idspProfilesReceiver");
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND (spProfiles_has_spProfileFlag IS NOT NULL)", "GROUP BY spProfiles_idspProfileSender");
	}
	//as a Receiver limit two user
	function friends_two($pid)
	{
		//	die('============');
		//return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)","","DISTINCT spProfiles_idspProfileSender,spProfiles_has_spProfileFlag,spProfiles_idspProfilesReceiver");
		return $this->ta->read("JOIN spprofiles PROF ON PROF.idspProfiles = t.spProfiles_idspProfileSender WHERE t.spProfiles_idspProfilesReceiver=" . $pid . " AND t.spProfiles_has_spProfileFlag = 1 ORDER BY PROF.spProfileName ASC", "");
		echo $this->ta->sql;
	}
	function friendslist($uid) //as a Receiver and as a sender
	{
		return $this->ta->read("WHERE ((spProfiles_idspProfilesReceiver in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")) OR (spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . "))) AND spProfiles_has_spProfileFlag == 1");
	}
	//as a sender
	function friend($uid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)" ,"","DISTINCT spProfiles_idspProfilesReceiver,spProfiles_has_spProfileFlag,spProfiles_idspProfileSender");
		return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND (spProfiles_has_spProfileFlag IS NOT NULL)", "GROUP BY spProfiles_idspProfilesReceiver");
	}
	//as a sender limit 2 user
	function friend_two($pid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)" ,"","DISTINCT spProfiles_idspProfilesReceiver,spProfiles_has_spProfileFlag,spProfiles_idspProfileSender");
		return $this->ta->read("JOIN spprofiles AS PROF ON PROF.idspProfiles = t.spProfiles_idspProfilesReceiver WHERE t.spProfiles_idspProfileSender=" . $pid . " AND t.spProfiles_has_spProfileFlag = 1 ORDER BY PROF.spProfileName ASC", "");
		//echo  $this->ta->sql;die('+++++++');
	
	}


	function friends_new($pid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)" ,"","DISTINCT spProfiles_idspProfilesReceiver,spProfiles_has_spProfileFlag,spProfiles_idspProfileSender");
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL)", "GROUP BY spProfiles_idspProfileSender");
		// echo $this->ta->sql;die('+++++++000'); 
		
	}

	
	function friend_new($pid)
	{
		//return $this->ta->read("WHERE spProfiles_idspProfileSender in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.") AND (spProfiles_has_spProfileFlag IS NOT NULL)" ,"","DISTINCT spProfiles_idspProfilesReceiver,spProfiles_has_spProfileFlag,spProfiles_idspProfileSender");
		return	$this->ta->read("WHERE spProfiles_idspProfileSender = $pid AND (spProfiles_has_spProfileFlag IS NOT NULL)", "GROUP BY spProfiles_idspProfilesReceiver");
		echo $this->ta->sql;die('+++++++000'); 
		
	}

	//read all friends last 5 days as receiver
	function readall_recently($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $pid . " AND spProfile_request_date BETWEEN ADDDATE(NOW(),-5) AND NOW() AND spProfiles_has_spProfileFlag = 1");
	}
	//read all friends last 5 days as sender
	function readall_recently_sender($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfileSender=" . $pid . " AND spProfile_request_date BETWEEN ADDDATE(NOW(),-5) AND NOW() AND spProfiles_has_spProfileFlag = 1");
	}
	//read all friends as receiver
	function readall($pid)
	{

		return $this->ta->read("JOIN spprofiles PROF ON PROF.idspProfiles = t.spProfiles_idspProfileSender WHERE t.spProfiles_idspProfilesReceiver=" . $pid . " AND t.spProfiles_has_spProfileFlag = 1 ORDER BY PROF.spProfileName ASC", "");
		//echo  $this->ta->sql;die('+++1');
	}

	function readalllimit($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $pid);
		//echo $this->ta->sql;
		//die;
	}

	function create($sender, $receiver)
	{
		return $this->ta->create(array("spProfiles_idspProfileSender" => $sender, "spProfiles_idspProfilesReceiver" => $receiver));
	}

	function cancel_Request_d($sender, $receiver)
	{
		return $this->ta->remove("Where spProfiles_idspProfileSender=$sender AND spProfiles_idspProfilesReceiver=$receiver");
	}

	function read($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND spProfiles_has_spProfileFlag IS NULL");
	}

	function checkFriendRequest($profileId, $receiverId)
	{
		$isRequested = false;
		$result = $this->ta->read("WHERE spProfiles_idspProfilesReceiver = " . $receiverId . " AND spProfiles_idspProfileSender = " . $profileId . " AND (spProfiles_has_spProfileFlag IS NULL OR spProfiles_has_spProfileFlag = 0)");
		if ($result != false && $result->num_rows > 0) {
			$isRequested = true;
		}
		return $isRequested;
	}

	function declined($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND spProfiles_has_spProfileFlag = -1");
	}

	function readtop($uid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") AND spProfiles_has_spProfileFlag IS NULL limit 3");
	}
	//read all friends request limit only 3
	function friendReequestList($pid)
	{
		return  $this->ta->read("WHERE spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where idspProfiles=" . $pid . ") AND (spProfiles_has_spProfileFlag = 0 OR spProfiles_has_spProfileFlag IS NULL) AND spProfiles_idspProfileSender != $pid limit 3");
		echo $this->ta->sql;
	}
	//read all friends request all
	function friendReequestAll($pid)
	{
		return $this->ta->read("WHERE spProfiles_idspProfilesReceiver in (Select idspProfiles from spProfiles where idspProfiles=" . $pid . ") AND (spProfiles_has_spProfileFlag = 0 OR spProfiles_has_spProfileFlag IS NULL) AND spProfiles_idspProfileSender != $pid");
		// echo $this->ta->sql;die('======');
	}
	function remove($masterdetails)
	{
		$this->ta->remove("WHERE t.idmasterDetails =" . $masterdetails);
	}

	function accept($sender, $receiver)
	{
		return $this->ta->update(array("spProfiles_has_spProfileFlag" => 1), "WHERE spProfiles_idspProfileSender =" . $sender . " AND spProfiles_idspProfilesReceiver =" . $receiver);
	}

	function reject($sender, $receiver)
	{
		return $this->ta->update(array("spProfiles_has_spProfileFlag" => -1), "WHERE spProfiles_idspProfileSender =" . $sender . " AND spProfiles_idspProfilesReceiver =" . $receiver);
	}
	//if one time friend request rejected then again send request
	function againSendRequest($sender, $receiver, $flag)
	{
		return $this->ta->update(array('spProfiles_has_spProfileFlag' => $flag), "WHERE (spProfiles_idspProfilesReceiver =" . $receiver . " AND spProfiles_idspProfileSender=" . $sender . ") OR (spProfiles_idspProfilesReceiver =" . $sender . " AND spProfiles_idspProfileSender=" . $receiver . ")");
	}
	//1st level friends list //pid = myId
	function frndLevelone($myId)
	{
		$myFrndList = array();
		//make my frnd list
		$result2 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result2 != false) { //sendr
			while ($row2 = mysqli_fetch_assoc($result2)) {
				if (in_array($row2['spProfiles_idspProfilesReceiver'], $myFrndList)) {
				} else {
					array_push($myFrndList, $row2['spProfiles_idspProfilesReceiver']);
				}
			}
		}
		$result3 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result3 != false) {
			while ($row4 = mysqli_fetch_assoc($result3)) {
				if (in_array($row4['spProfiles_idspProfileSender'], $myFrndList)) {
					echo $row4['spProfiles_idspProfileSender'];
				} else {
					array_push($myFrndList, $row4['spProfiles_idspProfileSender']);
				}
			}
		}
		//print_r($myFrndList);
		//get friends of friends
		foreach ($myFrndList as $key => $value) {
			$result4 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result4 != false) { //sendr
				while ($row4 = mysqli_fetch_assoc($result4)) {
					if (in_array($row4['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row4['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result5 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result5 != false) {
				while ($row5 = mysqli_fetch_assoc($result5)) {
					if (in_array($row5['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row5['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		array_unique($myFrndList);
		return $myFrndList;
	}
	//2nd level friends list //pid = myId
	function frndLevelScnd($myId)
	{
		$myFrndList = array();
		//make my frnd list
		$result2 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result2 != false) { //sendr
			while ($row2 = mysqli_fetch_assoc($result2)) {
				if (in_array($row2['spProfiles_idspProfilesReceiver'], $myFrndList)) {
				} else {
					array_push($myFrndList, $row2['spProfiles_idspProfilesReceiver']);
				}
			}
		}
		$result3 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result3 != false) {
			while ($row4 = mysqli_fetch_assoc($result3)) {
				if (in_array($row4['spProfiles_idspProfileSender'], $myFrndList)) {
					echo $row4['spProfiles_idspProfileSender'];
				} else {
					array_push($myFrndList, $row4['spProfiles_idspProfileSender']);
				}
			}
		}
		//print_r($myFrndList);
		//get friends of friends
		foreach ($myFrndList as $key => $value) {
			$result4 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result4 != false) { //sendr
				while ($row4 = mysqli_fetch_assoc($result4)) {
					if (in_array($row4['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row4['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result5 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result5 != false) {
				while ($row5 = mysqli_fetch_assoc($result5)) {
					if (in_array($row5['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row5['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		//make level 2 connection friends
		foreach ($myFrndList as $key => $value2) {
			$result6 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result6 != false) { //sendr
				while ($row6 = mysqli_fetch_assoc($result6)) {
					if (in_array($row6['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row6['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result7 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result7 != false) {
				while ($row7 = mysqli_fetch_assoc($result7)) {
					if (in_array($row7['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row7['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		array_unique($myFrndList);
		return $myFrndList;
	}
	//3rd level friends list //pid = myId
	function frndLevelThird($myId)
	{
		$myFrndList = array();
		//make my frnd list
		$result2 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result2 != false) { //sendr
			while ($row2 = mysqli_fetch_assoc($result2)) {
				if (in_array($row2['spProfiles_idspProfilesReceiver'], $myFrndList)) {
				} else {
					array_push($myFrndList, $row2['spProfiles_idspProfilesReceiver']);
				}
			}
		}
		$result3 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
		//echo $this->ta->sql;
		if ($result3 != false) {
			while ($row4 = mysqli_fetch_assoc($result3)) {
				if (in_array($row4['spProfiles_idspProfileSender'], $myFrndList)) {
					echo $row4['spProfiles_idspProfileSender'];
				} else {
					array_push($myFrndList, $row4['spProfiles_idspProfileSender']);
				}
			}
		}
		//print_r($myFrndList);
		//get friends of friends
		foreach ($myFrndList as $key => $value) {
			$result4 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result4 != false) { //sendr
				while ($row4 = mysqli_fetch_assoc($result4)) {
					if (in_array($row4['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row4['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result5 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value . " AND spProfiles_has_spProfileFlag = 1");
			if ($result5 != false) {
				while ($row5 = mysqli_fetch_assoc($result5)) {
					if (in_array($row5['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row5['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		//make level 2 connection friends
		foreach ($myFrndList as $key => $value2) {
			$result6 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result6 != false) { //sendr
				while ($row6 = mysqli_fetch_assoc($result6)) {
					if (in_array($row6['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row6['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result7 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result7 != false) {
				while ($row7 = mysqli_fetch_assoc($result7)) {
					if (in_array($row7['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row7['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		//make level 3 connection friends
		foreach ($myFrndList as $key => $value3) {
			$result8 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value3 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result8 != false) { //sendr
				while ($row8 = mysqli_fetch_assoc($result8)) {
					if (in_array($row8['spProfiles_idspProfilesReceiver'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row8['spProfiles_idspProfilesReceiver']);
					}
				}
			}
			$result9 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value3 . " AND spProfiles_has_spProfileFlag = 1");
			if ($result9 != false) {
				while ($row9 = mysqli_fetch_assoc($result9)) {
					if (in_array($row9['spProfiles_idspProfileSender'], $myFrndList)) {
					} else {
						array_push($myFrndList, $row9['spProfiles_idspProfileSender']);
					}
				}
			}
		}
		//make array unique
		array_unique($myFrndList);
		return $myFrndList;
	}
	//chek and get all frnds conncetion
	function frndLevelfrnd($frndid)
	{
		$levels = array();
		//1st level strt
		//when i am receiver
		$FrndList = array();
		$result = $this->ta->read("WHERE (spProfiles_idspProfilesReceiver = $frndid) and (spProfiles_has_spProfileflag is not null) and (spProfiles_has_spProfileflag != 0) GROUP BY spProfiles_idspProfileSender");
		//echo $this->ta->sql;
		if ($result != false) {
			while ($row = mysqli_fetch_assoc($result)) {
				$levels[0][] =  $row['spProfiles_idspProfileSender'];
			}
		}
		//when i am sender
		$result2 = $this->ta->read("WHERE (spProfiles_idspProfileSender = $frndid) and (spprofiles_has_spprofileflag is not null) and (spprofiles_has_spprofileflag != 0) GROUP BY spProfiles_idspProfilesReceiver");
		//echo $this->ta->sql;
		if ($result2 != false) {
			while ($row2 = mysqli_fetch_assoc($result2)) {

				if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels)) {
				} else {
					$levels[0][] =  $row2['spProfiles_idspProfilesReceiver'];
				}
			}
		}

		//2nd Level strt
		foreach ($levels as $key => $value) {
			foreach ($value as $key => $value2) {
				//receiver
				$result = $this->ta->read("WHERE (spProfiles_idspProfilesReceiver = $value2) and (spProfiles_has_spProfileflag is not null) and (spProfiles_has_spProfileflag != 0) GROUP BY spProfiles_idspProfileSender");
				//echo $this->ta->sql;
				if ($result != false) {
					while ($row = mysqli_fetch_assoc($result)) {
						if (in_array($row['spProfiles_idspProfileSender'], $levels[0])) {
						} else {
							if (empty($levels[1][0])) {
								$levels[1][] =  $row['spProfiles_idspProfileSender'];
							} else {
								if (in_array($row['spProfiles_idspProfileSender'], $levels[1])) {
								} else {
									$levels[1][] =  $row['spProfiles_idspProfileSender'];
								}
							}
						}
					}
				}
				//sender
				$result2 = $this->ta->read("WHERE (spProfiles_idspProfileSender = $value2) and (spprofiles_has_spprofileflag is not null) and (spprofiles_has_spprofileflag != 0) GROUP BY spProfiles_idspProfilesReceiver");
				if ($result2 != false) {
					while ($row2 = mysqli_fetch_assoc($result2)) {
						if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels[0])) {
						} else {
							if (empty($levels[1][0])) {
								$levels[1][] =  $row2['spProfiles_idspProfilesReceiver'];
							} else {
								if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels[1])) {
								} else {
									$levels[1][] =  $row2['spProfiles_idspProfilesReceiver'];
								}
							}
						}
					}
				}
			}
		}

		//3rd Level strt
		foreach ($levels as $key => $value3) {
			foreach ($value3 as $key => $value4) {
				//receiver
				$result = $this->ta->read("WHERE (spProfiles_idspProfilesReceiver = $value4) and (spProfiles_has_spProfileflag is not null) and (spProfiles_has_spProfileflag != 0) GROUP BY spProfiles_idspProfileSender");
				//echo $this->ta->sql;
				if ($result != false) {
					while ($row = mysqli_fetch_assoc($result)) {
						if (in_array($row['spProfiles_idspProfileSender'], $levels[0])) {
						} else {
							if (in_array($row['spProfiles_idspProfileSender'], $levels[1])) {
							} else {
								if (empty($levels[2][0])) {
									$levels[2][] =  $row['spProfiles_idspProfileSender'];
								} else {
									if (in_array($row['spProfiles_idspProfileSender'], $levels[2])) {
									} else {
										$levels[2][] =  $row['spProfiles_idspProfileSender'];
									}
								}
							}
						}
					}
				}
				//sender
				$result2 = $this->ta->read("WHERE (spProfiles_idspProfileSender = $value4) and (spprofiles_has_spprofileflag is not null) and (spprofiles_has_spprofileflag != 0) GROUP BY spProfiles_idspProfilesReceiver");
				if ($result2 != false) {
					while ($row2 = mysqli_fetch_assoc($result2)) {

						if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels[0])) {
						} else {
							if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels[1])) {
							} else {
								if (empty($levels[2][0])) {
									$levels[2][] =  $row2['spProfiles_idspProfilesReceiver'];
								} else {
									if (in_array($row2['spProfiles_idspProfilesReceiver'], $levels[2])) {
									} else {
										$levels[2][] =  $row2['spProfiles_idspProfilesReceiver'];
									}
								}
							}
						}
					}
				}
			}
		}
		return $levels;
		// echo "<pre>";		
		// print_r($levels);
		// echo "</pre>";
	}

	//chek user profile is frnd or which level
	function frndLeevel($myId, $frndid)
	{
		$result = $this->ta->read("WHERE (spprofiles_idspprofilesreceiver = $myId AND spProfiles_idspProfileSender = $frndid) OR (spprofiles_idspprofilesreceiver = $frndid AND spProfiles_idspProfileSender = $myId) and (spprofiles_has_spprofileflag is not null) and (spprofiles_has_spprofileflag != 0) GROUP BY spProfiles_idspProfileSender");
		if ($result != false) {
			return 0;
		} else {
			$myFrndList = array();
			//make my frnd list
			$result2 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
			if ($result2 != false) { //sendr
				while ($row2 = mysqli_fetch_assoc($result2)) {
					array_push($myFrndList, $row2['spProfiles_idspProfilesReceiver']);
				}
			}
			$result3 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $myId . " AND spProfiles_has_spProfileFlag = 1");
			if ($result3 != false) {
				while ($row4 = mysqli_fetch_assoc($result3)) {
					array_push($myFrndList, $row4['spProfiles_idspProfileSender']);
				}
			}
			//print_r($myFrndList);
			//get friends of friends
			foreach ($myFrndList as $key => $value) {
				$result4 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value . " AND spProfiles_has_spProfileFlag = 1");
				if ($result4 != false) { //sendr
					while ($row4 = mysqli_fetch_assoc($result4)) {
						array_push($myFrndList, $row4['spProfiles_idspProfilesReceiver']);
					}
				}
				$result5 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value . " AND spProfiles_has_spProfileFlag = 1");
				if ($result5 != false) {
					while ($row5 = mysqli_fetch_assoc($result5)) {
						array_push($myFrndList, $row5['spProfiles_idspProfileSender']);
					}
				}
			}
			array_unique($myFrndList);
			//print_r($myFrndList);
			if (in_array($frndid, $myFrndList)) {
				return 1;
			} else {
				//make level 2 connection friends
				foreach ($myFrndList as $key => $value2) {
					$result6 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
					if ($result6 != false) { //sendr
						while ($row6 = mysqli_fetch_assoc($result6)) {
							array_push($myFrndList, $row6['spProfiles_idspProfilesReceiver']);
						}
					}
					$result7 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value2 . " AND spProfiles_has_spProfileFlag = 1");
					if ($result7 != false) {
						while ($row7 = mysqli_fetch_assoc($result7)) {
							array_push($myFrndList, $row7['spProfiles_idspProfileSender']);
						}
					}
				}
				//make array unique
				array_unique($myFrndList);
				if (in_array($frndid, $myFrndList)) {
					return 2;
				} else {
					//make level 3 connection friends
					foreach ($myFrndList as $key => $value3) {
						$result8 = $this->ta->read("WHERE spProfiles_idspProfileSender=" . $value3 . " AND spProfiles_has_spProfileFlag = 1");
						if ($result8 != false) { //sendr
							while ($row8 = mysqli_fetch_assoc($result8)) {
								array_push($myFrndList, $row8['spProfiles_idspProfilesReceiver']);
							}
						}
						$result9 = $this->ta->read("WHERE spProfiles_idspProfilesReceiver=" . $value3 . " AND spProfiles_has_spProfileFlag = 1");
						if ($result9 != false) {
							while ($row9 = mysqli_fetch_assoc($result9)) {
								array_push($myFrndList, $row9['spProfiles_idspProfileSender']);
							}
						}
					}
					//make array unique
					array_unique($myFrndList);
					if (in_array($frndid, $myFrndList)) {
						return 3;
					} else {
						return 4;
					}
				}
			}
		}
	}
}
?>
