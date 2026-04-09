<?php	

class Image{
    /*
     * Validates video file extensions
     * 
     * This method validates the file extensions of video files being uploaded. It checks whether the provided file extensions 
     * are allowed for video uploads. If the file extension is not allowed, it returns an error message indicating the 
     * invalid format along with a list of allowed video extensions.
     *
     * @param array $fileArray The $_FILES array element for the uploaded file.
     * @return string|null Error message if the file extension is not allowed, otherwise null.
     */

function validateFileVideoExtensions($fileArray) {
    $allowedExtensions = array('mp4', 'avi', 'mov', 'wmv', 'mkv', 'flv', 'mpg', 'mpeg', 'webm', 'avchd', '3gp', '3g2');
    
    if (is_array($fileArray['name'])) {
        foreach ($fileArray['name'] as $fileName) {
            if (!empty($fileName)) {
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                  echo '<script>alert("Please upload only video files.");</script>';
                  echo "<script>window.history.back();</script>";
                  exit;
                }
            }
        }
    } else {
        $fileName = $fileArray['name'];
        if (!empty($fileName)) {
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowedExtensions)) {
              echo '<script>alert("Please upload only video files.");</script>';
              echo "<script>window.history.back();</script>";
              exit;
            }
        }
    }
    
    return null;
}




    /*
     * Validates image file extensions
     * 
     * This method validates the file extensions of image files being uploaded. It checks whether the provided file extensions 
     * are allowed for image uploads. If the file extension is not allowed, it returns an error message indicating the 
     * invalid format.
     *
     * @param array $fileArray The $_FILES array element for the uploaded file.
     * @return string|null Error message if the file extension is not allowed, otherwise null.
     */
     
function validateFileImageExtensions($fileArray) {
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif');
    if (is_array($fileArray['name'])) {
        foreach ($fileArray['name'] as $fileName) {
            if (!empty($fileName)) {
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    echo '<script>alert("Please upload only image files.");</script>';
                    echo "<script>window.history.back();</script>";
                    exit;

                }
            }
        }
    } else {
        $fileName = $fileArray['name'];
        if (!empty($fileName)) {
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                echo '<script>alert("Please upload only image files.");</script>';
                echo "<script>window.history.back();</script>";
                exit;
            }
        }
    }
    
    return null;
    
}

 /*
     * Validates documenet file extensions
     * 
     * This method validates the file extensions of documenet files being uploaded. It checks whether the provided file extensions 
     * are allowed for documenet uploads. If the file extension is not allowed, it returns an error message indicating the 
     * Please upload only documnet files.
     *
     * @param array $fileArray The $_FILES array element for the uploaded file.
     * @return string|null Error message if the file extension is not allowed, otherwise null.
     */
     
     
function validateFileDocExtensions($fileArray) {
  $allowedDocumentExtensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'odt', 'rtf', 'ppt', 'pptx');
    if (is_array($fileArray['name'])) {
      foreach ($fileArray['name'] as $fileName) {
       if (!empty($fileName)) {
         $extension = pathinfo($fileName, PATHINFO_EXTENSION);
         if (!in_array(strtolower($extension), $allowedDocumentExtensions)) {
           echo '<script>alert("Please upload only documnet files.");</script>';
           echo "<script>window.history.back();</script>";
           exit;
         }
       }
      }
    } else {
      $fileName = $fileArray['name'];
      if (!empty($fileName)) {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedDocumentExtensions)) {
          echo '<script>alert("Please upload only document files.");</script>';
          echo "<script>window.history.back();</script>";
          exit;
        }
      }
    }

    return null;

}

// Function to validate csv files
function validateCsvExtension($fileArray) {
  if (is_array($fileArray['name'])) {
    foreach ($fileArray['name'] as $fileName) {
      if (!empty($fileName)) {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (strtolower($extension) !== 'csv') {
          echo '<script>alert("Please upload only CSV files.");</script>';
          echo "<script>window.history.back();</script>";
          exit;
        }
      }
    }
  } else {
    $fileName = $fileArray['name'];
    if (!empty($fileName)) {
      $extension = pathinfo($fileName, PATHINFO_EXTENSION);
      if (strtolower($extension) !== 'csv') {
        echo '<script>alert("Please upload only CSV files.");</script>';
        echo "<script>window.history.back();</script>";
        exit;
      }
    }
  }

  return null;
}


function validateFileImageExtensionsWithPDF($fileArray) {
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif','pdf');
    if (is_array($fileArray['name'])) {
        foreach ($fileArray['name'] as $fileName) {
            if (!empty($fileName)) {
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                   return "Please upload only image files or PDF for Profiles.";
                    // echo '<script>alert("Please upload only image files.");</script>';
                    // echo "<script>window.history.back();</script>";
                    // exit;

                }
            }
        }
    } else {
        $fileName = $fileArray['name'];
        if (!empty($fileName)) {
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                return "Please upload only image files or PDF for Profiles.";
                // echo '<script>alert("Please upload only image files.");</script>';
                // echo "<script>window.history.back();</script>";
                // exit;
            }
        }
    }
    
    return true;
    
}


}	


?>
