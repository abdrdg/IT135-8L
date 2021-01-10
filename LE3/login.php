<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="grid-container">
        <form action="checklogin.php" method="post" class="grid-y">
            <h1>WELCOME</h1>
            <input type="text" name="username" placeholder="Username / Email" required class="cell">
            <input type="password" name="password" require placeholder="Password" required class="cell">
            <input type="submit" value="Login" class="cell">
            <br>
            <br>
            <a href="register.php" class="cell">Don't have an Account? Register Here!</a>
        </form>
    </div>
</body>
</html>