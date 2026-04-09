<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }

 
        $flagid = $_GET['flagid'];
        $sql = "SELECT * FROM rfqflag WHERE id = $flagid";
        $result =dbQuery($dbConn, $sql);
        if ($result) {
            $row = dbFetchAssoc($result);
            extract($row);
            $flager = $spProfile_idspProfile; 
            $postingId = $spPosting_idspPosting;
			 
        }
        
       // echo  $flager;

        //echo $postingId;
   
    
 
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
                    <h2>RFQ Flag Detail</h2>
                    <div class="table-responsive p_top_15">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-body">
       <!--      <?php
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
            ?> -->
        </div>
        
    </div>

        <button type="button" onclick="warPostEnable(1)" class="btn btn-info">Warning Poster + Enable Post</button>
        <button type="button" onclick="warPostEnable(2)" class="btn btn-info">Warning Flager + Enable Post</button>
        <button type="button" onclick="warPostEnable(3)" class="btn btn-danger">Disable</button>
        <button type="button" onclick="warPostEnable(4)" class="btn btn-success">Re-Enable Post</button>

    <div class="space"></div>
    <form method="Post" action="processFlag.php?action=addflag" name="frmAddMainNav" id="frmAddMainNav" class="hidden">
        <input type="hidden" name="catid" value="<?php echo $_GET['catid']; ?>">
        <input type="hidden" name="flager_pid" value="<?php echo $flager; ?>" >
        <input type="hidden" name="poster_pid" value="<?php echo $clientId; ?>" >
        <input type="hidden" name="postid" value="<?php echo $postingId; ?>" >
        <input type="hidden" name="whichReason" id="whichReason" value="">
        <input type="hidden" name="flagId" value="<?php echo $_GET['flagid']; ?>">
        <div class="from-group">
            <label>Reason</label>
            <textarea class="form-control" name="txtReason" rows="6"></textarea>
        </div>
        <br>
        <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary btn-flat">
    </form>


</section>
