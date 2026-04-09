    

    <div class="row">
        <div class="col-md-12">
            <div class="heading02 text-center">
                <h1><span>More Products from Seller</span></h1>
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <?php
        $p = new _postingview;
        //$ps = $p->allpost($SellId);
        $ps = $p->seller_product($SellId);
        //echo $p->ta->sql;
        if($ps != false){
            while ($row_ps = mysqli_fetch_assoc($ps)) {
                ?>
                <div class="col-md-4 no-padding">
                    <div class="product_box">
                        <?php
                            $pic = new _postingpic;
                            $result = $pic->read($row_ps['idspPostings']);
                            //echo $pic->ta->sql;
                            
                            if ($result != false) {
                                $rp = mysqli_fetch_assoc($result);
                                $picture = $rp['spPostingPic'];
                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                            } else{
                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                            }
                            
                        ?>
                        
                        <h2><?php 
                            if(!empty($row_ps['spPostingtitle'])){
                                if(strlen($row_ps['spPostingtitle']) < 15){
                                    ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row_ps['spPostingtitle']; ?>"><?php echo $row_ps['spPostingtitle']; ?></a><?php
                                }else{
                                    ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row_ps['spPostingtitle']; ?>"><?php echo substr($row_ps['spPostingtitle'], 0,15).'...'; ?></a><?php
                                }
                            }else{
                                echo "&nbsp;";
                            }
                        ?></h2>
                        <p class="desc">
                            <?php
                            if(!empty($row_ps['spPostingNotes'])){
                                if(strlen($row_ps['spPostingNotes']) > 70){
                                    echo substr($row_ps['spPostingNotes'], 0,70).'...';
                                }else{
                                    echo $row_ps['spPostingNotes'];
                                }
                            }else{
                                echo "&nbsp;";
                            }
                            ?>
                        </p>
                        <p class="price_pro">US $ <?php echo ($row_ps['spPostingPrice'] > 0)?$row_ps['spPostingPrice']:"0";?> <!--<span class="pull-right per_box">-8%</span>--></p>
                        <?php
                        $r = new _sppostrating;
                        $res = $r->read($SellId,$row_ps['idspPostings']);
                        if($res != false){
                            $rows = mysqli_fetch_assoc($res);
                            $rat = $rows["spPostRating"];
                        }else{
                            $rat = 0;
                        }
                            
                        $result_ra = $r->review($row_ps['idspPostings']);

                        if($result_ra != false){
                            $total = 0;
                            $count = $result_ra->num_rows;
                            while($rows = mysqli_fetch_assoc($result_ra)){
                                $total += $rows["spPostRating"];
                            }
                            $ratings = $total/$count;
                        }else{
                            $ratings = 0;
                        }
                        $r = new _sppostreview;
                        $result_r = $r->review($row_ps['idspPostings']);
                        //echo $r->ta->sql;
                        if($result_r != false){
                            $rows = mysqli_fetch_assoc($result_r);
                            $review = $result_r->num_rows;
                        }else{
                            $review = 0;
                        }
                        ?>
                        <p class="rating_box">
                            <?php 
                            echo $ratings."&nbsp;";
                            $count_star = 1;
                            while ($count_star <= 5) {
                                if($count_star < $ratings){
                                    echo '<i class="fa fa-star yellow_clr"></i> ';
                                }else{
                                    echo '<i class="fa fa-star-o"></i> ';
                                }
                                $count_star++;
                            }
                            ?> 

                            
                            <a href="#">(<?php echo $review;?>)</a>
                        </p>

                    </div>
                </div>
                <?php
            }
        }
        ?>
        
        
        

        
    </div>