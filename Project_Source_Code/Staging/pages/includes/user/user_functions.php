<?php
// Define a global variable to store the query result
global $queryResult;

// Function to perform SQL query and store the result in the global variable
function performQuery() {
  // Establish a database connection (replace with your own credentials)
  $conn = mysqli_connect("localhost", "username", "password", "database_name");

  // SQL query to execute (replace with your own query)
  $sql = "SELECT * FROM users";

  // Execute the query and store the result in the global variable
  global $queryResult;
  $queryResult = mysqli_query($conn, $sql);

  // Close the database connection
  mysqli_close($conn);
}

// Call the function to perform the query and store the result in the global variable
performQuery();

// Example usage of the global variable
while ($row = mysqli_fetch_assoc($queryResult)) {
  echo "Name: " . $row["name"] . " Email: " . $row["email"] . "<br>";
}




function user_is_logged_in($user_id)
{
    SELECT * FROM Session WHERE user_id = $user_id AND expiration_datetime > NOW() AND token = [token];
}

function visitor_is_logged_in()
{
    SELECT user_id FROM Session WHERE token = [token] AND expiration_datetime > NOW();

}
function user_role($user_id)
{
     SELECT user_role_id FROM users WHERE user_id = $user_id;
}
function content($url)
{
    SELECT user_role_id FROM users WHERE user_id = $user_id;
}
?>
