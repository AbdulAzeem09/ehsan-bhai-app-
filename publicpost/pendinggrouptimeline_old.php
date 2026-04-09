<div class="row">
    <div class="col-md-12 social 5">
        <?php
        $conn = _data::getConnection();
        $p = new _postings;
        $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
        $gid = $group_id;
       
        $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16   AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";
        $res = mysqli_query($conn, $sql);

        echo "<div id='timeline-container'>";
      
        if ($res->num_rows > 0) {


            while ($timeline = mysqli_fetch_assoc($res)) {
   

                $_GET["timelineid"] = $timeline['timelineid'];
                $shareby = $timeline['spShareByWhom'];
                $proid = $timeline['spPostings_idspPostings'];
                $sharedesc = $timeline['spShareComment'];
                $grouptimelines = 1;
                include "pendinggrouptimeentry.php";
            }
        } elseif ($res->num_rows == 0) {
            if (!empty($profile_exist) &&  $approve == 1) {

                echo "<h4 style='text-align: center;'>No Post Available</h4>";
            } else {


                echo "<h4 style='text-align: center;padding-left: 259px;'>No Post Available</h4>";
            }
        }



        echo "</div>";
        ?>
    </div>

</div>
