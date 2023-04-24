<?php

// require_once '/../../models/UserModel.php';
// echo "so we made it here";
class UserController {
    public function __construct() { }
    public function register($username, $email, $password) 
    {
    // Handle user registration
    
//         echo "so we made it in controller";
//         echo getcwd();
        require_once '../../models/UserModel.php';
//         echo "            aeged so we made it here";
    //   if (isset($_POST['submit'])) {
        // $username = $_POST['username'];
        // $email = $_POST['email'];
        // $password = $_POST['password'];
//         echo("_");
//         echo($username);
//         echo("_");
        
        // $user = UserModel::findByUsername($username);
        // if ($user) {
        //     $username_err = "Username already taken";
        //     echo "Username already taken";
        //         return false; // User already exists, registration failed
        // }
        
        $user = UserModel::findByEmail($email);
        if ($user) {
            $email_err = "Email already registered"; 
//             echo "Email already registered";
                return false; // Failed to insert user into database, registration failed
            }
//         echo("_");
//         echo("we are back in the controller now");
//         echo("_");
        $user = new UserModel(0,$username, $email,$password,1);
//          echo("we are back in the controller with model back again!!!! now");
        // $user->setUsername($username);
        //  echo("we are back in the controller with user back again!!!! now");
        // $user->setEmail($email);
        //  echo("we are back in the controller with email back again!!!! now");
        // $user->setPassword($password);
        //  echo("we are back in the controller with pass back again!!!! now");
        $validation = $user->validatePassword();
//          echo("we are back in the controller with pw back again!!!! now");
        if(!$validation)
        {
            echo ($password_err);
            return false;
        }
        $user->hashPassword($password);
        $user->save();
//         echo("_");
//         echo("we are back in the controller back again!!!! now");
//         echo("_");
        return true; // Registration successful
        
    }

        
    public function login($email, $password) 
    {
        echo "so we made it in controller";
        echo getcwd();
        require_once '../../models/UserModel.php';
        echo "            aeged so we made it here";
        // Verify login credentials
            
        $user = UserModel::verifyLogin($email, $password);
         echo("_");
        echo("we are back in the controller back again!!!! now");
        if ($user) 
        {
            print(session_id());
           print( session_status());
            $_SESSION['user_id'] = $user->getId();
            print( session_status());
            return true;
        } 
        else 
        {
            return false;
        }

    }
    
    public function logout() {
        session_unset();
        session_destroy();
        echo "Logged out successfully!";
    }
      
}


