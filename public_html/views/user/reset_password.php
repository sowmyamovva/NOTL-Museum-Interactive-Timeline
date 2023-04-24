<?php 
include '../../includes/header.php'; 
error_reporting(E_ALL);
ini_set('display_errors', '1');
$token_valid = false;
$success = false;
$email="";
 $token="";
// reset_password.php
if(isset( $_GET['email']) && isset( $_GET['token']))
{
    $email = $_GET['email'];
    $token = $_GET['token'];
    require_once '../../models/UserModel.php';
    $token_valid = UserModel::isValidPasswordResetToken($email, $token);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email address and the token from the query parameters
    

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address';
    } else {
        require_once '../../controllers/UserController.php';
        $controller = new UserController();
        $message = $controller->reset_password($_POST['email'], $token);
        // Check if the token is valid

    }
    }
}
else{
    $url = 'https://badger-timeline.infinityfreeapp.com/public_html/views/user/login';
    // echo "<script>window.location.replace('$url');</script>";
    // exit;

}
?>
<head>
  <title>Reset Password</title>
</head>
<body>
  <h1>Reset Password</h1>
  <?php if (isset($message)) { ?>
    <p><?php echo $message; ?></p>
  <?php } else if ($token_valid) { ?>
    <form method="post" >
        <input type="hidden" name="token" value="<?php $token ?>">
        <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required>
        <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div> 
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id = "password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="" required>
            <span class="invalid-feedback"><?php echo $password_err; ?></span><span id = "restrictions"></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" id = "confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="" required>
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><span id = "equivalence"></span>
        </div>
        <div class="form-group">
                <input id = "submitButton" type="submit" name = "reset_password" class="btn btn-primary" value="Reset Password">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
  <?php } else { ?>
    <p>Sorry, the password reset link is invalid or has expired. Please request a new password reset.</p>
  <?php } ?>
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
<?php 
include '../../includes/footer.php'; 
?>
