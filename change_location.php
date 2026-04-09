<?php
    if (isset($_POST['Change_Current_Location'])) {
        session_start(); 
        $_SESSION["Countryfilter"] = $_POST['spUserCountry'];
        $_SESSION["Statefilter"] = $_POST['spUserState'] ?? $_POST['spProfilesState'];
        $_SESSION["Cityfilter"] = $_POST['spUserCity'] ?? $_POST['spProfilesCity'];
        header("Location: ".$_SERVER['HTTP_REFERER']);
        die();
    }else {
?>

    <style>
        .change_location_modal{
            width: 100%;
            background-color: #a5a8ab3f;
            left: 0px;
            top: 0px;
            z-index: 9999;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 100px 20px;
        }

        .change_location_modal .modal-dialog{
            background-color: white;
            width: 600px;
            border: none !important;
        }

        @media(max-width: 560px) {
            .change_location_modal .modal-dialog{
                width: 100%;
            }
        }
        .change_location_modal .modal-header{
            border-bottom: none;
            padding: 20px;
            display: block;
        }

        .change_location_modal .modal-header .loc-info{
            width: 100%;
            margin-bottom: 10px;
        }
        .change_location_modal .modal-header .loc-info .title{
            font-size: 14px;
            color: #7649B3;
        }
        .change_location_modal .modal-header .loc-info .location{
            font-weight: 500;
        }

        .change_location_modal .modal-content{
            border: none;
        }
        
        .change_location_modal .modal-dialog .modal-title{
            width: 100%;
            font-size: 20px;
            font-weight: 500;
            position: relative;
            width: 100%;
        }

        .change_location_modal .modal-dialog .modal-title::after{
            content: "";
            position: absolute;
            background-color: #FB8308 !important;
            left: 0px;
            bottom: -8px;
        }

        .change_location_modal .modal-body{
            border: none;
            padding: 20px;
        }

        .change_location_modal .title{
            color : #FB8308;
        }
        .change_location_modal .text{
            /* font-weight: 500 */
            font-size: 18px;
            color : #454545;
        }
        .change_location_modal .in-1-col{
            width: 100% !important;
        }

        @media(max-width: 415px) {
            .change_location_modal .in-2-col{
                width: 100% !important;
            }
        }

        .change_location_modal .heghight-title{
            font-weight: 500;
            color: #FB8308;
        }
        .change_location_modal textarea{
            width: 100%;
            padding-top: 15px;
            border-radius: 4px !important;
            background-color: #F9FAFB;
            font-size: 12px;
            border: none;
            padding-left: 15px;
            outline: none;
            border: 1px solid #D9DCE0;
            margin-top: 5px;
            resize: none;
        }
        .change_location_modal textarea::placeholder{
            color: #909090;
            font-size: 12px;
        }
        .change_location_modal textarea:focus{
            border: 0.8px solid #FB8308;
            box-shadow: none;
        }
            
        .change_location_modal .main-container{
            display: block;
            position: relative;
            color: #1F1216;
            padding-left: 30px;
            margin-bottom: 16px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            font-size: 14px;
            user-select: none;
        }
        .change_location_modal .checkmark {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
            height: 20px;
            width: 20px;
            border: 1.5px solid #1F1216;
            border-radius: 50%;

        }
        .change_location_modal input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;

        }

            
        /* When the checkbox is checked, add a blue background */
        .change_location_modal .main-container input:checked ~ .checkmark {
            background-color: #08B564;
            border: none;
        }
            
            /* Create the checkmark/indicator (hidden when not checked) */
        .change_location_modal .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
            
            /* Show the checkmark when checked */
        .main-container input:checked ~ .checkmark:after {
            display: block;
        }
            
            /* Style the checkmark/indicator */
        .main-container .checkmark:after {
            left: 7px;
            top: 4px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .change_location_modal .input-group label{
            width: 100%;
            font-size: 14px;
            font-family: 500;
        }
        .change_location_modal .input-group input, .change_location_modal .input-group select{
            width: 100% !important;
            height: 36px;
            border-radius: 4px !important;
            background-color: #F9FAFB;
            font-size: 12px;
            border: none;
            padding-left: 15px;
            outline: none;
            margin-top: 5px;
            border: 1px solid #D9DCE0;
        }
        .change_location_modal .input-group input::placeholder, .change_location_modal .input-group select::placeholder{
            color: #909090;
            font-size: 12px;
        }
        .change_location_modal .input-group input:focus, .change_location_modal .input-group select:focus{
            border: 0.8px solid #FB8308;
            box-shadow: none;
        }

        .change_location_modal .location-head{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            color: #FB8308;
        }

        .change_location_modal .location-head img{
            cursor: pointer;
        }
            
        .change_location_modal .modal-footer{
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin: 20px 0px;
            border-top: none;
        }
        @media(max-width: 400px) {
            .change_location_modal .modal-footer{
                flex-wrap: wrap;
            }
        }
        .change_location_modal .modal-footer button{
            width: 150px;
            height: 36px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 75px;
            border: 1.5px solid #7649B3;
            color: #7649B3;
            background: none;
            transition: all 0.4s;
            cursor: pointer !important;
        }
        .change_location_modal .modal-footer button:hover{
            opacity: 0.9;
        }
        @media(max-width: 400px) {
            .change_location_modal .modal-footer button {
                width: 100%;
            }
        }
            
    </style>

    <div class="change-location">
        <div class="change-location-btn" class="change-location-btn" data-bs-toggle="modal" data-bs-target="#change-location"> Change Location</div>
        <div class="location">
        <?php
            $usercountry = $_SESSION["Countryfilter"];
            $userstate = $_SESSION["Statefilter"];
            $usercity = $_SESSION["Cityfilter"];

            $co = new _country;
            $result3 = $co->readCountry();
            if ($result3 != false) {
                while ($row3 = mysqli_fetch_assoc($result3)) {
                    if (isset($usercountry) && $usercountry == $row3['country_id']) {
                    $currentcountry = $row3['country_title'];
                    $currentcountry_id = $row3['country_id'];
                    }
                }
            }

            if (isset($userstate) && $userstate > 0) {
                $countryId = $currentcountry_id;
                $pr = new _state;
                $result2 = $pr->readState($countryId);
                if ($result2 != false) {
                    while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
                    //die('===');
                    if (isset($userstate) && $userstate == $row2["state_id"]) {
                        $currentstate_id = $row2["state_id"];
                        $currentstate = $row2["state_title"];
                    }
                    }
                }
            }

            if (isset($usercity) && $usercity > 0) {
                $stateId = $currentstate_id;
                $co = new _city;
                $result3 = $co->readCity($stateId);
                //echo $co->ta->sql;
                if ($result3 != false) {
                    while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
                    if (isset($usercity) && $usercity == $row3['city_id']) {
                        $currentcity = $row3['city_title'];
                        $currentcity_id = $row3['city_id'];
                    }
                    }
                }
            }
        ?>
        <!--Current Location: -->
        <?php
            $currentLocation = '';
            if (isset($currentcity)) {
                $currentLocation .= $currentcity . ', ';
            }
            if (isset($currentstate)) {
                $currentLocation .= $currentstate . ', ';
            }
            if (isset($currentcountry)) {
                $currentLocation .= $currentcountry;
            }
            echo $currentLocation;
        ?>
        </div>
    </div>

    <!-- Current Location Modal End -->
    <!-- Model Start change location -->
    <div class="modal change_location_modal" id="change-location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: unset !important;">
                <form action="/change_location.php" method="post">
                    <div class="modal-header">
                        <div class="loc-info">
                            <div class="title">Current Location</div>
                            <div class="location"><?php echo $currentLocation; ?></div>
                        </div>
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Location</h1>
                    </div>
                    <div class="modal-body">
                        <div class="input-group in-1-col">
                            <label>Country<span style="color: red">*</span></label>
                            <select class="form-select" name="spUserCountry" id="spUserCountry">
                                <option value="">Select Country</option>
                                <?php
                                    $co = new _country;
                                    $result3 = $co->readCountry();
                                    if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
                                <option value='<?php echo $row3['country_id']; ?>'
                                    <?php echo (isset($_SESSION["Countryfilter"]) && $_SESSION["Countryfilter"]  == $row3['country_id']) ? 'selected' : ''; ?>>
                                    <?php echo $row3['country_title']; ?></option>
                                <?php
                                    }
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="input-group in-1-col loadUserState">
                            <label>State<span style="color: red">*</span></label>
                            <select class="form-select" name="spUserState" id="spUserState">
                                <option>Select State</option>
                                <?php
                                    if (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] > 0) {
                                    $countryId = $_SESSION["Countryfilter"];
                                    $pr = new _state;
                                    $result2 = $pr->readState($countryId);
                                    if ($result2 != false) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                <option value='<?php echo $row2["state_id"]; ?>'
                                    <?php echo (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] == $row2["state_id"]) ? 'selected' : ''; ?>>
                                    <?php echo $row2["state_title"]; ?> </option>
                                <?php
                                    }
                                    }
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="input-group in-1-col loadCity">
                            <label>City</label>
                            <select id="spUserCity" class="form-select" name="spUserCity">
                                <option>Select City</option>
                                <?php
                                    if (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"] > 0) {
                                        $stateId = $_SESSION["Statefilter"];
                                        $co = new _city;
                                        $result3 = $co->readCity($stateId);
                                        if ($result3 != false) {
                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                <option value='<?php echo $row3['city_id']; ?>'
                                    <?php echo (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"]==$row3['city_id']) ? 'selected' : ''; ?>>
                                    <?php echo $row3['city_title']; ?></option> <?php
                                        }
                                        }
                                    } ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="Change_Current_Location" value="Change"
                            style="color: white ; background-color: #7649B3;" class="btn btn-primary">CHANGE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Current Location Modal End -->
    <!-- Model End Change Location -->

    <script type="text/javascript">

        //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
        $("#spUserCountry").on("change", function () {
            //alert('===1');
            var countryId = this.value;
            $.post("loadUserState.php", {
            countryId: countryId
            }, function (r) {
            //alert(r);
                $(".loadUserState").html(r);
            });
            $("#spUserCity").html('');
        
        });
        //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======


        //==========ON CHANGE LOAD CITY==========

        $("#spUserState").on("change", function() {
            var state = this.value;
            $.post("loadUserCity.php", {
                state: state
            }, function(r) {
                //alert(r);
                $(".loadCity").html(r);
            });
        });
        //==========ON CHANGE LOAD CITY==========

    </script>

<?php } ?>