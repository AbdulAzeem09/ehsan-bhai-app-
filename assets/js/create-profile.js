document.addEventListener("DOMContentLoaded", function () {
  handleProfileChange();
  updateHeading();
  toggleRightBar();
  datepicker("#availableForm");
});
//profile dropdown
//document.getElementById('profile-select').value = 0
const threeDotWrapper = document.getElementById("three-dot-wrapper");
function clickThreeDot() {
  if (threeDotWrapper.style.display == "none") {
    threeDotWrapper.style.display = "flex";
  } else {
    threeDotWrapper.style.display = "none";
  }
}

$("#profile-select").change(function () {
  handleProfileChange();
  updateHeading();
  toggleRightBar();
});

function toggleEndDateFields() {
  const currentJobCheckbox = document.querySelector("#isCurrentJob");
  if (
    document.getElementById("endMonth") &&
    document.getElementById("endYear")
  ) {
    const endMonthSelect = document.getElementById("endMonth");
    const endYearSelect = document.getElementById("endYear");
    if (currentJobCheckbox.checked) {
      endMonthSelect.disabled = true;
      endMonthSelect.value = "";
      endYearSelect.disabled = true;
      endYearSelect.value = "";
    } else {
      endMonthSelect.disabled = false;
      endYearSelect.disabled = false;
    }
  }
}

document.addEventListener("DOMContentLoaded", (event) => {
  const currentJobCheckbox = document.querySelector("#isCurrentJob");
  toggleEndDateFields();
  currentJobCheckbox.addEventListener("change", toggleEndDateFields);
});

function handleProfileChange() {
  if (document.getElementById("profile-select")) {
    var select = document.getElementById("profile-select");
    var selectedText = select.options[select.selectedIndex].text;
    var additionalContentDiv = document.getElementById("additional-content");
    if (selectedText === "Select profile") {
      var url = "newprofile.php";
      additionalContentDiv.innerHTML = "";
    } else {
      var url = `create${selectedText}Profile.php`;

      fetch(url)
        .then((response) => response.text())
        .then((data) => {
          additionalContentDiv.innerHTML = data;
          if (
            selectedText == "Professional" ||
            selectedText == "Freelancer" ||
            selectedText == "Employment"
          ) {
            var dateid = "#availableForm";
            if (selectedText == "Employment") {
              dateid = "#graduate";
            }
            datepicker(dateid);
            populateYears("yearSelect", "");
          }
          var event = new CustomEvent("contentUpdated", {
            detail: additionalContentDiv.innerHTML,
          });
          document.dispatchEvent(event);
        })
        .catch((error) => {
          console.error(`Error fetching ${url}:`, error);
        });
    }
  }
}

function addExperience(item) {
  var toDate = "PRESENT";
  var toDateCheck = "";
  var current = false;
  var endmonth = "";
  var endyear = "";
  if (
    item.tomonth !== undefined &&
    item.tomonth !== "" &&
    item.tomonth !== null &&
    item.tomonthname !== undefined &&
    item.toyear !== undefined &&
    item.toyear !== "" &&
    item.toyear !== null
  ) {
    toDate =
      '<span class="end-month">' +
      item.tomonthname +
      "</span> <span class='end-year'>" +
      item.toyear +
      "</span>";
    endmonth = item.tomonth;
    endyear = item.toyear;
    toDateCheck = new Date(item.toyear, item.tomonth);
  } else {
    current = true;
    toDateCheck = new Date();
  }
  var fromyear = "";
  var frommonth = "";
  if (
    item.fromyear !== undefined &&
    item.fromyear !== "" &&
    item.fromyear !== null &&
    item.frommonth !== undefined &&
    item.frommonth !== "" &&
    item.frommonth !== null &&
    item.frommonthname !== undefined
  ) {
    fromyear = item.fromyear;
    frommonth = item.frommonthname;
    var fromDate = new Date(item.fromyear, item.frommonth);
    if (toDateCheck != "") {
      var totalMonths =
        (toDateCheck.getFullYear() - fromDate.getFullYear()) * 12 +
        (toDateCheck.getMonth() - fromDate.getMonth());
      var diffYears = Math.floor(totalMonths / 12);
      var diffMonths = totalMonths % 12;
      if (diffYears > 0) {
        if (diffYears > 1) {
          toDate = toDate + " . " + diffYears + " Years";
        } else {
          toDate = toDate + " . " + diffYears + " Year";
        }
      }
      if (diffMonths > 0) {
        if (diffMonths > 1) {
          toDate = toDate + " " + diffMonths + " Months";
        } else {
          toDate = toDate + " " + diffMonths + " Month";
        }
      }
    }
  }
  var jobtitle = "";
  if (item.jobtitle != undefined) {
    jobtitle = item.jobtitle;
  }
  var company = "";
  if (item.company != undefined) {
    company = item.company;
  }
  var emptype = "";
  if (item.emptype != undefined) {
    emptype = item.emptype;
  }
  var description = "";
  if (item.description != undefined) {
    description = item.description;
  }
  var html =
    '<div class="exp-list" id="experience-entry-' +
    item.id +
    '">' +
    '<div class="bold-title job-title" style="margin-bottom: 5px;">' +
    '<span id="job-title">' +
    jobtitle +
    "</span>" +
    '<div class="icon">' +
    '<span style="cursor: pointer;">' +
    '<svg width="28" height="28" viewBox="0 0 28 28" fill="none" class="edit-experience" xmlns="http://www.w3.org/2000/svg" data-id="' +
    item.id +
    '">' +
    '<rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>' +
    '<path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>' +
    "</svg>" +
    "</span>" +
    '<span style="cursor: pointer;">' +
    '<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-buttons" data-id="' +
    item.id +
    '">' +
    '<rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>' +
    '<path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>' +
    "</svg>" +
    "</span>" +
    "</div>" +
    "</div>" +
    '<div class="title">' +
    '<span class="company-name">' +
    company +
    '</span> . <span class="employment-type">' +
    emptype +
    "</span></br>" +
    '<span class="start-month">' +
    frommonth +
    '</span> <span class="start-year">' +
    fromyear +
    "</span> - " +
    toDate +
    "</br>";
  if (item.country != undefined) {
    html =
      html +
      '<span class="country" data-value="' +
      item.country +
      '">' +
      item.country_title +
      "</span>";
  }
  if (item.state != undefined) {
    html =
      html +
      ", " +
      '<span class="state" data-value="' +
      item.state +
      '">' +
      item.state_title +
      "</span>";
  }
  if (item.city != undefined) {
    html =
      html +
      ", " +
      '<span class="city" data-value="' +
      item.city +
      '">' +
      item.city_title +
      "</span>";
  }
  if (current == true) {
    html =
      html +
      '<span class="is-current-job" data-value="' +
      current +
      '">' +
      ". On-site" +
      "</span>";
  } else {
    html =
      html +
      '<span class="is-current-job hidden" data-value="' +
      current +
      '"></span>';
  }
  html =
    html +
    "</br></div>" +
    '<div class="text job-description" style="margin-bottom: 10px;">' +
    description +
    "</div>" +
    "</div>";
  return html;
}

function datepicker(id) {
  var option = {
    showOn: "focus",
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    yearRange: "c-100:c+10",
  };
  var currentVal = $(id).val();
  if (currentVal && currentVal != "") {
    $(id).datepicker(option);
    $(id).datepicker("setDate", currentVal);
  } else {
    option["minDate"] = 0;
    $(id).datepicker(option);
  }
  $("#datepicker-icon").click(function () {
    $(id).focus();
  });
}

//create profile name change
function updateHeading() {
  if (document.getElementById("profile-select")) {
    var select = document.getElementById("profile-select");
    var selectedText = select.options[select.selectedIndex].text;
    var heading = document.querySelector(".main-heading");
    if (selectedText != "Select profile") {
      heading.textContent = "Create " + selectedText + " Profile";
    } else {
      heading.textContent = "Create New Profile";
    }
  }
}

function toggleRightBar() {
  if (document.getElementById("profile-select")) {
    var select = document.getElementById("profile-select");
    var selectedText = select.options[select.selectedIndex].text;
    var rightBar = document.querySelector(".right-bar");

    if (selectedText === "Select profile") {
      rightBar.style.display = "none";
    } else {
      rightBar.style.display = "block";
    }
  }
}

function showContent(contentId, element) {
  // Remove 'active-link' class from all links
  var links = document.querySelectorAll(".group-navigation .link");
  links.forEach(function (link) {
    link.classList.remove("active-link");
  });

  // Add 'active-link' class to the clicked link
  element.classList.add("active-link");

  // Hide all content elements
  var contents = document.querySelectorAll(".content-section");
  for (var i = 0; i < contents.length; i++) {
    contents[i].classList.add("hidden");
  }

  // Show the selected content
  var selectedContent = document.getElementById(contentId);
  if (selectedContent) {
    selectedContent.classList.remove("hidden");
  }
}

//to show year dropdown
function populateYears(id, value) {
  const yearSelect = $(`#${id}`);
  var lastYear = 1900;
  if (id == "endYear" && $("#startYear").val() != "") {
    lastYear = parseInt($("#startYear").val());
  }
  if (yearSelect.length > 0) {
    yearSelect.empty();
    const selectOption = $("<option></option>").val("").text("Select Year");
    yearSelect.append(selectOption);
    const currentYear = new Date().getFullYear();
    for (let year = currentYear; year >= lastYear; year--) {
      const option = $("<option></option>").val(year).text(year);
      if (year == value) {
        option.attr("selected", "selected");
      }
      yearSelect.append(option);
    }
  }
}

//to show state dropdown
$(document).on("change", "#spUserCountry", function () {
  var countryId = $(this).val();
  statelisting(countryId, 0, 0);
  citylisting(0, 0, 0);
});

//to show city dropdown

$(document).on("change", "#spUserState", function () {
  var stateId = $(this).val();
  citylisting(stateId, 0, 0);
});

$(document).ready(function () {
  const uploadImageInput = $("#upload-image");
  const profileImage = $("#profile-image");
  const cameraContainer = $("#camera-container");
  const camera = $("#camera");
  const canvas = $("#canvas")[0];
  const capturedImageContainer = $("#captured-image-container");
  const capturedImage = $("#captured-image");
  let stream = null;

  // Event listener for selecting images from the gallery
  uploadImageInput.on("change", function (event) {
    const file = event.target.files[0];
    validateImageFile("upload-image", "upload-image-error");
    const $errorElement = $("#upload-image-error");

    // Proceed only if there are no error messages
    if (!$errorElement.text() && file) {
      // Clear captured image if any
      $("#captured-image").attr("src", "");
      $("#profile-image").attr("src", URL.createObjectURL(file));
      handleImageUpload(file);
    }
  });

  // Event listener for clicking 'Upload Image' link
  $("#upload-image-link").on("click", function (event) {
    event.preventDefault();
    uploadImageInput.click();
  });

  // Event listener for clicking 'Capture Photo' link
  $("#capture-photo-link").on("click", function (event) {
    event.preventDefault();
    cameraContainer.show();
    navigator.mediaDevices
      .getUserMedia({ video: true })
      .then(function (str) {
        stream = str;
        camera[0].srcObject = stream;
      })
      .catch(function (err) {
        console.error("Error accessing the camera: " + err);
      });
  });

  // Event listener for clicking 'Take Photo' link
  $("#take-photo-link").on("click", function (event) {
    event.preventDefault();
    const context = canvas.getContext("2d");
    canvas.width = camera[0].videoWidth;
    canvas.height = camera[0].videoHeight;
    context.drawImage(camera[0], 0, 0, canvas.width, canvas.height);
    capturedImage.attr("src", canvas.toDataURL("image/png"));
    capturedImageContainer.show();
  });

  // Event listener for clicking 'Cancel' button
  $("#cancel-photo-link").on("click", function (event) {
    event.preventDefault();
    if (stream) {
      stream.getTracks().forEach((track) => track.stop());
    }
    cameraContainer.hide();
    capturedImageContainer.hide();
  });

  // Event listener for clicking 'Upload' button
  $("#upload-photo-link").on("click", function (event) {
    event.preventDefault();
    const imageUrl = capturedImage.attr("src");

    if (imageUrl) {
      profileImage.attr("src", imageUrl);
      capturedImageContainer.hide();
      cameraContainer.hide();
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
      }
      fetch(imageUrl)
        .then((res) => res.blob())
        .then((blob) => handleImageUpload(blob))
        .catch((error) => {
          console.error("Error converting image to blob:", error);
        });
    }
  });

  // Function to handle image upload via AJAX
  function handleImageUpload(imageData) {
    const formData = new FormData();
    const profileType = $("#profile-select").val();
    const page = "createprofile";

    formData.append("spPostings_idspPostings", profileType);
    formData.append("page", page);
    formData.append("spPostingPic", imageData, "profileImage.jpg");

    callAjax(
      "Timeline",
      "postPic",
      formData,
      1,
      $(".error-message"),
      function (response) {
        console.log("Form submitted successfully:", response);
      }
    );
  }
});

function validateForm(event, profile, task) {
  event.preventDefault();
  let isValid = true;
  // Clear previous error messages
  $(".error-message").text("");
  // Define required fields based on profile type
  let requiredFields = [];
  if (profile === "business") {
    requiredFields = [
      "companyname",
      "companytagline",
      "companyPhoneNo",
      "ProductAndServices",
      "BusinessOverview",
      "CompanySpecialties",
      "spUserCountry",
      "spUserState",
      "spUserCity",
      "phone-status-private",
      "phone-status-public",
      "profile-status-private",
      "profile-status-public",
      "email-status-private",
      "email-status-public",
      "publish",
      "showEmail",
    ];
  } else if (profile === "professional") {
    requiredFields = ["careerCategory", "careerHighlights"];
  } else if (profile === "freelancer") {
    requiredFields = [
      "profiletype_",
      "hourlyrate_",
      "skill_",
      "workinginterests_",
      "Overview",
      "languagefluency_",
    ];
  } else if (profile === "family") {
    requiredFields = ["carrer", "choice_", "spDynamicWholesell"];
  } else if (profile === "employment") {
    requiredFields = [
      "spPostingEducationLevel_",
      "jobSeekProfileTagline",
      "spPostingJobType_",
      "Language_Fluency",
      "skill",
      "hobbies_",
      "achievements_",
      "certification_",
      "references_",
      "graduate",
    ];
  } else if (profile === "personal") {
    requiredFields = [
      "email",
      "phone-status-private",
      "phone-status-public",
      "email-status-private",
      "email-status-public",
      "personalCountry",
      "personalState",
      "personalCity",
      "firstname",
      "lname",
      "phone",
      "email",
      "phone-status-private",
      "phone-status-public",
      "email-status-private",
      "email-status-public",
      "personalCountry",
      "personalState",
      "personalCity",
      "store",
    ];
  }

  // Validate required fields
  $.each(requiredFields, function (index, field) {
    const element = $(`#${field}`);
    const errorElement = $(`#error-${field}`);
    if (!element.val() || (element.is("select") && element.val() === "0")) {
      if (errorElement.length) {
        errorElement.text("Please fill this field");
        errorElement.css("color", "red"); // Set error text color to red
      }
      if (isValid) {
        element.focus(); // Focus on the first invalid field
      }
      isValid = false;
    } else {
      if (errorElement.length) {
        errorElement.text(""); // Clear error message if field is filled
      }
    }
  });
  // Validate radio buttons
  if (profile !== "family") {
    var radioGroups = [
      { name: "phone_status", id: "phone-status" },
      { name: "email_status", id: "email-status" },
    ];
    if (profile !== "personal") {
      radioGroups.push({ name: "profile_status", id: "profile-status" });
    }
    $.each(radioGroups, function (index, group) {
      const errorElement = $(`#error-${group.id}`);
      if (!$(`input[name="${group.name}"]:checked`).length) {
        if (errorElement.length) {
          errorElement.text("Please select an option");
          errorElement.css("color", "red");
        }
        if (isValid) {
          $(`input[name="${group.name}"]`).first().focus(); // Focus on the first invalid radio group
        }
        isValid = false;
      } else {
        if (errorElement.length) {
          errorElement.text(""); // Clear error message if a radio button is selected
        }
      }
    });
  }

  // If the form is valid, submit it
  if (isValid) {
    var formData;
    if (task == "create") {
      formData = new FormData($("#profile-form")[0]);
    } else {
      formData = new FormData($("#editform")[0]);
    }
    if (profile === "family") {
      const table = $("#familyTable");
      const tbody = table.find("tbody");
      const rows = tbody.find("tr");
      const tableData = [];
      rows.each(function () {
        const cells = $(this).find("td");
        const memberName = cells.eq(0).text().trim();
        const relationType = cells.eq(1).text().trim();
        var obj = { memberName, relationType };
        if (task == "update") {
          var rowId = cells.find("svg[data-id]").attr("data-id");
          obj["id"] = rowId;
        }
        tableData.push(obj);
      });
      if (tableData.length > 0) {
        if (task == "create") {
          $.each(tableData, function (index, data) {
            formData.append(`memberName_${index}`, data.memberName);
            formData.append(`relationType_${index}`, data.relationType);
          });
        }
        if (task == "update") {
          formData.append("famTableData", JSON.stringify(tableData));
        }
      } else {
        // Append empty values or handle as needed
        formData.append("tableDataExists", "false");
      }
    } else if (
      profile === "employment" ||
      profile === "freelancer" ||
      profile === "professional" ||
      profile === "personal"
    ) {
      if (task == "update") {
        const monthMap = {
          Jan: 0,
          Feb: 1,
          Mar: 2,
          Apr: 3,
          May: 4,
          Jun: 5,
          Jul: 6,
          Aug: 7,
          Sep: 8,
          Oct: 9,
          Nov: 10,
          Dec: 11,
        };
        var experienceEntries = $("#experience-entries .exp-list").toArray();
        var expArray = [];
        if (experienceEntries.length > 0) {
          experienceEntries.forEach(function (entry, index) {
            var obj = {};
            obj.id = $(entry).find("svg.delete-buttons").data("id");
            obj.job = $(entry).find("#job-title").text();
            obj.companyName = $(entry).find(".company-name").text();
            obj.empType = $(entry).find(".employment-type").text();
            obj.startMonth = monthMap[$(entry).find(".start-month").text()];
            obj.startYear = $(entry).find(".start-year").text();
            obj.isCurrentJob = $(entry).find(".is-current-job").data("value");
            if (obj.isCurrentJob == false) {
              obj.endMonth = monthMap[$(entry).find(".end-month").text()];
              obj.endYear = $(entry).find(".end-year").text();
            }
            obj.country = $(entry).find(".country").data("value");
            obj.state = $(entry).find(".state").data("value");
            obj.city = $(entry).find(".city").data("value");
            obj.description = $(entry).find(".job-description").text();
            expArray.push(obj);
          });
          formData.append("experienceData", JSON.stringify(expArray));
        }
      }

      if (task == "create") {
        // Education table data collection logic here
        const eduTable = $("#eduTable");
        const eduTbody = eduTable.find("tbody");
        const eduRows = eduTbody.find("tr");
        const eduTableData = [];
        eduRows.each(function () {
          const cells = $(this).find("td");
          const schoolCollege = cells.eq(0).text().trim();
          const degree = cells.eq(1).text().trim();
          const fieldOfStudy = cells.eq(2).text().trim();
          const year = cells.eq(3).text().trim();
          eduTableData.push({ schoolCollege, degree, fieldOfStudy, year });
        });
        if (eduTableData.length > 0) {
          $.each(eduTableData, function (index, data) {
            formData.append(`school_${index}`, data.schoolCollege);
            formData.append(`empdegree_${index}`, data.degree);
            formData.append(`study_${index}`, data.fieldOfStudy);
            formData.append(`year_${index}`, data.year);
          });
        } else {
          // Append empty values or handle as needed
          formData.append("eduTableDataExists", "false");
        }
        if (
          profile === "professional" ||
          profile === "employment" ||
          profile === "freelancer"
        ) {
          var experienceEntries = $("#experience-entries").children(
            ".experience-entry"
          );
          experienceEntries.each(function (index, entry) {
            var jobTitle = $(entry).find(".job-title").text().trim();
            var companyName = $(entry).find(".company-name").text().trim();
            var employmentType = $(entry)
              .find(".employment-type")
              .text()
              .trim();
            var startMonth = $(entry).find(".start-month").attr("data-value");
            var startYear = $(entry).find(".start-year").attr("data-value");
            var endMonth = $(entry).find(".end-month").attr("data-value");
            var endYear = $(entry).find(".end-year").attr("data-value");
            var country = $(entry).find(".country").attr("data-value");
            var state = $(entry).find(".state").attr("data-value");
            var city = $(entry).find(".city").attr("data-value");
            var isCurrentJob =
              $(entry).find(".is-current-job").attr("data-value") === "true"
                ? 1
                : 0;
            var jobDescription = $(entry)
              .find(".job-description")
              .text()
              .trim();

            formData.append(`jobTitle_${index}`, jobTitle);
            formData.append(`companyName_${index}`, companyName);
            formData.append(`employmentType_${index}`, employmentType);
            formData.append(`startMonth_${index}`, startMonth);
            formData.append(`startYear_${index}`, startYear);
            formData.append(`endMonth_${index}`, endMonth);
            formData.append(`endYear_${index}`, endYear);
            formData.append(`country_${index}`, country);
            formData.append(`state_${index}`, state);
            formData.append(`city_${index}`, city);
            formData.append(`isCurrentJob_${index}`, isCurrentJob);
            formData.append(`jobDescription_${index}`, jobDescription);
          });
        }
      }

      if (task == "update") {
        var tableData = [];
        $("#educationTableBody tr").each(function () {
          var row = $(this);
          var rowId = row.find("svg[data-id]").attr("data-id");
          var rowData = {
            id: rowId,
            school: row.find("td").eq(0).text(),
            degree: row.find("td").eq(1).text(),
            fieldOfStudy: row.find("td").eq(2).text(),
            year: row.find("td").eq(3).text(),
          };
          tableData.push(rowData);
        });
        formData.append("educationTableData", JSON.stringify(tableData));
      }
    }

    if (task == "create") {
      callAjax(
        "CreateProfile",
        "postCreateprofiles",
        formData,
        1,
        $(".error-message"),
        function (response) {
          window.location.reload();
        }
      );
    } else {
      console.log(formData);
      callAjax(
        "EditProfile",
        "updateUserProfile",
        formData,
        1,
        $(".error-message"),
        function (response) {
          toastr.success("Profile updated successfully.");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        }
      );
    }
  }
}

function addFamilyMember() {
  // Get input values
  const memberName = $("#memberName").val().trim();
  const relationType = $("#relationType").val();

  // Get error message elements
  const errorMemberName = $("#error-memberName");
  const errorRelationType = $("#error-relationType");

  // Reset error messages
  errorMemberName.text("");
  errorRelationType.text("");

  // Validate inputs
  let valid = true;
  if (!memberName) {
    errorMemberName.text("Member Name is required");
    valid = false;
  }
  if (!relationType) {
    errorRelationType.text("Relation Type is required");
    valid = false;
  }

  if (valid) {
    // Check if there's a row being edited
    const editedRow = $(".edit-mode");
    if (editedRow.length) {
      // Update the edited row with new values
      editedRow.find("td:eq(0)").text(memberName);
      editedRow.find("td:eq(1)").text(relationType);
      // Remove the edit mode class
      editedRow.removeClass("edit-mode");
      // Clear input fields
      $("#memberName, #relationType").val("");
    } else {
      // Create new row
      const newRow = $("<tr></tr>");

      // Set cell values
      newRow.append(`<td>${memberName}</td>`);
      newRow.append(`<td>${relationType}</td>`);
      newRow.append(`
              <td>
                  <span style="cursor: pointer;" class="edit-btn">
                      <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="new" onclick="editRow(this, 'family')">
                          <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                          <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                      </svg>
                  </span>
                 <span style="cursor: pointer;" class="delete-btn">
                   <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="new" onclick="deleteElement(this, 'family')">
                     <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                   </svg>
                </span>
              </td>
           `);

      // Append row to table
      $("#familyTable tbody").append(newRow);

      // Clear input fields
      $("#memberName, #relationType").val("");
    }
  }
}

function statelisting(countryId, stateId, personal) {
  callAjax(
    "LoadStateCity",
    "readstate",
    { countryId: countryId },
    0,
    $(".error-message"),
    function (response) {
      var stateSelect = "";
      if (personal == 1) {
        stateSelect = $("#personalState");
      } else {
        stateSelect = $("#spUserState");
      }
      stateSelect.empty();
      stateSelect.append(
        $("<option>", {
          value: 0,
          text: "Select State",
          selected: "selected",
        })
      );
      $.each(response, function (index, state) {
        var option = $("<option>", {
          value: state.state_id,
          text: state.state_title,
        });
        if (state.state_id == stateId) {
          option.attr("selected", "selected");
        }
        stateSelect.append(option);
      });
    }
  );
}

function citylisting(stateId, cityId, personal) {
  callAjax(
    "LoadStateCity",
    "readcity",
    { stateId: stateId },
    0,
    $(".error-message"),
    function (response) {
      var spUserCity = "";
      if (personal == 1) {
        spUserCity = $("#personalCity");
      } else {
        spUserCity = $("#spUserCity");
      }
      spUserCity.empty();
      spUserCity.append(
        $("<option>", {
          value: 0,
          text: "Select City",
          selected: "selected",
        })
      );
      $.each(response, function (index, city) {
        var option = $("<option>", {
          value: city.city_id,
          text: city.city_title,
        });
        if (city.city_id == cityId) {
          option.attr("selected", "selected");
        }
        spUserCity.append(option);
      });
    }
  );
}

function editData(element) {
  var row = $(element).closest("tr");

  // Retrieve the data from the row
  const schoolCollegeInput = row.find("td:eq(0)").text();
  const degreeInput = row.find("td:eq(1)").text();
  const fieldOfStudyInput = row.find("td:eq(2)").text();
  const yearSelectInput = row.find("td:eq(3)").text();

  // Populate the input fields with the retrieved data
  $("#schoolCollegeInput").val(schoolCollegeInput);
  $("#degreeInput").val(degreeInput);
  $("#fieldOfStudyInput").val(fieldOfStudyInput);
  $("#yearSelect").val(yearSelectInput);

  // Mark the row as in edit mode
  row.addClass("edit-mode");
}

function addEducation() {
  const schoolCollegeInput = $("#schoolCollege").val().trim();
  const degreeInput = $("#degree").val();
  const fieldOfStudyInput = $("#fieldOfStudy").val();
  const yearSelectInput = $("#yearSelect").val();
  const errorSchoolCollegeInput = $("#error-schoolCollege");
  const errorDegreeInput = $("#error-degree");
  const errorFieldOfStudyInput = $("#error-fieldOfStudy");
  const errorYearSelectInput = $("#error-yearSelect");
  errorSchoolCollegeInput.text("");
  errorDegreeInput.text("");
  errorFieldOfStudyInput.text("");
  errorYearSelectInput.text("");
  let valid = true;
  if (!schoolCollegeInput) {
    errorSchoolCollegeInput.text("field is required");
    valid = false;
  }
  if (!degreeInput) {
    errorDegreeInput.text("field is required");
    valid = false;
  }
  if (!fieldOfStudyInput) {
    errorFieldOfStudyInput.text("field is required");
    valid = false;
  }
  if (!yearSelectInput || yearSelectInput === "Select Year") {
    errorYearSelectInput.text("field is required");
    valid = false;
  }

  if (valid) {
    // Check if there's a row being edited
    const editedRow = $(".edit-mode");
    if (editedRow.length) {
      // Update the edited row with new values
      editedRow.find("td:eq(0)").text(schoolCollegeInput);
      editedRow.find("td:eq(1)").text(degreeInput);
      editedRow.find("td:eq(2)").text(fieldOfStudyInput);
      editedRow.find("td:eq(3)").text(yearSelectInput);
      // Remove the edit mode class
      editedRow.removeClass("edit-mode");
    } else {
      // Create new row
      const newRow = $("<tr></tr>");
      // Set cell values
      newRow.append(`<td>${schoolCollegeInput}</td>`);
      newRow.append(`<td>${degreeInput}</td>`);
      newRow.append(`<td>${fieldOfStudyInput}</td>`);
      newRow.append(`<td>${yearSelectInput}</td>`);
      newRow.append(`
        <td>
          <span style="cursor: pointer;" class="edit-btn">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="editRow(this, 'education')">
          <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
          <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
          </svg>
          </span>
          <span style="cursor: pointer;" class="delete-btn">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-button" onclick="deleteElement(this, 'education')" data-id="new">
          <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125
          V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
          </svg>
          </span>
        </td>
      `);

      // Append row to table
      $("#educationTableBody").append(newRow);
    }
    populateYears("yearSelect", "");
    $("#schoolCollege, #degree, #fieldOfStudy").val("");
  }
}

$(document).on("click", ".add-exp", function () {
  $(".error-message").text("");
});

$(document).ready(function () {
  var count = $(".experience-entry").length;
  // Show the modal for adding a new experience
  $("#addExperienceBtn").on("click", function () {
    clearForm();
    statelisting(0, 0, 0);
    citylisting(0, 0, 0);
    $("#add-experience").modal("show");
  });

  // Save experience (add or edit)
  $("#saveExperience").on("click", function () {
    $(".error-message").text("");
    const monthMap = {
      Jan: 0,
      Feb: 1,
      Mar: 2,
      Apr: 3,
      May: 4,
      Jun: 5,
      Jul: 6,
      Aug: 7,
      Sep: 8,
      Oct: 9,
      Nov: 10,
      Dec: 11,
    };
    var experienceId = $("#experience-id").val();
    var experienceData = {
      jobtitle: $("#jobTitle").val(),
      emptype: $("#employmentType").val(),
      company: $("#companyName").val(),
      country: $("#spUserCountry").val(),
      state: $("#spUserState").val(),
      city: $("#spUserCity").val(),
      country_title: $("#spUserCountry").find("option:selected").text(),
      state_title: $("#spUserState").find("option:selected").text(),
      city_title: $("#spUserCity").find("option:selected").text(),
      isCurrentJob: $("#isCurrentJob").is(":checked"),
      frommonthname: $("#startMonth").val(),
      frommonth: monthMap[$("#startMonth").val()],
      fromyear: $("#startYear").val(),
      //tomonthname: $('#endMonth').val(),
      //tomonth: monthMap[$('#endMonth').val()],
      //toyear: $('#endYear').val(),
      description: $("#jobDescription").val(),
    };
    if (experienceData.isCurrentJob == false) {
      experienceData.tomonthname = $("#endMonth").val();
      experienceData.tomonth = monthMap[$("#endMonth").val()];
      experienceData.toyear = $("#endYear").val();
    }
    // Validate inputs
    let valid = true;

    if (!experienceData.jobtitle) {
      $("#error-jobTitle").text("field is required");
      valid = false;
    }
    if (!experienceData.emptype) {
      $("#error-employmentType").text("field is required");
      valid = false;
    }
    if (!experienceData.company) {
      $("#error-companyName").text("field is required");
      valid = false;
    }
    if (!experienceData.country) {
      $("#error-spUserCountry").text("field is required");
      valid = false;
    }
    if (!experienceData.state) {
      $("#error-spUserState").text("field is required");
      valid = false;
    }
    if (!experienceData.city) {
      $("#error-spUserCity").text("field is required");
      valid = false;
    }
    if (!experienceData.frommonthname) {
      $("#error-startMonth").text("field is required");
      valid = false;
    }
    if (!experienceData.fromyear) {
      $("#error-startYear").text("field is required");
      valid = false;
    }
    if (!experienceData.tomonthname && !isCurrentJob.checked) {
      $("#error-endMonth").text("field is required");
      valid = false;
    }
    if (!experienceData.toyear && !isCurrentJob.checked) {
      $("#error-endYear").text("field is required");
      valid = false;
    }
    if (!experienceData.description) {
      $("#error-jobDescription").text("field is required");
      valid = false;
    }
    if (valid) {
      if (experienceId) {
        // Edit experience
        experienceData["id"] = experienceId;
        $("#experience-entry-" + experienceId).replaceWith(
          addExperience(experienceData)
        );
      } else {
        // Add new experience
        experienceData["id"] = "new";
        $("#experience-entries").prepend(addExperience(experienceData));
      }

      $("#add-experience").modal("hide");
      clearForm();
      if (count > 2) {
        $("#showAllEntries").show();
      } else {
        $("#showAllEntries").hide();
      }
    }
  });

  // Edit experience
  $(document).on("click", ".edit-experience", function () {
    $(".error-message").text("");
    var experienceId = $(this).data("id");
    var entry = $("#experience-entry-" + experienceId);
    var country = entry.find(".country").data("value");
    var state = entry.find(".state").data("value");
    var city = entry.find(".city").data("value");
    if (country && state) {
      statelisting(country, state, 0);
    }
    if (state && city) {
      citylisting(state, city, 0);
    }
    populateYears("startYear", entry.find(".start-year").text());
    $("#experience-id").val(experienceId);
    $("#jobTitle").val(entry.find(".job-title").text());
    $("#employmentType").val(entry.find(".employment-type").text());
    $("#companyName").val(entry.find(".company-name").text());
    $("#spUserCountry").val(country);
    var iscurrent = entry.find(".is-current-job").data("value");
    $("#isCurrentJob").prop("checked", iscurrent);
    if (iscurrent == false) {
      $("#endMonth").val(entry.find(".end-month").text());
      populateYears("endYear", entry.find(".end-year").text());
      toggleEndDateFields();
    }
    $("#startMonth").val(entry.find(".start-month").text());
    $("#jobDescription").val(entry.find(".job-description").text());

    $("#add-experience").modal("show");
  });

  // Delete experience
  $(document).on("click", ".delete-experience", function () {
    var experienceId = $(this).data("id");
    $("#experience-entry-" + experienceId).remove();
  });

  $("#show-more-experience").on("click", function (e) {
    e.preventDefault();
    $("#experience-entries .experience-entry").show();
    $("#show-more-wrapper").hide();
  });

  function updateExperienceVisibility() {
    var experiences = $("#experience-entries .experience-entry");

    experiences.hide();
    experiences.slice(0, MAX_VISIBLE_EXPERIENCES).show();

    if (experiences.length > MAX_VISIBLE_EXPERIENCES) {
      $("#show-more-wrapper").show();
    } else {
      $("#show-more-wrapper").hide();
    }
  }

  function clearForm() {
    $("#experience-id").val("");
    $("#experience-form")[0].reset();
  }

  $("#showAllEntries").on("click", function () {
    $(".experience-entry").show(); // Show all entries
    $(this).hide(); // Hide 'Show All' button
  });

  // Initially hide all but the latest two entries
  var allEntries = $(".experience-entry");
  if (allEntries.length > 2) {
    allEntries.slice(0, allEntries.length - 2).hide();
    $("#showAllEntries").show(); // Show 'Show All' button
  } else {
    $("#showAllEntries").hide(); // Hide 'Show All' button if there are only 2 or fewer entries
  }
});
