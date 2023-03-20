<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn->select_db($dbname);

    $query = "SELECT `email`,`password` FROM users";
    $result = $conn->query($query);

    if ($result === false) {
        // display any database errors
        echo 'Error: ' . mysqli_error($conn);
        exit;
    }

    // fetch all rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if (checkusername($rows, $email)) {
        if (checkpassword($rows, $password)) {
            $return_arr[] = array(
                "success" => true
            );
            echo json_encode($return_arr);
            exit;
        } else {
            $return_arr[] = array(
                "success" => false
            );
            echo json_encode($return_arr);
            exit;
            // echo '<script>alert("Invalid password"); window.location.href = "index.php";</script>';
          
        }
    } 
    else {
        // echo '<script>alert("Invalid Username"); window.location.href = "index.php";</script>';
        $return_arr[] = array(
            "success" => false
        );
        echo json_encode($return_arr);
        exit;
    }
}

function checkpassword($rows, $password)
{
    foreach ($rows as $row) {
        if ($row["password"] == $password) {
            return true;
        }
    }
    return false;
}

function checkusername($rows, $email)
{
    foreach ($rows as $row) {
        if ($row["email"] == $email) {
            return true;
        }
    }
    return false;
}