<style>
.nav-link.active {
    background-color: #7549b317;
    opacity: 1;
}
.nav-link {
    padding: 15px;
    border-radius: 5px;
}
@media (max-width: 768px) {
    nav {
        position: absolute !important;
        background: #fff;
        z-index: 9999;
        padding: 0px !important;
    }
}
.custom-nav {
    padding: 15px;
    background-color: #FAFAFC;
    border: 1px solid #D9DCE0;
    border-radius: 8px;
}
</style>
<script>
document.addEventListener('click', function(event) {
    var nav = document.querySelector('nav');
    var isClickInsideNav = nav.contains(event.target);

    if (!isClickInsideNav) {
        var navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        }
    }
});
</script>
<nav class="navbar navbar-expand-lg custom-nav" style='align-self: baseline;'>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'dashboard' ? 'active' : '') ?>" href="dashboard.php">
                    <img src="./images/dashboard.svg" alt="" class="me-2">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'post-a-job' ? 'active' : '') ?>" href="post-a-job.php">
                    <img src="./images/post-a-job.svg" alt="" class="me-2">
                    Post a Job
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'active-jobs' ? 'active' : '') ?>" href="active-jobs.php">
                    <img src="./images/active-job.svg" alt="" class="me-2">
                    Active Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'draft-jobs' ? 'active' : '') ?>" href="draft-jobs.php">
                    <img src="./images/draft-job.svg" alt="" class="me-2">
                    Draft Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'flagged-jobs' ? 'active' : '') ?>" href="flagged-jobs.php">
                    <img src="./images/flag-job.svg" alt="" class="me-2">
                    Flagged Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'forwarded-jobs' ? 'active' : '') ?>" href="forwarded-jobs.php">
                    <img src="./images/forword-job.svg" alt="" class="me-2">
                    Forwarded Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'expired-jobs' ? 'active' : '') ?>" href="expired-jobs.php">
                    <img src="./images/expire.svg" alt="" class="me-2">
                    Expired Jobs
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'browse-resume' ? 'active' : '') ?>" href="browse-resume.php">
                    <img src="./images/borwse-job.svg" alt="" class="me-2">
                    Browse Resume
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'saved-resume' ? 'active' : '') ?>" href="saved-resume.php">
                    <img src="./images/save-resume.svg" alt="" class="me-2">
                    Saved Resume
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'favourite-resume' ? 'active' : '') ?>" href="favourite-resume.php">
                    <img src="./images/favouit-resume.svg" alt="" class="me-2">
                    Favourite Resume
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $BaseUrl.'/job-board/index.php' ?>">
                    <img src="./images/return-to-home.svg" alt="" class="me-2">
                    Return To Home
                </a>
            </li>
        </ul>
    </div>
</nav>