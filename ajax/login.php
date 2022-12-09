<?php
header("Access-Control-Allow-Origin: *");
$arr = null;
// $servername = "localhost";
// $username = "hybrid_160720039";
// $password = "ubaya";
// $dbname = "hybrid_160720039";

// Create connection
$conn = new mysqli();
// Check connection
if ($conn->connect_error) {
    echo "Connection Error";
} else {
    extract($_POST);
    $sql = "SELECT * FROM users where username ='$username' and password = '$password'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {      
        echo "True";
    } else {
        echo "False";
    }
}
$stmt->close();
$conn->close();
