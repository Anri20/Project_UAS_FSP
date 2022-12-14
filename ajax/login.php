<?php
header("Access-Control-Allow-Origin: *");

$sname = "localhost";
$uname = "root";
$pass = "";
$dbname = "uas_fsp_memes";

// $sname = "localhost";
// $uname = "id20010020_root";
// $pass = "%<cM^Ms9S#(AOcL#";
// $dbname = "id20010020_uas_fsp_memes";

// Create connection
$conn = new mysqli($sname, $uname, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection Error";
} else {
    // extract($_POST);
    $username = 160420082;
    $password = 160420082;
    $sql = "SELECT * FROM users where username ='$username' and password = '$password'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        setcookie('username', $username, time() + 3600, "/");
        echo "True";
    } else {
        echo "False";
    }
}
$stmt->close();
$conn->close();
