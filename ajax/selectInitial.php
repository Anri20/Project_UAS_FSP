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
    $sql = "SELECT * FROM memes";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result = $conn->query($sql);

    $sumData = $result->num_rows;
    $sumPage = ceil($sumData / $perPage);

    $sql1 = "SELECT * FROM memes limit 0,12";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result1 = $conn->query($sql1);

    $data = [];
    $memes = [];
    if ($sumData > 0) {
        while ($r = $result1->fetch_assoc()) {
            array_push($memes, $r);
            // array_push($data['data'], $r);
        }
        $data['memes'] = $memes;
        $data['sumPage'] = $sumPage;
        $data['thisPage'] = 1;
        echo json_encode($data);
    } else {
        echo "Error";
    }
}
// $stmt->close();
$conn->close();
