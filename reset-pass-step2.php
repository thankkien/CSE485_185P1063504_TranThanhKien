<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/notify.js"></script>
    <title>My Curriculum Vitae - Recover</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <?php if (isset($_POST["confirm"])) {
        include('connection.php');
        $email = $_GET['email'];
        $sec_code = $_GET["code"];
        $query = mysqli_query($conn, "SELECT COUNT(`email`) FROM `user` WHERE `email` = '$email' AND `sec_code` = $sec_code");
        $result = mysqli_fetch_array($query);
        if ($result[0] == 1) {
            $password = rand(10000000, 99999999);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "UPDATE `user` SET `password` = '$hashed_password' WHERE `email` = '$email'");
            include("mailer-rs-pass2.php");
            echo '<script type="text/javascript">window.location = "http://localhost/BaiTapLon/page-login.php"</script>';
        }
        mysqli_close($conn);
    } ?>

    <?php if (isset($_GET["email"]) && isset($_GET["code"])) { ?>
        <div class="bg-light rounded mx-auto my-5 p-3" style="width: 400px;">
            <h2>Recover</h2>
            <p>Click confirm, the reset password will be sent to your email.</p>
            <hr>
            <form method="POST" action="reset-pass-step2.php?email=<?php echo $_GET["email"] ?>&code=<?php echo $_GET["code"] ?>">
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary" name="confirm" value="Confirm"></input>
                </div>
            </form>
        </div>
    <?php } else {
        header("location: index.php");
    } ?>

<?php include("footer.php");?>
</body>

</html>