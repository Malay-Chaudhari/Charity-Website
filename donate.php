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

    include 'partials/db_connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $donation = $_POST["donation"];
        $address = $_POST["address"];

        // Add donation item to the history table in the database
        $sql = "INSERT INTO `history` (`donation`,`address`, `dt`) VALUES ('$donation', '$address', CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
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
            margin-top: 70px;
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
                    <a class="nav-link active" href="donate.php">Donate</a>
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
            echo '<div class="alert alert-success" role="alert">
            <Strong>Success!</Strong> Our Volunteer will come and pick up things from the given location.
            </div>';
        }

        if ($showError) {
            echo '<div class="alert alert-danger" role="alert">
            <Strong>Sorry </Strong>for inconvenience. <br>';
            echo $showError;
            echo '</div>';
        }
    ?>
    <div class="container text-center my-3">
        <h1>
            What do you want to donate ?
        </h1>
        <div>
            <form action="/DE/donate.php" method="post">
                <div class="my-3">
                    <textarea name="donation" id="" cols="40" rows="5"></textarea>
                </div>
                <div class="my-3">
                    Please Enter the Address from where we can pick up things
                </div>
                <div class="my-3">
                    <textarea name="address" id="" cols="40" rows="5"></textarea>
                </div>
                <input class="btn btn-primary" type="submit">
            </form>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
    <script>
        setTimeout(() => document.querySelector('.alert').remove(), 3000);
    </script>
</body>

</html>