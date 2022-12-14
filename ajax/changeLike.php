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
    extract($_POST);
    $sql = "SELECT * FROM memes_has_likes where users_username = '$userId' and memes_idmemes = $memesId";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    // $result = $conn->query($sql);

    $status = "";
    if ($result->num_rows > 0) {
        $sql1 = "delete from memes_has_likes where users_username = '$userId' and memes_idmemes = $memesId";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();

        $sql2 = "update memes set `like` = `like` - 1 where idmemes = $memesId";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();

        $status = "delLike";
    } else {
        $sql1 = "insert into memes_has_likes(users_username, memes_idmemes) values ('$userId', $memesId)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();

        $sql2 = "update memes set `like` = `like` + 1 where idmemes = $memesId";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();

        $status = "addLike";
    }

    if (!$stmt1->error) {
        echo $status;
    } else {
        echo "Error";
    }
}
$stmt->close();
$stmt1->close();
$stmt2->close();
$conn->close();
