<?php include 'connection.php';
// requesting data 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    echo $id;
    $conn->select_db($dbname);
    // deleting the row having id =$id
    $sql = "DELETE FROM posts WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    

    
}