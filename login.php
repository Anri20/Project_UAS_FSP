<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <h1>LOGIN</h1>
        <form action="" method="post">
            Username: <br>
            <input type="text" name="username"><br><br>
            Password: <br>
            <input type="password" name="password"><br><br>
            <input type="submit" name="login" value="LOGIN">
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

</html>