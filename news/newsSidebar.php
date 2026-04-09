<?php
include '../../mlayer/' . $class . '.class.php';
$pr = new _spprofiles;
$result  = $pr->read($_SESSION["pid"]);
if ($result != false) {
   $sprows = mysqli_fetch_assoc($result);
   $country = $sprows["spProfilesCountry"];
   // echo $country;											
}
// $co = new _country;
// $result3 = $co->readCountryName($row['spProfilesCountry']);
// if ($result3) {
// 	$row3 = mysqli_fetch_assoc($result3);
// 	echo $row3['country_title'];
// }
$ad = $_GET['records'];

?>
<style>
   li .active {
      background-color: #aa86f7;

   }

   .sidebar-nav li {}

   .aaaa {
      background-color: violet;
   }

   label {
      display: inline-block;
      max-width: 100%;
      margin-bottom: 5px;
      font-weight: 700;
      margin-top: 8px;
   }
</style>
<!-- Sidebar -->
<div id="sidebar-wrapper">

   <ul class="sidebar-nav">

      <form method="GET" action="search.php" class="panel-search-form info form-group has-feedback no-margin-bottom" style="display: inline-flex;padding: 10px 20px; margin-bottom: 0;">
         <input type="text" value="<?php echo $ad; ?>" name="records" class="form-control" placeholder="Search" required>
         <button type="submit" style="padding:5px 10px;color:#7F00FF; name=" btns"class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>

      <li>
         <a href="index.php?page=1" class="<?php echo ($pageactive == 1) ? 'active' : ''; ?>"><i class="fa fa-thumb-tack" style="margin-left: 15px;" aria-hidden="true"></i> Local</a>
      </li>
      <li>
         <input type="hidden" id="idspProfileCountry_" value="<?php echo $country; ?>">
         <a href="mycountry_news.php?page=1" class="<?php echo ($pageactive == 2) ? 'active' : ''; ?>"><i class="fa fa-map-marker" style="margin-left: 15px;"></i> My Country</a>
      </li>
      <li>
         <a href="worldnews.php?page=1" class="<?php echo ($pageactive == 3) ? 'active' : ''; ?>"><i class="fa fa-globe" style="margin-left: 15px;"></i> World</a>
      </li>
      <li>
         <a href="bookmark_news.php" class="<?php echo ($pageactive == 4) ? 'active' : ''; ?>"><i class="fa fa-bookmark" style="margin-left: 15px;"></i> Bookmark Views</a>
      </li>
      <li>
         <a href="bookmarkNews.php?page=1" class="<?php echo ($pageactive == 16) ? 'active' : ''; ?>"><i class="fa fa-square" style="margin-left: 15px;"></i> Bookmark News</a>
      </li>
      <li>
         <a href="Ban_News.php?page=1" class="<?php echo ($pageactive == 18) ? 'active' : ''; ?>"><i class="fa fa-ban" style="margin-left: 15px;"></i> Banned News</a>
      </li>

      <li>
         <a href="bucket.php?page=1" class="<?php echo ($pageactive == 5) ? 'active' : ''; ?>"><i class="fa fa-archive" style="margin-left: 15px;"></i> My Bucket</a>
      </li>
      <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
         <li>
            <a href="mychannels.php?tab=accepted" class="<?php echo ($pageactive == 9) ? 'active' : ''; ?>"><i class="fa fa-newspaper-o" style="margin-left: 15px;"></i> My Channels Status</a>
         </li>
      <?php } ?>
      <li>
         <a href="myprofile.php" class="<?php echo ($pageactive == 7) ? 'active' : ''; ?>"><i class="fa fa-user" style="margin-left: 15px;"></i> My Profile</a>
      </li>
      <?php
      if ($_SESSION['guet_yes'] != "yes") {
      ?>
         <li>
            <a href="mychannels_news.php?page=1" class="<?php echo ($pageactive == 10) ? 'active' : ''; ?>"><i class="fa fa-television" style="margin-left: 15px;"></i> My Channels News</a>
         </li>

      <?php
      }
      ?>
      <li>
         <a href="notification.php" class="<?php echo ($pageactive == 11) ? 'active' : ''; ?>"><i class="fa fa-bell" aria-hidden="true" style="margin-left: 15px;"></i>
            </i>Notification</a>
      </li>
      <li>
         <a href="aboutus_news.php" class="<?php echo ($pageactive == 12) ? 'active' : ''; ?>"><i class="	fa fa-th" style="margin-left: 15px;"></i> About News-Views</a>
      </li>
      <li>
         <a href="settings.php" class="<?php echo ($pageactive == 13) ? 'active' : ''; ?>"><i class="fa fa-cog" aria-hidden="true" style="margin-left: 15px;"></i>
            Settings</a>
      </li>
      <li>
         <a href="Announcement.php" class="<?php echo ($pageactive == 14) ? 'active' : ''; ?>"><i class="fa fa-volume-up" aria-hidden="true" style="margin-left: 15px;"></i>
            Announcement</a>
      </li>

      <li>
         <a href="block_users.php" class="<?php echo ($pageactive == 17) ? 'active' : ''; ?>"><i class="fa fa-lock" aria-hidden="true" style="margin-left: 15px;"></i>
            Block Users</a>
      </li>


      <!--li>
      <a href="flaggedprofile.php" class="<?php echo ($pageactive == 15) ? 'active' : ''; ?>"><i class="fa fa-flag" aria-hidden="true" style="margin-right: 5px;" ></i>Flagged Profile</a>
   </li -->


      <li>
         <?php if ($_SESSION['guet_yes'] != 'yes') { 
            
            $pidss = $_SESSION['pid'];
            $nn = new _news;
            $spreads = $nn->readChannels($pidss);
            if ($spreads != false) {
               $numRowss = mysqli_num_rows($spreads);
              }
           
            ?>
         <button type="button" class="btn aaaa" data-toggle="modal" <?php  if($numRowss =='20'){echo "onclick='AddsChannels()'";}else{ echo "data-target='#exampleModal'";}?> ><i class="fa fa-plus" style="margin-left: 1px;"></i> Add Channels</button>
         <?php } ?>

      </li>
   </ul>
</div>
<!-- /#sidebar-wrapper -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="exampleModalLabel">Add Your Channel </h4>
         </div>
         <div class="modal-body">
            <form id="addChannelForm" action="index.php?page=1&msg=create" method="POST">
               <div class="form-group">
                  <label for="website_name" class="control-label">Website Name<span class="red">* <span class="spUserCountry erormsg"></span></label>
                  <input type="text" name="website_name" class="form-control" id="website_name" placeholder="Enter Website Name" required>
               </div>
               <div class="form-group">
                  <label for="website_link" class="control-label">Website Link<span class="red">* <span class="spUserCountry erormsg"></span></label>
                  <input class="form-control" type="text" name="website_link" id="website_link" required>
               </div>
               <div class="form-group">
                  <label for="news_type" class="lbl_7">News Type<span class="red">*<span class="spUserCountry erormsg"></span></label>

                  <select id="news_type" class="form-control" name="news_type" required>
                     <option value="">Select News Type</option>
                     <option value="Local">Local</option>
                     <option value="Country Wise">Country wide</option>
                  </select>
               </div>



               <div class="form-group">
                  <label for="news_country" class="lbl_7">Country<span class="spUserCountry erormsg"><span class="red">*</span></label>
                  <select id="news_country" class="form-control myclass" name="country" required>
                     <option value="0">Select Country</option>

                     <?php
                     $con = new _country;
                     $result1 = $con->readCountry();
                     if ($result1 != false) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                     ?>


                           <option value='<?php echo $row1['country_id']; ?>'><?php echo $row1['country_title']; ?></option>
                     <?php

                           $country_id = $row1['country_id'];
                        }
                     }
                     ?>
                  </select>
               </div>


               <div class="form-group" id="news_State">

                  <label>State<span class="red">*<span class="spUserCountry erormsg"></span></label>
                  <input type="text" class="form-control" placeholder="Select State" style="margin-bottom:15px">
               </div>





               <div class="form-group" style="margin-top:-14px;">
                  <label for="news_category" class="lbl_7">Category
                     <span class="red">* <span class="spUserCountry erormsg"></span></span>
                  </label>
                  <select id="news_category" class="form-control" name="category" required>
                     <option value="">Select Category</option>
                     <?php
                     $cat = new _news;
                     $result2 = $cat->readCategory();
                     if ($result2 != false) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                     ?>
                           <option value='<?php echo $row2['id']; ?>'><?php echo $row2['name']; ?></option>
                     <?php
                        }
                     }
                     ?>
                  </select>
               </div>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
            <button type="submit" id="channelSubmit" class="btn btn-primary btn-border-radius" name="submit">Submit Request</button>


         </div>
         </form>

      </div>
   </div>
</div>


<script>
   // $('#exampleModal').on('show.bs.modal', function (event) {
   //   var button = $(event.relatedTarget) // Button that triggered the modal
   //   var recipient = button.data('whatever') // Extract info from data-* attributes
   //   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
   //   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
   //   var modal = $(this)
   //   modal.find('.modal-title').text('Find or Add Your Channels ' + recipient)
   //   modal.find('.modal-body input').val(recipient)
   // })


   $(document).ready(function() {
      $("#news_country").on("change", function() {
         var x = $(this).val();
         // alert(x);

         $.ajax({
            url: "loadUserState.php",
            type: "POST",
            cache: false,
            data: {
               'country_id': x
            },
            success: function(data) {
               // location.reload();
               $('#news_State').html(data);

            }

         });


      });
   });
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
   function AddsChannels(){
      //alert('fffffffffff');
swal("You can add upto 20 Channels !", "", "success");
   }
</script>