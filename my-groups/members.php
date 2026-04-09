<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$g = new _spgroup;
$result = $g->groupdetails($_POST["gid"]);
if ($result != false) {
    $row = mysqli_fetch_assoc($result);
    $gname = $row["spGroupName"];
    $gtag = $row["spGroupTag"];
    $gdes = $row["spGroupAbout"];
    $gtype = $row["spgroupflag"];
    $gcategory = $row["spgroupCategory"];
    $glocation = $row["spgroupLocation"];
    $gimage = $row["spgroupimage"];
}

//Check Group Creator
$admin = 1;
$res = $g->checkcreator($_POST["gid"], $_SESSION["uid"]);
if ($res != false) {
    $row = mysqli_fetch_assoc($res);
    $admin = $row["spProfileIsAdmin"];
}
$m = new _spgroup;
$conn = _data::getConnection();
$sql = "select * from spprofiles_has_spgroup where spGroup_idspGroup ='" . $_POST['gid'] . "' and spProfiles_idspProfiles = " . $_SESSION["pid"];
$mResults = mysqli_query($conn, $sql);
if ($mResults != false) {
    $row = mysqli_fetch_all($mResults, MYSQLI_ASSOC);
    $isAssistant = $row[0]['spAssistantAdmin'];
}
?>

<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" id="sp-group-detail">
            <div class="panel-heading"></div>

            <div class="panel-body">
                <div style="margin-bottom:10px;">
                    <img src="<?php echo ($gimage); ?>" alt="Banner Image" class="img-rounded grpbanner">

                    <input type="hidden" id="idspGroup"  value=<?php echo $_POST["gid"]; ?>></input> 

                    <h2><?php echo $gname; ?></h2>
                    <h3 class="help-block"><?php echo $gtag; ?></h3>

                    <div class="description">
                        <p><?php echo $gdes; ?></p>
                    </div>

                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-6 description">
                            <label for="groupcategory">Group Category</label>
                            <p><?php echo $gcategory; ?></p>
                        </div>

                        <div class="col-md-6 description">
                            <label for="male">Location</label>
                            <p><?php echo $glocation; ?></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top:5px;">
                        <div class="col-md-5">
                            <a href="../grouptimelines/?groupid=<?php echo $_POST["gid"]; ?>&groupname=<?php echo $gname; ?>&timeline" class="btn btn-success" id="deleteGroup">Go to timeline</a>
                        </div>
                        <div class="col-md-7">
                            <div class="text-right <?php
                            if (($admin == 0)) {
                                echo "";
                            } elseif (($admin != 0) && ($isAssistant == 1)) {
                                echo "";
                            } else {
                                echo "hidden";
                            }
                            ?>" style="margin-top:10px;">                         
                                 <?php if ($admin == 0) { ?>
                                    <a href="deletegroup.php/?groupid=<?php echo $_POST["gid"]; ?>" class="btn btn-danger" id="deleteGroup"><span class="glyphicon glyphicon-trash"></span></a>
                                <?php } ?>
                                <button class="btn btn-primary" type="button" id="editgrp" data-groupid="<?php echo $_POST["gid"]; ?>">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--My All Friend for adding in the group-->
        <div class="<?php
        if (($admin == 0)) {
            echo "";
        } elseif (($admin != 0) && ($isAssistant == 1)) {
            echo "";
        } else {
            echo "hidden";
        }
        ?>">
                 <?php
                 include("myfriend.php");
                 ?>
        </div>
        <!-- Complete-->
    </div>
    <!--Testing-->
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 class="panel-title">Members</h3></div>
            <div class="panel-body">
                <ul class="list-group" id="sp-list-member">
                    <?php
                    $p = new _spgroup; //Admin will come on top
                    $rpvt = $p->members($_POST["gid"]);
                    if ($rpvt != false) {
                        while ($row = mysqli_fetch_assoc($rpvt)) {
                            if ($row['spProfileIsAdmin'] == 0) {
                                echo "<p id='gradmin-pid" . $row['idspProfiles'] . "' class='disabled list-group-item ' data-pid='" . $row['idspProfiles'] . "'><span class='glyphicon glyphicon-king'> </span> ";
                                echo $row['spProfileName'] . "</p>";
                            }
                        }
                    }
                    ?>		
                    <?php
                    $p = new _spgroup;
                    $rpvt = $p->members($_POST["gid"]);
                    if ($rpvt != false) {
                        while ($row = mysqli_fetch_assoc($rpvt)) {
                            if ($row['spProfileIsAdmin'] != 0) {
                                if ($row['spApproveRegect'] == null) {
                                    echo "<li class='list-group-item' data-pid='" . $row['idspProfiles'] . "' ><a id='gradmin-pid" . $row['idspProfiles'] . "' href='#' class='sp-profile-label' data-pid='" . $row['idspProfiles'] . "'>";
                                    echo $row['spProfileName'] . "</a>";

                                    echo "<div class='pull-right acptrjt'><span class='glyphicon glyphicon-ok gruopap' data-gid='" . $_POST["gid"] . "' data-pid='" . $row['idspProfiles'] . "'></span>&nbsp;&nbsp;<span class='glyphicon glyphicon-remove gruoprej' data-gid='" . $_POST["gid"] . "' data-pid='" . $row['idspProfiles'] . "'></span></div>";
                                    echo "</li>";
                                } else {
                                    echo "<li class='list-group-item' data-pid='" . $row['idspProfiles'] . "' ><a id='gradmin-pid" . $row['idspProfiles'] . "' href='../friends/?profileid=" . $row['idspProfiles'] . "' class='sp-profile-label' data-pid='" . $row['idspProfiles'] . "'>";
                                    echo $row['spProfileName'] . "</a><span class='glyphicon glyphicon-trash pull-right addtodelete " . ($admin == 0 ? "" : "hidden") . "' style='cursor:pointer;' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_POST["gid"] . "'></span></li>";
                                }
                            }
                        }
                    }
                    ?>							
                </ul>
            </div>
        </div>
    </div>
    <!--Testing Complete-->
</div>

