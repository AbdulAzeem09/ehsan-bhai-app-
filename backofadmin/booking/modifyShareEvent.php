<?php
    require_once '../library/config.php';
	if (!defined('WEB_ROOT')) {
		exit;
    }  


	$errorMessage = (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage'] != '') ? $_SESSION['errorMessage'] : '';

	if(isset($_GET['id']) && ($_GET['id']) != ''){
		$ArtCat  = $_GET['id'];
	}else {
		redirect('shareindex.php');
	}
	$sql = "SELECT * FROM sharepage_event WHERE id = $ArtCat";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	
	extract($row);

	$tbl_country_sql = "SELECT * FROM tbl_country";
    $tbl_country_result = dbQuery($dbConn, $tbl_country_sql);	

    $sharepage_event_category_sql = "SELECT * FROM sharepage_event_category";
    $sharepage_event_category_result = dbQuery($dbConn, $sharepage_event_category_sql);	

   
?>
<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>

<script type="text/javascript">
    window.onload = function () {
        // Automatically calculates the editor base path based on the _samples directory.
        // This is usefull only for these samples. A real application should use something like this:
        // oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
        var sBasePath = '../fckeditor/';
        var oFCKeditor = new FCKeditor('event_content');
        oFCKeditor.BasePath = sBasePath;
        oFCKeditor.Height = 230;
        oFCKeditor.ReplaceTextarea();
    }
</script>



<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Modify Share Event</h1>
</section>
<!-- Main content -->
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
    <!-- start any work here. -->
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="share_processArtRag.php?action=modify"
        enctype="multipart/form-data" onsubmit="return validate(this)">
        <input type="hidden" name="event_id" id="event_id" value="<?php echo $ArtCat;?>" />

        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
                    <div style="min-height:10px;"></div>
                    <div class="alert alert-<?php echo $_SESSION['data'];?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $_SESSION['errorMessage'];  ?>
                    </div> <?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
                </div>

                <div class="row">

                    <!-- Event Title -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>Event Title:</label></br>
                        <input type="text" name="event_title" id="event_title" class="form-control"
                            value="<?php echo isset($row['event_title']) ? $row['event_title'] : ''; ?>" />
                    </div>
                    <!-- Event Category -->            
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label for="event_category">Category:</label>
                        <select name="event_category" id="event_category" class="form-control">
                            <option value="">--Select Category--</option>
                            <?php
                                // Assuming $tbl_country_result is a valid resource from your query                                
                                while ($data = dbFetchAssoc($sharepage_event_category_result)) {                                                                     
                                    ?>
                            <option value="<?= $data['category_title']; ?>" <?php echo $row['event_category'] == $data['category_title'] ? 'selected': ''; ?>>
                                <?= $data['category_title']; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>    
                    <!-- Venue Name -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>Venue Name:</label></br>
                        <input type="text" name="venue_name" id="venue_name" class="form-control"
                            value="<?php echo isset($row['venue_name']) ? $row['venue_name'] : ''; ?>" />
                    </div>
                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Event Content:</label></br>
                        <textarea name="event_content" id="event_content" class="form-control event_content"
                 rows="3">
                            <?php echo isset($row['event_content']) ? $row['event_content'] : ''; ?>
                        </textarea>
                    </div>

                    <!-- Venue Address -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>Venue Address:</label></br>
                        <input type="text" name="venue_address" id="venue_address" class="form-control"
                            
                            value="<?php echo isset($row['venue_address']) ? $row['venue_address'] : ''; ?>" />
                    </div>



                    <!-- Country -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>Country:</label></br>
                        <select name="country" id="country" class="form-control">
                            <option value="">--Select Country--</option>
                            <?php
                                // Assuming $tbl_country_result is a valid resource from your query                                
                                while ($data = dbFetchAssoc($tbl_country_result)) {                                                                     
                                    ?>
                            <option value="<?= $data['country_title']; ?>"
                                <?php echo $row['country'] == $data['country_title'] ? 'selected' : ''; ?>
                                data-country_id="<?= $data['country_id']; ?>">
                                <?= $data['country_title']; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>


                    <!-- Province -->                  
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>City:</label></br>
                        <input type="hidden" id="old_state" value="<?= $row['province']?>">
                        <select name="province" id="province" class="form-control" disabled>
                        </select>
                    </div>

                    <!-- City -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>City:</label></br>
                        <input type="hidden" id="old_city" value="<?= $row['city']?>">
                        <select name="city" id="city" class="form-control" disabled>
                        </select>
                    </div>

                    <!-- Postal Code -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label>Postal Code:</label></br>
                        <input type="text" name="postal_code" id="postal_code" class="form-control" 
                            value="<?php echo isset($row['postal_code']) ? $row['postal_code'] : ''; ?>" />
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
                                <label>Start Date:</label></br>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    
                                    value="<?php echo isset($row['start_date']) ? $row['start_date'] : ''; ?>" />
                            </div>
                            <!-- End Date -->
                            <div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
                                <label>End Date:</label></br>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    
                                    value="<?php echo isset($row['end_date']) ? $row['end_date'] : ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Start Time -->
                            <div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
                                <label>Start Time:</label></br>
                                <input type="time" name="start_time" id="start_time" class="form-control"
                                    
                                    value="<?php echo isset($row['start_time']) ? $row['start_time'] : ''; ?>" />
                            </div>
                            <!-- End Time -->
                            <div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
                                <label>End Time:</label></br>
                                <input type="time" name="end_time" id="end_time" class="form-control"
                                    
                                    value="<?php echo isset($row['end_time']) ? $row['end_time'] : ''; ?>" />
                            </div>
                        </div>
                    </div>



                    <!-- Header Image -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Header Image:</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if (isset($row['event_header_image']) && $row['event_header_image'] != ''): ?>
                                <img src="<?php echo $row['event_header_image']; ?>" alt="Header Image"
                                    style="max-width: 30px; margin-bottom: 5px;  max-height: 30px;" />
                                    <?php endif; ?>
                                </div>
                            </div>
                            <input type="file" name="event_header_image" id="event_header_image" class="form-control"
                            accept=".jpg, .jpeg, .png" />
                            <span class="error-message" id="headerImageError" style="color: red; display: none;"></span>
                            <input type="hidden" name="event_header_image_current" id="event_header_image_current"
                            value="<?php echo isset($row['event_header_image']) ? $row['event_header_image'] : ''; ?>" />
                            <span class="size-message" style="color: red;">Note: Image must be 1700 x 400 pixels.</span>
                    </div>
                   
                    

                    <!-- Event Poster -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Image:</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if (isset($row['event_poster']) && $row['event_poster'] != ''): ?>
                                <img src="<?php echo $row['event_poster']; ?>" alt="Event Poster"
                                    style="max-width: 30px;  margin-bottom: 5px; max-height: 30px;" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <input type="file" name="event_poster" id="event_poster" class="form-control"
                            accept=".jpg, .jpeg, .png" />
                        <span class="error-message" id="posterImageError" style="color: red; display: none;"></span>
                        <input type="hidden" name="event_poster_current" id="event_poster_current"
                            value="<?php echo isset($row['event_poster']) ? $row['event_poster'] : ''; ?>" />
                            <span class="size-message" style="color: red;">Note: Image must be 880 x 660 pixels.</span>
                    </div>

                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Brochure:</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if (isset($row['brochure']) && $row['brochure'] != ''): ?>
                                <!-- Extract and display only the file name with a clickable link -->
                                <a href="<?php echo $row['brochure']; ?>" target="_blank">
                                    <?php echo basename($row['brochure']); ?>
                                </a>
                                <?php else: ?>
                                <span>No brochure uploaded</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <input type="file" name="brochure" id="brochure" class="form-control" accept=".pdf" />
                        <span class="error-message" id="brochureError" style="color: red; display: none;"></span>
                        <input type="hidden" name="brochure_current" id="brochure_current"
                            value="<?php echo isset($row['brochure']) ? $row['brochure'] : ''; ?>" />
                    </div>



                    <!-- Featuring Section -->
                    <!-- Featuring Section -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Featuring:</label>
                        <div id="featuring-container">
                            <?php
        // Decode JSON data from the database
        $featuringData = isset($row['featuring_data']) ? json_decode($row['featuring_data'], true) : [];

        // Check if the decoded data is an array and contains items
        if (!empty($featuringData) && is_array($featuringData)) {
            foreach ($featuringData as $item) {
                // Ensure each item has the required keys
                $title = isset($item['title']) ? $item['title'] : '';
                $description = isset($item['description']) ? $item['description'] : '';
                $image = isset($item['image']) ? $item['image'] : '';
                ?>
                            <div class="featuring-box row"
                                style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Title:</label>
                                    <input type="text" name="featuring_title[]" class="form-control"
                                        value="<?php echo htmlspecialchars($title); ?>" />
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Description:</label>
                                    <textarea name="featuring_description[]" class="form-control"
                                        rows="3"><?php echo stripslashes(htmlspecialchars($description)); ?></textarea>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Image:</label>
                                    <div style="display: flex; align-items: center;">
                                        <input type="file" name="featuring_image[]" class="form-control"
                                            style="margin-right: 10px;" />
                                        <!-- Display existing image if available -->
                                        <?php if (!empty($image)) { ?>
                                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Featuring Image"
                                            style="width: 30px; height: 30px; object-fit: cover;" />
                                        <input type="hidden" name="featuring_image_current[]"
                                            value="<?php echo htmlspecialchars($image); ?>" />
                                        <?php } ?>
                                    </div>                                    
                                </div>
                                <!-- Button Alignment -->
                                <div class="col-md-12 text-right">

                                    <button type="button" class="btn btn-danger"
                                        onclick="removeBox(this)">Cancel</button>
                                </div>
                            </div>
                            <?php
                    }
                } else {
            // Default empty set of featuring fields if no data exists
                ?>
                            <div class="featuring-box row"
                                style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Title:</label>
                                    <input type="text" name="featuring_title[]" class="form-control" />
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Description:</label>
                                    <textarea name="featuring_description[]" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Image:</label>
                                    <div style="display: flex; align-items: center;">
                                        <input type="file" name="featuring_image[]" class="form-control"
                                            style="margin-right: 10px;" />
                                    </div>
                                </div>
                                <!-- Button Alignment -->
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-primary" onclick="addMoreFeaturingFields()">Add
                                        More</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="removeBox(this)">Cancel</button>
                                </div>
                            </div>
                            <?php
                }
                ?>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addMoreFeaturingFields()">Add
                            More</button>
                    </div>
                    <!-- Discount -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Disounts:</label>
                        <div id="discounts-container">
                            <?php
        // Decode JSON data from the database
        $discount_list = isset($row['discount_list']) ? json_decode($row['discount_list'], true) : [];

        // Check if the decoded data is an array and contains items
        if (!empty($discount_list) && is_array($discount_list)) {
            foreach ($discount_list as $item) {
                // Ensure each item has the required keys
                $dis_start_date = isset($item['dis_start_date']) ? $item['dis_start_date'] : '';
                $dis_end_date = isset($item['dis_end_date']) ? $item['dis_end_date'] : '';
                $dis_ticket_discount = isset($item['dis_ticket_discount']) ? $item['dis_ticket_discount'] : '';
        ?>
                            <div class="discounts-box row"
                                style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
                                <div class="col-md-5" style="margin-bottom: 20px;">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="dis_start_date[]" id="dis_start_date" class="form-control"
                                        value="<?=$dis_start_date?>">
                                </div>
                                <div class="col-md-5" style="margin-bottom: 20px;">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="dis_end_date[]" id="dis_end_date" class="form-control"
                                        value="<?=$dis_end_date?>">
                                </div>
                                <div class="col-md-2" style="margin-bottom: 20px;">
                                    <label for="ticket_discount">Discount:</label>
                                    <input type="text" name="dis_ticket_discount[]" id="dis_ticket_discount"
                                        class="form-control" value="<?=$dis_ticket_discount?>" />
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger" onclick="removeDisBox(this)"
                                        style="">Cancel</button>
                                </div>
                            </div>
                            <?php
            }
        } else {
            // Default empty set of featuring fields if no data exists
        ?>
                            <div class="discounts-box row"
                                style="display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;">
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
                                    <input type="text" name="dis_ticket_discount[]" id="dis_ticket_discount"
                                        class="form-control" />
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
        <textarea name="iframe" id="iframe" class="form-control" rows="2"><?php echo isset($row['iframe']) ? $row['iframe'] : ''; ?></textarea>
    </div>                     -->
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
            <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow"
                onclick="window.location.href='shareindex.php?view=share_registration_type'" /> &nbsp;
        </div>
        </div>

    </form>
</section><!-- /.content -->

<script>
    function addMoreFeaturingFields() {
        var container = document.getElementById('featuring-container');
        var newBox = document.createElement('div');
        newBox.className = 'row featuring-box';
        newBox.style =
            'display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;';
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
        newBox.style =
            'display: flex;width: 100%;flex-wrap: wrap;margin-left: 0;padding: 20px;margin-bottom: 20px;box-shadow: 0 0 6px 5px #f2f2f2;';
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


<script>
    $(document).ready(function () {
        // Function to validate file type
        function validateFileType(input, errorMessageId, allowedExtensions) {
            const filePath = $(input).val();

            // Create a regex pattern for allowed extensions
            const extensions = new RegExp(`(${allowedExtensions.join('|')})$`, 'i');

            if (!extensions.exec(filePath)) {
                if (errorMessageId == '#brochureError') {
                    $(errorMessageId).text("Please upload a file in PDF format.").show();
                } else {
                    $(errorMessageId).text("Please upload a file in JPG, JPEG and PNG format.").show();
                }
                $(input).val(''); // Clear the input
            } else {
                $(errorMessageId).hide(); // Hide the error message
            }
        }

        // Validate brochure file
        $('#brochure').change(function () {
            validateFileType(this, '#brochureError', ['pdf']);
        });

        // Validate header image
        $('#event_header_image').change(function () {
            validateFileType(this, '#headerImageError', ['jpg', 'jpeg', 'png']);
        });

        // Validate poster image
        $('#event_poster').change(function () {
            validateFileType(this, '#posterImageError', ['jpg', 'jpeg', 'png']);
        });
    });

    // $(document).ready(function () {
    //     $('#country').change(function () {
    //         old_city = $('#old_city').val();
    //         var countryId = $(this).find(':selected').data('country_id');
    //         get_cities(countryId,old_city)
    //     });
    // });

    // $(window).on('load', function() {
    //     old_city = $('#old_city').val();
    //     var countryId = $('#country').find(':selected').data('country_id');
    //     get_cities(countryId,old_city)
    // });

    // function get_cities(countryId,old_city) {    

    //     // Check if countryId is not empty
    //     if (countryId) {
    //         // AJAX request to fetch cities based on the selected country
    //         $.ajax({
    //             url: 'share_processArtRag.php?action=fetch_cities', // Your PHP file that fetches cities
    //             type: 'POST',
    //             data: {
    //                 country: countryId
    //             }, // Send selected country ID
    //             dataType: 'json',
    //             success: function (res) {
    //                 console.log("Raw response:", res); // Log the raw response                      

    //                 // Clear the city dropdown
    //                 $('#city').empty();
    //                 $('#city').append(
    //                 '<option value="">Select City</option>'); // Placeholder

    //                 // Populate the city dropdown with the received data
    //                 $.each(res, function (index, city) {
    //                     $('#city').append(`<option value="${city.city_title}" ${city.city_title == old_city && 'selected'}>${city.city_title}</option>`);
    //                 });

    //                 // Enable the city dropdown
    //                 $('#city').prop('disabled', false);
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(error); // Handle errors
    //                 // Optionally handle UI changes or alerts
    //             }
    //         });
    //     } else {
    //         // If no country is selected, clear and disable the city dropdown
    //         $('#city').empty();
    //         $('#city').append('<option value="">Select City</option>'); // Placeholder
    //         $('#city').prop('disabled', true);
    //     }
    // }




    


    $(document).ready(function () {
        $('#country').change(function () {
            old_city = $('#old_city').val();
            var countryId = $(this).find(':selected').data('country_id');
            fetch_state(countryId,old_city = '')
        });
    });
    $(window).on('load', function() {
        old_state = $('#old_state').val();
        var countryId = $('#country').find(':selected').data('country_id');
        fetch_state(countryId,old_state)
    });
    function fetch_state(countryId,old_state) {    

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
                        $('#province').append(`<option value="${state.state_title}" data-state_id ="${state.state_id}" ${state.state_title == old_state ? 'selected' : ''}>${state.state_title }</option>`);
                    });

                    // Enable the city dropdown
                    $('#province').prop('disabled', false);
                    if(old_state){
                        old_city = $('#old_city').val();
                        var state_id = $('#province').find(':selected').data('state_id');
                        get_cities(state_id,old_city)
                    }
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
    });
    function get_cities(state_id,old_city) {    

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
                        $('#city').append(`<option value="${city.city_title}"  ${city.city_title == old_city ? 'selected' : ''}>${city.city_title}</option>`);
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