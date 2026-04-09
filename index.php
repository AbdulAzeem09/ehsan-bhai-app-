<?php
session_start();

/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */
include("univ/baseurl.php");
include("backofadmin/library/config.php");

include("backofadmin/library/functions.php");
require_once('common.php');

function sp_autoloader($class)
{
    include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The SharePage - Privacy, Freedom of Speech, and Prosperity</title>
        <link rel="icon" type="image/x-icon" href="../image/logo_jpg.jpg">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="image/bootstrap-4.0.0-dist/css/bootstrap.css">
        <link rel="stylesheet" href="image/bootstrap-4.0.0-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/new-homepage.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/custom.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/time-line.css">
        <script src="<?php echo $BaseUrl?>/assets/js/jquery_3.5.1/jquery.min.js"></script> 

        <style>
            /* Video popup styles for testimonials */
            .video-popup {
                display: none;
                width: 100%;
                height: 100vh;
                margin: auto;
                position: fixed;
                top: 0;
                box-shadow: 10px 10px 10px 10px black;
                z-index: 9999;
                left: auto;
            }
            .popup-bg {
                background: rgba(0,0,0,0.8);
                width: 100%;
                height: 100vh;
                position: absolute;
                left: 0;
            }
            .popup-content {
                background: black;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 800px;
                height: auto;
            }
            .video {
                width: 100%;
                height: 400px;
                margin: auto;
                display: block;
                border: none;
            }
            .close-btn {
                width: 100px;
                height: 50px;
                display: block;
                margin: 30px auto;
                cursor: pointer; 
                border: 2px solid black;
                background-color: white;
            }
            
            /* Testimonial slider styles */
            .testimonial-slider {
                display: flex;
                transition: transform 0.5s ease-in-out;
                gap: 2rem;
            }
            .testimonial-slide {
                min-width: 100%;
                box-sizing: border-box;
            }
            .testimonial-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                text-align: center;
            }
            .testimonial-card img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                margin-bottom: 1rem;
            }
            .testimonial-card h4 {
                font-size: 1.25rem;
                font-weight: 600;
                color: var(--dark-purple);
                margin-bottom: 0.5rem;
            }
            .testimonial-card h5 {
                font-size: 1rem;
                color: var(--primary-purple);
                margin-bottom: 1rem;
            }
            .testimonial-card p {
                color: #6B7280;
                line-height: 1.6;
            }
            
            /* Video testimonial styles */
            .video-testimonial-card {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                text-align: center;
                position: relative;
            }
            .video-testimonial-card img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
            }
            .video-play-btn {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(107, 70, 193, 0.8);
                color: white;
                border: none;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
                cursor: pointer;
                transition: background 0.2s;
            }
            .video-play-btn:hover {
                background: var(--primary-purple);
            }
            
            /* Footer font consistency */
            .foot, .foot h2, .foot h3, .foot p, .foot ul li, .footer-bottom {
                font-family: 'Poppins', sans-serif !important;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <div class="logo-section">
                    <a href="<?php echo $BaseUrl; ?>">
                        <img src="<?php echo $BaseUrl; ?>/assets/images/logo/tsp_trans-SMALL.png" alt="The SharePage Logo" style="width:60px">
                    </a>
                    <div class="logo-text">The SharePage</div>
                    <button class="mobile-toggle" aria-label="Toggle menu" onclick="(function(){var s=document.querySelector('.login-section'); if(!s)return; if(window.matchMedia('(max-width: 768px)').matches){ s.classList.toggle('collapsed'); }})();">
                        <span class="bar"></span>
                    </button>
                    </div>
                <div class="login-section collapsed">
                    <?php if (empty($_SESSION['uid'])) { ?>
                        <form method="post" action="authentication/ajaxLogin.php<?php echo isset($_GET['app']) ? '?app=' . urlencode($_GET['app']) : ''; ?>" class="login-inputs" id="headerLoginForm" role="form">
                            <input type="text" name="spUserEmail" placeholder="Enter username" class="login-input" required>
                            <div class="password-group">
                                <input type="password" name="spUserPassword" placeholder="Enter password" class="login-input" id="headerPassword" required>
                                <button type="button" class="password-toggle" id="toggleHeaderPassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <button type="submit" class="login-btn">LOG IN</button>
                        </form>
                        <a href="<?php echo $BaseUrl; ?>/sign-up.php" class="signup-link">OR SIGN UP</a>
                        <a href="<?php echo $BaseUrl; ?>/forgot-password.php" class="forgot-password">Forgot password?</a>
                    <?php } else { ?>
                        <a href="<?php echo $BaseUrl . '/timeline'; ?>" class="login-btn">My Timeline</a>
                        <a href="<?php echo $BaseUrl . '/authentication/logout.php'; ?>" class="signup-link">Log Out</a>
                         <?php } ?>
                 </div>
            </div>
            <div class="login-error-message" style="display:none; color:#DC2626; background:#FEE2E2; padding:0.60rem; border-radius:0.5rem; font-size:0.875rem;margin-left: 41.8%;margin-top: 6px;"></div>

        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <h1>WELCOME TO OUR COMMUNITY</h1>
                    <h2>Privacy, Freedom Of Speech, And Prosperity In One Place.</h2>
                    <p>A new era of the internet built on ethical & value driven networking, data privacy, content control, creator prosperity, and freedom of speech. Your world, your rules.</p>
                    
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/networking.png" alt="Networking"></div>
                            <h3>Networking</h3>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/e-commerce.png" alt="E-commerce"></div>
                            <h3>E-commerce</h3>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/Global.png" alt="Global Business Directory"></div>
                            <h3>Global Business Directory</h3>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/jobs.png" alt="Jobs"></div>
                            <h3>Jobs</h3>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/freelance.png" alt="Freelancing"></div>
                            <h3>Freelancing</h3>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/consultation.png" alt="Consultation & much more"></div>
                            <h3>Consultation & much more</h3>
                        </div>
                    </div>
                     <?php if (!isset($_SESSION['uid'])) { ?>
                        <button class="learn-more-btn" onclick="location.href='<?php echo $BaseUrl; ?>/page/howtos.php?page=howtos'">LEARN MORE</button>
                    <?php } else {?>
                        <button class="learn-more-btn" onclick="location.href='<?php echo $BaseUrl; ?>/timeline'">LEARN MORE</button>
                    <?php } ?>
                     </div>
                <div class="hero-illustration">
                    <img src="<?php echo $BaseUrl; ?>/assets/new/bannerImage.png" alt="The SharePage Community" class="hero-image" />
                            </div>
            </div>
        </section>

        <!-- Core Principles Section -->
        <section class="core-principles principles-section">
            <div class="core-principles-container">
                <h2>Our Core Principles</h2>
                <p>Built on the foundation of privacy, prosperity, and freedom of speech - creating a platform where you can thrive without compromise</p>
                
                <div class="principles-grid">
                    <div class="principle-card purple">
                        <div class="principle-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/Shield.png" alt="Privacy of Personal Data" /></div>
                        <h3>Privacy of<br>Personal Data</h3>
                        <div class="principle-tag">100% Data Protection</div>
                        <p>Your personal information is encrypted and protected with military-grade security. We never sell or share your data with third parties.</p>
                </div>
                    <div class="principle-card green">
                        <div class="principle-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/Icon.png" alt="Privacy of Content Sharing" /></div>
                        <h3>Privacy of<br>Content Sharing</h3>
                        <div class="principle-tag">Your Content, Your Rules</div>
                        <p>You control who sees your content. Multiple profiles and advanced privacy settings let you share with confidence and maintain complete control.</p>
                                    </div>
                    <div class="principle-card orange">
                        <div class="principle-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/Message square.png" alt="Freedom of Speech" /></div>
                        <h3>Freedom of<br>Speech</h3>
                        <div class="principle-tag">Speak Freely, Stay Safe</div>
                        <p>Express yourself freely in a safe unbiased environment. We protect your right to speak while ensuring respectful discourse.</p>
                                </div>
                    <div class="principle-card blue">
                        <div class="principle-icon"><img src="<?php echo $BaseUrl; ?>/assets/new/Vector 903.png" alt="Prosperity & Growth" /></div>
                        <h3>Prosperity &<br>Growth</h3>
                        <div class="principle-tag">Create Passive Income</div>
                        <p>Build wealth through our secure platform without any upfront cost. Freely earn passive income without any upfront investment.</p>
                        </div>
                </div>
            </div>
        </section>

        <!-- Who is The SharePage for Section -->
        <section class="target-audience">
            <div class="target-audience-container">
                <h2>Who Is The SharePage For?</h2>
                <p>The SharePage is for a wide range of individuals and businesses who want to connect, collaborate, and grow.</p>
                
                <div class="audience-grid">
                    <div class="audience-card highlight">
                        <h3>Individuals <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>People looking for safe, private and focused networking and communication without intrusive ads.</li>
                            <li>Users who want to buy, sell or advertise products/services at no cost.</li>
                        </ul>
                </div>
                    <div class="audience-card">
                        <h3>Businesses <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>Companies looking to create multiple profiles to promote different products or services.</li>
                            <li>Be part of the business global directory for greater brand visibility and world-wide opportunities.</li>
                        </ul>
                    </div>
                    <div class="audience-card">
                        <h3>Freelancers <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>Promote your skills and services to attract new clients worldwide.</li>
                            <li>Use The SharePage as a portfolio hub to build trust and credibility.</li>
                                </ul>
                            </div>
                    <div class="audience-card">
                        <h3>Professionals <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>Expand your network across industries and connect with like-minded peers.</li>
                            <li>Showcase expertise to gain recognition and new opportunities.</li>
                                </ul>
                            </div>
                    <div class="audience-card">
                        <h3>Communities <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>Engage members and create awareness for social or cultural causes.</li>
                            <li>Share events and initiatives to grow participation and support.</li>
                        </ul>
                        </div>
                    <div class="audience-card">
                        <h3>Organizations <i class="fas fa-arrow-right audience-arrow"></i></h3>
                        <ul>
                            <li>Highlight mission and activities to increase outreach and impact.</li>
                            <li>Connect with potential partners, donors, and collaborators.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Join Community Section -->
        <section class="join-community">
            <div class="join-community-container">
                <div class="community-content">
                    <h2>Join The SharePage Community</h2>
                    <p>Experience true freedom with complete privacy protection and unlimited earning potential.</p>
                    
                    <div class="benefit-boxes">
                        <div class="benefit-box">
                            <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="benefit-text">
                                <h4>Military-Grade Security</h4>
                                <p>Your personal data will never be sold to third-parties.</p>
                        </div>
                    </div>
                        <div class="benefit-box">
                            <div class="benefit-icon"><i class="fas fa-lock"></i></div>
                            <div class="benefit-text">
                                <h4>Content Privacy Control</h4>
                                <p>You decide who sees what you share.</p>
                            </div>
                        </div>
                            </div>
                        </div>
                
                <div class="login-form-section">
                    <h3>LOGIN TO YOUR ACCOUNT</h3>
                    <?php
                        $appParam = isset($_GET['app']) ? '?app=' . urlencode($_GET['app']) : '';
                    ?>
                    <form id="blogin" method="post" action="authentication/verifylogin_new.php<?php echo $appParam; ?>" autocomplete="off">
                        <div class="login-error-message" style="display:none; color:#DC2626; background:#FEE2E2; padding:1rem; border-radius:0.5rem; margin-bottom:1rem; font-size:0.875rem;"></div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="loginame" placeholder="name@example.com" name="spUserEmail" autofocus autocomplete="off" required class="form-input">
                            </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-group">
                                <input type="password" required placeholder="Password" id="lpass" name="spUserPassword" autocomplete="current-password" class="form-input">
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                        </div>
                    </div>
                        
                        <?php
                            if (isset($_GET['msg'])) {
                                if ($_GET['msg'] == 'regsuccess') { ?>
                                    <div style="background: #D1FAE5; color: #065F46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                                        Successfully Registered! Proceed to login.
                </div>
                                <?php } ?>
                                <?php
                                if ($_GET['msg'] == 'not_verified') { ?>
                                    <div style="background: #FEF3C7; color: #92400E; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;" id="emailNotVerifiedMsg">
                                        <strong>Warning!</strong> Your email is not verified. <a href="#" id="resendVerificationLink" style="color: #6B46C1; text-decoration: underline; cursor: pointer;" data-email="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">Click here</a> to resend the verification email. Please verify your email to continue.
                </div>
                                <?php }  ?>
                                <?php
                                if ($_GET['msg'] == 'wrong') {
                                ?>
                                    <div style="background: #FEE2E2; color: #991B1B; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                                        Email Not Verified!
                    </div>
                                <?php }
                            } ?>
                        <?php if ((isset($_GET['msg'])) && ($_GET['msg'] == 'wrongpass')) { ?>
                        <div style="color: #DC2626; margin-bottom: 1rem;">Incorrect email or password! Please try again.</div>
                        <?php } ?>
                        
                        <div class="form-options">
                            <div class="remember-me">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                            <a href="<?php echo $BaseUrl; ?>/forgot-password.php" style="color: #6B46C1;">Forgot password?</a>
                        </div>

                        <button type="submit" class="signin-btn">SIGN IN</button>
                        <a href="<?php echo $BaseUrl; ?>/sign-up.php" class="register-link">Don't have an account? Register now!</a>
                    </form>
                </div>
            </div>
        </section>

        <!-- Multiples Profiles Section -->
        <section class="multiples-profiles">
            <div class="multiples-profiles-container">
                <div class="multiples-profiles-header">
                    <h2>Maintain Your Privacy</h2>
                    <h3>With Multiple Profiles</h3>
                </div>

                <img src="<?php echo $BaseUrl; ?>/assets/new/largeShield.png" alt="Shield" class="large-shield-decor" />

                <div class="profiles-illustration">
                    <img src="<?php echo $BaseUrl; ?>/assets/new/maintain.png" alt="Maintain your privacy with multiple profiles" style="max-width: 100%; height: auto;">
                </div>
                <div class="profiles-content">
                    <ul class="profiles-list">
                        <li><i class="fas fa-check profile-check"></i> Business Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Professional Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Freelancer Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Employment Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Dating Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Family Profile</li>
                        <li><i class="fas fa-check profile-check"></i> Personal Profile</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        
        <?php  include_once("views/common/footer.php"); ?>                        
        

        <!-- Footer -->
        <!-- <footer class="footer">
            <div class="footer-container">
                <div class="footer-section">
                    <h4>The SharePage</h4>
                    <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 1rem;">Welcome to the SharePage! Your one-stop shop for social and ecommerce platforms! Socialize in confidence while exploring multiple streams of income opportunities waiting for you!</p>
                            </div>  
                <div class="footer-section">
                    <h4>Objective</h4>
                    <ul>
                        <li><a href="<?php echo $BaseUrl; ?>/contact.php">Contact Us</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>">The SharePage</a></li>
                    </ul>
                            </div>
                <div class="footer-section">
                    <h4>Guide</h4>
                    <ul>
                        <li><a href="<?php echo $BaseUrl; ?>/page/?page=referral__commissions">SharePage Navigation</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>">Business Profile</a></li>
                    </ul>
                        </div>
                <div class="footer-section">
                    <h4>Our Policies</h4>
                    <ul>
                        <li><a href="<?php echo $BaseUrl; ?>/copyrights">Copyrights</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/privacy">Privacy Policy</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/legal">Terms and Condition</a></li>
                    </ul>
                    </div>
                <div class="footer-section">
                    <h4>Offerings</h4>
                    <ul>
                        <li><a href="<?php echo $BaseUrl; ?>/page/?page=investment_opportunities">Investment Opportunities</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/page/?page=referral__commissions">Referral Commissions</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>">Sp Points</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>">We are Different</a></li>
                    </ul>
                                                            </div>
                                                        </div>
            <div class="footer-copyright">
                <p>The SharePage, 2025 All rights reserved</p>
                                                    </div>
        </footer> -->

        <!-- Video Popup -->
        <div class="video-popup" id="showpopi">
        <div class="popup-bg"></div>
        <div class="popup-content">
                <iframe src="" id="viddeo" class="video"></iframe>
                <button class="close-btn" onclick="closePop()">close</button>
        </div>
        </div>

        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery_3.5.1/jquery.min.js"></script>                            

        <script>
            // Password toggle functionality for main login form
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#lpass');

            if (togglePassword && password) {
            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye-slash');
            });
            }

            // Password toggle functionality for header login form
            const toggleHeaderPassword = document.querySelector('#toggleHeaderPassword');
            const headerPassword = document.querySelector('#headerPassword');

            if (toggleHeaderPassword && headerPassword) {
                toggleHeaderPassword.addEventListener('click', function (e) {
                    const type = headerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    headerPassword.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }

            // Video popup functionality
            function playVideo(videoUrl) {
                var videoFrame = document.getElementById('viddeo');
                videoFrame.src = '';
                document.getElementById('showpopi').style.display = "block";
                var videoFrame = document.getElementById('viddeo');
                videoFrame.src = videoUrl;
            }

            function closePop(){
                var videoFrame = document.getElementById('viddeo');
                videoFrame.src = '';
                document.getElementById('showpopi').style.display = "none";
            }

            // Testimonial slider functionality
            let currentTestimonialIndex = 0;
            const testimonialSlider = document.getElementById('testimonialSlider');
            const totalTestimonials = document.querySelectorAll('.testimonial-slide').length;

            function nextTestimonial() {
                currentTestimonialIndex = (currentTestimonialIndex + 1) % totalTestimonials;
                updateTestimonialSlider();
            }

            function prevTestimonial() {
                currentTestimonialIndex = (currentTestimonialIndex - 1 + totalTestimonials) % totalTestimonials;
                updateTestimonialSlider();
            }

            function updateTestimonialSlider() {
                const translateValue = -currentTestimonialIndex * 100 + '%';
                testimonialSlider.style.transform = 'translateX(' + translateValue + ')';
            }

            // Always start at top on page load/refresh
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            window.addEventListener('load', function() {
                setTimeout(function(){ window.scrollTo({ top: 0, left: 0, behavior: 'auto' }); }, 0);
            });
            window.addEventListener('beforeunload', function() {
                window.scrollTo(0, 0);
            });

            // AJAX Login functionality for header form
            $(document).ready(function() {
                $('#headerLoginForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    var $form = $(this);
                    var $errorDiv = $('.login-error-message').eq(0);

                    var $submitBtn = $form.find('button[type="submit"]');
                    var originalBtnText = $submitBtn.text();
                    
                    // Hide previous errors
                    $errorDiv.hide().text('');
                    
                    // Disable submit button
                    $submitBtn.prop('disabled', true).text('Logging in...');
                    
                    // Get form data
                    var formData = $form.serialize();
                    var actionUrl = $form.attr('action');
                    
                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Redirect on success
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.reload();
                                }
                            } else {
                                // Show error message
                                var errorMsg = response.message || 'An error occurred. Please try again.';
                                
                                // If it's a not_verified error, make "Click here" clickable
                                if (response.error_type === 'not_verified' && response.email) {
                                    errorMsg = errorMsg.replace('Click here', '<a href="#" class="resend-verification-link" data-email="' + response.email + '" style="color: #6B46C1; text-decoration: underline; cursor: pointer;">Click here</a>');
                                    $errorDiv.html(errorMsg).css("display", "inline-block").show();
                                } else {
                                    $errorDiv.text(errorMsg).css("display", "inline-block").show();
                                }
                                
                                $submitBtn.prop('disabled', false).text(originalBtnText);
                                
                                // If there's a redirect URL in error response, redirect after a delay
                                // if (response.redirect) {
                                //     setTimeout(function() {
                                //         window.location.href = response.redirect;
                                //     }, 2000);
                                // }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle non-JSON responses (fallback for non-AJAX requests)
                            if (xhr.responseText && xhr.responseText.trim() !== '') {
                                try {
                                    var response = JSON.parse(xhr.responseText);
                                    if (response.message) {
                                        $errorDiv.text(response.message).show();
                                    } else if (response.redirect) {
                                        window.location.href = response.redirect;
                                        return;
                                    }
                                } catch(e) {
                                    // If response is not JSON, it might be a redirect
                                    // Let the browser handle it naturally
                                    window.location.href = actionUrl;
                                    return;
                                }
                            } else {
                                $errorDiv.text('An error occurred. Please try again.').show();
                            }
                            $submitBtn.prop('disabled', false).text(originalBtnText);
                        }
                    });
                });

                // AJAX Login functionality for main login form
                $('#blogin').on('submit', function(e) {
                    e.preventDefault();
                    
                    var $form = $(this);
                    var $errorDiv = $('.login-error-message').eq(1);
                    var $submitBtn = $form.find('button[type="submit"]');
                    var originalBtnText = $submitBtn.text();
                    
                    // Hide previous errors
                    $errorDiv.hide().text('');
                    
                    // Disable submit button
                    $submitBtn.prop('disabled', true).text('Signing in...');
                    
                    // Get form data
                    var formData = $form.serialize();
                    var actionUrl = $form.attr('action');
                    
                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Redirect on success
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.reload();
                                }
                            } else {
                                // Show error message
                                var errorMsg = response.message || 'An error occurred. Please try again.';
                                
                                // If it's a not_verified error, make "Click here" clickable
                                if (response.error_type === 'not_verified' && response.email) {
                                    errorMsg = errorMsg.replace('Click here', '<a href="#" class="resend-verification-link" data-email="' + response.email + '" style="color: #6B46C1; text-decoration: underline; cursor: pointer;">Click here</a>');
                                    $errorDiv.html(errorMsg).show();
                                } else {
                                    $errorDiv.text(errorMsg).show();
                                }
                                
                                $submitBtn.prop('disabled', false).text(originalBtnText);
                                
                                // Scroll to error message
                                $('html, body').animate({
                                    scrollTop: $errorDiv.offset().top - 100
                                }, 500);
                                
                                // If there's a redirect URL in error response, redirect after a delay
                                if (response.redirect) {
                                    setTimeout(function() {
                                        window.location.href = response.redirect;
                                    }, 2000);
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle non-JSON responses (fallback for non-AJAX requests)
                            if (xhr.responseText && xhr.responseText.trim() !== '') {
                                try {
                                    var response = JSON.parse(xhr.responseText);
                                    if (response.message) {
                                        $errorDiv.text(response.message).show();
                                        $('html, body').animate({
                                            scrollTop: $errorDiv.offset().top - 100
                                        }, 500);
                                    } else if (response.redirect) {
                                        window.location.href = response.redirect;
                                        return;
                                    }
                                } catch(e) {
                                    // If response is not JSON, it might be a redirect
                                    // Let the browser handle it naturally
                                    window.location.href = actionUrl;
                                    return;
                                }
                            } else {
                                $errorDiv.text('An error occurred. Please try again.').show();
                                $('html, body').animate({
                                    scrollTop: $errorDiv.offset().top - 100
                                }, 500);
                            }
                            $submitBtn.prop('disabled', false).text(originalBtnText);
                        }
                    });
                });

                // Handle resend verification email click
                $(document).on('click', '.resend-verification-link, #resendVerificationLink', function(e) {
                    e.preventDefault();
                    var $link = $(this);
                    var email = $link.data('email');
                    
                    if (!email) {
                        alert('Email address not found.');
                        return;
                    }
                    
                    // Disable link and show loading
                    $link.css('pointer-events', 'none').text('Sending...');
                    
                    $.ajax({
                        url: '<?php echo $BaseUrl; ?>/authentication/ajaxResendVerification.php',
                        type: 'POST',
                        data: { email: email },
                        dataType: 'json',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            if (response.success) {
                                $link.text('Email sent!').css('color', '#059669');
                                setTimeout(function() {
                                    $link.text('Click here').css('color', '#6B46C1').css('pointer-events', 'auto');
                                }, 3000);
                            } else {
                                alert(response.message || 'Failed to send verification email. Please try again.');
                                $link.text('Click here').css('pointer-events', 'auto');
                            }
                        },
                        error: function() {
                            alert('An error occurred. Please try again.');
                            $link.text('Click here').css('pointer-events', 'auto');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
