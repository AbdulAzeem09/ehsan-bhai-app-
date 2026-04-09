<?php
function include_page_block($block_type){
    $block_list = [                        
        'blocked'=>'blocked_members_block.php',
        'admin'=>'admin_members_block.php',
        'rejected'=>'rejected_members_block.php',
        'asst_admin'=>'asstadmin_members_block.php',
        'all_members'=>'all_members_block.php',
    ];

    if(isset($block_list[$block_type])){
        return 'common/'.$block_list[$block_type]; // load page from array list
    } else {
        return 'common/'.$block_list['all_members']; // default timeline
    }
}

function generate_member_navigation($activeCounter,$getAllAdminMembersCount,$getAllAsstAdminMembersCount,$getRejectedMembersCount,$getBlockedMembersCount){
    $member_links = array(
        array("all_members","All Members $activeCounter" ),
        array("admin","Admin $getAllAdminMembersCount" ),
        array("asst_admin","Assistant Admin $getAllAsstAdminMembersCount" ),
        array("rejected","Rejected $getRejectedMembersCount" ),
        array("blocked","Blocked $getBlockedMembersCount" ),
    );
    foreach ($member_links as $mem){
        echo "<div class=\"link\" id=\"$mem[0]\" >$mem[1]</div>";
    }
}


?> 


 <div class="members">
    <div class="main-heading">
        <div class="top-heading">
            Members
        </div>
    </div>
    <div class="member-navigation">
        <?php generate_member_navigation($activeCounter,$getAllAdminMembersCount,$getAllAsstAdminMembersCount,$getRejectedMembersCount, $getBlockedMembersCount); ?>      
    </div>

    <?php include_once(include_page_block($block_type)) ; ?>                  

</div>
<script type="text/javascript">
    //active link    
    var ml = $(".member-navigation .link");
    if(block_type==''){ 
        $("#all_members").addClass("active-link"); 
    }else {
        ml.each(function( index, item ) {
            if( $(item).attr("id")==block_type ) { 
                $(this).addClass("active-link");    
                return false;   
            }
        });
    }
    //active link end
    
    // link routing
    $(".member-navigation .link").click(function () {
        var common = '<?php echo "/grouptimelines/?groupid=".$groupid."&groupname=".$groupname."&timeline&page=".$page_type."&block=";?>';
        window.location.replace(common+$(this).attr("id"));
    })
    // link routing    
</script>                