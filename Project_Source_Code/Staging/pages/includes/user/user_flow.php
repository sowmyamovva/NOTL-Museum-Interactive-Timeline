<?php

// Start the session
session_start();

// Check if the user has a session cookie
if (isset($_COOKIE['session_token'])) {

    // Retrieve the user's user_id from the Session table using the session token
    $dbhost = "";
    $dbname = "";
    $dbuser = "";
    $dbpass = "";

    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    $stmt = $dbh->prepare("SELECT user_id FROM Session WHERE token = ? AND expiration_datetime > NOW()");
    $stmt->execute(array($_COOKIE['session_token']));

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the query returns a result, the user is logged in and we have their user_id
    if ($result) {

        $user_id = $result['user_id'];

        // Store the user_id in the session
        $_SESSION['user_id'] = $user_id;

    } else {

        // If the query returns no results, the user is not logged in or their session has expired
        // Redirect the user to the login/register page
        header("Location: login.php");
        exit();

    }

} else {

    // If the user doesn't have a session cookie, redirect them to the login/register page
    header("Location: login.php");
    exit();

}

?>
