<?php
if (!isset($_COOKIE['username'])) {
    header('location: loginUI.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
    <div class="container">
        <!-- <i class="fa fa-comment fa-5x"></i>
        <i class="fa fa-heart fa-5x"></i>
        <i class="fa fa-heart-o fa-5x"></i> -->
        <!-- <div class='meme'>
            <img id="image-section" src='assets/img/1.jpg'>
            <i id="like-section" class='fa fa-heart fa-2x'></i>
            <i id="comment-section" class='fa fa-comment-o fa-2x'></i>
        </div> -->
    </div>
</body>

<script>
    $(document).ready(function() {
        $.post('ajax/selectAll.php').done(function(result) {
            let data = JSON.parse(result)
            $.each(data, function(index, value) {
                console.log(value)
                let likeUnit = " like"
                if(value['like'] > 1){
                    likeUnit = " likes"
                }
                $('.container').append(
                    `<div class='meme'>
                        <img id="image-section" src='assets/img/${value['imgURL']}.jpg'>
                        <span id="like-section"><i id="${value['idmemes']}" class='fa fa-heart'" style="color: red;"></i> ${value['like'] + likeUnit}</span>                        
                        <i id="comment-section" class='fa fa-comment-o'></i>
                    </div>`)
            })
        })
    })
</script>

</html>