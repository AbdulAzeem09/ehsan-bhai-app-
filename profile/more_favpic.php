<?php
include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$row1 = $_POST['row'];
$profile1 = $_POST['profile'];
$rowperpage1 = 4;


$p = new _postingviewartcraft;
$res5= $p->art_favorite_listreadmore($profile1,$row1,$rowperpage1);

// $html = '';
while($row3=mysqli_fetch_assoc($res5)){


    $postid = $row3['spPostings_idspPostings'];
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
















} 
?>

<div class="col-md-6 no-padding searchable">
                            <div class="row timelinefile no-margin br_radius_top bradius-15 musicbox pb_10 pt_10">
                                <!--        <input type="checkbox" class="emp_checkbox" value="<?php echo $row3['idspPostings']; ?>" data-emp-id="<?php echo $row3['idspPostings']; ?>" style="z-index: 9;left: 20px;top: 18px;" >-->



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
                                                                                                                                           <?php } ?>
                                                            

