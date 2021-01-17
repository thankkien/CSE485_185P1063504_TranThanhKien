<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/notify.js"></script>
    <title>My Curriculum Vitae - Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <?php if (isset($_SESSION["logined"])) { header("location: index.php"); }?>

    <?php
    if (isset($_POST['SignUp'])) {
        include('connection.php');
        $username       = trim($_POST['username-input']);
        $email          = trim($_POST['email-input']);
        $password1      = trim($_POST['pass-input1']);
        $password2      = trim($_POST['pass-input2']);

        $sql = "SELECT * FROM `users` WHERE `email` = '$email' or `username` = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            if ($password1 == $password2) {
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                $sec_code = rand(10000000, 99999999);
                $sql = "INSERT INTO users (`username`, `email`, `password`, `sec_code`) VALUES ('$username', '$email','$hashed_password','$sec_code');";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    include("mailer-activate.php");
                    echo '<script type="text/javascript">window.location = "http://localhost/BaiTapLon/page-login.php"</script>';
                } else {
                    echo "$sql $conn->error";
                }
                mysqli_close($conn);
            } else {
                echo "<script type='text/javascript'> notify('Cant login!! Accoutn or password are incorect', 'danger'); </script>";
            }
        } else {
            echo "<script type='text/javascript'> notify('Account is available!!', 'danger'); </script>";
        }
    } ?>


    <div class="bg-light rounded mx-auto my-5 p-3" style="width: 400px;">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <hr>
        <form method="POST" action="page-register.php">
            <div class="my-3">
                <label for="username-input">Username</label>
                <input type="text" class="form-control" name="username-input" placeholder="Enter username" required>
            </div>
            <div class="my-3">
                <label for="email-input">Email</label>
                <input type="email" class="form-control" name="email-input" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="my-3">
                <label for="pass-input1">Password</label>
                <input type="password" class="form-control" name="pass-input1" placeholder="Type password" required>
            </div>
            <div class="my-3">
                <label for="pass-input2">Confirm Password</label>
                <input type="password" class="form-control" name="pass-input2" placeholder="Retype password" required>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-primary" Name="SignUp" value="Sign Up"></input>
            </div>
            <hr>
            <p>Already have an account? <a href="page-login.php">Login here</a>.</p>
        </form>
    </div>
    
    <?php include("footer.php");?>
</body>

</html>