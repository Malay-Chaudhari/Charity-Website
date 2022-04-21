<?php
    $showError = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/db_connect.php';

        $name = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT * FROM `users` WHERE `username` = '$name' AND `password` = '$password'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num == 1) {
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $name;
          header("location: home.php");
        } else {
          $showError = "Invalid Credentials";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HELP</title>
    <link rel="icon" href="D:\Study\Web Development\Projects\DE\Img\favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .card {
            margin-top: 250px;
        }
    </style>
</head>

<body>
    <?php
        if ($showError) {
            echo '<div class="alert alert-danger" role="alert">
            <Strong>Sorry!</Strong> ';
            echo $showError;
            echo '</div>';
        }
    ?>
    <div class="container text-center col-md-6 mt-2">
        <h1>Login</h1>
        <form action="/DE/login.php" method="post">
            <div class="form-group text-left">
                <label for="text">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group text-left">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div>
            <hr class="bar">
            <span>OR</span>
            <hr class="bar">
        </div>
        <div class="btn btn-secondary">
            <a href="/DE/signup.php" class="secondary-btn" style="color: #fff;">Create an account</a>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>
    <script>
        setTimeout(() => document.querySelector('.alert').remove(), 3000);
    </script>
</body>

</html>