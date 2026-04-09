<div class="post_timeline timeline_Photo bradius-15 bg-white">
    <!-- video start -->
    <input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
    <input type="hidden" name="txtPagid" id="txtPagid" value="3">
    <!-- <div class="row filterArea no-margin bradius-20 bg-white">
        <div class="col-md-5 " style="padding: 3px;">
            <input type="checkbox" id="select_all">&nbsp;&nbsp;Select All&nbsp;&nbsp;
            <input type="button" id="delete_records" class="btn btn-primary fav_del_btn" value="Unfavorite">
        </div>
        <div class="col-md-3 no-padding ">
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
            // $res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);
            //$res = $p->globaltimelinesFavourite($start, $_SESSION['pid']);
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
                                $picture = $r['spPostingMedia'];
                                $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                $sppostingmediaExt = $r['sppostingmediaExt'];
                                if ($sppostingmediaExt == 'mp4') { ?>
                                    <div class="col-md-4 no-padding searchable">
                                        <div class="musicbox text-center br_radius_top bradius-15">
                                            <!-- <input type="checkbox" class="emp_checkbox" value="<?php echo $rows['idspPostings']; ?>" data-emp-id="<?php echo $rows['idspPostings']; ?>" style="z-index: 9;left: 15px;top: 10px;"> -->



                                            <div class="video_box br_radius_top">
                                                <video style='width: 100%' class="br_radius_top" controls>
                                                    <source src='<?php echo $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
                                                </video>
                                            </div>
                                            <!-- <span id='spFavouritePost' style="position: absolute;top: 12px;right: 14px;" data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-postid="<?php echo $rows['idspPostings']; ?> " data-original-title="Unfavourite"><span class='font_regular'> </span></span> -->
                                            <p class="date"><?php echo $dt->format('d-M-Y'); ?></p>
                                            <a class="name br_radius_bottom" href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['idspProfiles']; ?>"><?php echo ucwords($rows['spProfileName']); ?></a>
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