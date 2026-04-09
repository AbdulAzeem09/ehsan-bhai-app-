 
<?php
$businessId = isset($_GET["business"]) ? (int) $_GET["business"] : 0;
  
$link = $_SERVER['REQUEST_URI']; ?>   
 <style>
   .navbar a,
   .navbar a:focus {
     display: flex;
     align-items: center;
     justify-content: space-between;
     padding: 10px 15px 10px 15px !important;
     font-size: 16px;
     font-weight: 500;
     color: #fff;
     white-space: nowrap; 
     transition: 0.3s;
   }

   .active-tab {
     background-color: #f8f9fa;
     border-radius: 5px;
   }

   .active-tab a {
    color: black !important; 
   }

   #idfora{
    /*color: black !important; */       
   }

   h1 {
     font-size: 2em;
     margin: 0.67em 0;
   }

   #navbar {
     margin-top: 20px;

   }
 </style>


 <style>
.dropbtn1 {

   
  background-color:<?php if (strpos($link, 'servicetab') !== false) { echo 'white'; } else { echo ''; } ?> !important;      
     
  color: <?php if (strpos($link, 'servicetab') !== false) { echo 'black'; } else { echo 'white'; } ?>;        
  padding: 11px;  
  font-size: 16px;
  border: none;
  border-radius: 5px;
  margin-left: 27px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content1 {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  margin-left: 30% !important;     
}

.dropdown-content1 a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content1 a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content1 {display: block;}

.dropdown:hover .dropbtn1 {/*background-color: #3e8e41;*/ border: 1px solid white;}     
</style> 
 <?php
  $link = $_SERVER['REQUEST_URI'];
  $homeselect = '';
  $jobselect = '';
  $eventselect = '';
  $videoselect = '';
  $realEsate = '';
  $rental = '';
  $freelancer = '';
  $art_craft = '';
  $businessForSale = '';
  $gallery = '';
  $store = '';
  $new = '';
  $services = '';  
  //----home  active tab-----
  // if (strpos($link, 'details') !== false) {  
  //   $homeselect = 'active-tab';
  //   $homeselectfora = 'idfora'; 
  // } else {
  //   $homeselect = '';
  // }


 if (strpos($link, 'contact-us') !== false) {  
    $contacthomeselect = 'active-tab';
    $contactselectfora = 'idfora'; 
 }



  //----jobs  active tab-----
  else if (strpos($link, 'jobs') !== false) {
    $jobselect = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----events  active tab-----
  else if (strpos($link, 'events') !== false) {
    $eventselect = 'active-tab';
    $homeselectfora = 'idfora';
  } 
  //----videos  active tab-----
  else if (strpos($link, 'videos') !== false) {
    $videoselect = 'active-tab';
    $homeselectfora = 'idfora';
  } 
  //----realEsate  active tab-----
  else if (strpos($link, 'realEsate') !== false) {
    $realEsate = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----rental  active tab-----
  else if (strpos($link, 'rental') !== false) {
    $rental = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----freelancer  active tab-----
  else if (strpos($link, 'freelancer') !== false) {
    $freelancer = 'active-tab';
    $homeselectfora = 'idfora';
  } 
  //----art-craft  active tab-----
  else if (strpos($link, 'art-craft') !== false) {
    $art_craft = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----business-for-sale  active tab-----
  else if (strpos($link, 'business-for-sale') !== false) {
    $businessForSale = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----gallery  active tab-----
  else if (strpos($link, 'gallery') !== false) {
    $gallery = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  //----store  active tab-----
  else if (strpos($link, 'store') !== false) {
    $store = 'active-tab';
    $homeselectfora = 'idfora';
  } 

  else if (strpos($link, 'new') !== false) {
    $new = 'active-tab';
    $homeselectfora = 'idfora';
  } 
  //----services  active tab-----
  else if (strpos($link, 'servicetab') !== false) { 
    //$services = 'active-tab';  
  } 
 
 else 
 {
  $homeselect = 'active-tab';
    $homeselectfora = 'idfora'; 
 }

  ?>
<!- home active only home tab --->  
<?php //if (strpos($link, 'details') !== false) { ?>
 <li class="<?php echo $homeselect; ?> nav-item nav-link"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="details.php?business=<?php echo $businessId; ?>">Home</a></li> 


<li class="<?php echo $contacthomeselect; ?> nav-item nav-link"><a class="<?php if(isset($contactselectfora)) { echo $contactselectfora; } ?>" data-toggle="tab" href="contact-us.php?business=<?php echo $businessId; ?>">Contact Us</a></li> 

<?php //} 

?>

 <?php $prof = new _spprofiles;

  $res = $prof->read_business_tab($businessId);
  if ($res != false) {

    while ($row_tab = mysqli_fetch_assoc($res)) {


  ?>

     <?php if ($row_tab['module_name'] == "Job") {
        if ($row_tab['status'] == "1") {                                  ?>
         <li class="<?php echo $jobselect; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="jobs.php?business=<?php echo $businessId; ?>">Job</a></li>
     <?php }
      } ?>
     <?php if ($row_tab['module_name'] == "Videos") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $videoselect; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="videos.php?business=<?php echo $businessId; ?>">Videos</a></li>
     <?php }
      } ?>
     <!-- <li><a data-toggle="tab" href="#menu3">Additional Info</a></li>-->
     <?php if ($row_tab['module_name'] == "Store") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $store; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="store.php?business=<?php echo $businessId; ?>">Store</a></li>
     <?php }
      } ?>
     <?php if ($row_tab['module_name'] == "Real Estate") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $realEsate; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="realEsate.php?business=<?php echo $businessId; ?>">Real Estate</a></li><?php }
                                                                                                                                                    } ?>
     <?php if ($row_tab['module_name'] == "Rental") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $rental; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="rental.php?business=<?php echo $businessId; ?>">Rental</a></li>
     <?php }
      } ?>

     <?php if ($row_tab['module_name'] == "Freelancer") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $freelancer; ?>"><a  class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="freelancer.php?business=<?php echo $businessId; ?>">Freelancer</a></li><?php }
                                                                                                                                                    } ?>

     <?php if ($row_tab['module_name'] == "Events") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $eventselect; ?>"><a  class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="events.php?business=<?php echo $businessId; ?>">Events</a></li>
     <?php }
      } ?>

     <?php if ($row_tab['module_name'] == "Art and Craft") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $art_craft; ?>"><a  class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="art-craft.php?business=<?php echo $businessId; ?>">Art and Craft</a></li><?php }
                                                                                                                                                      } ?>

     <?php /*if ($row_tab['module_name'] == "Classified Ad") {
                  if ($row_tab['status'] == "1") { ?>   
                    <li><a data-toggle="tab" href="services.php?business=<?php echo $_GET['business']; ?>">Classified Ad</a></li> 

                <?php }
                }*/ ?>

     <?php /*if($row_tab['module_name']=="My Business Space"){  
if($row_tab['status']=="1"){?>
<li><a data-toggle="tab" href="#menu14">My Business Space</a></li> 

<?php }}*/ ?>

     <?php if ($row_tab['module_name'] == "Business For Sale") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $businessForSale; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="business-for-sale.php?business=<?php echo $businessId; ?>">Business for Sale</a></li>
     <?php }
      } ?>
     <?php /* if ($row_tab['module_name'] == "Trainings") {
        if ($row_tab['status'] == "1") { ?>
         <li><a data-toggle="tab" href="#menu16">Trainings</a></li><?php }
                                                                }*/
      ?>

 <?php if ($row_tab['module_name'] == "Company News") {
        if ($row_tab['status'] == "1") { ?>
         <li class="<?php echo $new; ?>"><a class="<?php echo $homeselectfora; ?>"  data-toggle="tab" href="news.php?business=<?php echo $businessId; ?>">News</a></li>

 <?php }
      }
    }
  } ?>
 <!--<li><a data-toggle="tab" href="#menu6">Contact</a></li>-->
 <li class="<?php echo $gallery; ?>"><a class="<?php echo $homeselectfora; ?>" data-toggle="tab" href="gallery.php?business=<?php echo $businessId; ?>">Gallery</a></li>  
<div class="dropdown">
  <li class="dropbtn1 <?php //echo $services; ?>">Pages</li>      
<div class="dropdown-content1" >
  <?php
                $cn = new _spprofiles;
                $result1 = $cn->read_menu_status($businessId);   
                //echo $cn->ta->sql;
                if ($result1) {
                    while ($row = mysqli_fetch_assoc($result1)) { 

                   
                     ?>
                    
                      

                      <a target="_blank"  data-toggle="tab" href="servicetab.php?business=<?php echo $businessId; ?>&id=<?php echo $row['id'] ?>"><?php echo ucfirst(strtolower($row['title'])); ?></a>           

                      <?php   
 

                    }

                  }
                ?>

  </div>
</div>   
<!-- <li class="dropbtn1 <?php //echo $services; ?>">News</li> -->
