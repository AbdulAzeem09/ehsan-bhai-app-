<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="container">
              <div class="row">
                <div class="col-md-4 p-2" style="padding:10px;">
                  <div class="searchNameField">
                    <input type="text" placeholder="Search member" id="searchName" class="form-control " />
                  </div>
                  <div class="mhead p-2" style="padding:10px;">
                    <div class="text-center mb-3">
                      <h5 class="members-heading">Select All
                        <input class="float-right allCheckboxa" id="statusalla" onclick="togglea(this);" type="checkbox" style="float:right;     margin-right: 25px;">
                      </h5>
                    </div>


                    <?php
                    $splinkp = new _spevent;
                    $pro = new _spprofiles;
                    $allCohost = array();
                    $ii = 1;
                    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
                      $fieldName = "spPostingCohost_";
                      $result7 = $splinkp->read($_GET['postid']);
                      //  echo $splinkp->ta->sql."<br>";  die('-------------------------');
                      if ($result7 != false) {
                        while ($row7 = mysqli_fetch_assoc($result7)) {
                          if ($row7['spPostingCohost'] != '') {
                            $allCohost = explode(",", $row7['spPostingCohost']);
                          }
                        }
                      }
                    }
                    //print_r($allFeature);
                    $selectedCohost = "";

                    if (in_array($_SESSION['pid'], $allCohost)) {
                      $selectco = "checked";
                    } else {
                      $selectco = '';
                    }

                    $b = array();
                    $r = new _spprofilehasprofile;
                    $pv = new _postingview;
                    $res = $r->readall($_SESSION["pid"]); //As a receiver
                    //echo $r->ta->sql;
                    if ($res != false) {
                      while ($rows = mysqli_fetch_assoc($res)) {
                        $p = new _spprofiles;
                        $sender = $rows["spProfiles_idspProfileSender"];
                        array_push($b, $sender);
                        $result = $p->read($rows["spProfiles_idspProfileSender"]);
                        //echo $p->ta->sql;
                        if ($result != false) {
                          $row = mysqli_fetch_assoc($result);
                          if (in_array($rows["spProfiles_idspProfileSender"], $allCohost)) {
                            $selectco = "checked";
                            $selectedCohost .= $row["spProfileName"] . "<br>";
                          } else {
                            $selectco = '';
                          }

                          if (!empty($row['spProfilePic'])) {
                            $avatar = $row['spProfilePic'];
                          } else {
                            $avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
                          }
                    ?>
                          <div class="bheada">
                            <img class="imagea" id="imga<?= $ii; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
                            <span id="namea<?= $ii; ?>" class="ml-4 font-weight-bold"><?php echo $row["spProfileName"]; ?></span>
                            <span>
                              <input value="<?php echo $rows["spProfiles_idspProfileSender"]; ?>" class="largerCheckboxa" id="statusa<?= $ii; ?>" onchange="check('<?= $ii; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selectco; ?>>
                            </span>
                          </div>
                    <?php }
                        $ii++;
                      }
                    } ?>