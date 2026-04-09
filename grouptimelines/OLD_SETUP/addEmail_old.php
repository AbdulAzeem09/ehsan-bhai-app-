<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once("../authentication/check.php");
        $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
    }
    if (!isset($_SESSION['pid'])) {
        include_once("../authentication/check.php");
        $_SESSION['afterlogin'] = "my-groups/";
    }

    $pid = $_SESSION['pid'];
    $getid = $group_id;
    $obj2 = new _spAllStoreForm;
    $ress2 = $obj2->readdatabymulid($getid, $pid);
    if ($ress2 == false) {
        //die("=======");
        header("location:$BaseUrl/my-groups/?msg=notaccess");
    }

?>

    <!DOCTYPE html>
    <html lang="en-US">
    <style>
        .multiselect-selected-text:hover {
            color: #04030af7 !important;
            opacity: .8;
        }

        .red {
            font-size: 12px !important;
        }

        .multiselect-container {
            height: 261px !important;
            overflow-y: scroll !important;
        }
    </style>

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
        <?php include('../component/f_links.php'); ?>
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo $BaseUrl ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


        <script src="<?php echo $BaseUrl; ?>/assets/js/editor.js"></script>
        <script>
            $(document).ready(function() {
                $("#txtEditor").Editor();
            });
        </script>
        <link href="<?php echo $BaseUrl; ?>/assets/css/editor.css" type="text/css" rel="stylesheet" />


        <script type="text/javascript">
            //USER ONE
            $(function() {
                $('#users').multiselect({
                    includeSelectAllOption: true
                });
                $('#groups').multiselect({
                    includeSelectAllOption: true
                });
                $('#importusers').multiselect({
                    includeSelectAllOption: true
                });
            });
            //USER TWO
            $(function() {
                $('#userstoo').multiselect({
                    includeSelectAllOption: true
                });
                $('#groupstoo').multiselect({
                    includeSelectAllOption: true
                });
                $('#importuserstoo').multiselect({
                    includeSelectAllOption: true
                });
            });

            function showGroup(group) {
                if (group == 'user') {
                    $("#usertoo").css('display', '');
                    $("#grouptoo").css('display', 'none');
                    $("#importusertoo").css('display', 'none');

                } else if (group == 'group') {
                    $("#usertoo").css('display', 'none');
                    $("#grouptoo").css('display', '');
                    $("#importusertoo").css('display', 'none');

                } else if (group == 'importuser') {
                    $("#usertoo").css('display', 'none');
                    $("#grouptoo").css('display', 'none');
                    $("#importusertoo").css('display', '');

                }
            }
        </script>
    </head>

    <body class="bg_gray" onload="pageOnload('groupdd')">
        <?php

        $g = new _spgroup;
        $result = $g->groupdetails($group_id);
        //echo $g->ta->sql;
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            $gimage = $row["spgroupimage"];
            $spGroupflag = $row['spgroupflag'];
        }
        ?>
        <?php include('../header.php'); ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include('../component/left-group.php'); ?>
                    </div>
                    <div class="col-md-9" style="height: auto;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="about_banner" id="ip6" style="padding-bottom: 10px;">
                                    <div class="top_heading_group " id="ip6">
                                        <div class="row" id="id">
                                            <div class="col-md-6">

                                                <ol class="breadcrumb">

                                                    <li class="hv"><a href="<?php echo $BaseUrl; ?>/grouptimelines/addEmail.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">
                                                            <p class="btn56 active">Email Campaign</p>
                                                        </a></li>
                                                    <li class="hv"><a href="<?php echo $BaseUrl; ?>/grouptimelines/emailReport.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&emailCampaigns">Reports</a></li>
                                                </ol>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="sms_campaign">
                                        <div class="form-group">
                                            <label for="name">Subject</label> <span class="red">*</span>
                                            <input class="form-control" id="txtName" placeholder="Subject..." type="text" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Email</label> <span class="red">*</span>
                                            <input class="form-control" id="email" placeholder="Email...." type="text" required="">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">

                                                    <div class="form-group col-md-6 ">
                                                        <label for="pass">Select user</label> <span class="red">*</span>
                                                        <select name="user_group" id="group" class="form-control" onchange="showGroup(this.value)">
                                                            <option>Select Group</option>
                                                            <?php
                                                            $ps = new _spgroup;
                                                            $json = $ps->SearchGrouplist($_GET["searchTerm"], $_SESSION["uid"], $_SESSION["pid"]);
                                                            foreach ($json as $ds) {
                                                            ?>

                                                                <option value="<?php echo $ds['id']; ?>"><?php echo $ds['text']; ?></option>

                                                            <?php } ?>
                                                            <option value="user">User</option>

                                                        </select>

                                                    </div>
                                                    <div class="col-md-6" id="usertoo">

                                                        <div class="form-group dropdown" style="width: 100%;">
                                                            <label>Select Members</label> <span class="red">*</span><br>
                                                            <select id="userstoo" name="users" multiple="multiple" class="form-control" style="width: 100%;">
                                                                <?php
                                                                $r = new _spprofilehasprofile;
                                                                $unread = new _friendchatting;
                                                                $a = array();
                                                                $res = $r->friends($_SESSION["uid"]); //As a receiver
                                                                if ($res != false) {
                                                                    while ($rows = mysqli_fetch_assoc($res)) {
                                                                        $rslt = $g->friendprofile($_SESSION["uid"], $rows["spProfiles_idspProfileSender"]);
                                                                        $groupname = "";
                                                                        $groupid = 0;
                                                                        $g = new _spgroup;
                                                                        if ($rslt != false) {
                                                                            $rws = mysqli_fetch_assoc($rslt);
                                                                            $groupid = $rws["idspGroup"];
                                                                            $groupname = $rws["spGroupName"];
                                                                            $groupname = str_replace(' ', '', $groupname);
                                                                        }

                                                                        array_push($a, $rows["spProfiles_idspProfileSender"]);
                                                                        $p = new _spprofiles;

                                                                        $sender = $rows["spProfiles_idspProfileSender"]; //Friend
                                                                        $receiver = $rows["spProfiles_idspProfilesReceiver"]; //My
                                                                        $total = 0;
                                                                        $unres = $unread->unreadmessage($sender, $_SESSION["uid"]); //$receiver
                                                                        if ($unres != false) {
                                                                            $total = $unres->num_rows;
                                                                        }

                                                                        $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                                                        if ($result != false) {
                                                                            $row = mysqli_fetch_assoc($result);
                                                                            echo "<option value='" . $row['idspProfiles'] . "' id='" . $row['idspProfiles'] . "' >" . $row['spProfileName'] . "</option>";
                                                                        }
                                                                    }
                                                                }
                                                                $b = array();
                                                                $r = new _spprofilehasprofile;
                                                                $res = $r->friend($_SESSION["uid"]); //As a sender
                                                                if ($res != false) {
                                                                    while ($rows = mysqli_fetch_assoc($res)) {

                                                                        array_push($b, $rows["spProfiles_idspProfilesReceiver"]);


                                                                        $r = in_array($rows["spProfiles_idspProfilesReceiver"], $a, true);

                                                                        $receiver = $rows["spProfiles_idspProfilesReceiver"]; //Friend
                                                                        $sender = $rows["spProfiles_idspProfileSender"]; //My
                                                                        $total = 0;
                                                                        $unres = $unread->unreadmessage($receiver, $_SESSION["uid"]);
                                                                        if ($unres != false) {
                                                                            $total = $unres->num_rows;
                                                                        }

                                                                        if ($r == "") {
                                                                            $p = new _spprofiles;
                                                                            $groupid = 0;
                                                                            $groupname = "";
                                                                            $g = new _spgroup;
                                                                            $rslt = $g->friendprofile($_SESSION["uid"], $rows["spProfiles_idspProfilesReceiver"]);

                                                                            if ($rslt != false) {
                                                                                $rws = mysqli_fetch_assoc($rslt);
                                                                                $groupid = $rws["idspGroup"];
                                                                                $groupname = $rws["spGroupName"];
                                                                                $groupname = str_replace(' ', '', $groupname);
                                                                            }

                                                                            $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
                                                                            if ($result != false) //All friend details
                                                                            {
                                                                                $row = mysqli_fetch_assoc($result);
                                                                                echo "<option value='" . $row['idspProfiles'] . "' id='" . $row['idspProfiles'] . "' >" . $row['spProfileName'] . "</option>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="box-footer">
                                                            <button id="saveEmail" class="btn btn_gray btn-border-radius">Start Campaign</button>
                                                            <input type="hidden" name="emails" id="emails" value="" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <input type="hidden" name="optionValuetoo" id="optionValuetoo" value="usertoo" />
                                        <input type="hidden" name="Idstoo" id="Idstoo" value="" />

                                    </div>



                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <?php
        include('../component/f_footer.php');
        include('../component/f_btm_script.php');
        ?>
        <script type="text/javascript">
            //send email campaign start
            $('#saveEmail').on('click', function() {
                $("#Idstoo").val('');
                var optionValuetoo = $("#optionValuetoo").val();
                var subject = $("#txtName").val();
                // alert(subject);
                var email = $("#email").val();
                // alert(email);
                var group = $("#group").val();
                //alert(group);
                var member = $("#userstoo").val();
                //alert(member);

                if (subject == '') {
                    $('.red').text('This Field is required');
                    var fal = 1;
                }

                if (email == '') {
                    $('.red').text('This Field is required');
                    var fal = 1;
                }
                if (group == 'Select Group') {
                    $('.red').text('This Field is required');
                    var fal = 1;
                }
                if (member == null) {
                    $('.red').text('This Field is required');
                    var fal = 1;
                }
                if (fal == 1) {
                    return false;
                }

                // alert(encodeURI(optionValue) );
                if (optionValuetoo == 'usertoo') {
                    var option = 'user';
                    var selected = $("#usertoo option:selected");
                    var ids = "";
                    selected.each(function() {
                        ids += +$(this).val() + ",";
                    });
                    $("#Idstoo").val(ids);
                }



                $.ajax({
                    type: 'POST',
                    url: '/grouptimelines/email_campaign/sendEmailCampaign.php',
                    data: {
                        'name': $('#txtName').val(),
                        // 'email':$('#email').val(),
                        'text': email,
                        'type': 'Email',
                        'date': $('#date').val(),
                        'time': $('#txttime').val(),
                        'user_id': $('#user_id').val(),
                        'user_id': $('#userOptiontoo').val(),
                        'user_or_group': option,
                        'group_id': $('#groupOptiontoo').val(),
                        'status': 'pending',
                        'Ids': $("#Idstoo").val(),
                    },
                    success: function(data) {
                        let result = data.trim();
                        if (result == 'success') {
                            //alert('======');
                            swal('Success', 'Campaign added', 'success');
                            $('#txtName').val(''),
                                // $('#email').val(''),
                                $('#txtEditor').val(''),
                                $('#date').val(''),
                                $('#txttime').val('');
                            location.reload();
                        } else {
                            swal('Error', data, 'error');
                        }
                    },
                    error: function(data) {
                        swal('Error', data, 'error');
                    }
                });
            })
            //send email campaign end
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo $BaseUrl ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
        </script>
    </body>

    </html>
<?php
} ?>