
<?php 
include('../univ/baseurl.php');
?>
<div class="row">

<style>

.list-wrapper {
padding: 15px;
overflow: hidden;
display: contents;

}



.list-item h4 {
color: #31abe3;
font-size: 18px;
margin: 0 0 5px;
}

.list-item p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #3e2048;
background-color: #3e2048;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;
background-color: #3e2048;
border-color: ###3e2048;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #3e2048;
}
</style>

<div class="col-md-12 social 3">
<?php


$conn = _data::getConnection();
$p = new _postings;

$gid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;


//old query at 02-jan-18
//$sql = "SELECT s.spPostings_idspPostings FROM spshare AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToGroup = $gid AND f.idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 and t.sppostingvisibility = $gid ORDER BY spPostings_idspPostings DESC";
//new query at 02-jan-18
//print_r($_GET['page']);die('====================');
if($_GET['page']==1)
{
$counts=0;
}
else{
$valss=$_GET['page']-1;
$counts=5*$valss;
}
$limitaa=10;
$sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment, s.created 
FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 OR  f.groupid = $gid
UNION ALL 
SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag, t.spPostingDate 
FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid OR t.groupid =  $gid   ORDER BY timelineid DESC limit $counts,$limitaa";



 $sql_count = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment, s.created 
FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 OR  f.groupid = $gid
UNION ALL 
SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag, t.spPostingDate 
FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid OR t.groupid =  $gid   ORDER BY timelineid DESC";

// echo $sql;
$res = mysqli_query($conn, $sql);

$res_count= mysqli_query($conn, $sql_count);
//var_dump($res);
//print_r($res);
//echo $res->num_rows;
//echo $sql;
echo "<div id='timeline-container'>";
/*echo $p->ta->sql;
print_r($res);*/
/*print_r($res);*/

if ($res->num_rows !=false) {


echo "<div class='list-wrapper'>";

while ($timeline = mysqli_fetch_assoc($res)) { 

//print_r($timeline);

$_GET["timelineid"] = $timeline['timelineid'];
$shareby = $timeline['spShareByWhom'];
$proid = $timeline['spPostings_idspPostings'];
$sharedesc = $timeline['spShareComment'];
$grouptimelines = 1;
echo "<div class='list-item 111'>";
include "grouptimelineentry_old.php"; 
echo "</div>";
//		die('tttttttttt');

}

echo "</div>";
echo "<div id='pagination-container' style='margin-top:22px'></div>";


}

else if($res->num_rows == 0){
if(!empty($profile_exist) &&  $approve == 1){

echo "<h4 style='text-align: center;'>No Post Available</h4>"; 

}else{


// echo "<h4 style='text-align: center;padding-left: 259px;'>No Post Available</h4>"; 

}



}



echo "</div>";

?>


<?php if($_GET['page']!=1)
{?>
<!--<a class="float-left btn btn-primary" href="<?php echo $BaseUrl.'/grouptimelines/?groupid=327&groupname=Test%20Group&timeline&page='.$_GET['page']-1;?>">Previous</a>-->
<!--<div><ul class="nav" style="display: flex;">
<li class="nav-item">
<a class="nav-link " href="<?php echo $BaseUrl?>/grouptimelines/about.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&about">About</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo $BaseUrl?>/grouptimelines/discussion-board.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&disc">Discussion</a>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo $BaseUrl?>/grouptimelines/group-folder.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&files">Files</a>
</li>
<li class="nav-item">
<a class="nav-link " href="<?php echo $BaseUrl?>/grouptimelines/group-event.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&event">Events</a>
</li>
<li class="nav-item">
<a class="nav-link " href="<?php echo $BaseUrl?>/grouptimelines/group-photo.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&photo">Gallery</a>
</li>
</ul></div>-->

<?php } ?> 
<?php 
// echo $grouptimeline.'======';

if($res->num_rows != 0 )
{

/* if  ($grouptimeline!=0)  
{*/

?>

<?php }
//} ?> 

</div>


</div>
<?php 
if ($res_count->num_rows > 11) {
    ?>
    
    <div>
    <h1 class="load-more" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer">Load More</h1>
    <input type="hidden" id="row" value="0">
    <input type="hidden" id="all" value="<?php echo $res_count->num_rows; ?>">
    <input type="hidden" id="gid" value="<?php echo $gid; ?>">
    <input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
    </div>
    

    <?php } ?>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 6;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});
</script>
-->

<script>
$(document).ready(function() {
// Load more data
$('.load-more').click(function() {

var row = Number($('#row').val());
var gid = Number($('#gid').val());
var allcount = Number($('#all').val());
row = row + 11;

if (row <= allcount) {


$("#row").val(row);
var profileid = $("#profiddd").val();


$.ajax({
url: '../publicpost/more_post.php',
type: 'post',
data: {
row: row,
profile: profileid,
gid:gid
},
beforeSend: function() {
$(".load-more").text("Loading...");
},
success: function(response) {
 

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"

$(".load-more").text("Load More");
$(".post:last").after(response).show().fadeIn("slow");
var rowno = row + 11;

// checking row value is greater than allcount or not
if (rowno > allcount) {
   
$('.load-more').css("display", "none");
} else {

$(".load-more").text("Load more");
}

$(".load-more").text("Load More");
}, 2000);
}
});
} else {

   
$('.load-more').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

// Reset the value of row
$("#row").val(0);

// Change the text and background
$('.load-more').text("Load more");
$('.load-more').css("background", "#15a9ce");
}, 2000);
}
});
});
</script>
