<style>
.nav-link.active{
    background-color: #7549b317;
    opacity: 1;
}
.nav-link{
    padding: 15px;
    border-radius: 5px;
}
@media (max-width: 768px) {
    nav{position: absolute !important;
    background: #fff;
    z-index: 9999;
    padding:0px !important;
    }
    
}
.custom-nav{
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
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'draft-application' ? 'active' : '') ?>" href="draft-application.php">
                        <img src="./images/post-a-job.svg" alt="" class="me-2">
                        Draft Application
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'applied-jobs' ? 'active' : '') ?>" href="applied-jobs.php">
                        <img src="./images/active-job.svg" alt="" class="me-2">
                        Applied Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'saved-jobs' ? 'active' : '') ?>" href="saved-jobs.php">
                        <img src="./images/saved-job.svg" alt="" class="me-2">
                        Saved Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'forwarded-jobs' ? 'active' : '') ?>" href="forwarded-jobs.php">
                        <img src="./images/forword-job.svg" alt="" class="me-2">
                        Forwarded Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'recommended-jobs' ? 'active' : '') ?>" href="recommended-jobs.php">
                        <img src="./images/expire.svg" alt="" class="me-2">
                        Recommended Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'my-resume' ? 'active' : '') ?>" href="my-resume.php">
                        <img src="./images/borwse-job.svg" alt="" class="me-2">
                        My Resume
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($job_seeker_nav) && $job_seeker_nav == 'my-cover-letters' ? 'active' : '') ?>" href="my-cover-letters.php">
                        <img src="./images/cover-letter.svg" alt="" class="me-2">
                        My Cover Letters
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BaseUrl.'/job-board/index.php' ?>">
                        <img src="./images/return-to-home.svg" alt="" class="me-2">
                        Return To Home
                    </a>
                </li>
            </ul>
        </div>
    
</nav>