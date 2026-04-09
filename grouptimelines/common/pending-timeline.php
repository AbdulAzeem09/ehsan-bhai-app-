<?php
 $_SESSION['groupid'] = $_GET['groupid'];
?>
<style>
  .posting-notes{
    padding-bottom: unset !important;
  }

  .blogs {
    padding: 10px 25px !important;
  }
</style>
<div class="pending-timeline">
  <div class="main-heading">
      <div class="top-heading">
          Pending Timeline
      </div>
  </div>

  <div id="pending-timeline-container" class="time-line">
    <div id="loadMore">
      <h4 class="load-more 111" >Load More</h4>
      <input type="hidden" id="groupid" name="groupid" value="<?php echo $_GET['groupid'];?>">
      <input type="hidden" id="row" value="0">
      <input type="hidden" id="all" value="0">
      <input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
    </div>
  </div>       
</div>