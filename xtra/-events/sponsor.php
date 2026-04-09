    
    <div class="row no-margin">
        <?php
        $pf  = new _postfield;
        $pro = new _spprofiles;
        $spo = new _sponsorpic;
        $count = 0;
        $result6 = $pf->readSponsorPost($_GET['postid']);
        //echo $pf->ta->sql."<br>";
        if($result6 != false){
            while ($row6 = mysqli_fetch_assoc($result6)) {
                
                if($row6['spPostFieldValue'] != ''){
                    $sponsorId = $row6['spPostFieldValue'];
                    $result8 = $spo->readSponsor($sponsorId);
                    //echo $spo->ta->sql;
                    if($result8 != false){
                        $row8 = mysqli_fetch_assoc($result8);
                        if($row8['sponsorCategory'] == $SpCat){

                            if($count == 0){
                                echo "<h2>".$SpCat."</h2>";
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="row sponsorBox m_btm_20" style="display: block!important;">
                                    <div class="col-md-3">
                                        <img src="<?php echo ($row8['sponsorImg']);?>" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <h3><?php echo $row8['sponsorTitle'];?></h3>
                                        <a href="<?php echo $row8['sponsorWebsite'];?>" target="_blank"><?php echo $row8['sponsorWebsite'];?></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                        }
                    }
                }

            }
        }
        ?>
    </div>