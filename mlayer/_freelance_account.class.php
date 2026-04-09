<?php

class _freelance_account
{

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct()
    {
        $this->ta = new _tableadapter("freelance_account");
        $this->tm = new _tableadapter("milestone");
        $this->ta->dbclose = false;
    }

    //milestone read
    function readUserBlnc($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser = $uid ORDER BY fa_id DESC LIMIT 1");
    }
    // READ USER BALANCE PROFILE WISE
    function readProBlnc($pid)
    {
        return $this->ta->read("WHERE spProfile_idspProfile = $pid ORDER BY fa_id DESC");
    }
    //read user acount detail
    function readUser($uid)
    {
        return $this->ta->read("WHERE spUser_idspUser = '$uid' ORDER BY fa_id DESC");
    }

    function readUser_d($pid)
    {
        return $this->tm->read("WHERE bussiness_profile_id = '$pid' ORDER BY id DESC");
    }

    // account adding
    function transactionupdate($data)
    {
        $this->ta->create($data);
    }
}
