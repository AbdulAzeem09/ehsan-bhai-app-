<div class="row">
    <div class="col-md-12 social 6">
        <?php
        //Finding friend
        //$fr = new _spprofilehasprofile;
        //$res = $fr->friendslist()

        $p = new _postingview;

        if(isset($_GET['post-detail']) && $_GET['post-detail'] >0){
            $postid = $_GET['post-detail'];
            $res = $p->singletimelines($postid);
            //echo $p->ta->sql;
        }
        
        echo "<div id='timeline-container'>";   
        if ($res != false)
            while ($timeline = mysqli_fetch_assoc($res)) {
                $_GET["timelineid"] = $timeline['idspPostings'];
                include "timelineentry.php";
            }
        echo "</div>";
        ?>
    </div>
    <!--<div class="<?php echo ($grouptimelines == 1 ? "col-md-2" : "") ?>"></div>-->
	
 

</div>


