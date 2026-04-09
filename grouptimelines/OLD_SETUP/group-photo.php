<!DOCTYPE html>
<html lang="en-US">

<head>
  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
  <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">

</head>
<style>
  div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
  }
</style>

<body class="bg_gray" onload="pageOnload('groupdd')">
  <?php


  $g = new _spgroup;
  $result = $g->groupdetails($group_id);

  //echo $g->ta->sql;
  if ($result != false) {
    $row = mysqli_fetch_assoc($result);
    $gimage = $row["spgroupimage"];
    $spGroupflag = $row['spgroupflag'];
  }
  //print_r($result);
  //die("=======");
  ?>


  <?php
  $obj = new _groupconversation;
  $result2 = $obj->readpa($group_id);

  while ($row2 = mysqli_fetch_assoc($result2)) {
    //print_r($row);
    //die("=======");
    //die("=======");
  }
  //print_r($result2);
  //die("=======");
  ?>


  <?php

  $objmem = new _groupconversation;
  $result3 = $objmem->readmember($group_id, $_SESSION['pid']);

  if ($result3 != false) {
    while ($row3 = mysqli_fetch_assoc($result3)) {

      //print_r($row3);
      //die("=======");

    }
  }
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="photos">
        <div class="heading-wrapper">
          <div class="main-heading">
            Photo Albums
          </div>
          <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-album">
              <img src="../assets/images/inner_group/add-4.svg" alt="">
              <span>Create Album</span>
            </div>
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-image">
              <img src="../assets/images/inner_group/add-4.svg" alt="">
              <span>Add Image</span>
            </div>
          </div>
        </div>
        <div class="album-wrapper">

          <?php
          $p = new _postings;
          $p2 = new _postings;
          $start = 0;
          //$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);

          $conn = _data::getConnection();

          $gid = $group_id;


          $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";

          //echo $sql;
          $res = mysqli_query($conn, $sql);
          //var_dump($res);


          $pg = new _spgroup;
          $rpvt = $pg->readgroupAdmin($group_id);
          if ($rpvt != false) {
            while ($row = mysqli_fetch_assoc($rpvt)) {


              $admin = $row['idspProfiles'];
            }
          }

          if ($res != false) {
            while ($timeline = mysqli_fetch_assoc($res)) {

              /*print_r($timeline);*/

              $_GET["timelineid"] = $timeline['timelineid'];
              $res2 = $p2->singletimelines($_GET["timelineid"]);
              //var_dump($res2);
              //echo $p2->ta->sql;
              if ($res2 != false) {
                while ($rows = mysqli_fetch_assoc($res2)) {

                  // print_r($rows);
                  $pr = new _spprofiles;
                  $NameOfProfile = $pr->getProfileName($rows['spProfiles_idspProfiles']);
                  // var_dump($NameOfProfile);
                  $dt = new DateTime($rows['spPostingDate']);

                  $pic = new _postingpic;
                  $result = $pic->read($rows['idspPostings']);
                  //var_dump($result);
                  //echo $pic->ta->sql;
                  if ($result != false) {
                    while ($rp = mysqli_fetch_assoc($result)) {
                      //print_r($rp);
                      $pict = $rp['spPostingPic'];
                    }
                  } else {
                    $pict = NULL;
                  }
                  if ($pict == NULL) {
                  } else { ?>
                    <div class="album">
                      <div class="img-wrapper" style="margin-bottom: 0px;">

                        <a class="thumbnail" rel="lightbox[group]" href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&timeline">
                          <?php
                          echo "<img alt='Posting Pic' src='" . ($pict) . "' style='width: 243px !important ; height : 200px'>";
                          ?>
                        </a>
                      </div>
                       
                        <a class="name" style="color: black!important; href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['spProfiles_idspProfiles']; ?>"><?php echo $NameOfProfile; ?></a>
                        <?php if ($admin == $_SESSION['pid']) { ?>
                          <a onclick="remove_member('<?php echo $BaseUrl . '/post-ad/deletegrouppost.php?postid=' . $rows['idspPostings'] . '&flag=1'; ?>')">
                            <i class="fa fa-trash"></i> Delete Post
                          </a>
                        <?php } ?>
                    </div>
          <?php
                  }
                }
              }
            }
          }



          ?>
        </div>


      </div>
    </div>
  </div>

  <div class="modal add-album-modal" id="add-album" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Album</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-group in-1-col">
                            <label>Album Name <span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Type Album Name">
                        </div>
                        <!-- <div class="input-group in-2-col" >
                            <label>Category</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div> -->

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        style="background-color: #7649B3; color : white;">Create</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal add-image-modal" id="add-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Photo</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <!-- <div class="input-group in-1-col">
                            <label>Album Name <span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Type Album Name">
                        </div> -->
                        <div class="input-group in-1-col">
                            <label>Select Album <span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Album</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="in-1-col upload-btn">
                            <img src="../assets/images/inner_group/add-4.svg" alt="">
                            Upload Image
                        </div>
                        <div class="in-1-col img-wrapper">
                            <img src="../assets/images/inner_group/img-2.svg" alt="" class="img">
                            <div class="cross-icon">
                                <img src="../assets/images/inner_group/cross.svg" alt="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        style="background-color: #7649B3; color : white;">Save</button>
                </div>
            </div>
        </div>
    </div>



  <script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>

  <script>
    function remove_member(id) {
      Swal.fire({
        title: 'Are you sure you want to delete ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonColor: '#FF0000',
        cancelButtonText: 'No',


      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = id;
        }
      });

    }
  </script>

  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
  <script>
    var _gaq = [
      ['_setAccount', 'UA-XXXXX-X'],
      ['_trackPageview']
    ];
    (function(d, t) {
      var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
      g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g, s)
    }(document, 'script'));
    // Colorbox Call
    $(document).ready(function() {
      $("[rel^='lightbox']").prettyPhoto();
    });
  </script>
  <!-- image gallery script end -->
</body>

</html>