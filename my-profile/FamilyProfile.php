<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/create-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <title>Master Dashboard</title>
</head>
<body>
    <div class="body-wrapper">
        <div class="nav-bar">
        </div>
        <div class="profile-wrapper">
            <div class="left-bar">
                <div class="heading">
                    My Profiles
                </div>
                <div class="left-bar-wrapper">
                    <div class="profile">
                        <div class="img-wrapper">
                            <img src="./images/user.svg" alt="">
                        </div>
                        <div class="detail">
                            <div class="name">Amelia Joseph</div>
                            <div class="title">Personal Profile</div>
                        </div>
                        <div class="check">
                            <img src="./images/check.svg" alt="">
                        </div>
                    </div>
                    <div class="profile" style="margin-bottom: 25px;">
                        <div class="img-wrapper">
                            <img src="./images/user.svg" alt="">
                        </div>
                        <div class="detail">
                            <div class="name">Amelia Joseph</div>
                            <div class="title">Personal Profile</div>
                        </div>
                        <div class="check">
                        </div>
                    </div>
                    <a href="">
                        <div class="create-btn">
                            <img src="./images/add.svg" alt="">
                            ADD NEW PROFILE
                        </div>
                    </a>
                    <div class="referal-code">
                        <div class="referal">
                            <div class="title">Referral Code:</div>
                            <div class="code">Q$J2O6GF</div>
                        </div>
                        <img src="./images/code.svg" alt="">
                    </div>
                </div>
            </div>
            <form class="profile">
                <div class="create-profile">
                    <div class="main-heading">
                        Create Family Profile
                    </div>
                    <div class="creat-profile-wrapper">
                        <div class="input-group">
                            <label>Select Profile<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" onchange="openTap()" id = "profile-select">
                                <option selected>Select Profile</option>
                                <option value="1">Business</option>
                                <option value="3">Professional</option>
                                <option value="2">Freelancer</option>
                                <option value="4">Employment</option>
                                <option value="5">Family</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Profile Name</label>
                            <input type="text" placeholder="Enter Profile Name">
                        </div>
                    </div>
                    
                </div>
              
                <div class="business-overview">
                    <div class="sub-heading">
                        Family Member
                    </div>
                    <div class="input-wrapper">
                        <div class="input-group in-2-col" >
                            <label>Member Name<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Member Name</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="input-group in-2-col" >
                            <label>Relation Type<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Relation Type</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="input-group in-1-col d-flex " style="align-items: center;">
                            
                            <img src="./images/add-2.svg" alt="">
                            <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
                                Add
                            </span>
                           
                        </div>
                        <div class="table-wrapper in-1-col">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="text-align: left; ">Family Member Name</th>
                                        <th style="width: 50%; text-align: left;" >Relation Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">Member Name 1</td>
                                        <td style="text-align: left;">Son</td>
                                        <td>
                                            <span style="cursor: pointer; ">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                                    <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                                </svg>
                                            </span>
                                            <span style="cursor: pointer;">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                                                </svg>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Member Name 2</td>
                                        <td  style="text-align: left; ">Sisier</td>
                                        <td>
                                            <span style="cursor: pointer;">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                                    <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                                </svg>
                                            </span>
                                            <span style="cursor: pointer;">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                                                </svg>
                                            </span>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="business-overview">
                    <div class="sub-heading">
                        Overview
                    </div>
                    <div class="input-wrapper">
                        <div class="input-group in-1-col">
                            <label>Store Name<span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Enter Store Name">
                        </div>
                        <div class="input-group in-1-col">
                            <label>My Interest<span style="color: #EF1D26;">*</span></label>
                            <textarea  placeholder="Type My Interest.." rows="4" cols="50"></textarea>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Career In<span style="color: #EF1D26;">*</span></label>
                            <textarea  placeholder="Type Career In.." rows="4" cols="50"></textarea>
                        </div>
                    </div>
                   
                </div>
                
                <div class="main-btns" style="margin-top: 30px;">
                    <button>CANCEL</button>
                    <button class="active">CREATE PROFILE</button>
                </div>
            </form>
            <div class="right-bar">
                <div class="heading">
                    Profile Picture
                </div>
                <div class="icon-wrapper">
                    <img src="./images/profile-img.svg" alt="">
                </div>
                <div class="title">
                    Upload Image
                </div>
                <div class="or">
                    OR
                </div>
                <div class="title">
                    Capture Photo from Camera
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
    <script>
        document.getElementById('profile-select').value = 5
        const threeDotWrapper = document.getElementById('three-dot-wrapper')
        function clickThreeDot() {
            if(threeDotWrapper.style.display == 'none') {
                threeDotWrapper.style.display = 'flex'
            } else {
                threeDotWrapper.style.display = 'none'
            }
        }
        
    </script>
</body>
</html>
