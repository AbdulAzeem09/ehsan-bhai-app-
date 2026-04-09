<!-- 
<?php print_r($_POST); ?> -->
<form class="" method="post" action="<?php echo $BaseUrl.'/events/search.php';?>" >
<div class="row">
<div class="col-md-6"> 
<div class="row">
<div class="col-md-5">
<div class="form-group">
<input type="text" name="txttitle" class="form-control" value="<?php if(isset($_POST['txttitle'])){ echo $_POST['txttitle'];  } ?>" placeholder="Keyword" required="" />
</div>
</div>
<div class="col-md-5">
<div class="form-group">
<input type="date" name="txtDate" class="form-control" value="<?php if(isset($_POST['txtDate'])){ echo $_POST['txtDate'];  } ?>" placeholder="When" />
</div>
</div>
<!--<div class="col-md-3">
<div class="form-group">
<select class="form-control" name="txtCategory">
    <option value="">Categories</option>
    <?php
        $m = new _subcategory;
        $catid = 9;
        $result = $m->read($catid);
        if($result){
            while($rows = mysqli_fetch_assoc($result)){
                   //echo "<option value='".$rows["subCategoryTitle"]."'>".$rows["subCategoryTitle"]."</option>";
                ?>

               <option value='<?php echo $rows["subCategoryTitle"]; ?>'   <?php if(isset($_POST['txtCategory']) && $rows["subCategoryTitle"] == $_POST['txtCategory'] ){ echo "selected";  } ?>><?php echo $rows["subCategoryTitle"]; ?></option>";

                <?php
            }
        }
    ?>
    
</select>
</div>
</div>-->
<!--<div class="col-md-3"> 
<div class="form-group">
<input type="text" name="txtLocation" class="form-control" value="<?php if(isset($_POST['txtLocation'])){ echo $_POST['txtLocation'];  } ?>" placeholder="Where(Your Location)" />
</div>
</div>-->
</div>
                        
</div>
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
<div class="col-md-2">
<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
<input type="submit" class="btn btnEvent findeventbtn btn-border-radius" value="Find Events">

<?php }else{ ?>

<input type="button" class="btn btnEvent findeventbtn" data-toggle='modal' data-target='#alertNotEmpProfile' value="Find Events">

<?php } ?>
</div> <?php }?>
</div>


</form>
<!--  <p>Act Big! Ultimate Music Festival</p> -->