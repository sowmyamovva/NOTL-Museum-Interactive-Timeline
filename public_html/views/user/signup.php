<?php
echo getcwd();
// require_once '../../controllers/UserController.php';
// $config = new UserController();
// $connection = $config->getConnection();
print("back?");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
            <?php
        // handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            require_once '../../controllers/UserController.php';
            $controller = new UserController();
            $result = $controller->register($_POST['username'], $_POST['email'], $_POST['password']);
            
            print("back?");
            if ($result === true) {
                echo '<p>Registration successful! You can now log in.</p>';
            } else {
                echo '<p>Registration failed. Please try again.</p>';
            }
        }
    ?>
        <p>Please fill this form to create an account.</p>
        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
             <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required>
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id = "password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                <span class="invalid-feedback"><?php echo $password_err; ?></span><span id = "restrictions"></span>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id = "confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required>
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><span id = "equivalence"></span>
            </div>
            <div class="form-group">
                <input id = "submitButton" type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
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

const confirmPasswordInput = document.getElementById("confirm_password");
submitButton.disabled = true;
password.addEventListener("input", function() {
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

   if (upperCount>=2 && hasSpecialChar && hasAlphanumeric && hasValidLength && str=== confirmPassword) 
   {
    // message.innerHTML = "Password is valid";
    submitButton.disabled = false;
  } 

});

const message = document.getElementById("equivalence");

confirmPasswordInput.addEventListener("input", function() {
  let password_val = password.value;
  let confirmPassword = confirmPasswordInput.value;

  if(confirmPassword === password_val) {
    message.innerHTML = "Passwords match.";
    if (upperCount>=2 && hasSpecialChar && hasAlphanumeric && hasValidLength) 
   {
    // message.innerHTML = "Password is valid";
    submitButton.disabled = false;
  } 
  } else {
    message.innerHTML = "Passwords do not match.";
  }


});
</script>
</html>
