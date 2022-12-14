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
    if ($command == "first") {
        $start = 0;
        $pageNow = 1;
    } else if ($command == "last") {
        $start = ($totPage - 1) * $perPage;
        $pageNow = $totPage;
    } else if ($command == "next") {
        if ($pageNow != $totPage) {
            $pageNow += 1;
        }
        $start = ($pageNow - 1) * $perPage;
    } else if ($command == "back") {
        if ($pageNow != 1) {
            $pageNow -= 1;
        }
        $start = ($pageNow - 1) * $perPage;
    } else {
    }
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
        $data['thisPage'] = $pageNow;
        echo json_encode($data);
    } else {
        echo "Error";
    }
}
// $stmt->close();
$conn->close();
