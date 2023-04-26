
<?php include '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/includes/header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        .hidden {display:none;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>User Profile</h2>

        <?php
        
        require_once '../../controllers/UserController.php';
        $controller = new UserController();
        $user_info = $controller->userProfileEdit();
        if ($guest) {
        $url = "https://badger-timeline.infinityfreeapp.com/public_html";
        echo "<script>window.location.replace('$url');</script>";
        exit;
        }
        $username = $user_info['username'];
        $email= $user_info['email'];
        // handle form submission

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
           
            if (isset($_POST['update']) && strlen($_POST['username'])>=1) 
            {
                require_once '../../controllers/UserController.php';
                $controller = new UserController();
                $check = $controller->updateUserProfile();
                if($check== true && !is_int($check))
                {
                    $url = "https://badger-timeline.infinityfreeapp.com/public_html/views/user/profile";
                    echo "<script>window.location.replace('$url');</script>";
                    exit;
                }
                else 
                {
                    echo "<script> document.getElementById('edit_button').click(); </script>";
                    $password_error = "";
                    $email_error = "";
                    if($result == 1)
                    {
                    
                        $password_error ="Password needs at least one special character";
                    }
                    else if($result == 2)
                    {
                         $password_error ="Password has non alphanumeric characters that are not special characters";
                    }
                    else if($result == 3)
                    {
                         $password_error ="Password needs at least 8 characters";
                    }
                    else if($result == 4)
                    {
                         $password_error ="Password needs at least 2 UpperCase";
                    }
                    else if($result == 5)
                    {
                         $email_error ="Email already exists";
                    }
                }
            }

            else if(strlen($_POST['username'])<1)
            {
                echo "<script> document.getElementById('edit_button').click(); </script>";
                $username_error ="Please enter a username";
            }

            // Check if the cancel button was clicked
            if (isset($_POST['cancel'])) {
            // Redirect to the profile page
            header('Location: /public_html/views/user/profile');
            exit;
            }

           
        }
        ?>
        <p>The following are your credentials.</p>
        <div id = "edit" class = "hidden">
        <form method="post" autocomplete ="off">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
                <span class="invalid-feedback"><?php echo $username_error; ?></span>
            </div>    
             <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required>
                <span class="invalid-feedback"><?php echo $email_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="new_password" id = "password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>" value="" >
                <span class="invalid-feedback"><?php echo $password_error; ?></span><span id = "restrictions"></span>
            </div>
            <div class="form-group">
                <input id = "submitButton" type="submit" name = "update" class="btn btn-primary" value="Update">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                <button class="btn btn-primary" onclick="toggleEdit()">Cancel</button>
            </div>
        </form>
        </div>
        <div id = "read_only">
        <p>Name: <?php echo $username; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <button onclick="toggleEdit()" id = "edit_button">Edit</button>
        </div>
    </div>    
</body>
<script>
const password = document.getElementById("password");
const restrictions = document.getElementById("restrictions");
var submitButton = document.getElementById("submitButton");
var upperCount = 0;
var hasValidLength = false;
var hasSpecialChar = false;
var hasAlphanumeric = false;

password.addEventListener("input", function() {
    if(password.length>0)  
    {
        submitButton.disabled = true;
    }
  let str = password.value;
  hasSpecialChar = str.match(/[^\w\s]/) !== null;
  for(let i = 0; i < str.length; i++) {
    if(/[A-Za-z0-9]/.test(str[i])) {
      hasAlphanumeric = true;
      if(/[A-Z]/.test(str[i])) {
        upperCount++;
      }
    }
  }

  hasValidLength = str.length >= 8;

  const alphanumericStatus = hasAlphanumeric ? "✔" : "❌";
  const lengthStatus = hasValidLength ? "✔" : "❌";
  const uppercaseStatus = upperCount >= 2 ? "✔" : "❌";
  const specialCharacterStatus = hasSpecialChar ? "✔" : "❌";

  const restrictionText = `Alphanumeric characters only: ${alphanumericStatus}<br>
                           Has a special character: ${specialCharacterStatus}<br>
                           Minimum length of 8 characters: ${lengthStatus}<br>
                           Minimum of 2 uppercase letters: ${uppercaseStatus}`;
  restrictions.innerHTML = restrictionText;

   if (upperCount>=2 && hasSpecialChar && hasAlphanumeric && hasValidLength) 
   {
    // message.innerHTML = "Password is valid";
    submitButton.disabled = false;
  } 

});

function toggleEdit() {
    // Get all the form fields
    var read_section = document.querySelector('#read_only');
    var edit_section = document.querySelector('#edit');
    // Disable or enable each form field depending on the current state
    read_section.classList.toggle("hidden");
    edit_section.classList.toggle("hidden");
  }
</script>

