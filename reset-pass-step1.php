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
    <?php
    if (isset($_POST['reset'])) {
        include('connection.php');
        $email = $_POST['email-input'];
        $query = mysqli_query($conn, "SELECT COUNT(`email`) FROM `user` WHERE `email` = '$email'");
        $result = mysqli_fetch_row($query);
        if ($result[0] == 1) {
            $sec_code = rand(10000000, 99999999);
            $query = mysqli_query($conn, "UPDATE `user` SET `sec_code` = $sec_code WHERE `email` = '$email'");
            include("mailer-rs-pass1.php");
            echo '<script type="text/javascript">window.location = "http://localhost/BaiTapLon/index.php"</script>';
        } else { 
            echo "<script type='text/javascript'> notify('Email is not available!!', 'danger'); </script>";
        }
        mysqli_close($conn);
    } ?>

    <div class="bg-light rounded mx-auto my-5 p-3" style="width: 400px;">
        <h2>Recover</h2>
        <p>Please enter an email to recover your password.</p>
        <hr>
        <form method="POST" action="reset-pass-step1.php">
            <div class="my-3">
                <label for="email-input">Email</label>
                <input type="email" class="form-control" name="email-input" placeholder="Enter email" required>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-primary" name="reset" value="Reset"></input>
            </div>
        </form>
    </div>

    <?php include("footer.php");?>
</body>

</html>