<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }

    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        $postid = $_GET['postid'];
    }else {
        // redirect to index.php if user id is not present
        redirect('index.php');
    }
    $sql = "SELECT * FROM sppostings AS s INNER JOIN spprofiles AS p ON s.spProfiles_idspProfiles = p.idspProfiles WHERE idspPostings = $postid";
    //echo $sql = "SELECT * FROM sppostings WHERE idspPostings = $postid";
    //$sql		=	"SELECT * FROM `sppostfield` WHERE spPostings_idspPostings = $postid";
    $result     = dbQuery($dbConn,$sql);
    $row = dbFetchAssoc($result);
    extract($row);
    $postDate = strtotime($spPostingDate);
    $postExpDate = strtotime($spPostingExpDt);
?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Post Detail<small>[Classifid ad]</small></h1>
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
                    <h3><?php echo $spPostingTitle;?></h3>
                    <p>By: <a href="javascript:void(0)"><?php showProfileName($dbConn, $spProfiles_idspProfiles); ?></a></p>
                    <hr>
                </div>
                <div class="col-md-4">
                    <p><i class="fa fa-clock-o"></i> Publish Date: <?php echo date("d-M-Y", $postDate); ?></p>
                </div>
                
                <div class="col-md-4">
                    <p><i class="fa fa-clock-o"></i> Expired Date: <?php echo date('d-M-Y', $postExpDate); ?></p>
                </div>
                <div class="col-md-4">
                    <p><i class="fa fa-dollar"></i> Price: <?php echo $spPostingPrice; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- gallery box -->
                    <div class="row">
                        <?php
                        $sql2 = "SELECT * FROM spPostingPics WHERE spPostings_idspPostings = $postid";
                        $result2 = dbQuery($dbConn, $sql2);
                        if ($result2 AND dbNumRows($result2) > 0) {
                            while($row2 = dbFetchAssoc($result2)){
                                $picture = $row2['spPostingPic'];
                                echo "<div class='col-md-4'><img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' style='width:100%;height: 204px;' ></div>";
                            }
                            
                        }else{
                            echo "<div class='col-md-4'><img alt='Posting Pic' src='".WEB_ROOT."upload/no-img.png' class='img-responsive' style='width:100%;height: 204px;' ></div>";
                        }
                        ?>
                    </div>
                    <h4>Description</h4>
                    <p><?php echo $spPostingNotes;?></p>
                    
                </div>
                <div class="col-md-6">
                    <div class="detailBox">
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $spProfileEmail; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone No</td>
                                    <td><?php echo $spProfilePhone; ?></td>
                                </tr>
                                <tr>
                                    <td>Category / Module</td>
                                    <td><?php showCategoryName($dbConn, $spCategories_idspCategory); ?></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    
                                    <td>
                                        <?php
                                        if($spPostingsCountry > 0 && $spPostingsCountry != ''){
                                            CountryName($dbConn, $spPostingsCountry);
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    
                                    <td>
                                        <?php
                                        if($spPostingsCity > 0 && $spPostingsCity != ''){
                                            CityName($dbConn, $spPostingsCity);
                                        } ?>
                                    </td>
                                </tr>
                                <?php

                                    //$sql      =   "SELECT * FROM `sppostfield` WHERE spPostings_idspPostings = $postid";
                                    $sql2 = "SELECT * FROM sppostfield WHERE spPostings_idspPostings = $postid";
                                    $result2 = dbQuery($dbConn, $sql2);
                                    if ($result2) {
                                        while($rw = dbFetchAssoc($result2)){
                                            if ($rw["spPostFieldLabel"] != '' && $rw['spPostFieldValue'] != '') {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rw["spPostFieldLabel"];?></td>
                                                    <td><?php echo $rw["spPostFieldValue"];?></td>
                                                </tr>                                                
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
            <div class="space"></div>
    </div>
</section>
