
         <div class="table-responsive">
                        
                       
                        <table id="example" class="table table-striped table-bordered dashVdo" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Video</th>
                                    <th>Visibility</th>
                                    <th>Selling Price</th>
                                    <th>Date</th>
                                    <th>Views</th>
                                    <th>Comments</th>
                                    <th>Like</th>
                                    <th>Dislike</th>
									<?php if($_GET['business']==$_SESSION['pid']){ ?>
                                    <th>Action</th>
									<?php  } ?>
                                </tr>
                            </thead>
                            <tbody id="video_body">
                                <?php 
								
							/*	if($_GET['page']==1){
                                $start = 0;
							}else{
								$sss = $_GET['page']-1;
								 $start = 5*$sss;
							}
		
            $limitaa = 5;*/   $f = new _spprofilehasprofile;
			                         $vd = new _video;   
                                    $v = new _videoupload; 
                                   $res = $v->myUploadedVdeos($_GET['business']);

                              //var_dump($res);
						   $num_rows= $res->num_rows;
						   
						    if($res != false){
                                        while ($row = mysqli_fetch_assoc($res)) { 
											
											
                                            if($row['video_visibility'] == 1) {
                                                $video_visibility = 'Public';
                                            } else {
                                                 $video_visibility = 'Private';
                                            }   
                                            $dt = new DateTime($row['video_posting_datetime']);  ?>
											
											
											  <tr>
                                    <td>
                                        
                           <?php if(!empty($row['video_thumbnail'])) { ?>
                            <img class="effect-fade lazyloaded" src="../upload/video/video_thumbnail/<?php echo $row['video_thumbnail']; ?>" alt="vp-ms07" style="height: 50px !important;width: 50px;">
                                        <?php } else { ?>
                                            <video class="effect-fade lazyloaded" id="uploaded_video" controls style="height: 50px!important; width: 50px;">
                                       <source src="../upload/video/video_files/<?php echo $row['video_file']; ?>"  type="video/mp4" >
                                            </video>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $video_visibility; ?></td>
                                    <td>
                                        <?php 
                                            if($row['video_price_status'] == '1') {
                                                echo $row['video_price'] . '$';
                                            } else {
                                                echo 'Free';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $dt->format('Y/m/d'); ?></td>
                                    <td><?php echo $row['video_views']; ?></td>
                                    <td>
                                        <?php 
                                            
                                            $resultCmt = $vd->get_video_comment_by_id($row['video_id']);
                                            if($resultCmt != false){
                                                $countComment = mysqli_num_rows($resultCmt);
                                                //echo number_format_short($countComment);  
                                            } else {
                                                echo '0';
                                            }
                                        ?>

                                    </td>
                                    <td>
                                        <?php 
                                            
                                            $resultLike = $vd->countLikes($row['video_id']);
                                            if($resultLike != false){
                                                $countLike = mysqli_num_rows($resultLike);
                                                echo $countLike;
                                            } else {
                                                echo '0';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            
                                            $resultDlike = $vd->countDislike($row['video_id']);
                                            if($resultDlike != false){
                                                $countDlike = mysqli_num_rows($resultDlike);
                                                echo $countDlike;
                                            } else {
                                                echo '0';
                                            }
                                        ?>
                                    </td>
									<?php if($_GET['business']==$_SESSION['pid']){ ?>
                                    <td>
                                        <a href="<?php echo $BaseUrl.'/videos/watch.php?video_id='.$row['video_id'];?>">
                                            <i class="fa fa-eye"></i>
                                        </a> | 
                                        <a href="<?php echo $BaseUrl.'/videos/uploadform.php?video_id='.$row['video_id'];?>">
                                            <i class="fa fa-edit"></i>
                                        </a> | 
                                        <a href="javascript:deleteVideo(<?php echo $row['video_id']; ?>)">
                                            <i class="fa fa-trash"style="color: red;"></i>
                                        </a> 
                                    </td>
									<?php } ?>
                                </tr>

                    											
<?php
							}} else{?>
                                                        <td colspan="9"><center>No Record Found</center></td> 
                                                           <?php }											
                                ?>
									
                      
                            </tbody>
                         
                        </table>
						 </div>




<!--<div class="table-responsive">
    <table class="table table-striped table-bordered dashVdo">
        <thead>
            <tr>
                <th>Title</th>
                
                <th class="text-center">Category</th>
                <th class="text-center">Album</th>
                <th class="text-center">Rating</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="showMysong">
            <?php
            $p = new _postingview;

            $result = $p->myAllSongs($_GET['business'], 10);
            //echo $p->ta->sql;
            if($result != false){
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="searchable">
                        <td>
                            <a href="<?php echo $BaseUrl.'/videos/music-detail.php?music='.$row['idspPostings'];?>" class="titleBox"><?php echo $row['spPostingtitle'];?></a>
                        </td>
                        
                        <td class="text-center">
                            <?php
                            $pf  = new _postfield;
                            $result_pf = $pf->read($row['idspPostings']);
                            if($result_pf != false){
                                $category = "";
                                $album = "";
                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                    if($category == ''){
                                        if($row2['spPostFieldName'] == 'musiccategory_'){
                                            echo $category = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($album == ''){
                                        if($row2['spPostFieldName'] == 'musicalbum_'){
                                            $album = $row2['spPostFieldValue'];
                                        }
                                    }
                                }
                            }
                            
                            ?>
                        </td>
                        <td class="text-center">
                            <?php echo (isset($album))?$album:'';?>
                        </td>
                        <td class="text-center">
                            <div class="star homestr">
                                <?php
                                //rating
                                $total = 0;
                                $r = new _sppostrating;
                                $result2 = $r->review($row['idspPostings']);
                                if($result2 != false){
                                    
                                    $count = $result->num_rows;
                                    while($rows = mysqli_fetch_assoc($result2)){
                                        $total += $rows["spPostRating"];
                                    }
                                    $ratings = $total/$count;
                                }else{
                                    $ratings = 0;
                                }
                                ?>
                                <i class="fa fa-star <?php echo ($total >= 1)? 'active': '';?>"></i>
                                <i class="fa fa-star <?php echo ($total >= 2)? 'active': '';?>"></i>
                                <i class="fa fa-star <?php echo ($total >= 3)? 'active': '';?>"></i>
                                <i class="fa fa-star <?php echo ($total >= 4)? 'active': '';?>"></i>
                                <i class="fa fa-star <?php echo ($total >= 5)? 'active': '';?>"></i>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo $BaseUrl.'/videos/music-detail.php?music='.$row['idspPostings'];?>" class="" >View Detail</a>
                            
                        </td>
                    </tr> <?php
                }
            }
            ?>
            
        </tbody>
    </table>
</div>-->