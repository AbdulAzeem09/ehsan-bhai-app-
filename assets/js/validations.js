
// Function to validate image files
function validateImageFile(inputId, errorElementId) {
  var input = document.getElementById(inputId);
  var file = input.files[0];
  var errorElement = document.getElementById(errorElementId);

  // Check if file is selected
  if (file) {
    var fileName = file.name;
    var fileExtension = fileName.split('.').pop().toLowerCase();
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif'];
    if (!allowedExtensions.includes(fileExtension)) {
      errorElement.textContent = "Please select a valid image file.";
      input.value = ''; // Clear the file input
    } else {
      errorElement.textContent = "";   
    }
  }
}


// Function to validate video files
function validateVideoFile(inputElementId, errorElementId) {
    var fileInput = document.getElementById(inputElementId);
    var file = fileInput.files[0];
    var errorElement = document.getElementById(errorElementId);

    // Check if file is selected
    if (file) {
        var fileName = file.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'flv', 'mpg', 'mpeg', 'webm', 'avchd', '3gp', '3g2'];
        if (!allowedExtensions.includes(fileExtension)) {
            errorElement.textContent = "Please select a valid video file.";
            fileInput.value = ''; // Clear the file input
        } else {
            errorElement.textContent = ""; 
        }
    }
}

// Function to validate doc files
function validateDocFile(inputElementId, errorElementId) {
  var fileInput = document.getElementById(inputElementId);
  var file = fileInput.files[0];
  var errorElement = document.getElementById(errorElementId);

  // Check if file is selected
  if (file) {
    var fileName = file.name;
    var fileExtension = fileName.split('.').pop().toLowerCase();
    var allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'odt', 'rtf', 'ppt', 'pptx'];
    if (!allowedExtensions.includes(fileExtension)) {
      errorElement.textContent = "Please select a valid Document file.";
      fileInput.value = ''; // Clear the file input
    } else {
      errorElement.textContent = ""; 
    }
  }
}

// Function to validate csv files
function validatecsvFile(inputId, errorId) {
  var allowedExtensions = /(\.csv)$/i;
  var fileInput = document.getElementById(inputId);
  var errorElement = document.getElementById(errorId);
  var fileName = fileInput.value;
  
  if (!allowedExtensions.exec(fileName)) {
    errorElement.innerText = "Please select a CSV file only";
    fileInput.value = '';
  } else {
    errorElement.innerText = ""; 
    return true;
  }
}


