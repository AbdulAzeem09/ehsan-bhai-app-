<style>
.btn_home{padding: 10px 15px;
    background-color: white;
    border-radius: 2px;}

</style>
        <div class="topBoxEvent text-right">
            <!-- <a href="javascript:void(0)" class="btn btn_event"><i class="fa fa-dashboard"></i> Dashboard</a> -->
           <!--  <a href="<?php echo $BaseUrl.'/events';?>" class="btn butn_cancel homecancelbtn"><i class="fa fa-home"></i>Home</a>-->
            <!-- <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent">Submit an event</a>-->
            
            <a class="btn_home" href="<?php echo $BaseUrl.'/events/'; ?>"><i class="fa fa-arrow-left"></i> Home</a> 

           <!--  <a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn <?php echo (isset($sponsor) && $sponsor == 1)?'':'hidden';?>">Add Sponsor</a> -->

         <!--    <button data-toggle="modal" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn <?php echo (isset($sponsor) && $sponsor == 1)?'':'hidden';?>">Add Sponsor</button>-->


        </div>
   