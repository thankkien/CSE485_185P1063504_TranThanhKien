<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <title>My Curriculum Vitae - Thanks!!</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">

    <style>
        .wrapper {
            background-color: white;
            width: 400px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET["email"]) && isset($_GET["code"])) {
        include('connection.php');
        $email = $_GET['email'];
        $code = $_GET['code'];

        $query = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `email` = '$email'");
        $result = mysqli_fetch_row($query);
        if ($result[0] == 1) {
            $error = 1;
        } else {
            $sql = "UPDATE users SET status = 1 WHERE `email` = '$email' and `sec_code` = '$code';";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $error = 0;
            } else {
                $error = 2;
            }
        }
        mysqli_close($conn);
    }
    ?>

    <?php include('nav-bar.php'); ?>

    <div class="wrapper mx-auto rounded mt-5">
        <?php
        if (isset($_GET["email"]) && isset($_GET["code"])) {
            if ($error == 0) {
                echo "<h2>Thank you!!</h2>";
                echo "<p>Thank you for using our product</p>";
                if (!isset($_SESSION["logined"])) {
                    echo "<hr>";
                    echo "<p>Please <a href='page-login.php'>login here</a>.</p>";
                } else {
                    header("Refresh: 3; url=account.php");
                }
            } else if ($error == 1) {
                echo "<h2>Oops!!</h2>";
                echo "<p>This account has been active</p>";
                echo "<hr>";
                echo "<p>Please <a href='page-login.php'>login here</a>.</p>";
            } else if ($error == 2) {
                echo "<h2>Oops!!</h2>";
                echo "<p>An error occurred during activation</p>";
                echo "<hr>";
                echo "<p>Go <a href='index.php'>home here</a>.</p>";
            }
        } else {
            header("location: index.php");
        } ?>

    </div>
    <?php include("footer.php");?>
</body>

</html>