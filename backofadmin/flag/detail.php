<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }
	

//print_r($_POST);

//echo "<br>";
//print_r($_GET);
  if($_GET['catid'] != 22) {
    if (isset($_GET['catid']) && $_GET['catid'] > 0) {
        $catid = $_GET['catid'];
        $flagid = $_GET['flagid'];
        $sql = "SELECT * FROM flagpost WHERE flag_id = $flagid";
        $result =dbQuery($dbConn, $sql);
        if ($result) {
            $row = dbFetchAssoc($result);
            extract($row);
            $flager = $spProfile_idspProfile;
            $postingId = $spPosting_idspPosting;
 
  
        }
        
    }else {
        // redirect to index.php if user id is not present
        redirect('index.php');
    }
  } else{
	  
  }

?>



<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Detail</h1>
</section>


<!-- Main content -->
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
				
				<?php  if($_GET['catid']  == 22) {
                     $sql1 =  "SELECT * FROM  sppostings  AS t where  idspPostings = ".$_GET['flagid']; 
 
    // echo $sql1;  
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);
						  
						   $sql2 =  "SELECT * FROM  flagtimelinepost  AS t where  spPosting_idspPosting = ".$_GET['flagid']; 
 
    // echo $sql1;
                          $result2  = dbQuery($dbConn, $sql2);

                          $row2 = dbFetchAssoc($result2);
						  
						   $sql3 =  "SELECT * FROM  spprofiles  AS t where  idspProfiles = ".$row2['spProfile_idspProfile']; 
 
     //echo $sql3; die("-------------");
                          $result3  = dbQuery($dbConn, $sql3);

                          $row3 = dbFetchAssoc($result3);
						  $wh = "";
						  ?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo  $row2['active_time']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
                                </tr>
                                <tr>
                                    <td><strong>Flager</strong></td>
                                    <td>
                                        <?php 
                                       echo $row3['spProfileName'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Why Flag</strong></td>
                                    <td><?php  if($wh){ echo $why_flag ;} else{ echo "not found" ;} ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td><?php echo  $row1['spPostingNotes']; ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
					<?php } ?>
				

                    <?php  if($_GET['catid']  == 1) {
                     $sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
 
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);
						
						  ?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<!-- id =2  -->
					<?php  if($_GET['catid']  == 2) {
                     $sql1 =  "SELECT * FROM  spjobboard  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
                     
     //echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1); 
						  //print_r($row1);
						  ?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<!-- id 3 -->
					<?php  if($_GET['catid']  == 3) {
                     $sql1 =  "SELECT * FROM  sprealstate  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
  
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<!-- id 5 -->
					<?php  if($_GET['catid']  == 5) {
                     $sql1 =  "SELECT * FROM  spfreelancer  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
 
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<?php  if($_GET['catid']  == 7) {
                     $sql1 =  "SELECT * FROM  spclassified  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
 
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1); 
						  //print_r($row1);
						  ?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<?php  if($_GET['catid']  == 9 ) {
                     $sql1 =  "SELECT * FROM  spevent  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
 
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } ?>
					
					<?php  if($_GET['catid']  == 10 ) {
                     $sql1 =  "SELECT * FROM  spvideo  AS t where  video_id = ".$spPosting_idspPosting;
 
    // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['video_title'];?>
                                        <td>
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
                    </div>
					<?php }					?>
					
					<?php  if($_GET['catid']  == 13 ) {
                     $sql1 =  "SELECT * FROM  sppostingsartcraft  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
 
     // echo $sql1;
                          $result1  = dbQuery($dbConn, $sql1);

                          $row1 = dbFetchAssoc($result1);?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $row1['spPostingTitle'];?>
                                        <td>
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
                    </div>
					<?php } 
					 
					//  $spids=$row1['idspPostings']; ?>
					
					<?php  if($_GET['catid']  == '20') {
					$catid=$_GET['catid'];
					$flagid=$_GET['flagid'];
					
                $sqlmanagecurrency =  "SELECT * FROM `flagpost` WHERE spCategory_idspCategory=$catid AND flag_id=$flagid";
				$managecurrency  = dbQuery($dbConn, $sqlmanagecurrency);
				$i=1;
				$rowmanagecurrency = mysqli_fetch_array($managecurrency);
				$flag_id=$rowmanagecurrency['flag_id'];
				 $flag_desc=$rowmanagecurrency['flag_desc'];
				$why_flag=$rowmanagecurrency['why_flag'];
				$pid= $rowmanagecurrency['spProfile_idspProfile'];
				$category_id=$rowmanagecurrency['spCategory_idspCategory'];
				$postid=$rowmanagecurrency['spPosting_idspPosting'];
				//print_r($rowmanagecurrency);
				  $sql21=  "SELECT * FROM `spprofiles` WHERE idspProfiles=$pid";
				$res21= dbQuery($dbConn, $sql21);
				$row21=mysqli_fetch_assoc($res21);
				$flager_name=$row21['spProfileName'];
				
			   $sql31=  "SELECT * FROM `spbuisnesspostings` WHERE idspbusiness=$postid";
				$res31= dbQuery($dbConn, $sql31);
				if($res31!=false){
				$row31=mysqli_fetch_assoc($res31);
				$headline=$row31['listing_headline'];
				}?>
                          
                    <h2>Flag Detail</h2>
                    <div class="table-responsive p_top_15">
                        <table class="table table-striped ">
                            <tbody>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?php echo $flag_date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Posting</strong></td>
                                    <td style="text-transform: capitalize;">
                                            <?php echo $headline;?>
                                        <td>
                                </tr>
                                <tr>
                                    <td><strong>Flager</strong></td>
                                    <td><a href="https://dev.thesharepage.com/friends/?profileid=<?php echo $pid;?>">
                                        <?php 
                                        echo $flager_name;
                                        ?></a>
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
                    </div>
					<?php }?>
					
					
                </div>
            </div>
        </div>
    </div>
   <!-- <div class="box box-success">
        <div class="box-body">
            <?php
            // =====================COMPANY DETAIL
            $sql3 = "SELECT * FROM sppostings WHERE idspPostings = $spPosting_idspPosting";
            $result3 = dbQuery($dbConn, $sql3);
            //echo $p->ta->sql;
            if($result3){
                $row3 = dbFetchAssoc($result3);
                $title      = $row3['spPostingTitle'];
                $overview   = $row3['spPostingNotes'];
                $country    = $row3['spPostingsCountry'];
                $city       = $row3['spPostingsCity'];
                $dt         = new DateTime($row3['spPostingDate']);
                $spPrice    = $row3['spPostingPrice'];
                //$postingDate = $p-> spPostingDate($row3["spPostingDate"]);
                $clientId   = $row3['spProfiles_idspProfiles'];
                //$postedPerson = $row3['spUser_idspUser'];
                $CloseDate  = $row3['spPostingExpDt'];
                // company profile information
                $sql4 = "SELECT * FROM spprofilefield WHERE spprofiles_idspProfiles = $clientId";
                $result4 = dbQuery($dbConn, $sql4);
                
                if ($result4) {
                    $CmpnyName = "";
                    $CmpnyDesc  = "";
                    $CmpSize    = "";

                    while ($row4 = mysqli_fetch_assoc($result4)) {
                        if($CmpnyName == ''){
                            if($row4['spProfileFieldName'] == 'companyname_'){
                                $CmpnyName = $row4['spProfileFieldValue']; 
                            }
                        }
                        if($CmpnyDesc == ''){
                            if($row4['spProfileFieldName'] == 'companytagline_'){
                                $CmpnyDesc = $row4['spProfileFieldValue']; 
                            }
                        }
                        if($CmpSize == ''){
                            if($row4['spProfileFieldName'] == 'CompanySize_'){
                                $CmpSize = $row4['spProfileFieldValue']; 
                            }
                        }
                    }
                }
            }
            // =====================POSTING DETAIL
            $sql2 = "SELECT * FROM spPostField WHERE spPostings_idspPostings = $spPosting_idspPosting";
            $result2 = dbQuery($dbConn, $sql2);
            if($result2){

                if ($_GET['catid'] == 1) {

                    include('store.php');
                }else if ($_GET['catid'] == 2) {

                    include('job-board.php');
                }else if ($_GET['catid'] == 5) {

                    include('freelance.php');
                }else if ($_GET['catid'] == 3) {

                    include('realestate.php');
                }else if ($_GET['catid'] == 9) {
                    
                    include('event.php');
                }else if ($_GET['catid'] == 13) {
                    
                    include('photos.php');
                }else if ($_GET['catid'] == 14) {
                    
                    include('music.php');
                }else if ($_GET['catid'] == 10) {
                    
                    include('videos.php');
                }else if ($_GET['catid'] == 8) {
                    
                    include('training.php');
                }else if ($_GET['catid'] == 7) {
                    
                    include('service.php');
                }else{
                    
                }
                
            }
           ?>
        </div>
        
    </div>-->

        <button type="button" onclick="warPostEnable(1)" class="btn btn-info">Warning Poster + Enable Post</button>
        <button type="button" onclick="warPostEnable(2)" class="btn btn-info">Warning Flager + Enable Post</button>
        <button type="button" onclick="warPostEnable(3)" class="btn btn-danger">Disable</button>
        <button type="button" onclick="warPostEnable(4)" class="btn btn-success">Re-Enable Post</button>

<?php

if($_GET['catid']=='1'){
$module='store';	
}
if($_GET['catid']=='5')
{
	$module='freelance';
}
if($_GET['catid']=='2')
{
	$module='jobboard';
}
if($_GET['catid']=='3')
{
	$module='realestate';
}
if($_GET['catid']=='9')
{
	$module='event';
}
if($_GET['catid']=='13')
{
	$module='artcraft';
}
if($_GET['catid']=='10')
{
	$module='video';
}
if($_GET['catid']=='7')
{
	$module='classified';
}
 ?>

    <div class="space"></div>
    <form method="Post" action="processFlag.php?action=addflag" name="frmAddMainNav" id="frmAddMainNav" class="hidden">
        <input type="hidden" name="catid" value="<?php echo $_GET['catid']; ?>">
        <input type="hidden" name="flager_pid" value="<?php echo $flager; ?>" >
        <input type="hidden" name="poster_pid" value="<?php echo $clientId; ?>" >
		<input type="hidden" name="product_id" value="<?php echo $spids; ?>" >
        <input type="hidden" name="postid" value="<?php echo $postingId; ?>" >
        <input type="hidden" name="whichReason" id="whichReason" value="">
        <input type="hidden" name="flagId" value="<?php echo $_GET['flagid']; ?>">
        <div class="from-group">
            <label>Reason</label>
	 <input type="hidden" name="module" id="module" value="<?php echo $module; ?>">

            <textarea class="form-control" name="txtReason" rows="6"></textarea>
        </div>
        <br>
        <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary btn-flat">
    </form>


</section>
