<?php
// echo("in model");
// echo getcwd();
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php';

class UserModel {
    private $id;
    private $username;
    private $email;
    private $password;
    private $user_role_id;
    
    public function __construct($id,$username, $email,$password,$user_role_id) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->user_role_id = $user_role_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getUserRoleId() {
        return $this->user_role_id;
    }

    public function setUserRoleId($user_role_id) {
        $this->user_role_id = $user_role_id;
    }

    public function validatePassword() {
        
        $special_char = preg_match('/[^\w\s\d]/', $this->password);
        if(!$special_char)
        {
            $password_err = "Please add a special character in the password.";
            // echo("*******1*****************");
            return 1;
        }
        else if(!preg_match('/^[a-zA-Z0-9]*[^a-zA-Z0-9\s]+[a-zA-Z0-9]*$/', ($this->password))) //alphanumeric
        {
            $password_err = "Password is non-alphanumeric.";
            // echo("**********2*************");
            return 2;
        } 
        else if (strlen($this->password) < 8) // Check for at least 8 characters
        {
            $password_err = "Password is too short, minimum 8 characters";
            // echo("*******3*****************");
            return 3;
        }

        // Check for at least 2 uppercase letters
        $uppercaseCount = 0;
        for ($i = 0; $i < strlen($this->password); $i++) {
            if ($this->password[$i] == strtoupper($this->password[$i])) {
                $uppercaseCount++;
            }
        }
        if ($uppercaseCount < 2) {
            $password_err = "Missing Uppercase";
            // echo("**********4**************");
            return 4;
        }

        return true;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function save() {
        
        // echo("_In save_");
        $db = new Config();
        $conn = $db->getConnection();
        // echo("_In save_");
        if ($this->id) {
            // Update an existing user
            $stmt = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
            $stmt->bind_param("sssi", $this->username, $this->email, $this->password, $this->id);
        } else {
            // Insert a new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $this->username, $this->email, $this->password);
        }
        // echo("saving!");
        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $stmt->insert_id;
            }
            // echo("saving yes!");
            return true;
        } else {
            // echo("nope! ");
            return false;
        }
    }
    
    public static function verifyLogin($email, $password) {

        //setPassword($password);
        // echo("_In verifyLogin __");
        $db = new Config();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        // echo("_In verifyLogin, next is result __");
        $result = $stmt->get_result();
        // print_r($result);
        if ($result->num_rows == 1) {
            // echo("_3333 In verifyLogin __");
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) 
            {
                if (session_status() == PHP_SESSION_NONE) 
                {
                    session_start();
                }
                $_SESSION["user_id"] = $row['user_id'];
                // print_r($_SESSION["user_id"]);
                session_write_close();
                $user_return = new UserModel($row['user_id'], $row['username'], $row['email'],$row['password'], $row['user_role_id']);
                // print_r($user_return);
                return $user_return;
              //  print($user_return->getId());
            }
            else{
                return 1;//password_err
            }
        }
        else{
            return 2;//email_err
        }
        // return false;
    }

    
    public static function findByUsername($username) {
        $db = new Config();
        $conn = $db->getConnection();
        // echo("_In find_by username_");
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return new UserModel($row['user_id'], $row['username'], $row['email'], $row['password'],$row['user_role_id']);
        }
        
        return null;
    }
    
    public static function findByEmail($email) {
        $db = new Config();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return new UserModel($row['user_id'], $row['username'], $row['email'], $row['password'],$row['user_role_id']);
        }
        
        return null;
    }
    public static function findById($id) {
        $db = new Config();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // $user_array =[]
            // return new UserModel($row['user_id'], $row['username'], $row['email'], $row['password'],$row['user_role_id']);
            return $row;
        }
        
        return null;
    }

    public static function updateUserInfo($userId, $newInfo) {
        
        $db = new Config();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("UPDATE users SET username=?, email=?, password=? WHERE user_id=?");
        $stmt->bind_param("sssi", $newInfo['username'], $newInfo['email'], $newInfo['password'], $userId);
        $stmt->execute();
        $stmt->close();
        return true;
    }


    public static function savePasswordResetToken($email, $token) {
    // Generate a new password reset token and save it to the database
    $db = new Config();
    $connection = $db->getConnection();
    $query = "INSERT INTO password_reset_tokens (email, token, created_at) VALUES (?, ?, NOW())";
    $stmt = $connection->prepare($query);    
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
  }

  public static function isValidPasswordResetToken($email, $token) {
    // Check if the password reset token is valid
    $db = new Config();
    $connection = $db->getConnection();
    $query = "SELECT COUNT(*) FROM password_reset_tokens WHERE email = ? AND token = ? AND created_at >= NOW() - INTERVAL 1 HOUR";
    $stmt = $connection->prepare($query);    
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count === 1;
  }

  public static function deletePasswordResetToken($email, $token) {
    // Delete the password reset token from the database
    $db = new Config();
    $connection = $db->getConnection();
    $query = "DELETE FROM password_reset_tokens WHERE email = ? AND token = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
  }

  public static function updatePassword($email, $password) {
    // Update the user's password in the database
    $db = new Config();
    $connection = $db->getConnection();
    $query = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ss', $password, $email);
    $stmt->execute();
  }

    
    
}
