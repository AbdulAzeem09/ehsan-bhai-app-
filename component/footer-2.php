<footer >
            <div class="foot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>The SharePage</h2>
                            <?php
                            $n = new _spcontent;
                            $result3 = $n->read(10);
                            if ($result3) {
                                $row3 = mysqli_fetch_assoc($result3);
                                echo "<p>".$row3['contDesc']."</p>";
                            }
                            ?>
                            
                            <div class="sociallinks">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                        <?php
                        $fh = new _spcontent;
                        $m = new _spAllStoreForm;
                        $i = 1;

                        $result5 = $fh->readFotheading();
                        if ($result5) {
                            while ($row5 = mysqli_fetch_assoc($result5)) {
                                ?>
                                <div class="col-md-2">
                                    <h2><?php echo $row5['fh_title']; ?></h2>
                                    <?php
                                    if ($i == 1) {
                                        ?>
                                        <p><a href="<?php echo $BaseUrl.'/contact.php';?>">Contact Us</a></p>
                                        <?php
                                    }
                                    $i++;

                                    $limit = 5; 
                                    $result = $m->readFootPage($row5['fh_id'], $limit);
                                    //echo $m->pg->sql;
                                    if ($result) {
                                        while($row = mysqli_fetch_assoc($result)){
                                            $pageTitle = $row['page_title'];
                                            $linkfot = str_replace(' ', '_', strtolower($pageTitle));
                                            ?>
                                            <p><a href="<?php echo $BaseUrl.'/page/?page='.$linkfot; ?>"><?php echo $pageTitle; ?></a></p>
                                            <?php
                                        }
                                    }
                                    ?>
                                   
                                </div>
                                <?php
                            }
                        }
                        ?>
                        

                    </div>
                </div>
            </div>
            <div class="btm_foot text-center">
                <p>&copy; TheSharePage, <?php echo date('Y');?> All rights reserved</p>
            </div>
        </footer>