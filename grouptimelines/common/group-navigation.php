<?php

$groupid = $_GET['groupid'];
$groupname = $_GET['groupname'];

function active_group_link($link_type){
    if($link_type == $_GET['page'] ){
        echo 'active-link';
    }
}
?>

<div class="group-navigation">
    <div class="link <?php active_group_link('1'); ?> <?php active_group_link('feeds'); ?>" >FEEDS</div>
    <div class="link <?php active_group_link('photos'); ?> <?php active_group_link('album'); ?>">PHOTOS</div>
    <div class="link <?php active_group_link('videos'); ?> <?php active_group_link('video'); ?>">VIDEOS</div>
    <div class="link <?php active_group_link('events'); ?>">EVENTS</div>
    <!-- <div class="link <?php //active_group_link('discussions'); ?>">DISCUSSIONS</div> -->
    <!-- <div class="link <?php //active_group_link('store'); ?>">STORE</div> -->
    <div class="link <?php active_group_link('files'); ?> <?php active_group_link('file'); ?>">FILES</div>
</div>
<div class="line"></div>

<script type="text/javascript">
    $(".group-navigation .link").click(function () {
        var common = '<?php echo "/grouptimelines/?groupid=".$groupid."&groupname=".$groupname."&timeline&page=";?>';
        window.location.replace(common+$(this).html().toLowerCase())
    })
</script>