<?php
include 'view-connection.php';
$sql_select = "SELECT * FROM posts";
$stmt = $conn->prepare($sql_select);
$stmt->execute();
$result = $stmt->get_result();

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
?>
