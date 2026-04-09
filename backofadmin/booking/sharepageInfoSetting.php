<?php
require_once '../library/config.php';
require_once '../library/functions.php';

// Disable error reporting
error_reporting(0);
@ini_set('display_errors', 0);

if (!defined('WEB_ROOT')) {
    exit;
}

// Fetch existing event info data
$sql = "SELECT * FROM event_info WHERE id = 1"; // Assuming you want to update the record with id = 1
$result = dbQuery($dbConn, $sql);
$event_info_data = mysqli_fetch_assoc($result);


// Handle form submission
if (isset($_POST['btnButton'])) {
    // Initialize an empty array to store event info list
    $event_info_list = [];

    // Loop through the event_info_title_list array
    foreach ($_POST['event_info_title_list'] as $key => $event_info_title_list) {
        // Sanitize input to avoid SQL injection
        $event_info_title_list = mysqli_real_escape_string($dbConn, $event_info_title_list);
        $event_info_content_list = mysqli_real_escape_string($dbConn, $_POST['event_info_content_list'][$key]);

        // Add sanitized data to array
        $event_info_list[] = [
            'event_info_title_list' => $event_info_title_list,
            'event_info_content_list' => $event_info_content_list,
        ];
    }

    // Convert event info list to JSON format and sanitize it
    $event_info_list_json = mysqli_real_escape_string($dbConn, json_encode($event_info_list));

    // Sanitize the event title and content
    $event_info_title = mysqli_real_escape_string($dbConn, $_POST['event_info_title']);
    $event_info_content = mysqli_real_escape_string($dbConn, $_POST['event_info_content']);

    // Check if a record exists
    $check_sql = "SELECT * FROM event_info WHERE id = 1";  // Adjust the WHERE clause based on your logic
    $result = mysqli_query($dbConn, $check_sql);

    if (!$result) {
        die("Error: " . mysqli_error($dbConn));  // Handle errors
    }

    // If no existing record, insert new data
    if (mysqli_num_rows($result) == 0) {
        $insert_data_sql = "INSERT INTO event_info (event_info_title, event_info_content, event_info_list) 
                            VALUES ('$event_info_title', '$event_info_content', '$event_info_list_json')";
        
        if (mysqli_query($dbConn, $insert_data_sql)) {
            echo "New event info inserted successfully.";
        } else {
            echo "Error inserting data: " . mysqli_error($dbConn);
        }
    } else {
        // If record exists, update it
        $update_data_sql = "UPDATE event_info 
                            SET event_info_title = '$event_info_title', 
                                event_info_content = '$event_info_content', 
                                event_info_list = '$event_info_list_json' 
                            WHERE id = 1";

        if ($result = dbQuery($dbConn, $update_data_sql)) {
            header("Location: $BaseUrl/backofadmin/booking/shareindex.php?view=sharepageInfoSetting");
        } else {
            echo "Error updating data: " . mysqli_error($dbConn);
        }
    }
}
?>

<section class="content top_heading">
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this)">
        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])): ?>
                        <?php if ($_SESSION['count'] <= 1): ?>
                            <?php $_SESSION['count'] += 1; ?>
                            <div class="alert alert-<?php echo $_SESSION['data']; ?>">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_SESSION['errorMessage']; ?>
                            </div>
                            <?php unset($_SESSION['errorMessage']); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Event Info Title -->
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Sharepage Info Title:</label>
                        <input type="text" name="event_info_title" class="form-control" value="<?= htmlspecialchars($event_info_data['event_info_title'] ?? ''); ?>" />
                    </div>
                    
                    <!-- Event Info Content -->
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <label>Sharepage Info Content:</label>
                        <textarea name="event_info_content" class="form-control" rows="3"><?= stripslashes(htmlspecialchars($event_info_data['event_info_content'] ?? '')); ?></textarea>
                    </div>
                    
                    <!-- Event Info List -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Sharepage Info List:</label>
                        <div id="featuring-container">
                            <?php if (!empty($event_info_data['event_info_list'])): ?>
                                <?php
                                $event_info_list = json_decode($event_info_data['event_info_list'], true);
                                foreach ($event_info_list as $key => $value): ?>
                                    <div class="featuring-box row" style="display: flex; width: 100%; flex-wrap: wrap; margin-left: 0; padding: 20px; margin-bottom: 20px; box-shadow: 0 0 6px 5px #f2f2f2;">
                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                            <label>Title:</label>
                                            <input type="text" name="event_info_title_list[]" class="form-control" value="<?= htmlspecialchars($value['event_info_title_list'] ?? ''); ?>" />
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 20px;">
                                            <label>Description:</label>
                                            <textarea name="event_info_content_list[]" class="form-control" rows="3"><?= stripslashes(htmlspecialchars($value['event_info_content_list'] ?? '')); ?></textarea>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <div style="display: grid; height: 100%; place-content: center;">
                                                <button type="button" class="btn btn-danger" onclick="removeBox(this)">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addMoreFeaturingFields()">Add More</button>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green" />
            </div>
        </div>
    </form>

    <script>
        function addMoreFeaturingFields() {
            var container = document.getElementById('featuring-container');
            var newBox = document.createElement('div');
            newBox.className = 'row featuring-box';
            newBox.style = 'display: flex; width: 100%; flex-wrap: wrap; margin-left: 0; padding: 20px; margin-bottom: 20px; box-shadow: 0 0 6px 5px #f2f2f2;';
            newBox.innerHTML = `
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <label>Title:</label>
                    <input type="text" name="event_info_title_list[]" class="form-control" />
                </div>
                <div class="col-md-6" style="margin-bottom: 20px;">
                    <label>Description:</label>
                    <textarea name="event_info_content_list[]" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-2 text-right">
                    <div style="display: grid; height: 100%; place-content: center;">
                        <button type="button" class="btn btn-danger" onclick="removeBox(this)">Cancel</button>
                    </div>
                </div>
            `;
            container.appendChild(newBox);
        }

        function removeBox(button) {
            var box = button.closest('.featuring-box');
            box.remove();
        }
    </script>
</section>
