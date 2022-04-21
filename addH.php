<?php
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
  }
?>

<?php
    $showAlert = false;
    $showError = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/db_connect.php';

        $hname = $_POST["hname"];
        $address = $_POST["address"];

        // Add hospital details to the hospital table in the database
        $sql = "INSERT INTO `hospital` (`hname`,`address`, `dt`) VALUES ('$hname', '$address', CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
            header("location: oxygen.php");
        } else {
            $showError = "We're facing techincal issues. Please try again later.";
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
    <link rel="icon" href="Img/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .card {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/DE/home.php">HELP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donate.php">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="oxygen.php">Oxygen<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DE/login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <?php
        if ($showAlert) {
            echo '<div class="extra alert alert-success" role="alert">
            <Strong>Success!</Strong> Hospital is added to the list.
            </div>';
        }

        if ($showError) {
            echo '<div class="extra alert alert-danger" role="alert">
            <Strong>Sorry </Strong>for inconvenience. <br>';
            echo $showError;
            echo '</div>';
        }
    ?>

    <div>
        <div class="alert alert-danger" role="alert">
            Add hospital only if you have proper information.
        </div>
        <form action="/DE/addH.php" method="post" class="container">
            <div class="form-group">
                <label for="hospitalName">Hospital Name</label>
                <input type="text" class="form-control" name="hname">
            </div>
            <div class="form-group d-flex flex-column">
                <label for="address">Address</label>
                <textarea name="address" cols="50" rows="10"></textarea>
            </div>
            <input type="submit" class="btn btn-info">
        </form>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
    
    <script>
        setTimeout(() => document.querySelector('.extra').remove(), 3000);
    </script>
</body>

</html>