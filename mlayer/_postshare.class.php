<?php
class _postshare
{

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        /*$this->ta = new _tableadapter("spShare");*/
        $this->ta = new _tableadapter("share");
        $this->tad = new _tableadapter("spMessaging");
        $this->ta->dbclose = false;
    }

    function share($data){
        return $this->ta->create($data);

    }

    function Share_To($data){
        return $this->tad->create($data);
        //echo $this->tad->sql;

    }


    function sharecount($postid){
        return $this->tad->read("where t.spPostings_idspPostings = '$postid'");
    }


    function readUserId($pid , $gid){

        return $this->ta->read("WHERE spShareByWhom  = $pid AND spShareToGroup = $gid ");
        // echo $this->ta->sql;
    }

    function read()
    {
        return $this->ta->read();

    }
    function read_post($gid)
    {
        return $this->ta->read(" WHERE spShareToGroup = $gid ");
        // echo  $this->ta->sql;

    }

    function readgroupshare($postid)
    {
        return $this->ta->read("WHERE spPostings_idspPostings =" .$postid);
    }

    function create($spPostings_idspPostings, $spShareByWhom, $spShareToWhom, $spShareComment){
        $this->ta->create(array("spPostings_idspPostings" =>$spPostings_idspPostings, "spShareByWhom" =>$spShareByWhom, "spShareToWhom"=>$spShareToWhom, "spShareComment"=>$spShareComment));
    }

    function getSharePost($uid)
    {
        return $this->ta->read("WHERE spShareToWhom  = $uid");

    }
}
?>