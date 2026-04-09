<?php
class _forwardjobs
{
  public $dbclose = false;
private $conn;
public $ta;

function __construct() {
  /*$this->ta = new _tableadapter("addenquiry");*/
  $this->ta = new _tableadapter("jb_forwardjob_details");
  $this->emp_pr = new _tableadapter("spemployment_profile");
  $this->ta->dbclose = false;
}

function delforwardjobs($enqid,$pid){
  //die('kkkkkkkkk');
  $this->ta->remove("WHERE frwId= ".$enqid." AND frwReciverId= $pid");
}

function delforwardjobsme($enqid){
  //die('kkkkkkkkk');
  $this->ta->remove("WHERE frwId= $enqid");
  echo $this->ta->sql;
}

//add to board in art gallery
function create($data){
  $id = $this->ta->create($data);
  return $id;
}

function readFwrdJob($id)
{
  $r = $this->ta->read('WHERE frwReciverId='.$id);

 return $r;
//echo $this->ta->sql;

}

function readFwrdJobbyme($id)
{
  $r = $this->ta->read('WHERE frwSenderId='.$id);
  return $r;
  //echo $this->ta->sql;

}

function emp_skills($id)
{
	$r = $this->emp_pr->read('WHERE spprofiles_idspProfiles='.$id);

  return $r;
  //echo $this->emp_pr->sql;die('---');
}

function readRecomdJob($id)
{
  $r = $this->ta->read('WHERE frwSenderId='.$id);
echo $this->ta->sql; die;
  //return $r;

}

}

 ?>
