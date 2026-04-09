const monthMap =['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
document.addEventListener("DOMContentLoaded", function() {
  var profileType = $("#pro-type").text();
  var profileid = $("#profileid").text();
  if(profileType == 2 || profileType == 3 || profileType == 5 || profileType == 4){
    var experror = $("#experience_error");
    callAjax("PublicView", "getUserExperience", {profileid: profileid}, 0, experror, function(success){
      if (success.error == undefined && success != '{}') {
        if(success.experience != undefined && success.experience.length > 0){
          var mainhtml = '';
          $.each(success['experience'], function(index, item){
            if(item.tomonth != undefined){
              item.tomonthname = monthMap[item.tomonth];
            }
            if(item.frommonth != undefined){
              item.frommonthname = monthMap[item.frommonth];
            }
            var html = addExperience(item);
            mainhtml = mainhtml+html;
          });
          if(success.count > 2){
            mainhtml = mainhtml+'<a class="view-all" id="exp-all">'+
            'View All '+success.count+' experiences'+
            '</a>'+
            '<input type="hidden" id="exp_all" value="'+success.count+'">'+
            '</div>';
          }
          $("#experience-entries").append(mainhtml);
        }
      }
    });
    
    if(profileType == 4){
      getEmailTable();
    }
    
  }
  document.getElementById('edit-icon').addEventListener('click', function() {
    document.getElementById('file-input').click();
  });
  document.getElementById('file-input').addEventListener('change', function(event) {
    if (event.target.files && event.target.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profilepic').src = e.target.result;
      };
      reader.readAsDataURL(event.target.files[0]);
      const page = "editprofile";
      const formData = new FormData();
      formData.append('spPostingPic', event.target.files[0]);
      formData.append('page', page);
      callAjax("Timeline", "postPic", formData, 1, $('.error-message'), function(response) {
          location.reload();
      });
    }
  });
  var name = document.getElementById("name").value;
  var modalHTML = `
   <style>
   .narrow-input:focus {
    outline: none;
  }
   .cancel-btn:hover {
        color: #fff;
        background-color: var(--bs-btn-hover-bg);
        border-color: var(--bs-btn-hover-border-color);
   }
   </style>
    <div id="myModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span>Update Profile Name</span>
        </div>
        <div class="modal-body">
          <input type="text" id="textInput"  value="${name}" class="narrow-input" style="height:42px">
        </div>
        <div class="modal-footer">
          <button class="cancel-btn" id="cancelBtn" style="background: #565e64;">Cancel</button>
          <button class="update-btn" id="updateBtn" style="background: linear-gradient(135deg, #FB8308, #f1a500);">Update</button>
        </div>
      </div>
    </div>`;
        
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    var modal = document.getElementById("myModal"); 
    var openModalBtn = document.getElementById("openModal");
    var closeModalBtn = document.getElementById("closeModal");
    var cancelBtn = document.getElementById("cancelBtn");
    var updateBtn = document.getElementById("updateBtn");
    openModalBtn.onclick = function() {
      modal.style.display = "flex";
    }
    cancelBtn.onclick = function() {
      modal.style.display = "none";
    }
    updateBtn.onclick = function() {
      var textInput = document.getElementById("textInput").value; 
      modal.style.display = "none";
      var MAINURL = window.location.origin;
      $.ajax({
        url: MAINURL + "/api.php?class=EditProfile&action=updateUser",
        type: "POST",
        data: {
          text: textInput
        },
        success: function(response) {
          console.log(" successful");
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error("failed:", error);
          location.reload();
        }
      });
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
});

$(document).on('click', '#exp-all', function() {
  var profileid = $("#profileid").text();
  var MAINURL = window.location.origin;
  var allcount = Number($('#exp_all').val());
  var experror = $("#experience_error");
  callAjax("PublicView", "getUserExperience", {profileid: profileid, skip: 2, limit: allcount}, 0, experror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.experience != undefined && success.experience.length > 0){
        var mainhtml = "";
        $.each(success['experience'], function(index, item){
          if(item.tomonth != undefined){
            item.tomonthname = monthMap[item.tomonth];
          }
          if(item.frommonth != undefined){
            item.frommonthname = monthMap[item.frommonth];
          }
          var html = addExperience(item);
           mainhtml = mainhtml+html;
        });
        $("#exp-all").css({
          display: "none"
        });
        $("#experience-entries").append(mainhtml);
      }
    }
  });
});

$(document).on("change", "#spUserCountry", function () {
  var countryId = $(this).val();
  statelisting(countryId, 0, 0);
});

$(document).on("change", "#personalCountry", function () {
  var countryId = $(this).val();
  statelisting(countryId, 0, 1);
});

$(document).on("change", "#personalState", function () {
  var stateId = $(this).val();
  citylisting(stateId, 0, 1);
});

$(document).on("change", "#spUserState", function () {
  var stateId = $(this).val();
  citylisting(stateId, 0, 0);
});

$(document).ready(function() {
  var ptype = $("#pro-type").text();
  if(ptype == 4){
    var countryId = $('#personalCountry').val();
    var stateId = $('#personalState').val();
    var cityId = $('#personalCity').val();
    if (stateId != 0 && countryId!= 0){
      statelisting(countryId, stateId, 1);
    }
    if (stateId != 0 && cityId!= 0){
      citylisting(stateId, cityId, 1);
    }
  } else{
    var countryId = $('#spUserCountry').val();
    var stateId = $('#spUserState').val();
    var cityId = $('#spUserCity').val();
    if (stateId != 0 && countryId!= 0){
      statelisting(countryId, stateId, 0);
    }
    if (stateId != 0 && cityId!= 0){
      citylisting(stateId, cityId, 0);
    }
  }
  var prefilledDate = $('#datepicker-input').val();
  var graduateprefilledDate = $('#graduate').val();
  var avialabaleprefilledDate = $('#availableForm').val();
  var dateid = '#datepicker-input';
  if(graduateprefilledDate){
    dateid = '#graduate';
  }
  if(avialabaleprefilledDate){
    dateid = '#availableForm';
  }
  var dateFormat = 'yy-mm-dd';
  $('#datepicker-icon').click(function() {
    $(dateid).datepicker('show');
  });
  $(dateid).datepicker({
    dateFormat: dateFormat,
    defaultDate: prefilledDate ? $.datepicker.parseDate(dateFormat, prefilledDate) : null,
    changeMonth: true,
    changeYear: true,
    onSelect: function(dateText, inst) {
    var selectedDate = $.datepicker.formatDate('yy-mm-dd', new Date(dateText));      
      $(dateid).val(selectedDate);
    }
  });
  
  $('#continue-button').click(function() {
    $("#email-table").empty();
    getEmailTable();
  });
  
  // $('#first_verify').click(function() {
  //   var email = $('#personalEmail').val().trim();
  //   var code = $('#register_otp').val().trim();
  //   var emailError = $('#error-personalEmail');
  //   var codeError = $('#error-first_verify');
  //   emailError.text('');
  //   codeError.text('');
  //   var valid = true;
  //   var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  //   if (!email) {
  //     emailError.text('Please fill this field');
  //     valid = false;
  //   } else if(!emailPattern.test(email)) {
  //     emailError.text('Invalid email');
  //     valid = false;
  //   }
  //   // if (!code) {
  //   //   codeError.text('Please fill this field');
  //   //   valid = false;
  //   // }
  //   if(valid == true){
  //     callAjax("EditProfile", "sendOtp", { type: 'first', mail: email, code: code }, 0, codeError, function(response) {
  //       console.log("After OTP verification response: ", response.toString());
  //       getEmailTableAfterAdd();
  //       let errorObj = $('#error-first_verify');
  //       if(response.toString() != "Success"){
  //         console.log("inside if: ", errorObj);
  //          errorObj.parent().removeClass('hidden').find("label,div").hide();
  //          errorObj.html("Email already exists").show();
  //       } else{
  //         $('.first').addClass('hidden');
  //         $('.second').removeClass('hidden');
  //         //  errorObj.closest(".first").find(".input-group").eq(0).hide();
  //         //  errorObj.closest(".first").find(".input-group").eq(1).removeClass("hidden").find("label").show();
  //         //  errorObj.closest(".first").find(".input-group").eq(1).find(".verify").show();
  //         //  errorObj.closest(".first").find(".input-group").eq(1).find(".verify-btn").show();
  //          console.log("inside else  ", errorObj);
  //       }
  //       // if(response == 1){
  //       // if(response == "Success" || response == 1){
  //       //   $('.retry').addClass('retry-show');
  //       //   $('.first').addClass('hidden');
  //       //   $('.second').removeClass('hidden');
  //       // }
  //     });
  //   }
    
  // });
  
  // $('#second_verify').click(function() {
  //   var email = $('#personalEmail').val().trim();
  //   var code = $('#new_otp').val().trim();
  //   var codeError = $('#error-second_verify');
  //   codeError.text('');
  //   var valid = true;
  //   if (!code) {
  //     codeError.text('Please fill this field');
  //     valid = false;
  //   }
  //   if(valid == true){
  //     callAjax("EditProfile", "sendOtp", { type: 'third', mail: email, code: code }, 0, $('.error-message'), function(response) {
  //       if(response == 1){
  //         $('.second').addClass('hidden');
  //         $('.success').removeClass('hidden');
  //         $('.modal-footer').removeClass('hidden');
  //       } else {
  //         $('.second').addClass('hidden');
  //         $('.fail').removeClass('hidden');
  //         $('.modal-footer').removeClass('hidden');
  //         $('#verifyEmailError').text('Enter the code we sent to your email address '+email);
  //       }
  //     });
  //   }
  // });
  
  // $('#send-again1').click(function() {
  //   $('#addmail').click();
  // });
  // $('#send-again2').click(function() {
  //   var email = $('#personalEmail').val().trim();
  //   callAjax("EditProfile", "sendOtp", { type: 'second', mail: email, resend: 1 }, 0, $('.error-message'), function(response) {
  //   });
  // });
  
  $(document).on('click', '#addmail', function() {
    $('.first').removeClass('hidden');
    $('.second').addClass('hidden');
    $('.success').addClass('hidden');
    $('.fail').addClass('hidden');
    $('.modal-footer').addClass('hidden');
    $("#personalEmail").val("");
    $("#register_otp").val("");
    $('#new_otp').val("");
    var mail = $('#primary-mail').html();
    console.log(mail);
    // callAjax("EditProfile", "sendOtp", { type: 'first', mail: mail }, 0, $('.error-message'), function(response) {
    // });
  });
  
});


$(document).on("change", "#spUserCountry", function () {
  var countryId = $(this).val();

  callAjax("LoadStateCity", "readstate", { countryId: countryId }, 0, $('.error-message'), function(response) {
    var $stateSelect = $("#spUserStates");

    // Clear existing options before appending new ones
    $stateSelect.empty();
    
    // Add the default "Select State" option
    $stateSelect.append($('<option>', {
        value: 0,
        text: "Select State",
        selected: "selected"
    }));
    
    // Append each state title as an option to the select element
    $.each(response, function(index, state) {
      $stateSelect.append($('<option>', {
          value: state.state_id,  
          text: state.state_title
      }));
    });
  });
});

function getEmailTableAfterAdd(){
  callAjax("EditProfile", "fetchPersonalMails", {}, 1, $('.error-message'), function(response) {
    var html = '';
    $.each(response, function(index, item){
      html = html + addMail(item);
    });
    $("#email-table").html(html);
  });
}

function getEmailTable(){
  // callAjax("EditProfile", "fetchPersonalMails", {}, 1, $('.error-message'), function(response) {
  //   var html = '';
  //   if(response.length < 10){
  //     if ($('#addmail').length == 0) {
  //       var moreHtml = '<div id="addmail" class="input-group in-1-col d-flex " style="align-items: center; margin-top: 20px; cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#email-add-sucess">'+
  //       '<img src="./images/add-2.svg" alt="">'+
  //       '<span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">'+
  //       'Add More Email'+
  //       '</span>'+
  //       '</div>';
  //       $("#more-email").append(moreHtml);
  //     }
  //   } else {
  //     $("#more-email").empty();
  //   }
  //   $.each(response, function(index, item){
  //     html = html + addMail(item);
  //   });
  //   $("#email-table").append(html);
  // });
}

function addMail(item){
  var rowId = '';
  var primary = 0;
  if(item.primary_mail != undefined && item.primary_mail == 1){
     rowId = "id='primary-mail'";
     primary = 1;
  }
  var html = '<tr>'+
  '<td '+rowId+' data-id="'+item.id+'" >'+item.email+'</td>'+
  '<td>';
  if(primary == 1) {
    html = html+'<span class="primary-email default">Primary Email</span>'
  } else {
    html = html + '<span class="primary-email active" onclick="makePrimary('+item.id+')" >Make it Primary</span>'+
    '<span style="cursor: pointer;" onclick="deleteEmail('+item.id+')">'+
    '<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">'+
    '<rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>'+
    '<path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>'+
    '</svg>'+
    '</span>';
  }
  html = html +'</td>'+
  '</tr>';
  return html
}

function deleteEmail(id){
  if(id != undefined || id != 0){
    Swal.fire({
      title: 'Do you want to delete this email?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!'
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(id);
        callAjax("EditProfile", "deleteEmail", {'id': id}, 0, $('.error-message'), function(response) {
          $("#email-table").empty();
          getEmailTable();
        });
      }
    });
  }
}

function makePrimary(id){
  if(id != undefined || id != 0){
    Swal.fire({
      title: 'Do you want to make this email primary?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!'
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(id);
        callAjax("EditProfile", "makePrimary", {'id': id}, 0, $('.error-message'), function(response) {
          $("#email-table").empty();
          getEmailTable();
        });
      }
    });
  }
}

function populateYear() {
  const yearSelect = document.getElementById('yearSelects');
  if (yearSelect) {
      const currentYear = new Date().getFullYear();
      for (let year = currentYear; year >= 1900; year--) {
          const option = document.createElement('option');
          option.value = year;
          option.text = year;
          yearSelect.appendChild(option);
      }
  }
}
$(document).on("change", "#spUserStates", function () {
  var stateId = $(this).val();

  callAjax("LoadStateCity", "readcity", { stateId: stateId }, 0, $('.error-message'), function(response) {
    var $spUserCity = $("#spUserCitys");
    
    $spUserCity.empty();
    // Append each City title as an option to the select element
    $.each(response, function(index, city) {
      $spUserCity.append($('<option>', {
          value: city.city_id,  
          text: city.city_title  
      }));
    });

    // Set the "Select City" option as selected by default using jQuery
    $spUserCity.prepend($('<option>', {
        value: 0,
        text: "Select City",
        selected: "selected" 
    }));
  });
});

$(document).on('click', '.delete-buttons', function() {
  var rowId = $(this).data('id');  
  callAjax("EditProfile", "deleteExperince", { rowId: rowId }, 0, $('.error-message'), function(response) {
    location.reload();
  });
});

document.addEventListener('DOMContentLoaded', function() {
  var foundedYear = $("#found-year").val();
  populateYears('yearSelect', foundedYear);

  let editingRow = null; 
  
});

function deleteElement(element, type) {
  var rowId = $(element).data('id');  
  if(rowId == 'new'){
    $(element).closest('tr').remove();
  } else {
    if(type == 'education'){
      callAjax("EditProfile", "deleteEducation", { rowId: rowId }, 0, $('.error-message'), function(response) {
        $(element).closest('tr').remove();
      });
    }
    if(type == 'family'){
      callAjax("EditProfile", "deleteFamilyMember", { rowId: rowId }, 0, $('.error-message'), function(response) {
        $(element).closest('tr').remove();
      });
    }
  }
}

function editRow(element, type) {
  var row = element.closest('tr');
  const rowId = element.getAttribute('data-id');
  if(type == 'family'){
    const member = row.cells[0].innerText;
    const relation = row.cells[1].innerText;
    row.editingData = {
      id: rowId,
      member: member,
      relation: relation,
    };
    document.getElementById('memberName').value = member;
    document.getElementById('relationType').value = relation;
  }
  if(type == 'education'){
    const school = row.cells[0].innerText;
    const degree = row.cells[1].innerText;
    const fieldOfStudy = row.cells[2].innerText;
    const year = row.cells[3].innerText;
    row.editingData = {
      id: rowId,
      school: school,
      degree: degree,
      fieldOfStudy: fieldOfStudy,
      year: year
    };
    document.getElementById('schoolCollege').value = school;
    document.getElementById('degree').value = degree;
    document.getElementById('fieldOfStudy').value = fieldOfStudy;
    populateYears('yearSelect', year);
  }
  row.classList.add('edit-mode');
}


