<script type="text/javascript">
//RealEstate select===========
//===primary Agent===
$("#spPostPrimAgt").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostPrimAgt").val(ui.item.label);
$("#spPostPrimAgtId_").val(ui.item.value);
return false;
}
});
//===primary broker
$("#spPostPrimBrk").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostPrimBrk").val(ui.item.label);
$("#spPostPrimBrkId_").val(ui.item.value);
return false;
}
});
//===Secondary Agent===
$("#spPostSecAgt").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostSecAgt").val(ui.item.label);
$("#spPostSecAgtId_").val(ui.item.value);
return false;
}
});
//===Secondary Broker===
$("#spPostSecBrk").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostSecBrk").val(ui.item.label);
$("#spPostSecBrkId_").val(ui.item.value);
return false;
}
});
//===tertiary Agent===
$("#spPostTertAgt").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostTertAgt").val(ui.item.label);
$("#spPostTertAgtId_").val(ui.item.value);
return false;
}
});
//===tertiary Broker===
$("#spPostTertBrk").autocomplete({
minLength: 1,
source: "../../mlayer/listfriend.php?pid=" + $("#spProfiles_idspProfiles").val(),
focus: function () {
return false;
},
select: function (event, ui) {
$("#spPostTertBrk").val(ui.item.label);
$("#spPostTertBrkId_").val(ui.item.value);
return false;
}
});
//event select organizer end===========
</script>
<input id="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
<div class="col-md-6">
<div class="form-group">
<label for="spPostPrimAgtId_">Primary Agent</label>
<input type="hidden" class="spPostField" name="spPostPrimAgtId" id="spPostPrimAgtId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostPrimAgt" value="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostPrimBrkId_">Primary Broker</label>
<input type="hidden" class="spPostField" name="spPostPrimBrkId" id="spPostPrimBrkId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostPrimBrk" value="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostSecAgtId_">Secondary Agent</label>
<input type="hidden" class="spPostField" name="spPostSecAgtId" id="spPostSecAgtId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostSecAgt" value="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostSecBrkId_">Secondary Broker</label>
<input type="hidden" class="spPostField" name="spPostSecBrkId" id="spPostSecBrkId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostSecBrk" value="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostTertAgtId_">Tertiary Agent</label>
<input type="hidden" class="spPostField" name="spPostTertAgtId" id="spPostTertAgtId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostTertAgt" value="" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostTertBrkId_">Tertiary Broker</label>
<input type="hidden" class="spPostField" name="spPostTertBrkId" id="spPostTertBrkId_" data-filter="1" value="">
<input type="text" class="form-control spPostField" id="spPostTertBrk" value="" />
</div>
</div>