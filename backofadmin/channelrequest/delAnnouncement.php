  <?php 
  include('../univ/baseurl.php');
  
  $id=$_GET['id'];
  $data="delete from spnews_announcement where id=$id";
  $spdata=dbQuery($dbConn,$data);
    ?>
  <script>
  window.location.replace('https://thesharepage.com/backofadmin/channelrequest/index.php?view=Announcement');
  </script>
   
 
