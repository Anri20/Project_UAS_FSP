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
    <?php
    $user = $_COOKIE['username'];
    echo "<input id='username' type='hidden' value='$user'>";
    ?>
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
        $.post('ajax/selectAll.php', {
            userId: $('#username').val(),
        }).done(function(result) {
            let data = JSON.parse(result)
            $.each(data, function(index, value) {
                console.log(value)
                let likeUnit = " like"
                if (value['like'] > 1) {
                    likeUnit = " likes"
                }
                $('.container').append(
                    `<div class='meme'>
                        <img id="image-section" src="assets/img/${value['imgURL']}.jpg">
                        <div id="like-section"><i id="${value['idmemes']}" class="fa fa-heart" onclick="btnLike(this.id)" style="color: red;"></i> <span id="like_${value['idmemes']}">${value['like']+likeUnit}</span></div>                        
                        <i id="comment-section" class='fa fa-comment-o'></i>
                    </div>`)
            })
        })
    })

    function btnLike(id) {
        $.post('ajax/changeLike.php', {
            userId: $('#username').val(),
            memesId: id,
        }).done(function(result) {
            // alert(result)
            // alert($('#like_' + id).html()[0])
            let likeNow = parseInt($('#like_' + id).html()[0])
            if (result == "addLike") {
                likeNow += 1
            } else if (result == "delLike") {
                likeNow -= 1
            }

            let likeUnitNow = " like";
            if (likeNow > 1) {
                likeUnitNow = " likes"
            }
            $('#like_' + id).html(likeNow + likeUnitNow)
        })
    }
</script>

</html>