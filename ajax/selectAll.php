<?php
$data = [];
$conn = mysqli_connect('localhost', 'root', '', 'uas_fsp_memes');
$sql = "select * from memes";
$result = $conn->query($sql);
while($r = $result->fetch_assoc()){
    echo $r['title'];
}
echo json_encode($data);
$conn->close();
