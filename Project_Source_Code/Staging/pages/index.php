<?php

include 'db.php';
$conn = OpenCon();
//echo "Connected Successfully";


//This is an example of our queries
$sql = "SELECT first_name, last_name FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo ("<pre> Name: " . $row["first_name"]. " " . $row["last_name"]. "<br></pre>");
  }
} else {
  echo "0 results";
}


CloseCon($conn);
?>
