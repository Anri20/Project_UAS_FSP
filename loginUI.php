<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="/script/jquery-3.6.1.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>LOGIN</h1>
        <form action="/ajax/login.php" method="POST">
            Username: <br>
            <input type="text" id="username"><br><br>
            Password: <br>
            <input type="password" id="password"><br><br>
            <input type="button" id="login" value="LOGIN">
        </form>
    </div>
    <?php
    if (isset($_POST['login'])) {
        if (isset($_SESSION['waktu'])) {
            $x = strtotime("now") - $_SESSION['waktu'];
            if ($x <= 60) {
                echo "Tunggu " . (60 - $x) . " detik lagi";
            } else {
                $_SESSION['nama'] = $_GET['nama'];
                $_SESSION['waktu'] = strtotime("now");

                print_r($_SESSION);
            }
        } else {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['waktu'] = strtotime("now");

            print_r($_SESSION);
        }
    }
    ?>
</body>
<script>
    $('body').on('click', '#login', function() {
        $.post("/ajax/login.php", {
                username: $('#username').val(),
                name: $('#password').val()
            })
            .done(function(data) {
                if(data == "true")
                {
                    //bisa login
                }
                else{
                    alert("Data tidak ditemukan");
                }
            });
    });
</script>

</html>