<?php 
// idspGroup, spGroupName
class _spgroup
{
    // property declaration
    public $dbclose = false;
	private $conn;
	public $ta;
	public $tad;
	
	function __construct() { 
		$this->ta = new _tableadapter("spGroup");
		$this->ta->join = "INNER JOIN spProfiles_has_spGroup as d ON t.idspGroup = d.spGroup_idspGroup INNER JOIN spProfiles as p ON d.spProfiles_idspProfiles = p.idspProfiles";
				
		$this->tad = new _tableadapter("spProfiles_has_spGroup");
		$this->ta->dbclose = false;
	}
	
	
	//Creator of group
	function checkcreator($gid,$uid)
	{
		return $this->tad->read("WHERE spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") AND spGroup_idspGroup=".$gid." AND spProfileIsAdmin =0");
	}
	
	function deletefreelancer($pid , $gid)
	{
		return $this->tad->remove("WHERE spGroup_idspGroup=".$gid." AND spProfiles_idspProfiles=".$pid);
	}
	
	
	function checkfreelancer($pid,$uid)
	{
		return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =".$uid."))AND d.spProfiles_idspProfiles=".$pid. " AND spGroupName='Favourite_Freelancer'");
	} 
	
	function updategrouppic($gid , $data)
	{
		 $this->ta->update(array("spgroupimage" =>$data) ,"WHERE idspGroup ='".$gid."'" );
	}
	
	function totalgroup()
	{
		return $this->ta->read();
	}
	
	function friendprofile($uid , $friendid)
	{
		//return $this->ta->read("WHERE d.spProfiles_idspProfiles in (Select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" .$uid.")))");
		
		return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.")) AND d.spProfiles_idspProfiles=".$friendid);
	}
	
	function groupdetails($gid)
	{
		return $this->ta->read("WHERE t.idspGroup =" . $gid );
	}
	
	function checkmember($gid , $uid)
	{
		return $this->ta->read("WHERE p.spUser_idspUser =".$uid ." AND t.idspGroup =".$gid);
	}
	
	function blockMember($gid,$pid)
	{
		$this->tad->update(array("spApproveRegect" => 0),"WHERE spProfiles_idspProfiles=".$pid." AND spGroup_idspGroup =".$gid);
	}
	
	function unblockMember($gid,$pid)
	{
		$this->tad->update(array("spApproveRegect" => 1),"WHERE spProfiles_idspProfiles=".$pid." AND spGroup_idspGroup =".$gid);
	}
	
	function rejectrequest($gid,$pid)
	{
		$this->tad->update(array("spApproveRegect" => 0),"WHERE spProfiles_idspProfiles=".$pid." AND spGroup_idspGroup =".$gid);
	}
	
	function acceptrequest($gid,$pid)
	{
		$this->tad->update(array("spApproveRegect" => 1),"WHERE spProfiles_idspProfiles=".$pid." AND spGroup_idspGroup =".$gid);
	}
	
	function creterequest($gid,$pid)
	{
		$this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => 1));
	}
	
	function grpmember($gid)
	{
		return $this->tad->read("WHERE spGroup_idspGroup =".$gid ." AND spApproveRegect = 1");
	}
	
	function publicgroup()
	{
		return $this->ta->read("WHERE t.spgroupflag = 0","","DISTINCT idspGroup, spGroupName,spGroupTag , spGroupAbout");
	}
	
	function create($data, $pid){
		$id = $this->ta->create($data);
		$this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $id, "spProfileIsAdmin" => 0 ,"spApproveRegect" => 1));
		return $id;
	}
	
	function admin_Member($pid, $gid)
	{
		return $this->tad->read("WHERE t.spProfiles_idspProfiles =".$pid. " AND t.spGroup_idspGroup =".$gid);
	}
	
	function readGroupName($gid)
	{
		return $this->ta->read("WHERE t.idspGroup = " . $gid ,"","DISTINCT idspGroup, spGroupName");
	}
	
	function addmember($data)
	{
		return $this->tad->create($data);
	}
	
	//checking
	function readGroup($pid)
	{
		return $this->tad->read("WHERE d.spProfiles_idspProfiles =" . $pid );
	}
	//complete
	function asprofile($pid)
	{
		return $this->ta->read("WHERE d.spProfiles_idspProfiles =" . $pid );
	}
	
	function removeMember($pid,$gid){
		$this->tad->remove("WHERE t.spProfiles_idspProfiles= " . $pid . " AND t.spGroup_idspGroup= " .$gid );
	}
	
	
	function read($pid){
		return $this->ta->read("WHERE d.spProfiles_idspProfiles =" . $pid . " AND d.spProfileIsAdmin=0");
	}
	
	function removeGroup($gid){
		$this->ta->remove("WHERE t.idspGroup = " . $gid);
	}
	
	function update($gid, $data){
		$this->ta->update($gid, $data);
	}
	
	function members($gid){
		return $this->ta->read("WHERE t.idspGroup = " . $gid ." AND (d.spApproveRegect IS NULL OR d.spApproveRegect = 1)");
	}
	
	function grouplist($name){
		$result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%')", "", "DISTINCT idspGroup, spGroupName");
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspGroup'], 'label'=>$rs['spGroupName']);
			
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
	
	
	function mygrouplist($name,$uid)
	{
		/*$result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%') AND idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " .$pid." )", "","DISTINCT idspGroup, spGroupName");
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspGroup'], 'label'=>$rs['spGroupName']);
			}
			echo json_encode($data);
		}
		else
			echo "no data";*/
		
		$result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%') AND idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(SELECT idspProfiles from spProfiles WHERE spUser_idspUser =".$uid.") )", "","DISTINCT idspGroup, spGroupName");
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspGroup'], 'label'=>$rs['spGroupName']);
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
	
	
	function sharedgroup($gid){
		return $this->ta->read("WHERE t.idspGroup = " . $gid, "", "DISTINCT idspGroup, spGroupName");
	}
	
	
	function group($pid)
	{
		return $this->ta->read("WHERE idspGroup in (Select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles=" .$pid.")", "" ,"DISTINCT idspGroup, spGroupName ,spApproveRegect");
	}
	
	function readMember($pid,$gid){
		return $this->tad->read("WHERE t.spProfiles_idspProfiles= " . $pid . " AND t.spGroup_idspGroup= " .$gid );
	}
	
	function allgroup($uid)
	{
		return $this->ta->read("WHERE p.spUser_idspUser =".$uid. " AND d.spProfileIsAdmin = 0");
	}
	
	function groupmember($uid)
	{
		return $this->ta->read("WHERE t.idspGroup in (SELECT spGroup_idspGroup from spProfiles_has_spGroup WHERE spProfiles_idspProfiles in (SELECT idspProfiles from spProfiles WHERE spUser_idspUser =".$uid."))","","DISTINCT idspGroup, spGroupName,spgroupflag");
	}
	
	function readfreelancers($uid)
	{
		return $this->ta->read("WHERE p.spUser_idspUser=".$uid. " AND d.spProfileIsAdmin = 0");
	}
	
	function createFreelancer($pid){
		$id = $this->ta->create(array("spGroupName" => "Favourite_Freelancer", "spGroupTag" => "Favourite freelancer", "spGroupAbout" => "It contains favourite freelancer" , "spgroupflag" => 0));
		
		$this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $id, "spProfileIsAdmin" => 0, "spApproveRegect" => 1));
		return $id;
	}
	
	function addfreelancer($gid,$pid)
	{
		$this->tad->create(array("spProfiles_idspProfiles" => $pid, "spGroup_idspGroup" => $gid, "spProfileIsAdmin" => 1 ,"spApproveRegect" => 1));
	}
	
	function publicgroupauto($name)
	{
		$result = $this->ta->read("WHERE t.spGroupName  like ('%" . $name . "%') AND t.spgroupflag = 0", "","DISTINCT idspGroup, spGroupName");
		if ($result != false) {
			while($rs = $result->fetch_assoc()) {
				$data[] = array('value'=>$rs['idspGroup'], 'label'=>$rs['spGroupName']);
			}
			echo json_encode($data);
		}
		else
			echo "no data";
	}
}
?>