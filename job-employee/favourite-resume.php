<?php
//require_once('../common.php');
include('../univ/baseurl.php');
session_start();
include "check_job_employee.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-employee/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/'. $class .'.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $category = $_GET['category'] ?? null;
    $keyword = $_GET['keyword'] ?? null;
    $records_per_page = (isset($_GET['per_page'])) ? $_GET['per_page'] : 10;
    // Get the current page number from URL, default to 1 if not set
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;
    ?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'favourite-resume'; ?>
<link rel="stylesheet" href="./job-employee.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                    <div class="main-body">
                        <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <img src='../assets/images/menu-icon-2.svg'>
                        </button>
                        <div class="main-heading">
                            Favourite Resume
                        </div>
                        <div class="resume-wrapper">
                            <div class="filter-2 filters company-news-filter">
                                <form id="filter-form" method="get" action="">
                                    <div class="left">
                                        <div class="input-group">
                                            <label>Search Keyword<span style="color: #EF1D26;">*</span></label>
                                            <input type="text" name="keyword" value="<?= $_GET['keyword'] ?? '';?>" placeholder="Search Job by keyword">
                                        </div>
                                        <div class="input-group">
                                            <label>Job Category<span style="color: #EF1D26;">*</span></label>
                                            <select class="form-select" aria-label="Default select example" name="category" id="category">
                                                <option value="" selected>Select Job Category</option>
                                                <?php
                                                    $co = new _subcategory;
                                                    $result3 = $co->read(2);
                                                    if ($result3 != false) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                                    ?>
                                                        <option value='<?php echo $row3['idsubCategory']; ?>' <?php echo ( isset($_GET['category']) && $_GET['category'] == $row3['idsubCategory'] ? "selected" : $pre_data['spCategories_idspCategory'].'-'.$row3['idsubCategory'] ) ?>
                                                    >
                                                    <?php echo $row3['subCategoryTitle']; ?>
                                                    </option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="per_page" name="per_page" value="<?= (isset($_GET['per_page'])) ? $_GET['per_page'] : 10;?>">
                                        <input type="hidden" id="page" name="page" value="<?= $page ?>">
                                        <div class="input-group">
                                            <button type="submit" id="filter_submit" value="submit" class="clear" name="submit" style="border-radius: 75px">Filter</button>
                                            <a href="<?php echo $BaseUrl . '/job-employee/browse-resume.php'; ?>" style="margin-left:5px">Clear</a>
                                        </div>
                                    </div>
                                </form>
                                <?php include "../change_location.php"; ?>
                            </div>

                            <div class="resume-list">
                                <?php 
                                    $cl = new _resumeget;
                                    $dsf = $cl->browseFavResume( $_SESSION['uid'], $keyword, $category);
                                    $totalPages = $cl->browseFavResumeCount($_SESSION['uid']);
                                    if ($dsf && $dsf->num_rows > 0) {
                                        while ($row = $dsf->fetch_assoc()) {
                                            $sfill = (!empty($row['save'])) ? '-fill' : '';
                                            $ffill = (!empty($row['fav'])) ? 'fav-fill' : 'fav-2';
                                            $sStatus = (!empty($row['save'])) ? $row['save'] : 0;
                                            $fStatus = (!empty($row['fav'])) ? $row['fav'] : 0;
                                            $em = new _spemployment_profile;
                                            $profile = $em->read($row['pid']);
                                            if ($profile != false)
                                            {
                                                $profile = mysqli_fetch_assoc($profile);
                                            }
                                            $conn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
                                            $sql = "SELECT tbl_country.country_title,tbl_state.state_title, tbl_city.city_title  
                                                FROM spprofiles
                                                left join tbl_country on tbl_country.country_id = ".$_SESSION['Countryfilter']."
                                                left join tbl_state on tbl_state.state_id = ".$_SESSION['Statefilter']."
                                                left join tbl_city on tbl_city.city_id = ".$_SESSION['Cityfilter']."
                                                ";
                                            
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                $locationData = mysqli_fetch_assoc($result);
                                            }
                                            // echo "<pre>"; print_r($locationData);die();
                                    ?>
                                        <div class="resume">
                                            <div class="img-wrapper">
                                                <?php if(!empty($row['spProfilePic'])){ ?>
                                                    <img src="<?= $row['spProfilePic']; ?>" alt="" width="100" height="100">
                                                <?php } else{ ?>
                                                    <img src="./images/user-01.svg" alt="">
                                                <?php } ?>
                                            </div>
                                            <div class="detail">
                                                <div class="fav-icon" style="top:20px;">
                                                    <img src="./images/save<?= $sfill ?>.svg" alt="" onclick="updateStatus(<?= $sStatus?>, <?= $row['pid'] ?>, 'save');">
                                                    <img src="./images/<?= $ffill ?>.svg" alt="" onclick="updateStatus(<?= $fStatus?>, <?= $row['pid'] ?>, 'fav');">
                                                </div>
                                                <div class="name" title="<?= htmlspecialchars($row['spProfileName']); ?>"><?php echo (strlen($row['spProfileName']) <= 10) ? $row['spProfileName']:  substr(htmlspecialchars($row['spProfileName']),0,18).'...'; ?></div>
                                                <?php if($profile) { ?>
                                                    <div class="tagline" title="<?= $profile['profile_tagline']; ?>">
                                                    <?php echo (strlen($profile['profile_tagline']) <= 60) ? $profile['profile_tagline']:  substr(htmlspecialchars($profile['profile_tagline']),0,60).'...'; ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="skills">
                                                    <div class="skill-img">
                                                        <img src="./images/career.svg" alt="">
                                                    </div>
                                                    <div class="title">
                                                        <span>Career In: </span>
                                                        <?= $row['subCategoryTitle']; ?>
                                                    </div>
                                                </div>
                                                <?php if($profile) { ?>
                                                    <div class="skills">
                                                        <div class="title" title="<?= $profile['skill']; ?>">
                                                            <?php echo (strlen($profile['skill']) <= 60) ? $profile['skill']:  substr(htmlspecialchars($profile['skill']),0,60).'...'; ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($locationData)) { ?>
                                                <div class="skills">
                                                    <div class="skill-img">
                                                        <img src="./images/location.svg" alt="">
                                                    </div>
                                                    <div class="title">
                                                        <span><?= $locationData['country_title'] ?>,</span>
                                                        <span><?= $locationData['state_title'] ?></span>,
                                                        <span><?= $locationData['city_title'] ?></span>,
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <button class="view-btn" onclick="viewProfile(<?= $row['pid']?>);">
                                                    View Profile
                                                </button>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align: center;">No Resume available</td></tr>';
                                    }
                                ?>	
                            </div>    
                            
                            <?php if ($dsf && $dsf->num_rows > 0) { 
                                
                                $total_records = $totalPages->num_rows;
                                $total_pages = ceil($total_records / $records_per_page);
                            ?>
                                <div class="pagination">
                                    <div class="items">
                                        <div class="title">
                                            Show
                                        </div>
                                        <select class="form-select" aria-label="Default select example" id="pagination-per-page">
                                            <option <?php if(isset($_GET['per_page']) && $_GET['per_page'] == 10){ echo "selected";}?> value="10">10</option>
                                            <option <?php if(isset($_GET['per_page']) && $_GET['per_page'] == 20){ echo "selected";}?> value="20">20</option>
                                            <option <?php if(isset($_GET['per_page']) && $_GET['per_page'] == 50){ echo "selected";}?> value="50">50</option>
                                            <option <?php if(isset($_GET['per_page']) && $_GET['per_page'] == 100){ echo "selected";}?> value="100">100</option>
                                        </select>
                                        <div class="title">Items</div>
                                    </div>
                                    <div class="list">
                                        <?php if ($page > 1) {?>
                                            <div class="box pagination-link" data-page= "<?= ($page - 1) ?>">
                                                Previous
                                            </div>

                                        <?php } ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $page) { ?>
                                                <div class="box exect active pagination-link" data-page="<?= $i?>">
                                                    <?= $i ?>
                                                </div>
                                        <?php } else { ?>
                                            <div class="box exect pagination-link" data-page="<?= $i ?>">
                                                <?= $i?>
                                            </div>
                                        <?php } } ?>

                                        <?php if ($page < $total_pages) {?>
                                            <div class="box pagination-link" data-page="<?= ($page + 1) ?>">
                                                Next &raquo;
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../views/common/footer.php"; ?>
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>

    <script>
        $(document).ready(function(){
            $("#pagination-per-page").change(function(){
                var per_page = $('#pagination-per-page option:selected').val();
                $("#per_page").val(per_page);
                $("#filter_submit").trigger('click');
            });

            $(".pagination-link").click(function(){
                var per_page = $(this).data('page');
                $("#page").val(per_page);
                $("#filter_submit").trigger('click');
            }); 
        })

        function viewProfile(pid){
            window.location.href = '/friends/?profileid='+pid;
        }

        function updateStatus(status, pid, type){
            $.ajax({
                url: 'update_resume_status.php',
                type: "POST",
                data: {
                    status: status,
                    pid:pid,
                    type:type
                },
                success: function(response) {
                    if(response == 1){
                        alert('Resume status updated.');
                        location.reload();
                    }
                }
            });
        }
    </script>
</body>

</html>
<?php
}
?>