<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
  <?php
        // handle form submission
        // if (session_status() == PHP_SESSION_NONE) {
    
        //     session_start();
           
        // }
        session_start();
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            session_write_close();
             $url = "https://badger-timeline.infinityfreeapp.com/public_html";
            header("Location: $url");
        } else {
            // since the username is not set in session, the user is not-logged-in
            // he is trying to access this page unauthorized
            // so let's clear all session variables and redirect him to the index
            session_unset();
            session_write_close();
           
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            print("here?");
             $_SESSION['user_id'] =12356;
            require_once '../../controllers/UserController.php';
            $controller = new UserController();
            $result = $controller->login($_POST['email'], $_POST['password']);
            
            print("back?");
            if ($result === true) {
                $url = "https://badger-timeline.infinityfreeapp.com/public_html";
            header("Location: $url");
               // echo '<p>login successful! You can now log in.</p>';
            } else {
                echo '<p>login failed. Please try again.</p>';
            }
        }
    ?>
    <div class ="wrapper">
	<h2>Login</h2>
	<form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required>
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>   
        <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id = "password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                <span class="invalid-feedback"><?php echo $password_err; ?></span><span id = "restrictions"></span>
        </div>
        <div class="form-group">
                <input id = "submitButton" type="submit" class="btn btn-primary" value="Login">
        </div>
	</form>
	<p>Don't have an account? <a href="signup.php">Sign up</a> now.</p>
    </div>
</body>
</html>

