<?php 

include 'connection.php';

// requesting data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Title = $_POST['title'];
    $rating = $_POST['rating'];

// validating title and rating through regex

    if (!(preg_match('/^[a-zA-Z0-9\s]+$/', $Title))) {
        echo "<script>alert('Invalid First Name')</script>";
        return;
    }
    
    if (!(preg_match('/^(?:[1-9]|10)$/', $rating))) {
        echo "<script>alert('Invalid Rating Name')</script>";
        return;
    }
    

// if the user entered valid title and rating enter the data into table

    $sql = "INSERT INTO movie (Title, Rating) 
            VALUES ('$Title', '$rating' )";

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

// to view the table 

$sql_select = "SELECT * FROM movie";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $title = $row["Title"];
    $rating = $row["Rating"];

    $return_arr[] = array("id" => $id,
                    "Title" => $title,
                    "rating" => $rating);
}
echo json_encode($return_arr);
    
} else {
    echo "0 results";
}
}