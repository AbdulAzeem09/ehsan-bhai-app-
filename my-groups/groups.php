<?php
session_start();
?>
<input type="hidden" id="idspgroupprofile" name="idspgroupprofile" value=<?php echo $_SESSION["pid"]; ?>></input>

<input id="spProfileTypes_idspProfileTypes" type="hidden" value=<?php echo $_SESSION["ptid"]; ?>>

<input id="userid" type="hidden" value=<?php echo $_SESSION['uid']; ?>>
<?php

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$p = new _spgroup;
$rpvt = $p->read($_SESSION['pid']);
if ($rpvt != false) {
    while ($row = mysqli_fetch_assoc($rpvt)) {
        $rpvt = $g->members($row['idspGroup']);
        if ($rpvt != false) {
            while ($rows = mysqli_fetch_assoc($rpvt)) {
                if ($rows['spProfileIsAdmin'] == 0) {
                    $ptid = $rows["spProfileType_idspProfileType"];
                }
            }
        }
        echo "<a  id='gradmin-gid" . $row['idspGroup'] . "' href='members.php' class='list-group-item sp-group-label' data-gid='" . $row['idspGroup'] . "' data-createrptid='" . $ptid . "'>";
        echo $row['spGroupName'] . "</a>";
    }
}
?>
		