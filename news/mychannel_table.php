 <style>
   table {
     font-family: arial, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }

   td,
   th {
     border: 1px solid #dddddd;
     text-align: left;
     padding: 8px;
   }

   tr:nth-child(even) {
     background-color: #dddddd;
   }


   body {
     font-family: Arial;
   }

   /* Style the tab */
   .tab {
     overflow: hidden;
     border: 1px solid #ccc;
     background-color: #f1f1f1;
   }

   /* Style the buttons inside the tab */
   .tab button {
     background-color: inherit;
     float: left;
     border: none;
     outline: none;
     cursor: pointer;
     padding: 14px 16px;
     transition: 0.3s;
     font-size: 17px;
   }


   /* Create an active/current tablink class */
   .tab button.active {
     background-color: #ccc;
   }

   /* Style the tab content */
   .tabcontent {
     display: none;
     padding: 6px 12px;
     border: 1px solid #ccc;
     border-top: none;



   }

   #btnsty {
     height: 10px;
     padding-bottom: 30px;
     font-size: 15px;
     width: 90px;
     margin-left: 3px;
   }

   .sorting_1 {
     width: 150px;
   }

   .ped th {
     text-align: center;
   }

   .ped .web_n {
     width: 100px;
   }

   .ped .pd_b {
     padding-bottom: 18px;
   }

   #pending_news {
     width: 80px;
     padding-bottom: 15px;
   }
 </style>
 <h3>My Channel Status</h3>
 <div class="tab">
   <button class="tablinks btn btn-success  <?php if ($_GET['tab'] == "accepted") {
                                              echo 'active';
                                            } ?> " onclick="openCity(event, 'Tokyo')" id="btnsty">Approved</button>
   <button class="tablinks btn btn-info  <?php if ($_GET['tab'] == "pending") {
                                            echo 'active';
                                          } ?>" onclick="openCity(event, 'Tokyo2')" id="btnsty">Pending</button>
   <button class="tablinks btn btn-danger  <?php if ($_GET['tab'] == "rejected") {
                                              echo 'active';
                                            } ?>" onclick="openCity(event, 'Tokyo3')" id="btnsty">Rejected</button>
 </div>
 <div id="Tokyo" class="tabcontent" <?php if ($_GET['tab'] == "accepted") {
                                      echo 'style="display:block"';
                                    } else {
                                      echo 'style="display:none"';
                                    } ?>>


   <h3>Accepted</h3>

   <div class="box-body tbl-respon">
     <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
     <table class="table table-bordered table-striped tbl-respon2 display" id="example">
       <thead>
         <tr>
           <th>Website Name</th>
           <th>Website Link</th>
           <th>News Type</th>
           <th>Country</th>
           <th>Category</th>
           <th>Create Date</th>
           <th>Delete</th>
         </tr>
       </thead>

       <tbody>
         <?php
          $pids = $_SESSION['pid'];
          $nn = new _news;
          $spread = $nn->read2('1', $pids);
          if ($spread != false) {
            while ($results = mysqli_fetch_array($spread)) {
              $country = $nn->readcounty($results['country']);
              if ($country != false) {
                $results2 = mysqli_fetch_array($country);
              }



              $category = $nn->spcategory($results['category']);
              if ($category != false) {
                $results3 = mysqli_fetch_array($category);
              }
          ?>
             <tr>
               <td><?php echo $results['website_name']; ?></td>
               <td>
                 <a href="
	<?php
              $str = $results['website_link'];
              if (str_contains($str, 'https://')) {
                $str1 = substr($str, 8);
                $variable = substr($str1, 0, strpos($str1, "/")); ?>
						<?php
            ?> https://<?php echo $variable;
                      } else {
                        //$str = substr($str, 0, strpos($str, "/"));
                        echo  $str;
                      } ?> "><?php
                              $str = $results['website_link'];
                              if (str_contains($str, 'https://')) {
                                $str1 = substr($str, 8);
                                $variable = substr($str1, 0, strpos($str1, "/")); ?>
                     <?php
                      ?> https://<?php echo $variable;
                                } else {
                                  //$str = substr($str, 0, strpos($str, "/"));
                                  echo  $str;
                                } ?></a>

               </td>
               <td><?php echo $results['news_type']; ?></td>
               <td><?php echo $results2['country_title']; ?></td>
               <td> <?php echo $results3['name']; ?></td>
               <td><?php echo $results['created_at']; ?></td>

               <td><a href="delete_channel.php?rssid=<?php echo $results['rss_id']; ?>&accepted=accepted" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" style="margin-left: 20px;"><i class="fa fa-trash" title="Delete"></i></a></td>
             </tr>



         <?php }
          } ?>
       </tbody>
     </table>
   </div>
 </div>
 <div id="Tokyo2" class="tabcontent" <?php if ($_GET['tab'] == "pending") {
                                        echo 'style="display:block"';
                                      } else {
                                        echo 'style="display:none"';
                                      } ?>>
   <h3>Pending</h3>
   <div class="box-body tbl-respon">
     <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
     <table class="table table-bordered table-striped tbl-respon2 display" id="example2">
       <thead>
         <tr class="ped">
           <th class="web_n pd_b">Website Name</th>
           <th class="pd_b" style="width: 70px;">Website Link</th>
           <th id="pending_news">News Type</th>
           <th class="pd_b">Country</th>
           <th class="pd_b">Category</th>
           <th class="pd_b" style="width: 75px;">Create Date</th>
           <th class="pd_b">Delete</th>
         </tr>
       </thead>

       <tbody>
         <?php
          $pids = $_SESSION['pid'];
          $nn = new _news;
          $spread = $nn->read2('3', $pids);
          if ($spread != false) {
            while ($results = mysqli_fetch_array($spread)) {

              $country = $nn->readcounty($results['country']);
              if ($country != false) {
                $results2 = mysqli_fetch_array($country);
              }



              $category = $nn->spcategory($results['category']);
              if ($category != false) {
                $results3 = mysqli_fetch_array($category);
              }
          ?>



             <tr>
               <td><?php echo $results['website_name']; ?></td>
               <td><a href="https://<?php
                                    $str = $results['website_link'];
                                    if (str_contains($str, 'https://')) {
                                      $str1 = substr($str, 8);
                                      $variable = substr($str1, 0, strpos($str1, "/")); ?>
						<?php
            ?> https://<?php echo $variable;
                                    } else {
                                      //$str = substr($str, 0, strpos($str, "/"));
                                      echo  $str;
                                    }
                        ?>
">https://<?php
              $str = $results['website_link'];
              if (str_contains($str, 'https://')) {
                $str1 = substr($str, 8);
                $variable = substr($str1, 0, strpos($str1, "/")); ?>
                   <?php
                    ?> https://<?php echo $variable;
                              } else {
                                //$str = substr($str, 0, strpos($str, "/"));
                                echo  $str;
                              } ?>
                 </a>
               </td>
               <td><?php echo $results['news_type']; ?></td>
               <td><?php echo $results2['country_title']; ?></td>
               <td> <?php echo $results3['name']; ?></td>
               <td><?php echo $results['created_at']; ?></td>
               <td><a onclick="deleteConfirm('<?php echo $results['rss_id']; ?>');" class="btn btn-danger" style="margin-left: 20px;"><i class="fa fa-trash" title="Delete"></i></a></td>

               <!-- <td><a href="delete_channel.php?rssid=<?php echo $results['rss_id']; ?>&pending=pending" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" style="margin-left: 20px;"><i class="fa fa-trash" title="Delete"></i></a></td>-->

             </tr>



         <?php }
          } ?>
       </tbody>
     </table>
   </div>
 </div>
 <div id="Tokyo3" class="tabcontent" <?php if ($_GET['tab'] == "rejected") {
                                        echo 'style="display:block"';
                                      } else {
                                        echo 'style="display:none"';
                                      } ?>>
   <h3>Rejected</h3>
   <div class="box-body tbl-respon">
     <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
     <table class="table table-bordered table-striped tbl-respon2 display" id="example4">
       <thead>
         <tr class="ped">
           <th class="web_n pd_b">Website Name</th>
           <th class="pd_b" style="width: 70px;">Website Link</th>
           <th class="pd_b" style="width: 60px;">News Type</th>
           <th class="pd_b">Country</th>
           <th class="pd_b">Category</th>
           <th class="pd_b" style="width: 60px;">Create Date</th>
           <th class="pd_b">Delete</th>
         </tr>
       </thead>

       <tbody>
         <?php
          $pids = $_SESSION['pid'];
          $nn = new _news;
          $spread = $nn->read2('2', $pids);
          if ($spread != false) {
            while ($results = mysqli_fetch_array($spread)) {
              $country = $nn->readcounty($results['country']);
              if ($country != false) {
                $results2 = mysqli_fetch_array($country);
              }



              $category = $nn->spcategory($results['category']);
              if ($category != false) {
                $results3 = mysqli_fetch_array($category);
              }
          ?>



             <tr>
               <td><?php echo  $results['website_name']; ?></td>
               <td><a target="_blank" href="https://<?php
                                                    $str = $results['website_link'];
                                                    if (str_contains($str, 'https://')) {
                                                      $str1 = substr($str, 8);
                                                      $variable = substr($str1, 0, strpos($str1, "/")); ?>
				<?php
        ?>https:// <?php echo $variable;
                                                    } else {
                                                      //$str = substr($str, 0, strpos($str, "/"));
                                                      echo  $str;
                                                    }
                    ?>
">https://<?php
              $str = $results['website_link'];
              if (str_contains($str, 'https://')) {
                $str1 = substr($str, 8);
                $variable = substr($str1, 0, strpos($str1, "/")); ?>
                   <?php
                    ?> https:// <?php echo $variable;
                              } else {
                                //$str = substr($str, 0, strpos($str, "/"));
                                echo  $str;
                              }
                                ?></a>




               </td>
               <td><?php echo $results['news_type']; ?></td>
               <td><?php echo $results2['country_title']; ?></td>
               <td> <?php echo $results3['name']; ?></td>
               <td><?php echo $results['created_at']; ?></td>
               <td><a href="delete_channel.php?rssid=<?php echo $results['rss_id']; ?>&rejected=rejected" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" style="margin-left: 20px;"><i class="fa fa-trash" title="Delete"></i></a></td>
             </tr>



         <?php }
          } ?>
       </tbody>
     </table>
   </div>
 </div>

 <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
 <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

 <script type="text/javascript">
   $(document).ready(function() {

     var table = $('#example').DataTable({
       select: false,
       "columnDefs": [{
         className: "Name",

         "visible": false,
         "searchable": false
       }]
     }); //End of create main table


     var table = $('#example2').DataTable({
       select: false,
       "columnDefs": [{
         className: "Name",

         "visible": false,
         "searchable": false
       }]
     });

     var table = $('#example4').DataTable({
       select: false,
       "columnDefs": [{
         className: "Name",

         "visible": false,
         "searchable": false
       }]
     });

     $('#example tbody').on('click', 'tr', function() {

       // alert(table.row( this ).data()[0]);

     });
   });
 </script>
 <script>
   function openCity(evt, cityName) {
     var i, tabcontent, tablinks;
     tabcontent = document.getElementsByClassName("tabcontent");
     for (i = 0; i < tabcontent.length; i++) {
       tabcontent[i].style.display = "none";
     }
     tablinks = document.getElementsByClassName("tablinks");
     for (i = 0; i < tablinks.length; i++) {
       tablinks[i].className = tablinks[i].className.replace(" active", "");
     }
     document.getElementById(cityName).style.display = "block";
     evt.currentTarget.className += " active";
   }
 </script>
 <script>
   $(document).ready(function() {
     /* $('#btnsty').click(function(){
		    $(this).css("background-color","black");   
	   });
	   
	   
	   $('#btnsty').click(function(){
		    $(this).css("background-color","black");  
	   }); */

     $('.tablinks').click(function() {
       $(this).css("background-color", "black");
     });


   });
 </script>
 <script>
   function deleteConfirm(id) {


     swal({
         title: "Are you sure you want to delete this item?",
         /*text: "You Want to Logout!",*/
         type: "warning",
         confirmButtonClass: "sweet_ok",
         confirmButtonText: "Yes, Delete!",
         cancelButtonClass: "sweet_cancel",
         cancelButtonText: "Cancel",
         showCancelButton: true,
       },
       function(isConfirm) {
         if (isConfirm) {
           ///window.location.href = 'processRegUser.php?action=delete&userId=' + userId;
           window.location.href = 'delete_channel.php?rssid=' + id + '&pending=pending';
         }
       });
   }
 </script>