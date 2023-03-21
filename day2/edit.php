<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateuid= $_POST["user_id"];
    $updatepost= $_POST["post_name"];
    $updatedes = $_POST["post_description"];
    $id = $_POST["id"];
    $check = "SELECT `id` FROM posts";
    $result1 = mysqli_query($conn, $check);
    $num = $result1->num_rows;
    $stmt = $conn->prepare("UPDATE posts SET user_id=?, post_description=?, post_name=? WHERE id=?");
    $stmt->bind_param("isss", $updateuid, $updatedes, $updatepost, $id);
    for ($i = 0; $i < $num; $i++) {
        $arr = mysqli_fetch_assoc($result1);
        if ($arr['id'] == $id) {
            if ($updatedes != null && $updatepost != null && $updateuid != null) {
                $query = "UPDATE posts SET user_id='$updateuid' , post_description='$updatedes',post_name='$updatepost'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "user id,Post name and Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            else if ($updatedes != null && $updatepost==null && $updateuid==null) {
                $query = "UPDATE posts SET post_description='$updatedes' WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
           else if ($updateuid != null && $updatepost==null && $updatedes==null) {
                $query = "UPDATE posts SET user_id='$updateuid' WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "user id Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
           else if ($updatepost != null && $updateuid==null && $updatedes==null) {
                $query = "UPDATE posts SET post_name='$updatepost'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post name Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            else if ($updateuid != null && $updatepost!=null && $updatedes==null) {
                $query = "UPDATE posts SET user_id='$updateuid' , post_name='$updatepost'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post name Updated and user id updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            else if ($updatepost != null && $updatedes!=null && $updateuid==null) {
                $query = "UPDATE posts SET post_name='$updatepost' , post_description='$updatedes'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post name Updated and Post description updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            else if ($updateuid != null && $updatedes!=null && $updatepost==null) {
                $query = "UPDATE posts SET user_id='$updateuid' , post_description='$updatedes'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "user id updated and Post description");
                    echo json_encode($return_arr);
                    exit;
                }
            }
        }
    }

}

?>