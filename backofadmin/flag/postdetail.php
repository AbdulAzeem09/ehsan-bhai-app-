<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }

    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        $postid = $_GET['postid'];
       $flagid = $_GET['flagid'];
        $sql = "SELECT * FROM flagtimelinepost WHERE flag_id = $flagid";
        $result =dbQuery($dbConn, $sql);


        if ($result) {
            $row = dbFetchAssoc($result);
            extract($row);
            $flager = $spProfile_idspProfile;
            $postingId = $flagpostprofileid;
        }
        
/* print_r($row);*/
    }else {
        // redirect to index.php if user id is not present
        redirect('index.php');
    }
    

?>


<section class="content-header top_heading">
    <h1>Flag Post[Timeline]</h1>
</section>

<section class="content">
    
    <div class="box box-success">
        <div class="box-body">
            <div>
                <?php
                if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                    if($_SESSION['count'] <= 1){
                        $_SESSION['count'] +=1; ?>
                        <div class="space"></div>
                        <p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
                        unset($_SESSION['errorMessage']);
                    }
                } ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Post Detail</h2>

                                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posted By</strong></td>
                                    <td>
                                        <?php 
                                        showProfileName($dbConn, $flagpostprofileid);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Flager</strong></td>
                                    <td>
                                        <?php 
                                        showProfileName($dbConn, $spProfile_idspProfile);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Why Flag</strong></td>
                                    <td><?php echo $why_flag; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Post</strong></td>
                                    <td>
                                        <br>
                            <?php

                            $sql2 = "SELECT * FROM allpostdata WHERE idspPostings = $postid";
                            $result2 =dbQuery($dbConn, $sql2);
                         
                         if ($result2) {
                               $row2 = dbFetchAssoc($result2);
                            }
                          if($row2["spPostingNotes"] != ''){


                                            echo "<div style='color:#333'>".$row2["spPostingNotes"]."</div>";
                                          }
                             $sql1 = "SELECT * FROM sppostingpics WHERE spPostings_idspPostings = $postid";
                             $result1 =dbQuery($dbConn, $sql1);
                             if ($result1){
                                   $row1 = dbFetchAssoc($result1);
                                       $pic = $row1['spPostingPic'];
                                       if(!empty($pic)){

                                               echo "<br><div class='row no-margin'>";
                                            echo "<img alt='Posting Pic' src=' ".($pic)."' style='max-height:300px;' class='postpic img-thumbnail img-responsive bradius-15' >";
                                            echo "</div>";

                                       }
                                          
                                }        

                               

                                        
                             
                                 ?>

                                 <?php
                                    $sql3 = "SELECT * FROM sppostingmedia WHERE spPostings_idspPostings = $postid";
                             $result3 =dbQuery($dbConn, $sql3);
                                if ($result3 != false) 
                                     
                                  {

                             $r = mysqli_fetch_assoc($result3);
                             $picture = $r['spPostingMedia'];
                                $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                $sppostingmediaExt = $r['sppostingmediaExt'];
                                if($sppostingmediaExt == 'mp3'){ ?>
                                  <div style='margin-left:15px;margin-right:15px;'>
                                    <audio controls>
                                      <source src="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" type="audio/<?php echo $sppostingmediaExt;?>">
                                      Your browser does not support the audio element.
                                    </audio>
                                  </div>
                                  <?php
                                }else if($sppostingmediaExt == 'mp4'){ ?>
       
                          <div style='margin-left:15px;margin-right:15px;'>
                                    <video  style='max-height:300px;' controls>
                                      <source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
                                    </video>
                                  </div>
                                  <?php
                                }else if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
                                  ?>

                                  <div class="">
                                    <div class=" ">
                                      <img src="<?php echo $BaseUrl.'/assets/images/pdf.png'?>" style="height: 33px;width: 31px;" alt="pdf" class="" />
                                    </div>
                                    <div class="col-md-5">
                                      <h3><?php echo $sppostingmediaTitle;?></h3>
                                      <small><?php echo $sppostingmediaExt;?></small>
                                      <a href="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" target="_blank">Download</a>
                                    </div>
                                  </div>


                                  <?php
                                }
                                          } 
                                          
                                       
                                       ?>

                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
              
                   <!--  <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td>
                                        <?php 
                                        showPostTitle($dbConn, $spPosting_idspPosting);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Flager</strong></td>
                                    <td>
                                        <?php 
                                        showProfileName($dbConn, $spProfile_idspProfile);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Why Flag</strong></td>
                                    <td><?php echo $why_flag; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td><?php echo $flag_desc; ?></td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</section>