<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<div class="post_timeline timeline_Photo bradius-15 bg-white">
    <!-- image gallery start -->
    <input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
    <input type="hidden" name="txtPagid" id="txtPagid" value="1">
    <!--  <div class="row filterArea no-margin bradius-20 bg-white">
<div class="col-md-5 " style="padding: 3px;">
<input type="checkbox" id="select_all" >&nbsp;&nbsp;Select All&nbsp;&nbsp;
<input type="button" id="delete_records" class="btn btn-primary fav_del_btn" value="Unfavourite">
</div>
<div class="col-md-3 no-padding">
<form class="form-inline">
<div class="form-group">
<label>Sort By</label>
<select class="form-control ordrSave bradius-20">

<option value="ASC">ASC</option>
<option value="DESC">DESC</option>
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
    <div class="row">
        <div class="gallery-img br_radius_top bradius-15" id="update_gallery">
            <div id="overlay">
                <div><img src="<?php echo $BaseUrl . '/assets/images/' ?>loading.gif" width="64px" height="64px" /></div>
            </div>
            <div class="page-content">

                <div id="pagination-result">
                    <input type="hidden" name="rowcount" id="rowcount" />
                </div>
            </div>
            <?php
            $fe = new _freelance_favorites;
            $p = new _postingviewartcraft;
            $results1 = $p->art_favorite_list_num($_SESSION["pid"]);
            $count_num_rows = $results1->num_rows;

            $results = $p->art_favorite_list($_SESSION["pid"]);
            if ($results) {

                echo "<div class='row m_top_10 frndProfileImg no-margin gallery-img m_btm_5'>";

                while ($rows = mysqli_fetch_assoc($results)) {

                    $postid = $rows['spPostings_idspPostings'];
                    $pf  = new _postfield;

                    $result = $p->singletimelines($postid);

                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);

                        //print_r($row);
                        $ProTitle   = $row['spPostingTitle'];
                        $ProCat   = $row['spPostSerComty'];
                        $skill   = $row['skill'];
                        $ProDes     = $row['spPostingNotes'];

                        $price      = $row['spPostingPrice'];
                        $country    = $row['spPostingsCountry'];
                        $city       = $row['spPostingsCity'];



                        $category = $row['servicecategory'];

                        $countryAdd    = $row['spPostCountry'];
                        $state = $row['spPostState'];
                        $cityAdd = $row['spPostCity'];
                        $dt = new DateTime($row['spPostingDate']);
                        $dtime = $row['spPostingDate'];
                        $PostingDate = $dt->format('d-m-Y');
                        $postalCod = $row['spPostPostalCode'];
                        $isPhoneShow = $row['spPostShowPhone'];
                        $isEmailShow = $row['spPostShowEmail'];
                        $pro = new  _spprofiles;
                        $resultpro = $pro->read($row['spProfiles_idspProfiles']);
                        if ($resultpro) {
                            $rowsp = mysqli_fetch_assoc($resultpro);

                            $ArtistName = $rowsp['spProfileName'];
                            $ArtistId   = $row['spProfiles_idspProfiles'];
                            $ArtistAbout = $rowsp['spProfileAbout'];
                            $ArtistPic  = $rowsp['spProfilePic'];
                            $UserEmail  = $rowsp['spProfileEmail'];
                            $UserPhone  = $rowsp['spProfilePhone'];
                        }
            ?>


                        <div class="col-md-6 no-padding searchable">
                            <div class="row timelinefile no-margin br_radius_top bradius-15 musicbox pb_10 pt_10">
                                <!--        <input type="checkbox" class="emp_checkbox" value="<?php echo $rows['idspPostings']; ?>" data-emp-id="<?php echo $rows['idspPostings']; ?>" style="z-index: 9;left: 20px;top: 18px;" >-->



                                <div class="col-md-2 no-padding">
                                    <?php
                                    $pc = new _postingpicartcraft;
                                    $res = $pc->read_fav_list($postid);

                                    //echo $pc->ta->sql;
                                    $active1 = 0;
                                    if ($res != false) {
                                        while ($postr = mysqli_fetch_assoc($res)) {
                                            $picture = $postr['spPostingPic']; ?>

                                            <?php
                                            if (isset($picture)) { ?>
                                                <img src="<?php echo $picture; ?>" alt="pdf" class="img-responsive" style="height: 50px;margin-left: 5px;" />
                                            <?php
                                            } else { ?>
                                                <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="height: 50px;margin-left: 5px;"> <?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                                        <?php
                                            $active1++;
                                        }
                                    } else { ?>
                                        <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="height: 50px;margin-left: 5px;"> <?php
                                                                                                                                                }
                                                                                                                                                    ?>

                                </div>

                                <div class="col-md-10">
                                    <!-- <span id='spFavouritePost' style="position: absolute;top: 2px;right: 7px;" data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-postid="<?php echo $postid; ?> " data-original-title="Unfavourite"><span class='font_regular'> </span></span> -->
                                    <h3><?php echo substr($ProTitle, 0, 20); ?></h3>
                                    <small style="margin-bottom: 0px;"><?php echo $category; ?></small>
                                    <p class="date" style="padding: 0px;margin-bottom: 5px;"><?php echo $ProCat; ?></p>


                                </div>
                                <div class="col-md-12 no-padding ">


                                    <a class="name text-center br_radius_bottom" href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>">View Art&Craft</a>
                                </div>
                            </div>
                        </div>

            <?php



                    }
                }
                echo"</div>";

                if($count_num_rows > 10){
                    ?>
                    <h1 class="load-more1 111" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer" >Load More</h1>
                                                    <input type="hidden" id="row1" value="0">
                                                    <input type="hidden" id="all1" value="<?php echo $count_num_rows; ?>"> 
                                                    <input type="hidden" id="profiddd1" value="<?php echo $_SESSION["pid"]; ?>"> 
                                                    
                      <?php } 

            }else{

                echo"<h4 style='text-align:center;'>No Photos found</h4>";
            }



            ?>
            <div class="space"></div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.load-more1').click(function(){
        
        var row1 = Number($('#row1').val());
        var allcount1 = Number($('#all1').val());
        row1 = row1 + 8;

        if(row1 <= allcount1){
			
            $("#row1").val(row1);
            var profileid1 = $("#profiddd1").val();
		
  
            $.ajax({
                url: 'more_favpic.php', 
                type: 'post',
                data: {row:row1,profile:profileid1},
                beforeSend:function(){
                    $(".load-more1").text("Loading...");
                },
                success: function(response){
					
                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".searchable:last").after(response).show().fadeIn("slow");
						
						   $(".load-more1").text("Load More");
                        var rowno = row1 + 8;
                        // checking row value is greater than allcount or not
                        if(rowno > allcount1){
						    $('.load-more1').css("display","none");
                        }else{
                            $(".load-more1").text("Load more");
                        }
						$(".load-more1").text("Load More");
                    }, 2000);
                }
            });
        }else{
            $('.load-more1').text("Loading...");
				
            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
               // $('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");

                // Reset the value of row
               // $("#row1").val(0); 

                // Change the text and background
                $('.load-more1').text("Load more");
                $('.load-more1').css("background","#15a9ce");
            }, 2000);
        }
    });
});






</script>