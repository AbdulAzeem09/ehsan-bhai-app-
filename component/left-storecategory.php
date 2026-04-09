

   <style>
        /*#abc{
        white-space: nowrap; 
        width: 120px; 
        overflow: hidden;
        text-overflow: ellipsis; 
        }
        .scroll {
        height: 680px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align:justify;
        }*/

        .active_cate {
        font-size: 19px !important;
        color: chartreuse !important;
        }
    </style>
    <div class="w-100">
        
        <div class="">
                    <div class="">

    <?php
	 session_start();
    //echo $_GET['mystore'];
        $pv = new _postfield;
            $rdf = $pv->read($_GET["postid"]);

            if ($rdf != false) {
                
                  $rowf = mysqli_fetch_assoc($rdf);
           /*  
             echo "<pre>";
             print_r($rowf);*/

             $spPostFieldValue = $rowf['spPostFieldValue'];
               
    }

    if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
        $storeTitle = "Retail Store";
        $storeFolder = "retail";
    

    }else{
        if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
            $p = new _spprofiles;

           // print_r($_SESSION['pid']);
            if(isset($_SESSION['pid'])){
                $result  = $p->profilestore($_SESSION["pid"]);
                if($result != false)
                {
                    $rowss = mysqli_fetch_assoc($result);
                  //  echo "<pre>";

                 //   print_r($rowss);
                    $storename = $rowss["spDynamicWholesell"];
                }
            }
            if(isset($storename)){
                $storeTitle = $storename;
            }else{
                $storeTitle = "My Store";
            }
            
            $storeFolder = "my-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 4){
            $storeTitle = "Friend's Store";
           // $storeTitle = "Sale By Friends";
            $storeFolder = "friend-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
            $storeTitle = "Group Store";
            $storeFolder = "private-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 99){
            $storeTitle = "WholeSale Store";
            $storeFolder = "wholesale";

        }else{
            
           /* echo"Here";*/
            //print_r($_GET['mod']);

            if(isset($_GET['mod']) && $_GET['mod'] == 'retail'){

                $storeTitle = "Retail";

            }else if(isset($_GET['mod']) && $_GET['mod'] == 'wholesale'){

                $storeTitle = "Wholesale";
           
            }else if(isset($_GET['mod']) && $_GET['mod'] == 'manufacturer'){
                
                $storeTitle = "Manufacturer";
            
            }else if(isset($_GET['mod']) && $_GET['mod'] == 'distributor'){
                
                $storeTitle = "Distributors";
           
            }else if(isset($_GET['mod']) && $_GET['mod'] == 'personal'){
                
                $storeTitle = "Personal Sale";
           
            }else if($_SERVER['QUERY_STRING'] == "type=auction"){ 
                //echo "here";
                 $storeTitle = "Auction"; 
           
            }else if($_SERVER['REQUEST_URI'] == "/public_rfq/"){ 
                
                $storeTitle = "RFQ";

            }else if($_SERVER['REQUEST_URI'] == "/store/category_search.php"){ 
                
                $storeTitle =  "Category"; 
            
            }else if(!empty($spPostFieldValue)){
                              
                $storeTitle = $spPostFieldValue;
                        
            }else{
                
                $storeTitle = "Public Store";
            }
            
            $storeFolder = "store";
        }
    }

    $pr = new _spprofiles;
    $result  = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $profileType = $sprows["spProfileType_idspProfileType"];
        // 2 and 5 are employment and freelance types
    }
    ?>

    <div class="left_store">
	
        <?php
        if(isset($_GET['mystore']) && $_GET['mystore'] == 99){ ?>
            
           <span class="top_sharepage text-center" style="line-height: 0;
    margin-top: 34px;">@sharepagestore</span>
			<h1 style="margin-bottom: -35px;"><?php echo (isset($_SESSION['MyProfileName'])? $_SESSION['MyProfileName'] : "Profile ");?> Store</h1>
            <br>
            <?php
        } ?>

        <?php  //echo $_SESSION["pid"]; 

              $bs = new _spbusiness_profile;

        $rpvt = $bs->read($_SESSION["pid"]);


       // echo $bs->ta->sql;
        if ($rpvt != false){
            $bussinessrow = mysqli_fetch_assoc($rpvt);
            $Storeusername = $bussinessrow['spDynamicWholesell'];
			//echo $Storeusername;
            $profilename = $bussinessrow['spprofiles_idspProfiles'];
           // $status = $row['spAccountStatus'];
            //$publish = $row['spprofilesPublished'];
           
            // echo "<pre>";
            //print_r($row);
            
        }




        ?>
		<style>
		[slider]>div>[sign] {
   
    background-color:green!important;
   
	}
	[slider]>div>[sign]:after {
   
    border-top-color: green !important;
}
a.success.active {
    color:#2dc32d!important;
}
		
		</style>

    <?php if(isset($_GET['userid']) && $_GET['userid'] > 0){ ?>


            <a href="<?php echo $BaseUrl?>/store/storeindex.php">
            <h3 class="active_store" style="color: #787f85;padding: 1px 10px;text-decoration-line: underline;">Back <i class="fa fa-arrow-left" aria-hidden="true"></i></h3></a>

             <a href="<?php echo $BaseUrl.'/store/my-all-product.php?userid='.$_GET['userid']; ?>">
            <h3 class="active_store" style="color: #787f85;padding: 1px 10px;text-decoration-line: underline;">All Product</h3></a>

             <a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$_GET['userid']; ?>">
            <h3 class="active_store" style="color: #787f85;padding: 1px 10px;text-decoration-line: underline;">Store Information</h3></a>

         
           
     <?php  }else{?>
        <?php if($profileType != '2' && $profileType != '5') { ?>
         <!-- <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="margin-right: 14px!important;padding: 6px;width: auto;background-color:orange!important;padding: 8px 33px!important; margin-top:-60px; height: 35px;">Sell Product</a> -->
        <?php  }?>

   <?php  }?>   


       <!--   <div class="btn-group categorydrp" role="group" >
            <span  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span data-placement="bottom">Select Store <span class="caret"></span></span></span>
            <ul class="dropdown-menu no-padding">
                <li id="mystore"><a href="<?php echo $BaseUrl; ?>/my-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-suitcase"></span> <?php echo $Storeusername; ?></a></li>

              
                <li id="publicpost"><a href="<?php echo $BaseUrl; ?>/retail/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-globe"></span> Retail Store</a></li>
                <?php
                $p = new _spprofiles;
                $res = $p->readProfiles($_SESSION["uid"]);
                if ($res != false) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        if (isset($rows["spDynamicWholesell"])){
                            $folder = $rows["spDynamicWholesell"];
                            $profileType = $rows['spProfileType_idspProfileType'];
                        }
                        $profileid = $rows["idspProfiles"];
                    }
                }
                if ($profileType == 1){
                    echo "<li id='wholesell'><a href='" . $BaseUrl . "/wholesale' class='stores' data-profileid='" . $_SESSION["pid"] . "' id='wholesaler'><span class='fa fa-cart-plus '></span> Wholesaler Store</a></li>";
                }
                ?>
                <li id="grouppost"><a href="<?php echo $BaseUrl; ?>/private-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-users"></span> Groups Store</a></li>
                <li id='friendstore'><a href="<?php echo $BaseUrl; ?>/friend-store/" class="stores" data-profileid="<?php echo $_SESSION["pid"]; ?>"><span class="fa fa-user-plus "></span> Friend's Store</a></li>
                <?php
                if ($_SESSION['ptid'] == 1 || $_SESSION['ptid']  == 3) {
                    ?>
                    <li id="publicpost"><a href="<?php echo $BaseUrl; ?>/public_rfq/" class="stores" ><span class="fa fa-globe"></span> Public RFQ</a></li>
                    <?php
                }
                ?>
                
                
                
            </ul>
        </div> -->

    
    
         
        <?php
       
        
            
       
        if(isset($_GET['mystore']) && $_GET['mystore'] == 4){
        ?>
            
            <form method="post" action="friend.php" >
                <div class="main_div_form hidden" id="display_after_10_sec" >
                    <div class="main_div_form_left" id="main_div_form_left" >
                        <label>Select Members</label><br>
                        <select id="leftmenu" name="txtMember[]" multiple="multiple" class="form-control left_drop_multi" style="width: 70%;">  
                            <?php
                            $g = new _spgroup;
                            $r = new _spprofilehasprofile;
                            $unread = new _friendchatting;
                            $a = array();
                            $res = $r->friends($_SESSION["uid"]);//As a receiver
                            //echo $r->ta->sql;
                            if($res != false){
                                while($rows = mysqli_fetch_assoc($res)){
                                    $rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfileSender"]);
                                    $groupname = "";
                                    $groupid = 0;
                                    $g = new _spgroup;
                                    if($rslt != false)
                                    {
                                        $rws = mysqli_fetch_assoc($rslt);
                                        $groupid = $rws["idspGroup"];
                                        $groupname = $rws["spGroupName"];
                                        $groupname = str_replace(' ', '', $groupname);
                                    }
                                    
                                    array_push($a,$rows["spProfiles_idspProfileSender"]);
                                    $p = new _spprofiles;
                                    
                                    $sender = $rows["spProfiles_idspProfileSender"];//Friend
                                    $receiver = $rows["spProfiles_idspProfilesReceiver"];//My
                                    $total = 0;
                                    $unres = $unread->unreadmessage($sender,$_SESSION["uid"]);//$receiver
                                    if($unres != false)
                                    {
                                        $total = $unres->num_rows;
                                    }
                                    
                                    $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                    if($result != false)
                                    {   
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
                                    }
                                }
                            }
                            //RECEIVER PROFILE NAME
                            $b = array();
                            $r = new _spprofilehasprofile;
                            $res = $r->friend($_SESSION["uid"]);//As a sender
                            //echo $r->ta->sql;
                            if($res != false)
                            {               
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    
                                    array_push($b,$rows["spProfiles_idspProfilesReceiver"]);
                                    
                                    
                                    $r = in_array($rows["spProfiles_idspProfilesReceiver"],$a,true);
                                    
                                    $receiver = $rows["spProfiles_idspProfilesReceiver"];//Friend
                                    $sender = $rows["spProfiles_idspProfileSender"];//My
                                    $total = 0;
                                    $unres = $unread->unreadmessage($receiver,$_SESSION["uid"]);
                                    //echo $unread->ta->sql;
                                    if($unres != false)
                                    {
                                        $total = $unres->num_rows;
                                    }
                                    
                                    if($r == "")
                                    {
                                        $p = new _spprofiles;
                                        $groupid = 0;
                                        $groupname = "";
                                        $g = new _spgroup;
                                        $rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfilesReceiver"]);
                                        
                                        if($rslt != false)
                                        {
                                            $rws = mysqli_fetch_assoc($rslt);
                                            $groupid = $rws["idspGroup"];
                                            $groupname = $rws["spGroupName"];
                                            $groupname = str_replace(' ', '', $groupname);
                                        }
                                        
                                        $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
                                        if($result != false)//All friend details
                                        {   
                                            $row = mysqli_fetch_assoc($result);
                                            echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                
                    <div class="main_div_form_right" >
                        <label>&nbsp;</label><br>
                        <input type="submit" class="btn btn_frnd" name="btn_frndstore" value="Go">
                    </div>
                </div>
            </form>
            <?php
        } ?>


       <!--  <a href="<?php echo $BaseUrl.'/'.$storeFolder;?>"><h3 class="active_store"><?php echo $storeTitle;?></h3></a> -->

      <!--  <?php echo $profilename; ?>
           -->
       <?php if(isset($_GET['userid']) && $_GET['userid'] > 0){ ?>


           <a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$_GET['userid']; ?>">
            <h2 class="active_store" style="margin: 15px 10px;"><?php //echo $Storeusername;?></h2></a>
            <?php if($profileType != '2' && $profileType != '5') { ?>
              <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="margin-right: -3px!important;padding: 6px;width: auto;background-color:#2ba805!important;padding: 7px 33px!important; margin-top: -5px;">Sell Product</a>
            <?php }?>
           
       <?php }?>
              
         
     
      
       
     
       <!--  <hr class="dotedline">
        <ul class="left_store_bar">
            <li><a href="javascript:void(0)"><i class="fa fa-caret-right" aria-hidden="true"></i> Sale Item</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-caret-right" aria-hidden="true"></i> Best Sellers</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-caret-right" aria-hidden="true"></i> Popular Item</a></li>
            <li><a href="javascript:void(0)"><i class="fa fa-caret-right" aria-hidden="true"></i> Clearance</a></li>
        </ul> -->


        <?php
        if(isset($_GET['catName'])){
            $fieldValue = str_replace('_', ' ', $_GET['catName']);
            $categoryTitle = str_replace('-', '&', $fieldValue);
            //$categoryTitle = $_GET['catName'];
        }
        
        //set folder path
        if(isset($folderName) && $folderName == 'my-store'){
            $folder = "my-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 4){
            $folder = "friend-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
            $folder = "private-store";

        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 99){
            $folder = "wholesale";

        }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
            $folder = "retail";
        }else{
            $folder = "store";
        }

        ?>
        <?php if($profileType != '2' && $profileType != '5') { 
            $leftFilterMarginTop = "0px";
        } else {
            $leftFilterMarginTop = "0px";
        }
        ?> 
        <div class="left_filter <?php echo ($_GET['mystore'] == 99)?'hidden':'';?>" style="margin-top: <?php echo $leftFilterMarginTop ?>; border: none;">
           
        <?php
        
          if (isset($_GET['mystore']) && $_GET['mystore'] == 5) {?>
            <a href="<?php echo $BaseUrl.'/'.$storeFolder;?>"><h3 class="active_store">My Groups</h3></a>
            <ul class="left_store_bar">
                <?php
                $g = new _spgroup;
                $result = $g->groupmember($_SESSION['uid']);
                if ($result != false) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fieldValue = str_replace(' ', '_', $row["spGroupName"]);
                        $FinalTitle = str_replace('&', '-', $fieldValue);
                        echo "<li class=''>
                        <a href='".$BaseUrl."/private-store/category.php?gid=" . $row['idspGroup'] . "&gname=" . $FinalTitle . "&back=back' class='groupsearch groupactive' data-gid='" . $row['idspGroup'] . "' data-gname='" . $row['spGroupName'] . "'><i class='fa fa-group'></i> " . $row['spGroupName'] . "</a></li>";
                    }
                } ?>
            </ul>
            <?php
           }

        ?>

          <!--   <h1>Type</h1>
            <div class="">
                <a href="<?php echo $BaseUrl.'/store/view-all.php?type=auction';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Auction</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?mod=retail';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Retail</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?mod=wholesale';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Wholesaler</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?mod=manufacturer';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Manufacturer</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?mod=distributor';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Distributors</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?mod=personal';?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Personal Sale</a>
            </div> -->
<style>
	
	/*a.success.active {
    color:#00FF00;
}*/
	</style>
            <!-- <h1 style="margin-top:0px">Choose Category</h1> -->
            <ul class="list-unstyled components mb-5" >
                <?php


               // print_r($_SERVER['REQUEST_URI']);
               // print_r($_GET['type']);
               $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
               $ss = new _spAllStoreForm;
               $httl = $ss->mkc();
               // echo $m->ta->sql;die("sani");
                if($httl != false){
                    while($rows = mysqli_fetch_assoc($httl)){
                      //   print_r($rows["masterDetails"]);

         if ($rows["masterDetails"] == "All") {?>

             <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/'.$folder.'/view-all.php?type='.$_GET['type'] || $_SERVER['REQUEST_URI'] == '/'.$folder.'/' ||$_SERVER['REQUEST_URI'] == '/'.$folder.'/view-all.php?condition='.$rows['masterDetails'].'&folder='.$storeFolder )?'activepage' : '';?> " >
 
      <a class=" <?php if($_GET['condition'] == "All"){echo "active"; }?>"  id="abc1" title="<?php echo $rows["subCategoryTitle"];?>" href="<?php echo $BaseUrl ?>/store/filtercategory.php?id=<?php echo $rows['subCategoryTitle']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $rows["subCategoryTitle"];?></a></li>


               
         <?php }else{ 
            
            
            ?>

             <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/'.$folder.'/view-all.php?condition='.$rows['masterDetails'].'&folder='.$storeFolder)?'activepage' : '';?> " >

             <a class=" <?php if($_GET['condition'] == "All"){echo "active"; }?> <?php if($rows['subCategoryTitle']==$id){echo "active_cate active"; } ?>" id="abc2" title="<?php echo $rows["subCategoryTitle"];?>" href="<?php echo $BaseUrl ?>/store/filtercategory.php?id=<?php echo $rows['subCategoryTitle']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php if (strlen($rows["subCategoryTitle"]) < 25) { echo $rows["subCategoryTitle"]; } else{ echo substr($rows["subCategoryTitle"], 0, 24) . '...'; }
             
             
             $pp = new _postingview;
             $filterid1 = $rows["subCategoryTitle"];
             $result31 = $pp->personal_allfilter($filterid1);
             $aa1 = $result31->num_rows;
             if($aa1){
             echo "<span style='color:white' class='pull-right b1'>(" . $aa1 . ")</span>";
             }else{
                echo "<span style='color:white' class='pull-right b1'>(0)</span>";
             } 
             
             ?></a></li><?php
                         
                    } 
                }
            }
                ?>
            </ul>
            <?php if($_GET['folder']=="retail"){  ?>

            <h1>Price</h1>
			<?php  } ?>
            <div class="">
               <!--  <form class="form-inline  pricebox" action="<?php echo $BaseUrl.'/'.$folder.'/view-all.php'?>" method="POST">
                    <div class="form-group">
                        <label for="dollar">$</label>
                        <input type="text" class="form-control" name="txtStartPrice" id="txtTitle" />
                        
                        <label for="dollar">to $</label>
                        <input type="text" class="form-control" name="txtEndPrice" id="txtTitle" />
                        <span id=name_error  class="red"></span>

                        <button type="submit" class="btn" name="btnPriceRange" id="add"><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                        
                    </div>
                </form> -->
             

                 <!-- <form class="form-inline  pricebox" action="<?php echo $BaseUrl.'/'.$folder.'/view-all.php'?>" method="POST"> -->
                    <form class="form-inline  pricebox" action="" method="POST">
      <style type="text/css">
          [slider] {
  width: 100%;
  position: relative;
  height: 3px;
  margin:20px 0 50px 0;
}

[slider] > div {
  position: absolute;
  left: 13px;
  right: 15px;
  height: 3px;
}
[slider] > div > [inverse-left] {
  position: absolute;
  left: 0;
  height: 3px;
  border-radius: 10px;
  background-color: #CCC;
  margin: 0 0px;
}

[slider] > div > [inverse-right] {
  position: absolute;
  right: 0;
  height: 3px;
  border-radius: 10px;
  background-color: #CCC;
  margin: 0 7px;
}


#leftsidebar .custom-menu .btn {
    width:50px!important;
}

[slider] > div > [range] {
  /*position: absolute;
  left: 0;
  height: 3px;
  border-radius: 14px;
  background-color: #035049;*/
  position: absolute;
    left: 0;
    height: 4px;
    border-radius: 14px;
    /* background-color: #035049; */
    background: rgb(26,178,255);
    background: linear-gradient(0deg, rgba(26,178,255,1) 42%, rgba(20,137,197,1) 100%);
}

[slider] > div > [thumb] {
  /*position: absolute;
  top: -7px;
  z-index: 2;
  height: 20px;
  width: 20px;
  text-align: left;
  margin-left: -11px;
  cursor: pointer;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
  background-color: #FFF;
  border-radius: 50%;
  outline: none;*/
  position: absolute;
    top: -8px;
    z-index: 2;
    height: 20px;
    width: 14px;
    text-align: left;
    margin-left: -11px;
    cursor: pointer;
    box-shadow: 0 3px 8px rgb(0 0 0 / 40%);
    background-color: #0088cc;
    border-radius: 7px;
    outline: none;
}

[slider] > input[type=range] {
  position: absolute;
  pointer-events: none;
  -webkit-appearance: none;
  z-index: 3;
  height: 14px;
  top: -2px;
  width: 100%;
  opacity: 0;
}

div[slider] > input[type=range]:focus::-webkit-slider-runnable-track {
  background: transparent;
  border: transparent;
}

div[slider] > input[type=range]:focus {
  outline: none;
}

div[slider] > input[type=range]::-webkit-slider-thumb {
  pointer-events: all;
  width: 28px;
  height: 28px;
  border-radius: 0px;
  border: 0 none;
  background: red;
  -webkit-appearance: none;
}

div[slider] > input[type=range]::-ms-fill-lower {
  background: transparent;
  border: 0 none;
}

div[slider] > input[type=range]::-ms-fill-upper {
  background: transparent;
  border: 0 none;
}

div[slider] > input[type=range]::-ms-tooltip {
  display: none;
}

/*[slider] > div > [sign] {
  opacity: 0;
  position: absolute;
  margin-left: -18px;
  top: -35px;
  z-index:3;
  background-color: #035049;
  color: #fff;
  width: 35px;
  height: 29px;
  border-radius: 28px;
  -webkit-border-radius: 28px;
  align-items: center;
  -webkit-justify-content: center;
  justify-content: center;
  text-align: center;
}*/

/*[slider] > div > [sign]:after {
  position: absolute;
  content: '';
  left: 0;
  border-radius: 16px;
  top: 19px;
  border-left: 14px solid transparent;
  border-right: 14px solid transparent;
  border-top-width: 16px;
  border-top-style: solid;
  border-top-color: #035049;
  width: 28px;
  right: 0;
  margin: 0 auto;
}*/

[slider] > div > [sign] > span {
  font-size: 14px;
  font-weight: 600;
  line-height: 29px;
}

[slider] > div > [sign] {
  opacity: 1;
  background-color: transparent !important;
  padding: 15px 0;
  display: inline-block;
}
      </style>  
<?php if($_GET['folder']=="retail"){  ?>
	  
                   <div slider id="slider-distance">
<?php
 $au = new _productposting;
if($_GET['condition'] == 'All'){ 
                    
								
								 if($_GET['page']==1){
                                $start = 0;
							}else{
								$sss = $_GET['page']-1;
								 $start = 10*$sss;
							}
		$limitaa = 10;
			
                             $result3 = $au->allretailproduct_heigestprice(1,$_SESSION['pid'],$start,$limitaa);
							 		 
				}else {
                             $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);
							
					}
		if($result3){
			$row3 = mysqli_fetch_assoc($result3);
			$heigest_price=$row3['retailSpecDiscount'];
		}
?>

<?php if(isset($_POST['txtStartPrice']) && isset($_POST['txtEndPrice'])){   

 $txtStartPrice = $_POST['txtStartPrice'];
$txtEndPrice = $_POST['txtEndPrice'];

$leng = $txtStartPrice/$heigest_price*100;


$leng2 = $txtEndPrice/$heigest_price*100;


$l3 = 100 -$leng2 ;
echo '<div class="1">
        <div inverse-left style="width:'.$leng.'%;"></div>
        <div inverse-right style="width:'.$l3.'%;"></div>
        <div range style="left:'.$leng.'%;right:'.$l3.'%;"></div>
        <span thumb style="left:'.$leng.'%;"></span>
        <span thumb style="left:'.$leng2.'%;"></span>
        <div sign style="left:'.$leng.'%;">
          <span id="value">'.$txtStartPrice.'</span>
        </div>
        <div sign style="left:'.$leng2.'%;">
          <span id="value">'.$txtEndPrice.'</span>
        </div>
        </div>';
} else{
?>
  <div class="2"> 
    <div inverse-left style="width:70%;"></div>
    <div inverse-right style="width:70%;"></div>
    <div range style="left:0%;right:0%;"></div>
    <span thumb style="left:0%;"></span>
    <span thumb style="left:100%;"></span>
    <div sign style="left:0%;">
      <span id="value">0</span>
    </div>
    <div sign style="left:100%;">
      <span id="value"><?php echo $heigest_price; ?></span>
    </div>
  </div>


<?php
}

 ?>

<?php if(isset($_POST['txtStartPrice']) && isset($_POST['txtEndPrice'])){   

 $txtStartPrice = $_POST['txtStartPrice'];
 //echo $txtStartPrice;
 
$txtEndPrice = $_POST['txtEndPrice'];
//echo $txtEndPrice; 
 
?>
 <input type="range" value="0" max="<?php echo $heigest_price; ?>" min="0" name="txtStartPrice" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  let value = (this.value/parseInt(this.max))*100
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

  <input type="range" value="<?php echo $txtEndPrice;  ?>" max="<?php echo $heigest_price; ?>" min="0" step="1" name="txtEndPrice" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  let value = (this.value/parseInt(this.max))*100
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />

  <?php
}else{
?>

 <input type="range" value="0" max="<?php echo $heigest_price; ?>" min="0" name="txtStartPrice" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  let value = (this.value/parseInt(this.max))*100
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

  <input type="range" value="<?php echo $heigest_price; ?>" max="<?php echo $heigest_price; ?>" min="0" step="1" name="txtEndPrice" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  let value = (this.value/parseInt(this.max))*100
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />


<?php
}

?>

</div>

<?php } ?>
<!--<button type="submit" class="btn" name="btnPriceRange" id="add" style="background-color: #49a749;"><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i></button>-->

<?php if($_GET['folder']=="retail"){  ?>
<button type="submit" class="btn" name="btnPriceRange" id="add" style="background-color: #2ba805 !important; font-size: 16px; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;padding: 3px 25px;margin-left: 25px;">Filter</button>
<?php   }  ?>
                 <!--    <div class="form-group">
                        <label for="dollar">$</label>
                        <input type="text" class="form-control" name="txtStartPrice" id="txtTitle" />
                        
                        <label for="dollar">to $</label>
                        <input type="text" class="form-control" name="txtEndPrice" id="txtTitle" />
                        <span id=name_error  class="red"></span>

                        <button type="submit" class="btn" name="btnPriceRange" id="add"><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                        
                    </div> -->
                </form>
            </div>

<!--             <h1>Friend Level</h1>
            <div>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?friendlevel=1'?>"><i class="fa fa-caret-right" aria-hidden="true"></i> 1st Level</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?friendlevel=2'?>"><i class="fa fa-caret-right" aria-hidden="true"></i> 2nd Level</a>
                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?friendlevel=3'?>"><i class="fa fa-caret-right" aria-hidden="true"></i> 3rd Level</a>
            </div> -->

           
            <div class="">
                <?php
                $p = new _postingview;
                $c = new _country; 

                $result_c = $p->getCountry();
                //echo $p->ta->sql;
                if($result_c != false){
                    while ($row_c = mysqli_fetch_assoc($result_c)) {
                        if ($row_c['spPostingsCountry'] > 0) {
                            $result_cntry = $c->readCountryName($row_c['spPostingsCountry']);
                            if ($result_cntry) {
                                $row2 = mysqli_fetch_assoc($result_cntry);
                                ?>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?country='.$row2['country_title'];?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $row2['country_title'];?></a>
                                <?php
                            }
                        }
                    }
                }
                ?>

            </div>


        </div>
    </div>
</div>
</div>
</div>
     <script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                var selectPoint = $("#txtTitle").val();
                    var txtIndusrtyType = $("#txtTitle").val();
                         //var txtPercent = $("#txtPercent").val(); 


                      var flag=0;
      
       if (txtIndusrtyType!="")
       {
       var strArr = new Array();
       strArr = txtIndusrtyType.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

                    
         /*         if(selectPoint == "0"){
                            

                        $("#select_error").text("Please Select Point type.");
                        return false;

                     }else if(txtIndusrtyType == ""){
                            

                        $("#text_error").text("Please Enter Title.");
                        return false;

                     }*/ if(selectPoint == ""  &&  txtIndusrtyType == "" ){
                            

                        $("#name_error").text("Please Enter price.");
                            //$("#icon_error").text("Please Enter price.");
                              //$("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    else if(selectPoint != "" && txtIndusrtyType == ""  ){
                            

                        $("#name_error").text("");
                        //$("#icon_error").text("Please Enter price.");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     else if(selectPoint == "" && txtIndusrtyType != ""  ){
                            

                        $("#name_error").text("Please Enter price.");
                        //$("#icon_error").text("");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     
                     else if(flag == 1){
                        $("#name_error").text("Space not allowed.");
                        return false;

                     }
                     
                     else{
                        
                         $("#frmAddMainNav").submit();
                        
                     }

                 });
           });

        </script>   
        
