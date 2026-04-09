<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<div class='list-group'>";
$r = new _spprofilehasprofile;
$unread = new _friendchatting;
$a = array();
$res = $r->friends($_SESSION["uid"]); //As a receiver
//echo $r->ta->sql;
if ($res != false) {

    while ($rows = mysqli_fetch_assoc($res)) {

        $rslt = $g->friendprofile($_SESSION["uid"], $rows["spProfiles_idspProfileSender"]);
        $groupname = "";
        $groupid = 0;
        $g = new _spgroup;
        if ($rslt != false) {
            $rws = mysqli_fetch_assoc($rslt);
            $groupid = $rws["idspGroup"];
            $groupname = $rws["spGroupName"];
            $groupname = str_replace(' ', '', $groupname);
        }

        array_push($a, $rows["spProfiles_idspProfileSender"]);
        $p = new _spprofiles;

        $sender = $rows["spProfiles_idspProfileSender"]; //Friend
        $receiver = $rows["spProfiles_idspProfilesReceiver"]; //My
        $total = 0;
        $unres = $unread->unreadmessage($sender, $_SESSION["uid"]); //$receiver
        if ($unres != false) {
            $total = $unres->num_rows;
        }

        $result = $p->read($rows["spProfiles_idspProfileSender"]);
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            echo " <a href='#' class='list-group-item list-group-item-action friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "' data-friendname='" . $row["spProfileName"] . "' data-groupid='" . $groupid . "'>
                    <img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "' >"
            . "<span class='frndname'>" . $row["spProfileName"] . " </span>";
            //. "<span class='" . $row["spprofiletypeicon"] . " frdicon' data-frndicon='" . $row["spprofiletypeicon"] . "'></span>";
            if ($row['is_active'] == 1) {
                echo "<span style='float: right;'><img style='height:16px;width:16px'  src='" . $BaseUrl . "/img/green.png'></span>";
            } else {
                echo "<span style='float: right;'><img style='height:16px;width:16px' src='" . $BaseUrl . "/img/gray.png'></span>";
            }
            echo "</a>";
        }
    }
}
echo "</div>";