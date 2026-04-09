    <script>
        function getresult(url) {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    rowcount: $("#rowcount").val(),
                    "pagination_setting": $("#pagination-setting").val()
                },
                beforeSend: function() {
                    $("#overlay").show();
                },
                success: function(data) {
                    $("#pagination-result").html(data);
                    setInterval(function() {
                        $("#overlay").hide();
                    }, 500);
                },
                error: function() {}
            });
        }
    </script>

    <div class="post_timeline timeline_Photo bradius-15 bg-white">
        <!-- image gallery start -->
        <input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
        <input type="hidden" name="txtPagid" id="txtPagid" value="1">
        <!-- <div class="row filterArea no-margin bradius-20 bg-white">
            <div class="col-md-5 " style="padding: 3px;">
                <input type="checkbox" id="select_all" >&nbsp;&nbsp;Select All&nbsp;&nbsp;
                <input type="button" id="delete_records" class="btn btn-primary fav_del_btn" value="Unfavorite">
            </div>
            <div class="col-md-3 no-padding">
                <form class="form-inline">
                    <div class="form-group">
                        <label>Sort By</label>
                        <select class="form-control ordrSave bradius-20">
                            
                            <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-4 no-padding">
                <form class="">
                    <div class="">
                        <input type="text" name="" value="" id="searchtx" class="form-control searchkeywordbox" placeholder="search keyword, description" />
                    </div>
                </form>
            </div>
        </div>-->
        <div class="row" style="min-height:70px;">
            <div class="gallery-img br_radius_top bradius-15" id="update_gallery">
                <!---<div id="overlay"><div><img src="<?php //echo $BaseUrl.'/assets/images/'
                                                        ?>loading.gif" width="64px" height="64px"/></div></div>-->
                <div class="page-content">

                    <div id="pagination-result">
                        <input type="hidden" name="rowcount" id="rowcount" />
                    </div>
                </div>
                <script>
                    getresult("getresult.php");
                </script>

            </div>
        </div>

        <!-- image gallery end -->
    </div>