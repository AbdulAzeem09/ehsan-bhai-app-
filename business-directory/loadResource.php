
<?php
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if (isset($_POST['category'])) {
    //print_r($_POST); die('------------');
    $category = $_POST['category'];
    $pid = $_SESSION['pid'];

    $fd = new _favouriteBusiness;
    $p = new _spprofiles;
    $pf = new _profilefield;


    $result = $fd->readmyFavourite($_SESSION['pid'], 2);
    //echo $fd->ta->sql;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $res = $p->readUserId($row['idspProfiles_spProfileCompany']);

            if ($res) {
                while ($row2 = mysqli_fetch_assoc($res)) {

                    $country    = $row2["spProfilesCountry"];
                    $state      = $row2["spProfilesState"];
                    $city       = $row2["spProfilesCity"];

                    $query = $pf->read($row2["idspProfiles"]);
                    if ($query != false) {
                        $cmpnyName = "";
                        $cmpnyAddress = "";
                        $cmpnyCategory = "";

                        while ($row6 = mysqli_fetch_assoc($query)) {
                            if ($cmpnyName == '') {
                                if ($row6['spProfileFieldName'] == 'companyname_') {
                                    $cmpnyName = $row6['spProfileFieldValue'];
                                }
                            }
                            if ($cmpnyAddress == '') {
                                if ($row6['spProfileFieldName'] == 'companyaddress_') {
                                    $cmpnyAddress = $row6['spProfileFieldValue'];
                                }
                            }
                            if ($cmpnyCategory == '') {
                                if ($row6['spProfileFieldName'] == 'businesscategory_') {
                                    $cmpnyCategory = $row6['spProfileFieldValue'];
                                }
                            }
                        }
                    }

                    $bp = new _spbusiness_profile;
                    $cat = strtoupper($category);
                    $rpvt = $bp->getCategory($row2["idspProfiles"], $cat);

                    if ($rpvt != false) {
                        $row_p = mysqli_fetch_assoc($rpvt);

                        //echo "<pre>";
                        //print_r($row_p);
                        $cmpnyName = $row_p['companyname'];
                        $cmpnyCategory = $row_p['businesscategory'];
                    }
                    $mch = new _spprofiles;
                    $cats = $mch->readcat11($cmpnyCategory);
                    if ($cats != false) {
                        $catgory_1 = mysqli_fetch_assoc($cats);
                    }
                    // SHOW ALL COUNTRY , STATE, CITY
                    $st  = new _state;
                    $c   = new _country;
                    $ci  = new _city;
                    // county name
                    $result3 = $c->readCountryName($country);
                    if ($result3 != false) {
                        $row3 = mysqli_fetch_assoc($result3);
                    }
                    // provision name
                    $result5 = $st->readStateName($state);
                    if ($result5 != false) {
                        $row5 = mysqli_fetch_assoc($result5);
                    }
                    // city name
                    $result4 = $ci->readCityName($city);
                    if ($result4 != false) {
                        $row4 = mysqli_fetch_assoc($result4);
                    }
                    if ($category == 1) {
?>
<?php
                        echo '<tr>
<td><a href="' . $BaseUrl . '/business-directory/detail.php?business=' . $row2["idspProfiles"] . '">' . $cmpnyName . '</a></td>
<td class="text-center">' . $catgory_1['masterDetails'] . '</td>
<td class="text-center">' . $row3["country_title"] . '</td>
<td class="text-center">' . $row4["city_title"] . '</td>
<td class="text-center">
<a href="' . $BaseUrl . '/business-directory/detail.php?business=' . $row2['idspProfiles'] . '" class="btn" data-toggle="tooltip" title="View Business Detail"><i class="fa fa-briefcase"></i></a>
<a href="' . $BaseUrl . '/friends/?profileid=' . $row2["idspProfiles"] . '" class="btn" data-toggle="tooltip" title="View Profile"><i class="fa fa-user"></i></a>
<a href="javascript:void(0)" class="removeToResorc btn" data-favourite="2" data-company="' . $row2["idspProfiles"] . '" data-pid="' . $_SESSION["pid"] . '">
<span id="addtofavouriteeve"><i class="fa fa-trash"></i></span>
</a>
<a href="javascript:void(0)" class="btn addnotesresource" data-toggle="tooltip" title="Add Notes" data-resourceid="' . $row["idspFavbus"] . '">
<i class="fa fa-sticky-note" aria-hidden="true" data-toggle="modal" data-target="#myModal_1"></i>
</a>
</td>
</tr>'; ?>

<?php
                    } else if ($category == $cmpnyCategory) {
?>
<?php
                        echo '<tr>
<td><a href="' . $BaseUrl . '/business-directory/detail.php?business=' . $row2["idspProfiles"] . '">' . $cmpnyName . '</a></td>
<td class="text-center">' . $catgory_1['masterDetails'] . '</td>
<td class="text-center">' . $row3["country_title"] . '</td>
<td class="text-center">' . $row4["city_title"] . '</td>
<td class="text-center">
<a href="' . $BaseUrl . '/business-directory/detail.php?business=' . $row2['idspProfiles'] . '" class="btn" data-toggle="tooltip" title="View Business Detail"><i class="fa fa-briefcase"></i></a>
<a href="' . $BaseUrl . '/friends/?profileid=' . $row2["idspProfiles"] . '" class="btn" data-toggle="tooltip" title="View Profile"><i class="fa fa-user"></i></a>
<a href="javascript:void(0)" class="removeToResorc btn" data-favourite="2" data-company="' . $row2["idspProfiles"] . '" data-pid="' . $_SESSION["pid"] . '">
<span id="addtofavouriteeve"><i class="fa fa-trash"></i></span>
</a>
<a href="javascript:void(0)" class="btn addnotesresource" data-toggle="tooltip" title="Add Notes" data-resourceid="' . $row["idspFavbus"] . '">
<i class="fa fa-sticky-note" aria-hidden="true" data-toggle="modal" data-target="#myModal_1"></i> 
</a>
</td>
</tr>'; ?>

<?php
                    }
                }
            }
        }
    }
}
?>


