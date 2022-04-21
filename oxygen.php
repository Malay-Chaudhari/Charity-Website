<?php
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
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
                    <a class="nav-link active" href="oxygen.php">Oxygen<span class="sr-only">(current)</span></a>
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

    <div class="alert alert-danger" role="alert">
        Add or Remove hospital only if you have proper information.
    </div>
    <div class="container">
        <h1>Oxygen is available here</h1>
        <div>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Hosptial Name</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody id="book-list">
                <?php
                    include 'partials/db_connect.php';

                    // Show hospital details to the hospital table on webpage
                    $sql = "SELECT `hname`, `address` FROM `hospital`";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'.$row['hname'].'</td>';
                        echo '<td>'.$row["address"].'</td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <h3>Want to add or remove hospital ?</h3>
            <div>
                <div class="my-3">
                    <a class="btn btn-primary" href="/DE/addH.php">Add Hospital</a>
                </div>
                <hr>
                <div class="my-3">
                    OR
                </div>
                <hr>
                <div class="my-3">
                    <a href="/DE/removeH.php" class="btn btn-primary">Remove Hospital</a>
                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
</body>

</html>