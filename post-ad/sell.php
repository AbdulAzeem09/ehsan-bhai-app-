<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <style>
        .select2-search__field {
            width: 106px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #ccc !important;

            outline: 0;
        }

        /* #SelExample{
  width:200px;
} */

        body {

            border: 1px solid #ccc !important;

        }
    </style>
</head>

<input type="hidden" id="sellflag" name="spPostingsFlag" value="2">

<?php

//$arrcat = explode(",", $category);

//print_r($arrcat);

?>
<div class="col-md-4">
    <div class="form-group">
        <label for="subcategory_">Category </span><span style="font-size: 9px;color: black;font-weight: 600;">(Press Ctrl key and Select For Multiple Selection)</span></label><span style="">* <span class="lbl_20"></span>
            <!-- 
			<input type="hidden" class="spPostField" id="subcategory_" name="subcategory" value="</?php echo $category; ?>"> -->

            <select class="form-control subcat catego_sel" onchange="fun_cat(this)" id="subcategory_" name="subcategory" required>
                <?php
                $m = new _subcategory;
                $catid = 1;
                $result = $m->read($catid);
                if ($result) {
                    while ($rows = mysqli_fetch_assoc($result)) {


                        echo ucwords(strtolower($rows["subCategoryTitle"]));

                ?>

                        <option value='<?php echo $rows["subCategoryTitle"]; ?>' data-id="<?php echo $rows['idsubCategory']; ?>" <?php if (isset($category) && $category == $rows["subCategoryTitle"]) {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>";
                <?php
                    }
                }
                ?>
            </select>



            <!-- <button id="but_read">Selected Value</button> -->

            <!-- 	<select class="form-control " data-filter="1" multiple size="5" id="subcategory_" name="subcategory_">
					<option value="0">Select Category</option>

			  </select> -->
            <!-- <div class="invalid-feedback">
          Field is Require
        </div> -->
    </div>
</div>
<!-- <div class='col-md-4' >
		    <div class='form-group'>
		        <label for='sppostingShippingCharge' class="">Shipping Charges <span>*<span class="lbl_4"></span></span></label>
		        <input type='text' class='form-control' id='sppostingShippingCharge' name='sppostingShippingCharge' value='<?php echo $shipping; ?>'>
		    </div>
		</div> -->

<div class="hidbuy">

    <div class="col-md-4" style="" id="industry_select" style="display:none;">
        <div class="form-group">
            <label for="industryType_">Industry Type </span></label><span>* <span class="lbl_19"></span>
                <select class="form-control spPostField" data-filter="1" name="industryType_" id="industryType">
                    <option value="0">Select Industry Type</option>
                    <?php
                    $it = new _spAllStoreForm;
                    $result2 = $it->readIndustryType();
                    if ($result2) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                            <option value="<?php echo str_replace(' ', '', $row2['industryTitle']); ?>"><?php echo ucwords(strtolower($row2['industryTitle'])); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
        </div>
    </div>

    <!-- <div class="col-md-4" style="" id="industry_select" style="display:none;">
				<div class="form-group">
					<label for="industryType_">Industry Type <span>* <span class="lbl_19"></span></span></label>
					<select class="form-control spPostField" data-filter="1" name="industryType_" id="industryType">
						<option value="0">Select Industry Type</option>
						<?php
                        $it = new _spAllStoreForm;
                        $result2 = $it->readIndustryType();
                        if ($result2) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
								<option value="<?php echo str_replace(' ', '', $row2['industryTitle']); ?>"><?php echo ucwords(strtolower($row2['industryTitle'])); ?></option>
								<?php
                            }
                        }
                                ?>
				  </select>
				</div>
			</div> -->


    <!--  <div class="col-md-4" style="">
                <div class="form-group" style="padding-top: 26px;">
                    <input type="radio" class=" spPostField" value="Hard" id="hardqty" name="quantitytype" checked>
                    <label for="hardqty">Hard Quantity </label>
                    <input type="radio" class=" spPostField" value="Soft" id="softqty" name="quantitytype" >
                    <label for="softqty">Soft Quantity </label>


                </div>
            </div> -->


    <!-- <div class="col-md-4" style="">
                <div class="form-group">
                    <br>

                </div>
            </div>
             -->

    <!--Retail code of Sell-->
    <div class="retail-wholesheller">

        <?php
        //include_once ("retail.php");

        if ($selltype == "Auction") {

            include_once("auction.php");
        } elseif ($selltype == "Retail") {

            include_once("retail.php");
            # code...
        } elseif ($selltype == "Wholesale") {
            # code...
            include_once("wholesell.php");
        } else {

            include_once("retail.php");
        }

        ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function() {
        $('#hardqty').keypress(function(event) {
            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                event.preventDefault(); //stop character from entering input
            }
        });
        $('#softqty').keypress(function(event) {
            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                event.preventDefault(); //stop character from entering input
            }
        });
        /*    $('#retailSpecDiscount_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            $('#retailQuantity_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });*/
    });

    $(document).ready(function() {
        //console.log( "ready!" );
        $("#industry_select").hide();
    });
</script>



<script>
    $(document).ready(function() {




        /*$('.catego_sel').keypress(function(){
                alert("djsfdsj");
                $('.lbl_20').remove();

                });

            });*/
    });



    function fun_cat(a) {

        //alert(a);
        $('.lbl_20').remove();
    }
</script>

<script type="text/javascript">
    function checkprotype(protype) {


        if (protype == "1") {

            $("#showvarients").show();
            $("#showretailPrice").hide();

            $("#showretailQuantity").hide();


        } else {

            $("#showvarients").hide();
            $("#showretailPrice").show();
            $("#showretailQuantity").show();

        }
    }

    $(".addcustomsell").on("click", "#sellType_", function(e) {


        //alert($(this).val());

        //console.log($(this).val());

        /* if ($(this).val() == "Buynow"){
             $(".hidbuy").load("../buynow.php", {profileid: $("#spProfiles_idspProfiles").val(), retailflag: 1, postid: $("#postid").val()}, function (response) {
                 $("#sellflag").val(2);
             });
         }*/


        if ($(this).val() == "Auction") {
            $(".hidbuy").load("../auction.php", {
                profileid: $("#spProfiles_idspProfiles").val(),
                retailflag: 1,
                postid: $("#postid").val()
            }, function(response) {
                $("#sellflag").val(2);
                $("#industry_select").show();
            });
        } else if ($(this).val() == "Wholesaler") {

            //alert($(this).val());
            //wholesale panel
            $(".hidbuy").load("../wholesell.php", {
                profileid: $("#spProfiles_idspProfiles").val(),
                retailflag: 1,
                postid: $("#postid").val()
            }, function(response) {
                $("#sellflag").val(0);
                $("#industry_select").show();
            });
        } else if ($(this).val() == "Retail") {
            $("#industry_select").show();

            // alert($(this).val());
            $(".hidbuy").load("../retail.php", {
                profileid: $("#spProfiles_idspProfiles").val(),
                retailflag: 1,
                postid: $("#postid").val()
            }, function(response) {
                $("#sellflag").val(2);
                $("#industry_select").show();
            });
        }

    });




    $("select.subcat").change(function() {

        var subcategory = $(this).val();

        //if ($(".subcat option[value=Clothing]:selected").length > 0){
        if (subcategory == "Clothing") {

            $("#clothsize").show();

        } else {

            $("#clothsize").hide();

        }


        //if ($(".subcat option[value=Shoes]:selected").length > 0){
        if (subcategory == "Shoes") {

            $("#shoesize").show();

        } else {

            $("#shoesize").hide();

        }




        /*	alert(subcategory);
}
}
if ($("#catoption option[value=Clothing]:selected").length > 0){
    alert('all is selected');
}*/

        /*if (in_array("100", $marks))
        if ($("#subcategory_ option[value=Clothing]:selected").length > 0){
            alert('all is selected');
        }*/
        //alert(subcategory);
        $("#subcategory_").val(subcategory);

        /* var str = $(this).val().split(',');
    if ($.inArray("Clothing", str) !== -1) {
        alert('match!');
    } else {
        alert('no match!');
    };*/

    });

    $(document).ready(function() {
        $(".subcat").select2({
            width: "100%",
            placeholder: "Select Category",
            allowClear: true,
            maximumSelectionLength: 5
        });
    });
</script>

<!-- <script type="text/javascript">
$('#SelExample').select2({
    selectOnClose: true
});
</script> -->