<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn->select_db($dbname);

    $query = "SELECT `email`,`password` FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        // display any database errors
        echo 'Error: ' . mysqli_error($conn);
        exit;
    }

    // fetch the row into an array
    $row = $result->fetch_assoc();

    if ($row !== null) {
        if ($password === $row['password']) {
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
        }
    } 
    else {
        $return_arr[] = array(
            "success" => false
        );
        echo json_encode($return_arr);
        exit;
    }
}
