<?php  
if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;}
$keyword = $_GET['keyword'] ?? '';
$announcements = $grp->getGroupAnnouncements($groupid, $role, $keyword);
?>
<div class="announcement">
    <div class="main-heading">
        <div class="top-heading">
            Announcement
        </div>
        <?php if(in_array($role, ['admin','owner'])) { ?>
            <div class="btn" onclick="resetModal();" data-bs-toggle="modal" data-bs-target="#add-anc">
                <img src="./images/add-4.svg" alt="">
                <span>Add Announcement</span>
            </div>
        <?php } ?>
    </div>

    <?php if($announcements) { ?>
        <div class="search-box">
            <?php 
                $getParams = $_GET;
                unset($getParams['grouptimelinePage']);
                unset($getParams['keyword']);
                $searchUrl = "/grouptimelines/?".http_build_query($getParams);
            ?>
            <form onSubmit="return false;" action="<?= $searchUrl ?>" id="search">
                <input type="text" id="keyword" name="keyword" value="<?= $keyword ?>" placeholder="Search by keyword...">
                <div class="search-icon" onclick="window.location.href = $('#search').attr('action')+'&keyword='+$('#keyword').val();">
                    <img src="./images/search-3.svg" alt="">
                </div>
            </form>
        </div>
    <?php } ?>

    <div class="table-wrapper">
        <?php
        if($announcements){ ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th class="text-center">Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while($row = mysqli_fetch_assoc($announcements)) {
                        $p = new _spprofiles;
                        $name = $p->getProfileName($row['profile_id']);
                    ?>
                    <tr>
                        <td style="padding-left: 20px;">
                            <?= $row['title'] ?>
                        </td>
                        <td><span class="read-more"><?= $row['message'] ?></span></td>
                        <td class="text-center date-td">
                            <div class="date">
                                <?= date('M d, Y, H:i A', strtotime($row['announcemt_date'])) ?>
                            </div>
                            <div class="title">
                                By <?= $name ?>
                            </div>
                        </td>
                        <?php if(in_array($role, ['admin','owner'])) { ?>
                        <td class="action">
                            <div class="link" style="cursor:pointer;">
                                <span class="img edit_announcement" data-id="<?= $row['id'] ?>" data-date="<?= date('Y-m-d', strtotime($row['announcemt_date'])) ?>" data-time="<?= date('H:i:s', strtotime($row['announcemt_date'])) ?>" data-title="<?= $row['title'] ?>" data-message="<?= $row['message'] ?>" style="cursor:pointer;">
                                    <img src="./images/edit-3.svg" alt="">
                                </span>
                                <span class="img" style="padding-left: 4px;" onclick="deleteAnnouncement('<?= $row['id'] ?>')">
                                    <img src="./images/delete.svg" alt="">
                                </span>
                            </div>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>        
        <?php }else{
            echo "<h6>No announcements found.</h6>";
        }  ?>
    </div>

    <div class="modal add-album-modal" id="add-anc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 modal_title" id="staticBackdropLabel">Create Announcement</h1>
                </div>
                <div class="modal-body">
                    <form onSubmit="return false;">
                        <div class="input-group in-1-col">
                            <label>Announcement Title (max 100 characters)  <span style="color: #EF1D26;">*</span></label>
                            <input id="announcement_title" maxlength="100" type="text" placeholder="Type Title">
                        </div>
                        <div class="input-group in-1-col">
                            <label>Message (max 500 characters) <span style="color: #EF1D26;">*</span></label>
                            <textarea id="announcement_message" placeholder="Enter Messagae" rows="5"></textarea>
                        </div>
                        <div class="input-group in-2-col">
                            <label>Announcement Date <span style="color: #EF1D26;">*</span></label>
                            <input id="announcement_date" readonly type="date" placeholder="Announcement Date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="input-group in-2-col">
                            <label>Announcement Time <span style="color: #EF1D26;">*</span></label>
                            <input id="announcement_time" type="time" name="time" placeholder="Announcement Time" value="<?= date('H:i:s') ?>">
                        </div>

                        <input type="hidden" id="announcement_id" name="announcement_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_announcement" data-gid="<?= $_GET['groupid']?>" id="create_announcement" style="background-color: #7649B3; color : white;">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".edit_announcement").click(function(){
        var id = $(this).data('id');
        var title = $(this).data('title');
        var message = $(this).data('message');
        var date = $(this).data('date');
        var time = $(this).data('time');
        $(".modal_title").text('Update Announcement');
        $(".save_announcement").text('Update');
        $("#announcement_id").val(id);
        $("#announcement_title").val(title);
        $("#announcement_message").val(message);
        $("#announcement_date").val(date);
        $("#announcement_time").val(time);
        $("#add-anc").modal('show');
    });

    function resetModal(){
        $(".modal_title").text('Create Announcement');
        $(".save_announcement").text('Create');
        $("#announcement_id").val('');
        $("#announcement_title").val('');
        $("#announcement_message").val('');
    }
</script>
    