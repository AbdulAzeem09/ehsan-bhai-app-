   
    
            <div class="row">
                <div class="col-md-12">
                    <div class="files_name text-center">
                        <p>Shared Files </p>
                    </div>
                    

                </div>
            </div>
            <div class="" style="padding: 15px;">
                <div class="row ">
                    <div class="gallery-img" id="update_gallery">
                        <?php
                        $p = new _postingview;
                        $p2 = new _postingview;
                        $start = 0;
                        //$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);

                        $conn = _data::getConnection();
                        $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
                        $gid = $group_id;
                        $sql = "SELECT s.spPostings_idspPostings FROM spshare AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToGroup = $gid AND f.idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 and t.sppostingvisibility = $gid ORDER BY spPostings_idspPostings DESC";
                        $res = mysqli_query($conn, $sql);

                        if ($res != false){
                            while ($timeline = mysqli_fetch_assoc($res)) {
                                $_GET["timelineid"] = $timeline['spPostings_idspPostings'];
                                $res2 = $p2->singletimelines($_GET["timelineid"]);
                                if ($res2 != false){
                                    while ($rows = mysqli_fetch_assoc($res2)) {
                                        $media = new _postingalbum;
                                        $result = $media->read($rows['idspPostings']);
                                        if ($result != false) {
                                            $r = mysqli_fetch_assoc($result);
                                            $picture = $r['spPostingMedia'];
                                            $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                            $sppostingmediaExt = $r['sppostingmediaExt'];
                                            if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
                                                ?>
                                                <div class="col-md-6 no-padding searchable">
                                                    <div class="row timelinefile no-margin">
                                                        <div class="col-md-2 no-padding">
                                                            <img src="<?php echo $BaseUrl.'/assets/images/pdf.png'?>" alt="pdf" class="img-responsive" />
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h3><?php echo $sppostingmediaTitle;?></h3>
                                                            <small><?php echo $sppostingmediaExt;?></small>
                                                            <a href="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" target="_blank">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                            }
                                        }


                                        
                                    }
                                }
                            }
                        }

                        ?>
                        

                    </div>
                </div>
            </div>
