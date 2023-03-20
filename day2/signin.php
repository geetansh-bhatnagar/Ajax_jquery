<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Define regex patterns
  $namePattern = '/^[a-zA-Z]+$/';
  $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

  // Validate input fields against regex patterns
  if (!preg_match($namePattern, $firstName)) {
    $return_arr[] = array(
      "success" => false,
      "message" => "Invalid first name",
    );
    echo json_encode($return_arr);
    exit;
  }
  if (!preg_match($namePattern, $lastName)) {
    $return_arr[] = array(
      "success" => false,
      "message" => "Invalid last name",
    );
    echo json_encode($return_arr);
    exit;
  }
  if (!preg_match($emailPattern, $email)) {
    $return_arr[] = array(
      "success" => false,
      "message" => "Invalid email address",
    );
    echo json_encode($return_arr);
    exit;
  }
  // if (!preg_match($passwordPattern, $password)) {
  //   $return_arr[] = array(
  //     "success" => false,
  //     "message" => "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number",
  //   );
  //   echo json_encode($return_arr);
  //   exit;
  // }


  // Prepare the statement
  $stmt = mysqli_prepare($conn, "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");

  // Bind parameters to the statement
  mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $password);

  // Execute the statement
  if(mysqli_stmt_execute($stmt)) {
    $return_arr[] = array(
      "success" => true,
      "message" => "Ho raha hai",
    );
  } else {
    $return_arr[] = array(
      "success" => false,
      "message" => "Error: " . mysqli_stmt_error($stmt),
    );
  }

  // Close the statement
  mysqli_stmt_close($stmt);

  // Encode the response as JSON and output it
  echo json_encode($return_arr);
}
