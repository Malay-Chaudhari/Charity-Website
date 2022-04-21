<?php
    $showAlert = false;
    $showError = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include 'Partials/db_connect.php';
        $name = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        // Check whether this username exists
        $existSql = "SELECT * FROM `users` WHERE `username` = '$name'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows > 0) {
            // $exists = true;
            $showError = "Username Already Exists";
        } else {
            // $exists = false;
            
            if ($password == $cpassword) {
                $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$name', '$password', current_timestamp())";
    
                $result = mysqli_query($conn, $sql);
    
                if ($result) {
                    $showAlert = true;
                }
            } else {
                $showError = "Passwords don't match";
            }
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>HELP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
        .card {
            margin-top: 11%;
        }
    </style>
    <link rel="icon" href="Img/favicon.ico">
</head>

<body>
    <?php
        if ($showAlert) {
            echo '<div class="alert alert-success" role="alert">
            <Strong>Success!</Strong> Your account is now created and you can login
            </div>';
        } 
        
        if ($showError) {
            echo '<div class="alert alert-danger" role="alert">
            <Strong>Sorry!</Strong> ';
            echo $showError;
            echo '</div>';
        }
    ?>

    <div class="container col-md-6">
        <h1 class="text-center mb-3 mt-5">Sign Up to our website</h1>

        <!-- Form -->
        <form action="/DE/signup.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Sign Up</button>
        </form>
        <div class="login mb-5">
            <h3>Already have an account?</h3>
            <a href="/DE/login.php">Login here</a>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>
    <script>
        setTimeout(() => document.querySelector('.alert').remove(), 3000);
    </script>
</body>

</html>