    
    <div class="row" id="timelinechange">
        <div class="col-md-12 social 4">
            <?php
            //Finding friend
            //$fr = new _spprofilehasprofile;
            //$res = $fr->friendslist()
            //get all hide posting
            $hp = new _hidepost;
            $results = $hp->getPost($_SESSION['pid']);
            //echo $hp->ta->sql;
            $hidepost = array();
            if($results != false){
                while ($rowh = mysqli_fetch_assoc($results)) {
                    array_push($hidepost, $rowh['spPostings_idspPostings']);
                }
            }

            //print_r($hidepost);

            $p = new _postingview;
            if (isset($grouptimelines) && $grouptimelines == 1) {
                $res = $p->grouptimelines($_GET["groupid"]);
            } else {
                $start = 0;
                $res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);
                //$res = $p->globaltimelines($start, $_SESSION["uid"]);
                //echo $p->ta->sql;
            }
            echo "<div id='timeline-container'>";
			//echo $p->ta->sql;
            if ($res != false)
                while ($timeline = mysqli_fetch_assoc($res)) {
                    if(in_array($timeline['idspPostings'], $hidepost)){

                    }else{
                        $_GET["timelineid"] = $timeline['idspPostings'];
                        include "timelineentry.php";
                    }
                    
                }
            echo "</div>";
            ?>
        </div>
        <!--<div class="<?php echo ($grouptimelines == 1 ? "col-md-2" : "") ?>"></div>-->

    </div>


