<?php
if(!isset($_SESSION)){
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funny Memes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">

    </div>
</body>

<script>
    $(document).ready(function() {
        $.post('/Full-Stack_Programming/Project_UAS_FSP/ajax/selectAll.php').done(function(data){
            console.log(data)
            $.each(data, function(index, value){

            })
        })
    })
</script>

</html>