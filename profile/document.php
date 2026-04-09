    <div class="post_timeline timeline_Photo bradius-15 bg-white">
        <!-- Document start -->
        <input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
        <input type="hidden" name="txtPagid" id="txtPagid" value="4">
        <!--<div class="row filterArea no-margin bradius-20 bg-white">
            <div class="col-md-5 " style="padding: 3px;">
                <input type="checkbox" id="select_all" >&nbsp;&nbsp;Select All&nbsp;&nbsp;
                <input type="button" id="delete_records" class="btn btn-primary fav_del_btn" value="Unfavorite">
            </div>
            <div class="col-md-3 no-padding">
                <form class="form-inline">
                    <div class="form-group">
                        <label>Sort By</label>
                        <select class="form-control ordrSave bradius-20">
                            <option value="DESC">DESC</option>
                            <option value="ASC">ASC</option>
                            
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-4 no-padding">
                <form class="">
                    <div class="">
                        <input type="text" name="" value="" id="searchtx" class="form-control searchkeywordbox" placeholder="search keyword, description" />
                    </div>
                </form>
            </div>
        </div>-->


        <div class="row ">
            <div class="gallery-img" id="update_gallery">
                <?php
                //$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);
                // $res = $p->globaltimelinesFavourite($start, $_SESSION['pid']);
                $res = $p->globaltimelinesFavourite_uid_pid($start, $_SESSION['pid'], $_SESSION['uid']);
                if ($res != false) {
                    while ($timeline = mysqli_fetch_assoc($res)) {
                        $_GET["timelineid"] = $timeline['idspPostings'];
                        $res2 = $p2->singletimelines($_GET["timelineid"]);
                        if ($res2 != false) {
                            while ($rows = mysqli_fetch_assoc($res2)) {
                                $media = new _postingalbum;
                                $result = $media->read($rows['idspPostings']);
                                if ($result != false) {
                                    $dt = new DateTime($rows['spPostingDate']);
                                    $r = mysqli_fetch_assoc($result);
                                    //print_r($r);
                                    $picture = $r['spPostingMedia'];
                                    $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                    $sppostingmediaExt = $r['sppostingmediaExt'];
                                    if ($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx') {
                ?>
                                        <div class="col-md-6 no-padding searchable">
                                            <div class="row timelinefile no-margin br_radius_top bradius-15 musicbox pb_10 pt_10">
                                                <!-- <input type="checkbox" class="emp_checkbox" value="<?php echo $rows['idspPostings']; ?>" data-emp-id="<?php echo $rows['idspPostings']; ?>" style="z-index: 9;left: 20px;top: 18px;"> -->



                                                <div class="col-md-2 no-padding">
                                                    <img src="<?php echo $BaseUrl . '/assets/images/pdf.png' ?>" alt="pdf" class="img-responsive" />
                                                </div>

                                                <div class="col-md-10">
                                                    <!-- <span id='spFavouritePost' style="position: absolute;top: 2px;right: 7px;" data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-postid="<?php echo $rows['idspPostings']; ?> " data-original-title="Unfavourite"><span class='font_regular'> </span></span> -->
                                                    <h3><?php echo substr($sppostingmediaTitle, 0, 10); ?></h3>
                                                    <small style="margin-bottom: 0px;"><?php echo $sppostingmediaExt; ?></small>
                                                    <p class="date" style="padding: 0px;margin-bottom: 5px;"><?php echo $dt->format('d-M-Y'); ?></p>

                                                    <a href="<?php echo $sppostingmediaTitle; ?>" class="db_btn db_primarybtn btn-border-radius"><i class="fa fa-download " aria-hidden="true"></i>&nbsp;&nbsp;Download</a>
                                                </div>
                                                <div class="col-md-12 no-padding ">


                                                    <a class="name text-center br_radius_bottom" href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['idspProfiles']; ?>"><?php echo ucwords($rows['spProfileName']); ?></a>
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
        <!-- image gallery end -->
    </div>