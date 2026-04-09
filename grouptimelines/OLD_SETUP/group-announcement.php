<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
  include_once("../authentication/check.php");
  $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}


?>
<!DOCTYPE html>
<html lang="en-US">

<head>

  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <?php include('../component/links.php'); ?>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
  <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

</head>

<style>
  div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
  }
</style>


<body class="bg_gray" onload="pageOnload('groupdd')">
  <?php

  include_once("../header.php");

  $g = new _spgroup;
  $result = $g->groupdetails($group_id);
  if ($result != false) {
    $row = mysqli_fetch_assoc($result);

    $userid = $row['spProfiles_idspProfiles'];

    $gimage = $row["spgroupimage"];
    $spGroupflag = $row['spgroupflag'];
  }
  ?>

  <section class="landing_page">
    <div class="container">
      <div class="row">
        <div class="col-md-14">
          <div class="group-wrapper">
            <div class="side-bar" id="side-bar">
              <?php include('../component/left-group.php'); ?>
            </div>
            <div class="group-body-wrapper">
              <div class="announcement">
                <div class="main-heading">
                  <div class="top-heading">
                    Announcement
                  </div>
                  <?php
                  $pid = $_SESSION['pid'];
                  if ($pid == $userid) {
                  ?>
                    <div class="btn" data-toggle="modal" data-target="#myModal22">
                      <img src="../assets/images/inner_group/add-4.svg" alt="">
                      <span>Add Announcement</span>
                    </div>
                  <?php } ?>
                </div>
                <?php
                if (isset($_GET['id'])) {
                  $deleteobj2 = new _groupsponsor;
                  $deleteobj2->remove22($_GET['id']);
                }
                ?>
                <?php
                $obj2 = new _groupsponsor;
                $result = $obj2->readPost22($group_id);
                ?>
                <div class="table-wrapper">
                  <table id="example" style="border-collapse: collapse;">
                    <thead>
                      <tr class="border-0" role="row">
                        <th style="border: white;">Title</th>
                        <th style="border: white;">Title</th>
                        <th style="border: white;">Message</th>
                        <th class="text-center" style="border: white;">Date</th>
                        <th class="text-center" style="border: white;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result != false) {
                        while ($row2 = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td><?php echo htmlspecialchars($row2['title']); ?></td>

                            <td><?php echo htmlspecialchars($row2['title']); ?></td>
                            <td><span class="read-more"><?php echo htmlspecialchars($row2['message']); ?></span></td>
                            <td class="text-center date-td"><?php echo htmlspecialchars($row2['announcemt_date']); ?></td>
                            <?php if ($pid == $userid) { ?>
                              <td class="action bg-white">
                                <img src="../assets/images/inner_group/dot-2.svg" alt="" class="dot bg-white " style="border-right:none" onclick="threeDot(this)">
                                <div class="more-links" id="three-dot" style="display: none;">
                                  <div class="link border-0 p-0">
                                    <span class="img">
                                      <img src="../assets/images/inner_group/view.svg" alt="">
                                    </span>
                                    <span>View</span>
                                  </div>
                                  <div class="link border-0 p-0">
                                    <a data-toggle="modal" data-target="#myModal33" id="announcement" href="" data-date="<?php echo htmlspecialchars($row2['announcemt_date']); ?>" data-title="<?php echo htmlspecialchars($row2['title']); ?>" data-message="<?php echo htmlspecialchars($row2['message']); ?>"><span class="img">
                                        <img src="../assets/images/inner_group/edit-3.svg" alt="">
                                      </span>
                                      <span>Edit</span></a>
                                  </div>
                                  <div class="link border-0 p-0">
                                    <a style="cursor: pointer;" onclick="delete_play('<?php echo htmlspecialchars($BaseUrl); ?>/grouptimelines/group-announcement.php?groupid=<?php echo htmlspecialchars($group_id); ?>&groupname=sfererete&announcement&status=delete&id=<?php echo htmlspecialchars($row2['id']); ?>')">
                                      <img src="../assets/images/inner_group/delete.svg" alt="">
                                      <span>Delete</span></a>
                                  </div>
                                </div>
                              </td>
                            <?php } ?>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- Modal for announcement editing -->
                <div class="container">
                  <div class="modal fade" id="myModal33" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">ANNOUNCEMENT</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="" id="id2">
                          <div>
                            <label for="" class="form-label">Date</label>
                            <input class="form-control" name="date" id="date" disabled>
                          </div>
                          <br>
                          <div>
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" disabled>
                          </div>
                          <div></br>
                            <label for="" class="form-label">Message</label>
                            <textarea class="form-control" name="textarea" id="message" disabled></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Rest of the code -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <form action="" method="POST">
    <div class="container">

      <!-- Trigger the modal with a button -->


      <!-- Modal -->
      <div class="modal fade" id="myModal22" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="display: inline-block">POST AN ANNOUNCEMENT</h3>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="" id="id2">
              <div>
                <label for="" class="form-label">Date</label>
                <input type="date" class="form-control" name="date">
              </div>
              <br>
              <div>
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
              </div>
              <div></br>
                <label for="" class="form-label"> Announcement Detail</label>
                <textarea class="form-control" name="textarea"> </textarea>

              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-danger btn-border-radius" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-default btn-primary btn-border-radius">Submit</button>
            </div>
          </div>

        </div>
      </div>

    </div>
  </form>
  
  <?php include('../component/footer.php'); ?>
  <?php include('../component/btm_script.php'); ?>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
  <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

  <script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>

  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
  <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

      var table = $('#example').DataTable({
        select: false,
        "columnDefs": [{
          className: "Name",
          "targets": [0],
          "visible": false,
          "searchable": false
        }]
      }); //End of create main table


      $('#example tbody').on('click', 'tr', function() {

        // alert(table.row( this ).data()[0]);

      });
    });
  </script>


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

    $(document).ready(function() {
      $('#table_id').DataTable();
    });

    $('#announcement').click(function() {
      var date = $(this).attr('data-date');
      var title = $(this).attr('data-title');
      var message = $(this).attr('data-message');
      var action = $(this).attr('data-message');

      $('#date').val(date);
      $('#title').val(title);
      $('#message').val(message);

    });
  </script>




  <script type="text/javascript">
    function delete_play(url) {
      // alert(url);
      //alert('hello');
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
          window.location.href = url;
        }
      });
    }

    function threeDot(element) {
      const dotContent = element.nextElementSibling;
      if (dotContent.style.display === 'none' || dotContent.style.display === '') {
        dotContent.style.display = 'flex';
      } else {
        dotContent.style.display = 'none';
      }
    }

    // Event listener to close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdowns = document.querySelectorAll('.more-links');
      dropdowns.forEach(dropdown => {
        if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
          dropdown.style.display = 'none';
        }
      });
    });
  </script>
  <!-- image gallery script end -->
</body>

</html>
<script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const dataTablesInfo = document.getElementsByClassName("dataTables_info")[0];
    const dataTablesLength = document.getElementsByClassName("dataTables_length")[0];

    if (dataTablesInfo && dataTablesLength) {
      // Hide the dataTables_info element
      dataTablesInfo.style.display = 'none';

      // Move dataTablesLength to the position of dataTablesInfo
      dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);
      dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);

      // Ensure dataTablesLength is displayed
      dataTablesLength.style.display = 'block';
    }
  });
</script>





<script type="text/javascript">
  const dataTables = document.getElementByQuery("dataTables_length")

  function delete_play(url) {
    // alert(url);
    //alert('hello');
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
        window.location.href = url;
      }
    });
  }
</script>
<!-- image gallery script end -->
</body>

</html>
<script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const dataTablesInfo = document.getElementsByClassName("dataTables_info")[0];
    const dataTablesLength = document.getElementsByClassName("dataTables_length")[0];
    const dataTablesFilter = document.querySelector("#example_filter input[type='search']");

    dataTablesFilter.setAttribute('placeholder', 'Search here...'); 
    const div = document.createElement('div');
    div.classList.add('datafilter-search-icon');
    const img = document.createElement('img');

    img.src = '../assets/images/inner_group/search-3.svg';
    img.alt = 'Search icon';

    div.appendChild(img);

    dataTablesFilter.parentNode.appendChild(div);

    if (dataTablesInfo && dataTablesLength) {
      dataTablesInfo.style.display = 'none';
      dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);
      dataTablesInfo.parentNode.insertBefore(dataTablesLength, dataTablesInfo);
      dataTablesLength.style.display = 'block';
    }
  });
</script>