    
    <form method="post" action="../post-ad/dopost.php"  id="sp-form-post" enctype="multipart/form-data" >
        <input type="hidden" id="catname" value="">
        <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
        <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
        <input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">

        <div class="row">
            <!-- <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value=""> -->

            <div class="col-md-12">
                <div class="topstatus">
                    <div class="createbox">
                        <span><label><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" class="img-responsive" > <strong>Create a post</strong></label></span>
                        <span class="seprate">|</span>
                        <span><label class="btn-bs-file"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/post_photo_icon_enable.png" alt="" class="img-responsive" /> Post Photo<input type="file" class="postingpic" name="spPostingPic[]" accept="image/*" multiple="multiple"></label></span>
                        <span class="seprate">|</span>
                        <span><label class="btn-bs-file"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="" class="img-responsive" /> Audio/Video<input type="file" id="addvideo" class="spmedia"  name="spPostingMedia"  accept=""></label></span>
                        <span class="seprate">|</span>
                        <span><label class="btn-bs-file"><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="" class="img-responsive" /> Documents<input type="file" id="addDocument" class='spDocument' name="spPostingDocument" accept="" /></label></span>
                                            
                        

                    </div>
                </div>
            </div>
            <?php
                $p = new _album;
                $res = $p->readalbum($_SESSION["pid"]);
                if ($res != false) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($row['spPostingAlbumName'] == "Timeline") {
                            $albumid = $row["idspPostingAlbum"];
                        }
                    }
                    if (!isset($albumid)) {
                        $pid = $_SESSION["pid"];
                        $albumid = $p->timelinealbum($pid);
                    }
                }else {
                    $pid = $_SESSION["pid"];
                    $albumid = $p->timelinealbum($pid);
                }
            ?>
            <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
            <div class="col-md-12">
                <div class="statusimage commentprofile2">
                    <?php
                        $p = new _spprofiles;
                        $result = $p->read($_SESSION['pid']);
                        if ($result != false) {
                            $row = mysqli_fetch_assoc($result);
                            if (isset($row["spProfilePic"]))
                                echo "<img alt='profilepic' class='img-circle img_posting_absolut' src=' " . ($row["spProfilePic"]) . "'  >";
                            else
                                echo "<img alt='profilepic' class='img-circle img_posting_absolut'  src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    ?>
					<img id="loading_indicator" src="<?php echo $BaseUrl;?>/assets/images/loader/ajax-loader.gif" style="width: 16px;height: 11px;left: 94%;top: 3px;right: 0px;" >
                    <textarea type="text" class="grptimeline form-control" id="grptimelinefrmtxt" data-emojiable="true" required placeholder="Share What's in your mind" onkeyup="return demo();" name="spPostingNotes" rows="3" spellcheck="false" ></textarea>
                </div>
                <div class="post_btn_footer">
                    <p class="tel_feel">Tell how are you feeling?</p>
                    <div class="dropdown pull-right timeline_butn">
                        <button id="spPostSubmitTimeline" type="button" class="btn btnPosting" data-visibility="<?php echo "-1" ?>" data-loading-text="Posting...">Post</button>
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" id="mygroup" ><span class="caret"></span></button>
                        <ul class="dropdown-menu timelinedrop" id="allmygroup">
                            <li><label>Share with group</label></li>
                            <?php include("allmygroup.php"); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 hidden" id="showchekbox">
                <div class="post_timeline acknowled" style="padding: 5px;">
                    <label class="checkbox-inline"><input type="checkbox" id="chkAcknw" value="1" checked="">Acknowledgement: I am owner of this item.</label>
                    <label class="checkbox-inline"><input type="checkbox" id="chkAgree" value="1" checked="">I agree to the <a href="javascript:void(0)">copyright violate information </a></label>
                </div>
            </div>
            <div id="postingPicPreview">
                <div id="dvPreview" class="hidden timelineimg"></div>
            </div>
            <div id="media-container"></div>
            



        </div>
    </form>
    <div class="timelineload" >
        <div class="loader"></div>
    </div>
    <div class="row no-margin">
        <div class="col-md-12 no-padding">
            <div id="mediaTitle" class=""></div>
            <div id="groupTitle" class=""></div>
        </div>
        <div class="col-md-12 no-padding">
            <div id="progressBox" style="" class="">
                <progress id="progressBar" value="0" max="100" style="width:100%"></progress>
                <span id="status">100% Loading</span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
           
           $( document ).ready(function() {
                $("#spPostSubmitTimeline").on("click", function(){
                 

                    var txtIndusrtyType = $("textarea#grptimelinefrmtxt").val();
                    

                      var flag=0;
      
       if (txtIndusrtyType!="")
       {
       var strArr = new Array();
       strArr = txtIndusrtyType.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

                    if(txtIndusrtyType == ""){
                            

                        $("#text_error").text("Please Enter Title.");
                        return false;

                     }
                     else if(flag == 1){
                        $("#text_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>