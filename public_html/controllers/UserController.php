<?php

// require_once '/../../models/UserModel.php';
// echo "so we made it here";
class UserController {
    public function __construct() { }
    public function register($username, $email, $password,$confirm_password) 
    {
        // Handle user registration
            // echo "so we made it in controller";
            // echo getcwd();
            require_once '../../models/UserModel.php';
            // echo "            aeged so we made it here";
            //   if (isset($_POST['submit'])) {
            // $username = $_POST['username'];
            // $email = $_POST['email'];
            // $password = $_POST['password'];
            // echo("_");
            // echo($username);
            // echo("_");

            // $user = UserModel::findByUsername($username);
            // if ($user) {
            //     $username_err = "Username already taken";
            //     echo "Username already taken";
            //         return false; // User already exists, registration failed
            // }

            $user = UserModel::findByEmail($email);
            if ($user) {
                $email_err = "Email already registered"; 
                // echo "Email already registered";
                    return 5; // Failed to insert user into database, registration failed
                }
            // echo("_");
            // echo("we are back in the controller now");
            // echo("_");
            $user = new UserModel(0,$username, $email,$password,1);
                // echo("we are back in the controller with model back again!!!! now");
            // $user->setUsername($username);
            //  echo("we are back in the controller with user back again!!!! now");
            // $user->setEmail($email);
            //  echo("we are back in the controller with email back again!!!! now");
            // $user->setPassword($password);
            //  echo("we are back in the controller with pass back again!!!! now");
            $validation = $user->validatePassword();
                // echo("we are back in the controller with pw back again!!!! now");
            if(is_int($validation))
            {
                // echo ($password_err);
                return $validation;
            }
            $user->hashPassword($password);
            $user->save();
            // echo("_");
            // echo("we are back in the controller back again!!!! now");
            // echo("_");
            return true; // Registration successful
    }

        
    public function login($email, $password) 
    {
        // echo "so we made it in controller";
        // echo getcwd();
        require_once '../../models/UserModel.php';
        // echo "            aeged so we made it here";
        // Verify login credentials
            
        $user = UserModel::verifyLogin($email, $password);
        // echo("_");
        // echo("we are back in the controller back again!!!! now");
        if ($user && !is_int($user)) 
        {
            $_SESSION['user_id'] = $user->getId();
            return true;
        } 
        else
        {
            return $user;
        }

    }
    
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $url = "https://badger-timeline.infinityfreeapp.com/public_html";
        header("Location: $url");
        exit;
    }

    public function userProfileEdit() {
        session_start();
            if (isset($_SESSION["user_id"])) {
        
        
            $userId = $_SESSION['user_id'];
            require_once '../../models/UserModel.php';
            $userInfo =  UserModel::findById($userId);

            // Only display the profile edit page if the logged-in user matches the profile being edited
            if ($userId === $userInfo['user_id'] || $userInfo['user_role_id'] == 1) {
                // Load the view to display the user profile edit page
                return $userInfo;
            } else {
                // Redirect to homepage if the user doesn't have access to the profile edit page
                header('Location: https://badger-timeline.infinityfreeapp.com/public_html/');
            }
            
            }
            else {
                // Redirect to homepage if the user doesn't have access to the profile edit page
                //  print("<script>console.log('in controller logged out')</script>");
                header('Location: https://badger-timeline.infinityfreeapp.com/public_html/');
            }
        session_write_close();
    }

    public function updateUserProfile() {
        session_start();
        $userId = $_SESSION['user_id'];
        require_once '../../models/UserModel.php';
        $userInfo = UserModel::findById($userId);
        $username = $userInfo['username'];
        $email = $userInfo['email'];
        $password = $userInfo['password'];
        if(isset($_POST['new_password']) && password_hash($_POST['new_password'], PASSWORD_DEFAULT) != $password)
        {
            $user = new UserModel(0,$username, $email,$_POST['new_password'],1);
            $validation = $user->validatePassword();
            
            if(is_int($validation))
            {
                // echo ($password_err);
                return $validation;
            }

            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        }
        else
        {
            $new_password = $password;
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            return 5;
        }
        // Update user info in database
        $newInfo = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $new_password
        );
        $check = UserModel::updateUserInfo($userId, $newInfo);
        // Redirect back to the profile edit page with a success message
         $success =  "Profile updated successfully";
        // header('Location: https://badger-timeline.infinityfreeapp.com/public_html/views/user/profile');
        // exit();
        return true;
    }
    public function forgot_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the user's email address
        $email = $_POST['email'];
        require_once '../../models/UserModel.php';
        $userInfo = UserModel::findByEmail($email);
        if(is_null($userInfo) )
        {
            return 0;
        }
        // Validate the email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        } 
        else 
        {
            // Generate a unique token
            $token = bin2hex(random_bytes(16));

            // Save the token and the email address to the database
            require_once '../../models/UserModel.php';
            UserModel::savePasswordResetToken($email, $token);

            // Send the password reset email



            // $subject = 'Reset your password';
            // $message = "Click on this link to reset your password: https://badger-timeline.infinityfreeapp.com/public_html/views/user/reset_password.php?email=$email&token=$token";
            $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Email Verification</title>
                </head>
                <body style="background-color: #f2f2f2; font-family: Arial, sans-serif;">
                    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
                        <h2 style="color: #262626;">Verify your Login for Niagara on the Lake Museum - Staff</h2>
                        <p style="color: #9D9B99;">This email has been sent to verify your login for Niagara on the Lake Museum editors. The link provided will stay valid for 1 hour.</p>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/reset_password?email='.$email.'&token='.$token.'" style="display: inline-block; background-color: #262626; color: #9D9B99; padding: 10px 20px; text-decoration: none;">Verify My Email</a>
                        </div>
                    </div>
                </body>
                </html>';
            // Include PHPMailer files
            require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/sendemail/src/PHPMailer.php';
            require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/sendemail/src/SMTP.php';
            require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/sendemail/src/Exception.php';

            // Create a new PHPMailer instance
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            // Set up SMTP credentials
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'notl.badgertech@gmail.com';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set up email content
            $mail->setFrom('notl.badgertech@gmail.com', 'BadgerTech');
            $mail->addAddress($email);
            $mail->Subject = 'Reset Password Request';
            $mail->Subject = 'Verify your Login for Niagara on the Lake Museum - Staff';
            $mail->Body = '';
            $mail->msgHTML($message, dirname(__FILE__));
            $mail->AltBody = 'Click on this link to reset your password: https://badger-timeline.infinityfreeapp.com/public_html/views/user/reset_password?email='.$email.'&token='.$token.'.To view the message, please use an HTML compatible email viewer!';



            // Send email and check for errors
            if (!$mail->send()) {
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                // echo 'Message sent!';
            }


            // mail($email, $subject, $message);

            // Redirect the user to a confirmation page
            // header('Location: /public_html/views/user/password_reset_sent');
            $url = 'https://badger-timeline.infinityfreeapp.com/public_html/views/user/login';
            echo "<script>window.location.replace('$url');</script>";
            exit;

        }
        }
    }

    public function reset_password($email, $token)
    {
         require_once '../../models/UserModel.php';
        if (!UserModel::isValidPasswordResetToken($email, $token))
        {
            $message = 'Invalid or expired token';
            return $message;
        } else 
        {
        // Get the new password from the form
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $user = new UserModel(0,"", $email,$password,1);
            $validation = $user->validatePassword();
            // Validate the password
            if ($validation && $password == $confirm_password) 
            {
                // Update the user's password in the database
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                UserModel::updatePassword($email, $hash_password);

                // Delete the password reset token
                UserModel::deletePasswordResetToken($email, $token);

                // Redirect the user to a success page
                $message = "Success!";
                return $message;
            } 
            else 
            {
                $message ="Could not update password. Please try again.";
                return $message;
            }
        }
    }

      
}

