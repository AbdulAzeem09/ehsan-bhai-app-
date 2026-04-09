        

    <?php 
    include "../mlayer/_spcontent.class.php"; 
    include "../mlayer/_contact.class.php"; 
    ?>

    <footer >
        <div class="foot">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>The SharePage</h2>
                        <?php
                        $n = new _spcontent;
                        $result3 = $n->read(10);
                        if ($result3) {
                            $row3 = mysqli_fetch_assoc($result3);
                            echo "<p>".$row3['contDesc']."</p>";
                        }
                        ?>
                        
                        <div class="sociallinks">
                            <?php
                            $cn = new _contact;
                            $result4 = $cn->readSocial();
                            if ($result4) {
                                while ($row4 = mysqli_fetch_assoc($result4)) {
                                    ?>
                                    <a href="<?php echo $row4['spSocLink']; ?>" target="_blank" ><i class="<?php echo $row4['spSocIcon']; ?>"></i></a>
                                    <?php
                                }
                            }
                            ?>                            
                        </div>
                    </div>
                    <?php
                    $fh = new _spcontent;
                    $m = new _spAllStoreForm;
                    $i = 1;

                    $result5 = $fh->readFotheading();
                    if ($result5) {
                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            ?>
                            <div class="col-md-2">
                                <h2><?php echo $row5['fh_title']; ?></h2>
                                <?php
                                if ($i == 1) {
                                    ?>
                                    <p><a href="<?php echo $BaseUrl.'/contact.php';?>">Contact Us</a></p>
                                    <?php
                                }
                                $i++;

                                $limit = 5; 
                                $result = $m->readFootPage($row5['fh_id'], $limit);
                                //echo $m->pg->sql;
                                if ($result) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $pageTitle = $row['page_title'];
                                        $linkfot = str_replace(' ', '_', strtolower($pageTitle));
                                        ?>
                                        <p><a href="<?php echo $BaseUrl.'/page/?page='.$linkfot; ?>"><?php echo $pageTitle; ?></a></p>
                                        <?php
                                    }
                                }
                                ?>
                               
                            </div>
                            <?php
                        }
                    } 
                    ?>
                    

                </div>
            </div>
        </div>
        <div class="btm_foot text-center">
            <p>© The SharePage, <?php echo date('Y'); ?> All rights reserved</p>
        </div>
    </footer>
    <script type="text/javascript">
        $(function(){
            $('#carousel-example-generic').carousel({
              interval: 3000
            });

            $('#carousel-example-Newsfees').carousel({
              interval: 4000
            });

            $('#carousel-example-group').carousel({
              interval: 4000
            });

            $('#carousel-example-event').carousel({
              interval: 4000
            });
            
        });
    </script>

        
<?php if(isset($editor_invite)){ ?>
<script> 
$(document).ready(function() {
    // Initialize Quill Editor
    const quill = new Quill('#editor-invite', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                
                
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
               
                
                [{ 'align': [] }]
            ]
        }
    });
});


$(document).ready(function() {
    // Function to validate email
    function isValidEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailPattern.test(email);
    }

    // Handle button click
    $('#sendInviteButton').click(function() {
        const email = $('#invite_email').val();
        const subject = $('#invite_subject').val();
        const message = $('.email-data').html();

        // Validate email
       /* if (!isValidEmail(email)) {
            $("#invite_email_error").focus();
            $('#invite_email_error').html("Please enter a valid email address.");
            return;
        }*/
        $('#invite_email').val('');
        $('#invite_email_error').html('');
        // AJAX request to send_invite_email.php
        $.ajax({
            url: '<?php echo $BaseUrl?>/send_invite_email.php',
            type: 'POST',
            data: {
                email: email,
                subject: subject,
                message: message
            },
            success: function(response) {
                $('#result').html('<p><br>Invitation sent successfully!</p>');
            },
            error: function(xhr, status, error) {
                $('#result').html('<p>An error occurred: ' + error + '</p>');
            }
        });
    });
});


</script>
<?php } ?>