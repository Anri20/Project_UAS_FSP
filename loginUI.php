<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="center">
            <h1>LOGIN</h1>
            <form id="formLogin" action="/ajax/login.php" method="POST">
                <!-- Username -->
                <input type="text" id="username" placeholder="Username">
                <!-- Password -->
                <input type="password" id="password" placeholder="Password">
                <!-- btnLogin -->
                <input type="button" id="login" value="LOGIN">
            </form>
        </div>
    </div>
</body>
<script>
    $('body').on('click', '#login', function() {
        $.post("ajax/login.php", {
                username: $('#username').val(),
                password: $('#password').val()
            })
            .done(function(data) {
                if (data == "True") {
                    // bisa login
                    // console.log(data)
                    // localStorage.setItem('username', $('#username').val())
                    window.open("index.php", "_self");
                    // window.open("index.php");
                } else {
                    alert("Data tidak ditemukan");
                }
            });
    });
</script>

</html>