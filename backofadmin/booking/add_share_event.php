<?php
 
 session_start();

 // Retrieve stored data and errors, if available
 $form_data = $_SESSION['form_data'] ?? [];
//  print_r($form_data);
 $form_errors = $_SESSION['form_errors'] ?? [];
//  print_r($form_errors);
 
 // Clear the session data once it's retrieved
 unset($_SESSION['form_data'], $_SESSION['form_errors']);
 print_r($_SESSION['form_data']);
require_once '../library/config.php';
require_once '../library/functions.php';
error_reporting(0);
@ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
    }

        
if (isset($_GET['clearError'])) {
    // Clear only the error message
    unset($_SESSION['errorMessage']);
    echo 'Error message cleared';
    exit(); // Stop further execution after handling the AJAX request
}

$errorMessage = (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage'] != '') ? $_SESSION['errorMessage'] : '';
$tbl_country_sql = "SELECT * FROM tbl_country";
$tbl_country_result = dbQuery($dbConn, $tbl_country_sql);	

$sharepage_event_category_sql = "SELECT * FROM sharepage_event_category";
$sharepage_event_category_result = dbQuery($dbConn, $sharepage_event_category_sql);	


?>
<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>

<script type="text/javascript">		
    window.onload = function(){
        // Automatically calculates the editor base path based on the _samples directory.
        // This is usefull only for these samples. A real application should use something like this:
        // oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
        var sBasePath = '../fckeditor/' ;
        var oFCKeditor = new FCKeditor( 'event_content' ) ;
        oFCKeditor.BasePath	= sBasePath ;
        oFCKeditor.Height = 230; 
        oFCKeditor.ReplaceTextarea() ;
    }
</script>	
	
<section class="content-header top_heading">
    <h1>Add Share Event</h1>
</section>
<section class="content">
    <?php 
        if(isset($errorMessage) && $errorMessage != ''){
            ?>
            <div id="timerAlert" class="alert alert-danger alert-dismissible fade " role="alert"  style="opacity: 1;">
                <?= $errorMessage?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    ?>
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="share_processArtRag.php?action=add" enctype="multipart/form-data" onsubmit="return validate(this)">
        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
                        if ($_SESSION['count'] <= 1) {
                            $_SESSION['count'] += 1; ?>
                            <div class="alert alert-<?php echo $_SESSION['data'];?>">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_SESSION['errorMessage']; ?>
                            </div>
                            <?php unset($_SESSION['errorMessage']); } } ?>
                </div>

                <div class="row">
                    <!-- Other Form Fields -->
  <!-- Title Field -->
  <div class="col-md-4" style="margin-bottom: 20px;">
                    <label for="event_title">Title:</label>
                    <input type="text" name="event_title" id="event_title" class="form-control" 
                           value="<?= isset($form_data['event_title']) ? htmlspecialchars($form_data['event_title']) : ''; ?>" />
                </div>

                <!-- Category Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label for="event_category">Category:</label>
                    <select name="event_category" id="event_category" class="form-control">
                        <option value="">--Select Category--</option>
                        <?php while ($data = dbFetchAssoc($sharepage_event_category_result)) { ?>
                            <option value="<?= htmlspecialchars($data['category_title']); ?>"
                                <?= isset($form_data['event_category']) && $form_data['event_category'] == $data['category_title'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($data['category_title']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Venue Name Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label for="venue_name">Venue Name:</label>
                    <input type="text" name="venue_name" id="venue_name" class="form-control" 
                           value="<?= isset($form_data['venue_name']) ? htmlspecialchars($form_data['venue_name']) : ''; ?>"/>
                </div>

                <!-- Event Content -->
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <label>Event Content:</label>
                    <textarea name="event_content" id="event_content" class="form-control" rows="3"><?= isset($form_data['event_content']) ? htmlspecialchars($form_data['event_content']) : ''; ?></textarea>
                </div>

                <!-- Venue Address Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label for="venue_address">Venue Address:</label>
                    <input type="text" name="venue_address" id="venue_address" class="form-control" 
                           value="<?= isset($form_data['venue_address']) ? htmlspecialchars($form_data['venue_address']) : ''; ?>"/>
                </div>

                <!-- Country Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label>Country:</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">--Select Country--</option>
                        <?php while ($data = dbFetchAssoc($tbl_country_result)) { ?>
                            <option value="<?= htmlspecialchars($data['country_title']); ?>"
                                data-country_id="<?= htmlspecialchars($data['country_id']); ?>"
                                <?= isset($form_data['country']) && $form_data['country'] == $data['country_title'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($data['country_title']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Province Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <input type="hidden" id="province_error_valid"  value="<?= isset($form_data['province']) ? htmlspecialchars($form_data['province']) : ''; ?>"/>
                    <label>Province:</label>
                    <select name="province" id="province" class="form-control" disabled>
                        <!-- Add options dynamically with JavaScript if needed -->
                    </select>
                </div>

                <!-- City Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                <input type="hidden" id="city_error_valid"  value="<?= isset($form_data['city']) ? htmlspecialchars($form_data['city']) : ''; ?>"/>
                    <label>City:</label>
                    <select name="city" id="city" class="form-control" disabled>
                        <!-- Add options dynamically with JavaScript if needed -->
                    </select>
                </div>

                <!-- Postal Code Field -->
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label for="postal_code">Postal Code:</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control" 
                           value="<?= isset($form_data['postal_code']) ? htmlspecialchars($form_data['postal_code']) : ''; ?>" />
                </div>
                <div   div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"value="<?= isset($form_data['start_date']) ? htmlspecialchars($form_data['start_date']) : ''; ?>" />
                        </div>
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"  value="<?= isset($form_data['end_date']) ? htmlspecialchars($form_data['end_date']) : ''; ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <label for="start_time">Start Time:</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" value="<?= isset($form_data['start_time']) ? htmlspecialchars($form_data['start_time']) : ''; ?>" />
                        </div>            
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <label for="end_time">End Time:</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" value="<?= isset($form_data['end_time']) ? htmlspecialchars($form_data['end_time']) : ''; ?>" />
                        </div>
                    </div>
                </div>                
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label for="event_header_image">Header Image:</label>
                        <input type="file" name="event_header_image" id="event_header_image" class="form-control" accept=".jpg, .jpeg, .png"/>                        
                        <span class="size-message" style="color: red;">Note: Image must be 1700 x 400 pixels.</span>
                        <span class="size-message" style="color: red;display:<?= isset($form_errors['eventHeaderErrorMessage']) ? 'block':'none';?>;"><?= isset($form_errors['eventHeaderErrorMessage']) ? htmlspecialchars($form_errors['eventHeaderErrorMessage']) : ''; ?></span>
                    </div>


                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label for="event_poster">Image:</label>
                        <input type="file" name="event_poster" id="event_poster" class="form-control" accept=".jpg, .jpeg, .png"/>
                        <span class="size-message" style="color: red;">Note: Image must be 880 x 660 pixels.</span>
                        <span class="size-message" style="color: red;display:<?= isset($form_errors['eventPosterErrorMessage']) ? 'block':'none';?>;"><?= isset($form_errors['eventPosterErrorMessage']) ? htmlspecialchars($form_errors['eventPosterErrorMessage']) : ''; ?></span>
                    </div>

                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label for="brochure">Brochure:</label>
                        <input type="file" name="brochure" id="brochure" class="form-control"/>
                    </div>

                    <!-- Featuring Section -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Featuring:</label>
                        <div id="featuring-container">
                            <?php
                                $featuring_title = $form_data['featuring_title'];
                                $featuring_description = $form_data['featuring_description'];
                                // $featuring_image = $form_data['featuring_image'];
                                if(!empty($featuring_title)){
                                    foreach ($featuring_title as $key => $featuring_title1) {
                                      ?>
                                    <div class="featuring-box row" style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                            <label>Title:</label>
                                            <input type="text" name="featuring_title[]" class="form-control" value="<?php echo  isset($featuring_title1) ? $featuring_title1 : '' ?>"/>
                                        </div>
                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                            <label>Description:</label>
                                            <textarea name="featuring_description[]" class="form-control" rows="3"><?php echo isset($featuring_description[$key]) ? $featuring_description[$key] : '' ?></textarea>
                                        </div>
                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                            <label>Image:</label>
                                            <input type="file" name="featuring_image[]" multiple class="form-control"/>
                                            
                                        </div>
                                        
                                        <!-- Button Alignment -->
                                        <div class="col-md-12 text-right">
                                            
                                            <button type="button" class="btn btn-danger" onclick="removeBox(this)">Cancel</button>
                                        </div>
                                    </div>
                                    <?php
                                  }
                                }else{                                    
                                    ?>                               
                                <div class="featuring-box row" style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <label>Title:</label>
                                        <input type="text" name="featuring_title[]" class="form-control"/>
                                    </div>
                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <label>Description:</label>
                                        <textarea name="featuring_description[]" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <label>Image:</label>
                                        <input type="file" name="featuring_image[]" multiple class="form-control"/>
                                        
                                    </div>
                                    
                                    <!-- Button Alignment -->
                                    <div class="col-md-12 text-right">
                                        
                                        <button type="button" class="btn btn-danger" onclick="removeBox(this)">Cancel</button>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addMoreFeaturingFields()">Add More</button>
                    </div>
                    <!-- Discount -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Disounts:</label>
                        <div id="discounts-container">
                            <?php
                                $dis_start_date = $form_data['dis_start_date'];
                                $dis_end_date = $form_data['dis_end_date'];
                                // print_r($dis_end_date);
                                $dis_ticket_discount = $form_data['dis_ticket_discount'];
                                if($dis_start_date > 0){
                                    foreach ($dis_start_date as $key => $dis_start_date1) {
                                        ?>                                                                
                                        <div class="discounts-box row" style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">                                                                                                                              
                                            <div class="col-md-5" style="margin-bottom: 20px;">                                                           
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" name="dis_start_date[]" id="dis_start_date" class="form-control" value="<?= isset($dis_start_date1) ? htmlspecialchars($dis_start_date1) : ''; ?>">
                                            </div>
                                            <div class="col-md-5" style="margin-bottom: 20px;">                                    
                                                <label for="end_date">End Date:</label>
                                                <input type="date" name="dis_end_date[]" id="dis_end_date" class="form-control" value="<?= isset($dis_end_date[$key]) ? htmlspecialchars($dis_end_date[$key]) : ''; ?>"/>                                       
                                            </div>
                                            <div class="col-md-2" style="margin-bottom: 20px;">
                                                <label for="ticket_discount">Discount:</label>
                                                <input type="text" name="dis_ticket_discount[]" id="dis_ticket_discount" class="form-control"  value="<?= isset($dis_ticket_discount[$key]) ? htmlspecialchars($dis_ticket_discount[$key]) : ''; ?>"/>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger" onclick="removeDisBox(this)"
                                                    style="">Cancel</button>
                                            </div>
                                        </div>
                                    <?php                                        
                                    }
                                }else{
                                    ?>                             
                                        <div class="discounts-box row" style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">                                                                                                                              
                                            <div class="col-md-5" style="margin-bottom: 20px;">                                                           
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" name="dis_start_date[]" id="dis_start_date" class="form-control">                                                                                                                                                
                                            </div>
                                            <div class="col-md-5" style="margin-bottom: 20px;">                                    
                                                <label for="end_date">End Date:</label>
                                                <input type="date" name="dis_end_date[]" id="dis_end_date" class="form-control">                                       
                                            </div>
                                            <div class="col-md-2" style="margin-bottom: 20px;">
                                                <label for="ticket_discount">Discount:</label>
                                                <input type="text" name="dis_ticket_discount[]" id="dis_ticket_discount" class="form-control" />
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger" onclick="removeDisBox(this)"
                                                    style="">Cancel</button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addMoreDisFields()">Add
                            More</button>
                    </div>
                        <!-- iFrame -->
                    <!-- <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Map:</label></br>
                        <textarea name="iframe" id="iframe" class="form-control" rows="2"></textarea>
                    </div>       -->

                </div>
            </div>

            <div class="box-footer">
                <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green"/> &nbsp;
                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='shareindex.php?view=share_registration_type'"/> &nbsp;
            </div>
        </div>
    </form>

    <script>
        function addMoreFeaturingFields() {
            var container = document.getElementById('featuring-container');
            var newBox = document.createElement('div');
            newBox.className = 'row featuring-box';
            newBox.style = 'display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;';
            newBox.innerHTML = `
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label>Title:</label>
                    <input type="text" name="featuring_title[]" class="form-control"/>
                </div>
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label>Description:</label>
                    <textarea name="featuring_description[]" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label>Image:</label>
                    <input type="file" name="featuring_image[]" class="form-control"/>                    
                </div>

                <!-- Button Alignment -->
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-danger" onclick="removeBox(this)">Cancel</button>
                </div>
            `;
            container.appendChild(newBox);
        }
        function removeBox(button) {
            var box = button.closest('.featuring-box');
            box.remove();
        }
        function addMoreDisFields() {
            var container = document.getElementById('discounts-container');
            var newBox = document.createElement('div');
            newBox.className = 'row discounts-box';
            newBox.style = 'display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;';
            newBox.innerHTML = `
                <div class="col-md-5" style="margin-bottom: 20px;">                                                           
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="dis_start_date[]" id="start_date" class="form-control">                                                                                                                                                
                </div>
                <div class="col-md-5" style="margin-bottom: 20px;">                                    
                    <label for="end_date">End Date:</label>
                    <input type="date" name="dis_end_date[]" id="end_date" class="form-control">                                       
                </div>
                <div class="col-md-2" style="margin-bottom: 20px;">
                    <label for="ticket_discount">Discount:</label>
                    <input type="text" name="dis_ticket_discount[]" id="ticket_discount" class="form-control" />
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" onclick="removeDisBox(this)"
                        style="">Cancel</button>
                </div>
            `;
            container.appendChild(newBox);
        }
        function removeDisBox(button) {
            var box = button.closest('.discounts-box');
            box.remove();
        }
    </script>
</section>

		
<script>
$(document).ready(function() {
    // Function to validate file type
    function validateFileType(input, errorMessageId, allowedExtensions) {
        const filePath = $(input).val();

        // Create a regex pattern for allowed extensions
        const extensions = new RegExp(`(${allowedExtensions.join('|')})$`, 'i');

        if (!extensions.exec(filePath)) {
            if(errorMessageId == '#brochureError'){
                $(errorMessageId).text("Please upload a file in PDF format.").show();
            }else{
                $(errorMessageId).text("Please upload a file in JPG, JPEG and PNG format.").show();
            }
            $(input).val(''); // Clear the input
        } else {
            $(errorMessageId).hide(); // Hide the error message
        }
    }

    // Validate brochure file
    $('#brochure').change(function() {
        validateFileType(this, '#brochureError', ['pdf']);
    });

    // Validate header image
    $('#event_header_image').change(function() {
        validateFileType(this, '#headerImageError', ['jpg', 'jpeg', 'png']);
    });

    // Validate poster image
    $('#event_poster').change(function() {
        validateFileType(this, '#posterImageError', ['jpg', 'jpeg', 'png']);
    });
});
</script>
<script>
    setTimeout(function() {        
        $.ajax({
                url: 'share_processArtRag.php?action=clearError', // Your PHP file that fetches cities
                type: 'POST',
                data: {
                    clearError: true
                }, 
                success: function (res) {                   
                    $('#timerAlert').hide();
                    
                },
                error: function (xhr, status, error) {
                    console.error(error); // Handle errors
                    // Optionally handle UI changes or alerts
                }
            });
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
<script>
    // Set a timer to close the alert after 5 seconds (5000 ms)
	function addArtCat(){
		window.location.href = 'shareindex.php?view=add';
	}
	
    // function deleteclassificateCategory(subCat){



    //     swal({
    //             title: "Do You Want Delete this  Category?",
    //             /*text: "You Want to Logout!",*/
    //             type: "warning",
    //             confirmButtonClass: "sweet_ok",
    //             confirmButtonText: "Yes, Delete!",
    //             cancelButtonClass: "sweet_cancel",
    //             cancelButtonText: "Cancel",
    //             showCancelButton: true,
    //         },
    //         function(isConfirm) {
    //             if (isConfirm) {
    //                 window.location.href = 'process.php?action=delete&subCat=' + subCat;
    //             } else {
    //                 // swal("Cancelled", "You canceled)", "error");
    //             }
    //         });






    //     /*if (confirm('Do You Want Delete this Sub Category?')) {
    //         window.location.href = 'processSubCategory.php?action=delete&subCat=' + subCat;
    //     }*/
    // }


    
    $(document).ready(function () {
        $('#country').change(function () {
            old_city = $('#old_city').val();
            var countryId = $(this).find(':selected').data('country_id');
            fetch_state(countryId,old_city = '')
        });

        <?php
            if (!empty($form_data)) {
                ?>                                    
                    var old_city = $('#old_city').val();
                    var countryId = $('#country').find(':selected').data('country_id');
                    let province_error_valid = $('#province_error_valid').val();
                    // console.log(province_error_valid);
                    fetch_state(countryId, old_city, province_error_valid);                    
                <?php
            }
        ?>

    });
    function fetch_state(countryId,old_city,select = '') {    
        // console.log(select);

        // Check if countryId is not empty
        if (countryId) {
            // AJAX request to fetch cities based on the selected country
            $.ajax({
                url: 'share_processArtRag.php?action=fetch_state', // Your PHP file that fetches cities
                type: 'POST',
                data: {
                    country: countryId
                }, // Send selected country ID
                dataType: 'json',
                success: function (res) {
                   
                    // Clear the city dropdown
                    $('#province').empty();
                    $('#province').append(
                    '<option value="">Select Province</option>'); // Placeholder

                    // Populate the city dropdown with the received data
                    $.each(res, function (index, state) {
                        if(select != ''){
                            $('#province').append(`<option value="${state.state_title}" data-state_id ="${state.state_id}" ${select == state.state_title ? 'selected' : ''}>${state.state_title}</option>`);
                        }else{
                            $('#province').append(`<option value="${state.state_title}" data-state_id ="${state.state_id}">${state.state_title}</option>`);
                        }
                    });

                    // Enable the city dropdown
                    $('#province').prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.error(error); // Handle errors
                    // Optionally handle UI changes or alerts
                }
            });
        } else {
            // If no country is selected, clear and disable the city dropdown
            $('#province').empty();           
            $('#province').prop('disabled', true);
        }
    }

    
    $(document).ready(function () {
        $('#province').change(function () {
            old_city = $('#old_city').val();
            var state_id = $(this).find(':selected').data('state_id');
            get_cities(state_id,old_city = '')
        });

        <?php
            if (!empty($form_data)) {
                ?>    
                    setTimeout(() => {                        
                        var old_city = $('#old_city').val();
                        var state_id = $('#province').find(':selected').data('state_id');                    
                        let city_error_valid = $('#city_error_valid').val();
                        get_cities(state_id,old_city = '',city_error_valid)                   
                    }, 1000);                                
                <?php
            }
        ?>
    });
    function get_cities(state_id,old_city, city_error_valid = '') {    
        console.log(state_id);
        console.log(city_error_valid);
        // Check if countryId is not empty
        if (state_id) {
            // AJAX request to fetch cities based on the selected country
            $.ajax({
                url: 'share_processArtRag.php?action=fetch_cities', // Your PHP file that fetches cities
                type: 'POST',
                data: {
                    state_id: state_id
                }, // Send selected country ID
                dataType: 'json',
                success: function (res) {
                    console.log("Raw response:", res); // Log the raw response                      

                    // Clear the city dropdown
                    $('#city').empty();
                    $('#city').append(
                    '<option value="">Select City</option>'); // Placeholder

                    // Populate the city dropdown with the received data
                    $.each(res, function (index, city) {
                        if(city_error_valid != ''){
                            $('#city').append(`<option value="${city.city_title}" ${city_error_valid == city.city_title ? 'selected':''}>${city.city_title}</option>`);
                        }else{
                            $('#city').append(`<option value="${city.city_title}">${city.city_title}</option>`);
                        }
                    });

                    // Enable the city dropdown
                    $('#city').prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.error(error); // Handle errors
                    // Optionally handle UI changes or alerts
                }
            });
        } else {
            // If no country is selected, clear and disable the city dropdown
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>'); // Placeholder
            $('#city').prop('disabled', true);
        }
    }
</script>