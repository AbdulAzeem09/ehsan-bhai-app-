	
	
	
	// ===WEBSITE URL
	var url_site = "http://localhost/marina/hfh/backofadmin/";
	// ===END
	
	$(document).ready(function () {
		// ===checkbox
		$('.checkbox').on("click", "input[type=checkbox]", function (e) {
			var catId = $(this).val();
			if ($(this).is(':checked')){
				$.post(url_site+"category/loadcatname", {catId: catId}, function (data) {
					$(".showCategory").append(data);
				});
			}else{
				//console.log("no");
				$(".cat_"+catId).remove();
				var proId = $("#hidId").val();
				$.post(url_site+"category/removecatname", {catId: catId, proId:proId}, function (data) {
					//console.log(data);
				});
			}
		});
		// WHEN CLICK ON THE ADD THEN THE PRODUCT ADD IN MULTI TABLES
		$(".showCategory").on("click", ".addCate", function () {
			var catId = $(this).attr("data-add-id");
			var $el=$("#mulSubCat_"+catId);
			var proId = $("#hidId").val();
			var txtDept = 1;
			if (proId > 0) {
				$el.find('option:selected').each(function(){
					var subCatId = $(this).val();
					//console.log(catId, subCatId);
					//===PRODUCT ADD TO MULTI CAT / SUB-CAT
					$.post(url_site+"product/addpromulticat", {proId:proId,txtDept:txtDept, catId: catId,subCatId:subCatId }, function (data) {
						//console.log(data);
					});
					//===END
				});
				
				$(this).text("Added");
			}
		});
		// WHEN CLICK ON THE UPDATE THEN THE PRODUCCT UPDATE IN MULTI TABLES
		$(".showCategory").on("click", ".updateCate", function () {
			var catId = $(this).attr("data-add-id");
			var $el=$("#mulSubCat_"+catId);
			var proId = $("#hidId").val();
			var txtDept = 1;
			if (proId > 0) {
				// DELETE ALL SUB-CATEGORY OLD FROM MULTI SELECT
				$.post(url_site+"product/dellpromulticat", {proId:proId, catId: catId}, function (data) {
					//console.log(data);
				});
				// END	
					
				$el.find('option:selected').each(function(){
					var subCatId = $(this).val();
					//console.log(catId, subCatId);
					//===PRODUCT ADD TO MULTI CAT / SUB-CAT
					$.post(url_site+"product/addpromulticat", {proId:proId,txtDept:txtDept, catId: catId,subCatId:subCatId }, function (data) {
						//console.log(data);
					});
					//===END
				});
				
				$(this).text("Updated");
			}
		});
		
		
		
		
		
		
		
		//===ADD ON CLICK
		$("#addcatmulti").on("click", function(){
			
			var $el=$("#txtNeCat");
			var proId = $("#hidId").val();
			var txtDept = 1;
			if (proId > 0) {
				if (txtDept > 0) {
					$el.find('option:selected').each(function(){
						var catId = $(this).val();
						$.post(url_site+"product/addpromulticat", {proId:proId,txtDept:txtDept, txtCat: catId}, function (data) {
							
						});
						//===END
					});
					$(".apendvalue").html('');
					$(".showBox").addClass("hidden");
					
					$("#shownewpro").html("<p class='alert alert-success' >Added Successfully!</p>");
				}
			}
		});
		
		// [LOAD CATEGORY ON DEPARTMENT CHANGE]
		$('#newDept').change(function(){
			//alert("this");
			if(this.value > 0){
				var depId = this.value;
				$.post(url_site+"subcategory/loadnewcat", {depId: depId}, function (data) {
					$("#newCategory").html(data);
				});
			}else{
				$("#newCategory").html('');
			}
		});
		// ===[LOAD SUB-CATEGORY]
		$(".chkCategory").on("click", ".spCategory", function () {
			var catId = $(this).val();
            if ($(this).is(':checked')){
				//shwo sub-category
				//console.log("checked");
				if(catId > 0){
					$.post(url_site+"product/newsubcat", {catId: catId}, function (data) {
						$("#newSubCat").append(data);
					});
				}
			}else{
				console.log("Not");
				//hide sub-category
				$(".cat_sub_"+catId).hide();
				$(".cat_sub_"+catId).html('');
			}
		});
		// ==[ON CLICK ADD THEN GET CATEGORY AND THEN GET SUB-CATEGORY]
		$('#btnnewadd').on("click", function(){
			var proId = $("#hidId").val();
			var txtDept = $("#newDept").val();
			if (proId > 0) {
				if (txtDept > 0) {
					$.each($("input[name='newcategory']:checked"), function(){
						//console.log($(this).val()+', ');
						var catId = $(this).val();
						//===sub-category
						$.each($("input[name='subcategory_"+catId+"']:checked"), function(){
							//console.log(catId+' , '+$(this).val() );
							var subcat = $(this).val();
							$.post(url_site+"product/addprofot", {proId:proId,txtDept:txtDept, txtCat: catId, txtSubCat:subcat }, function (data) {
								//console.log(data);
								//$("#shownewpro").html(data);
							});
							//===END
						});
						//===END
					});
					//===END
					$("#newSubCat").html('');
					$("#newCategory").html('');
					$("#shownewpro").html("<p class='alert alert-success' >Added Successfully!</p>");
				}
			}
		});
		
		
		
		
		
	});