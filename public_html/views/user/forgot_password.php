<?php 
include '../../includes/header.php'; 
error_reporting(E_ALL);
ini_set('display_errors', '1');
// reset_password.php
if(isset( $_POST['email']))
{
    require_once '../../controllers/UserController.php';
    $controller = new UserController();
    $user_info = $controller->forgot_password();
}
else
{
    $message = "Please enter your registered email.";
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
  <?php if ($message) { ?>
    <p>Please enter your registered email.</p>
  <?php } ?>
    <form method="post" >
        <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="" required>
        <span class="invalid-feedback"><?php echo $email_err; ?></span>
        <div class="form-group">
                <input id = "submitButton" type="submit" name = "verify_email" class="btn btn-primary" value="Verify Email">
        </div>
    </form>
</body>

<?php 
include '../../includes/footer.php'; 
?>
