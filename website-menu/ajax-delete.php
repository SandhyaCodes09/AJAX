<?php
    $emp_id = $_POST['id'];
    $conn = mysqli_connect("localhost", "root", "", "data_munch") or die("Connection Failed");

$sql = "DELETE FROM users WHERE user_id = {$emp_id}";

if(mysqli_query($conn, $sql)){
    echo 1;
}
else{
    echo 0;
}

?>