<?php
header("Access-Control-Allow-Origin: *");
$arr = null;
$sname = "localhost";
$uname = "root";
$pass = "";
$dbname = "uas_fsp_memes";

// $sname = "localhost";
// $uname = "hybrid_160720039";
// $pass = "ubaya";
// $dbname = "hybrid_160720039";

// Create connection
$conn = new mysqli($sname, $uname, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection Error";
} else {
    extract($_POST);
    $start = ($page - 1) * $perPage;
    $sql = "SELECT * FROM memes limit $start, $perPage";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result = $conn->query($sql);

    $data = [];
    $memes = [];
    if ($result->num_rows > 0) {
        while ($r = $result->fetch_assoc()) {
            array_push($memes, $r);
            // array_push($data['data'], $r);
        }
        $data['memes'] = $memes;
        $data['thisPage'] = $page;
        echo json_encode($data);
    } else {
        echo "Error";
    }
}
// $stmt->close();
$conn->close();
