<?php include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST['user_id'];
    $post_name = $_POST['post_name'];
    $post_description = $_POST['post_description'];
    
    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT(100) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(100) NOT NULL UNIQUE,
        post_name VARCHAR(100) NOT NULL,
        post_description TEXT NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        // echo "Table posts created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
    

    $sql = "INSERT INTO posts (user_id, post_name, post_description) 
    VALUES ('$user_id', '$post_name', '$post_description')";


    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $sql_select = "SELECT * FROM posts";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $id = $row['id'];
            $user_id = $row['user_id'];
            $post_name = $row["post_name"];
            $post_description = $row["post_description"];

            $return_arr[] = array(
                "id" => $id,
                "user_id" => $user_id,
                "post_name" => $post_name,
                "post_description" => $post_description
            );
            
        }
        
        echo json_encode($return_arr);
    } else {
        echo "0 results";
    }
}