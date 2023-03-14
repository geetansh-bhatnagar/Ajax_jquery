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

$sql = "INSERT INTO office (First_name, Last_name , Address , Position , Department
) VALUES ('$fname','$last_name','$address','$position', '$department')";
echo $link->query($sql);

// Fetch all records from table
// $sql = "SELECT * FROM office";
// $result = $link->query($sql);
// $row = mysqli_fetch_array($result);

// echo  $row['First_name'] ;
// echo  $row['Last_name'] ;
// echo  $row['Address'] ;
// echo  $row['Position'] ;
// echo  $row['Department'] ;


?>