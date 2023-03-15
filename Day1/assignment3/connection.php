<?php
// config
$server= "localhost";
$user="admin";
$password="admin";
$dbname="office";

$link = new mysqli($server, $user, $password);

// checking connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
  }
  
  // creating and checking whether database is created or not
  $createdb = "CREATE DATABASE IF NOT EXISTS $dbname";
  if ($link->query($createdb) === TRUE) {
    // echo "Database created successfully";
  } else {
    // echo "Error creating database: " . $link->error;
  }
  $link->select_db($dbname);
  
  // creating and checking whether table is created or not
  $createtb = "CREATE TABLE office (
    First_name VARCHAR(100) NOT NULL,
    Last_name VARCHAR(100) NOT NULL,
    Address VARCHAR(255) NOT NULL,
   Position VARCHAR(255) NOT NULL,
    Department VARCHAR(255) NOT NULL
);";
  
  if ($link->query($createtb) === TRUE) {
    // echo "Table created successfully";
  } else {
    // echo "Error creating table: " . $link->error;
  }

  //Now we are inserting data in the table 
  $fname = $_POST['fname'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$position = $_POST['position'];
$department = $_POST['department'];
$pattern = "/^[a-zA-Z ]{1,30}$/";


// if (!(preg_match('([A-Z][a-z]*)([\\s\\\'-][A-Z][a-z]*)*', $fname))) {
//   echo "<script>alert('Invalid First Name')</script>";
//   return;
// }

// if (!(preg_match('([A-Z][a-z]*)([\\s\\\'-][A-Z][a-z]*)*', $last_name))) {
//   echo "<script>alert('Invalid Last Name')</script>";
//   return;
// }

$sql = "INSERT INTO office (First_name, Last_name , Address , Position , Department
) VALUES ('$fname','$last_name','$address','$position', '$department')";
$link->query($sql);

// fethching data from the table 

$sql_select = "SELECT * FROM office";
$result = $link->query($sql_select);

if ($result->num_rows > 0) {
    
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["First_name"] . "</td><td>" . $row["Last_name"] . "</td><td>" 
        . $row["Address"] . "</td><td>" . $row["Position"] 
        . "</td><td>" . $row["Department"] . "</td></tr>";
    }
    
} else {
    echo "0 results";
}

?>