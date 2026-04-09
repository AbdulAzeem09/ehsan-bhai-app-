<?php

//Edit and delete 
$p = new _spprofiles;
$result = $p->readMember($_SESSION['uid'], $_GET["groupid"]);
if ($result != false) {
    while ($row = mysqli_fetch_assoc($result)) {

        $profileid = $row["idspProfiles"];
        $profilename = $row["spProfileName"];

        $g = new _spgroup;
        $pr = $g->admin_Member($profileid, $_GET["groupid"]);
        if ($pr != false) {
            $rw = mysqli_fetch_assoc($pr);
            if ($rw["spProfileIsAdmin"] == 0) {
                $admin = $rw["spProfileIsAdmin"];
            }
        }
    }
}


$p = new _spgroup;
$rpvt = $p->members($_GET["groupid"]);
//echo $p->ta->sql;
if ($rpvt != false) {
    while ($row = mysqli_fetch_assoc($rpvt)) {

//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";


        echo "<div class='searchable groupmembers'>";
        if ($row['spApproveRegect'] == 1) {
            if ($row['spProfileIsAdmin'] == 0) {
                //src=' ".($row['spProfilePic'])."'

                echo "<div class='box box-primary'>"
                . "<span class='searchtimelines' style='cursor:pointer; color:#1a936f; font-size:15px;' data-profileid='" . $row['idspProfiles'] . "'>"
                . "<img  alt='Posting Pic' class='img-circle' style='width:50px; height:50px;'  src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "'> " . $row['spProfileName'] . " "
                . "</span>"
                . "<span class='glyphicon glyphicon-king'></span>"
                . "</div>";
                
            } else {
               
                echo "<div class='box box-primary'><div class='sp-group-details del'>"
                . "<span class='searchtimelines' style='cursor:pointer; color:#1a936f; font-size:15px;' data-profileid='" . $row['idspProfiles'] . "'>"
                . "<img  alt='Posting Pic' class='img-circle' style='width:50px; height:50px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "'> " . $row['spProfileName'] . ""
                . "</span>";
                if (isset($admin) && $row['spAssistantAdmin'] == 0) {
                    echo "<a href='#' class='btn btn-success assistant_admin' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Make Admin Assistant</a><span style='".(($row['spAssistantAdmin'] == 0) ? "margin:0px -8px 0px 8px" : "")."' class='separator1'></span>";
                    //echo "<button type='button' class='btn btn-success assistant_admin' id='assistant_admin' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Make Assistant Admin</button>";
                } elseif (isset($admin) && $row['spAssistantAdmin'] == 1) {
                    echo "<a href='#' class='btn btn-primary remove_assistant' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Remove Admin Assistant</a><span style='".(($row['spAssistantAdmin'] == 1) ? "margin:0px -8px 0px 10px" : "")."' class='separator1'></span>";
                } 

                if ($row['spAssistantAdmin'] == 1 && (!isset($admin))) {
                    echo " <span><I class='fa fa-users'></I></span>";
                }
                if ($row['spAssistantAdmin'] == 1 && (isset($admin))) {
                    echo " <span><I class='fa fa-users'></I></span>";
                }

                //<a href='#'  class='addtodelete " . (isset($admin) ? "" : "hidden") . "' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>
                echo "<button style='float:right;".(($row['spAssistantAdmin'] == 0) ? "" : "")."' class='btn btn-danger addtodelete btn-border-radius " . (isset($admin) ? "" : "hidden") . "' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Delete</button>"
//                . "<span class='pull-right glyphicon glyphicon-trash' style='margin-top:20px;'></span>"
//                . "</a>"
                        . "</div>";
                        
                       
            }
        }
        echo "</div></div>";
    }
}
?>		