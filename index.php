<?php
if (!isset($_COOKIE['username'])) {
    header('location: loginUI.php');
}
$user = $_COOKIE['username'];
// echo "<input id='username' type='hidden' value='$user'>";
echo "<script>localStorage.setItem('username', $user)</script>";
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
    // $user = $_COOKIE['username'];
    // echo "<input id='username' type='hidden' value='$user'>";
    // echo "<script>localStorage.setItem('username', $user)</script>";
    ?>
    <a id="logout" href="logout.php">Logout</a>
    <br>
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
    <br>
    <div class="paging">

    </div>
</body>

<script>
    let perpage = 12
    let sumPage = 0
    $(document).ready(function() {
        $.post('ajax/selectInitial.php', {
            userId: localStorage.getItem('username'),
            perPage: perpage,
        }).done(function(result) {
            let data = JSON.parse(result)
            sumPage = data['sumPage']
            console.log(data)
            $('.container').html('')
            $.each(data['memes'], function(index, value) {
                console.log(value)
                let likeUnit = " like"
                if (value['like'] > 1) {
                    likeUnit = " likes"
                }
                $('.container').append(
                    `<div class='meme'>
                        <a href='detailmemes.php?id=${value['idmemes']}' onclick="detailMemes(this.id)"><img id="image-section" src="assets/img/${value['imgURL']}.jpg"></a>
                        <div id="like-section"><i id="${value['idmemes']}" class="fa fa-heart" onclick="btnLike(this.id)" style="color: red;"></i> <span id="like_${value['idmemes']}">${value['like']+likeUnit}</span></div>                        
                        <i id="comment-section" class='fa fa-comment-o'></i>
                    </div>`)
            })

            $('.paging').html('')
            $('.paging').append(`<a onclick="changePage('first')"> << </a>`)
            $('.paging').append(`<a onclick="changePage('back')"> < </a>`)
            for (let i = 1; i <= sumPage; i++) {
                // $('.paging').append(`<button id=${i} class=pagingBtn><a href="index.php?p=${i}">${i}</a></button>`)
                if(i == 1){
                    $('.paging').append(`<a id="${i}" class="pagingBtn dot" onclick="changeToPage(this.id)">${i}</a>`)
                }else{
                    $('.paging').append(`<a id="${i}" class="pagingBtn" onclick="changeToPage(this.id)">${i}</a>`)
                }
            }
            $('.paging').append(`<a onclick="changePage('next')"> > </a>`)
            $('.paging').append(`<a onclick="changePage('last')"> >> </a>`)
        })

        localStorage.setItem('pageNow', 1)
    })

    function changePage(command) {
        // alert(command)
        $.post('ajax/paging2.php', {
            pageNow: localStorage.getItem('pageNow'),
            command: command,
            perPage: perpage,
            totPage: sumPage,
        }).done(function(result) {
            let data = JSON.parse(result)
            console.log(data)
            $('.container').html('')
            $.each(data['memes'], function(index, value) {
                console.log(value)
                let likeUnit = " like"
                if (value['like'] > 1) {
                    likeUnit = " likes"
                }
                $('.container').append(
                    `<div class='meme'>
                        <a href='detailmemes.php?id=${value['idmemes']}' onclick="detailMemes(this.id)"><img id="image-section" src="assets/img/${value['imgURL']}.jpg"></a>
                        <div id="like-section"><i id="${value['idmemes']}" class="fa fa-heart" onclick="btnLike(this.id)" style="color: red;"></i><span id="like_${value['idmemes']}">${value['like']+likeUnit}</span></div>                        
                        <i id="comment-section" class='fa fa-comment-o'></i>
                    </div>`)
            })

            $(`#${localStorage.getItem('pageNow')}`).removeClass("dot")
            localStorage.setItem('pageNow', data['thisPage'])
            $(`#${localStorage.getItem('pageNow')}`).addClass("dot")
        })
    }

    function changeToPage(pageNum) {
        $.post('ajax/paging.php', {
            page: pageNum,
            perPage: perpage,
        }).done(function(result) {
            let data = JSON.parse(result)
            console.log(data)
            $('.container').html('')
            $.each(data['memes'], function(index, value) {
                console.log(value)
                let likeUnit = " like"
                if (value['like'] > 1) {
                    likeUnit = " likes"
                }
                $('.container').append(
                    `<div class='meme'>
                        <a href='detailmemes.php?id=${value['idmemes']}' onclick="detailMemes(this.id)"><img id="image-section" src="assets/img/${value['imgURL']}.jpg"></a>
                        <div id="like-section"><i id="${value['idmemes']}" class="fa fa-heart" onclick="btnLike(this.id)" style="color: red;"></i><span id="like_${value['idmemes']}">${value['like']+likeUnit}</span></div>                        
                        <i id="comment-section" class='fa fa-comment-o'></i>
                    </div>`)
            })

            $(`#${localStorage.getItem('pageNow')}`).removeClass("dot")
            localStorage.setItem('pageNow', pageNum)
            $(`#${localStorage.getItem('pageNow')}`).addClass("dot")
        })
    }

    function detailMemes(id) {
        $.post('ajax/memes.php', {
            Id: id,
        }).done(function(result) {
            //mau di buat pop up trs di append ke detail memes
        })
    }

    function btnLike(id) {
        $.post('ajax/changeLike.php', {
            userId: localStorage.getItem('username'),
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