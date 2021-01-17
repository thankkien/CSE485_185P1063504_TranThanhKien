<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/notify.js"></script>
    <title>My Curriculum Vitae - Account</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <?php if (!isset($_SESSION["logined"])) {
        header("location: index.php");
    } ?>

    <?php
    include "connection.php";
    $sql = "SELECT * FROM `users` WHERE `user_id` = " . $_SESSION["logined"] . ";";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_row($result);
    mysqli_close($conn);
    $id = $_SESSION["logined"];
    ?>

    <?php
    if (isset($_POST['update-ava'])) {
        include "connection.php";
        if (!isset($_FILES['fileUpload'])) {
            $target_dir = "img/avatar/";
            $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
            $ava = rand(1000, 9999) . uniqid() . "." . $imageFileType;
            $target_file = $target_dir . $ava;
            $uploadOk = 1;
            // Check if image file is a actual image or fake image
            if (isset($_POST["Update"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "<script type='text/javascript'> notify('File is an image - " . $check["mime"] . "', 'danger'); </script>";
                    $uploadOk = 1;
                } else {
                    echo "<script type='text/javascript'> notify('File is not an image.', 'danger'); </script>";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "<script type='text/javascript'> notify('Sorry, file already exists.', 'danger'); </script>";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 320000000) {
                echo "<script type='text/javascript'> notify('Sorry, your file is too large.', 'danger'); </script>";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "<script type='text/javascript'> notify('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'danger'); </script>";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                header("Refresh: 3; url=" . $_SERVER['PHP_SELF']);
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . $ava . " has been uploaded. ";
                } else {
                    echo "<script type='text/javascript'> notify('Sorry, there was an error uploading your file.', 'danger'); </script>";
                    header("Refresh: 3; url=" . $_SERVER['PHP_SELF']);
                }
            }
        }
        $sql = "UPDATE `users` SET `avatar` = '$ava' WHERE `user_id` = $id";

        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script type='text/javascript'> notify('Successful avatar update!!', 'success'); </script>";
            header("Refresh: 3; url=" . $_SERVER['PHP_SELF']);
        } else {
            echo "<script type='text/javascript'> notify('$conn->error', 'danger'); </script>";
        }
        mysqli_close($conn);
    }

    if (isset($_POST['activate-email'])) {
        include "connection.php";
        $email = $user[2];
        $sec_code = rand(10000000, 99999999);
        $sql = "UPDATE `users` SET `sec_code` = $sec_code WHERE `user_id` = $id";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            include("mailer-activate.php");
            echo '<script type="text/javascript">window.location = "http://localhost/BaiTapLon/account.php"</script>';
        } else {
            echo "<script type='text/javascript'> notify('$conn->error', 'danger'); </script>";
        }
        mysqli_close($conn);
    }

    if (isset($_POST['change-pass'])) {
        include "connection.php";
        $old_pass       = trim($_POST['old-pass']);
        $hashed_old_pass = password_hash($old_pass, PASSWORD_DEFAULT);
        $sql = "SELECT `password` FROM `users` WHERE `user_id` = $id";
        $result = mysqli_query($conn, $sql);
        $pass = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            if (password_verify($old_pass, $pass[0])) {
                $new_pass       = trim($_POST['new-pass']);
                $retype_npass       = trim($_POST['retype-npass']);
                if ($new_pass == $retype_npass) {
                    $hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                    $sql = "UPDATE `users` SET `password` = '$hashed_new_pass' WHERE `user_id` = $id";
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "<script type='text/javascript'> notify('Password changed successfully!!', 'danger'); </script>";
                        header("Refresh: 3; url=" . $_SERVER['PHP_SELF']);
                    } else {
                        echo "<script type='text/javascript'> notify('$conn->error', 'danger'); </script>";
                    }
                } else {
                    echo "<script type='text/javascript'> notify('New password doesn't match', 'danger'); </script>";
                }
            } else {
                echo "<script type='text/javascript'> notify('Old password is incorrect', 'danger'); </script>";
            }
        } else {
            echo "<script type='text/javascript'> notify('An unknown error', 'danger'); </script>";
        }
        mysqli_close($conn);
    }
    ?>

    <div class="container bg-light rounded p-4 my-5">
        <div class="row">
            <div class="col-md-3">
                <img src="img/avatar/<?php echo $user[7] ?>" alt="" class="rounded-circle border border-secondary border-3" width="100%" height="auto">
            </div>
            <div class="col-md-9">
                <form method="POST" action="account.php" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <label for="fileToUpload" class="form-label">Upload your new avatar</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="fileToUpload">
                            <button type="submit" class="btn btn-primary" name="update-ava">Update</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="POST" action="account.php">
                    <div class="col-lg-6">
                        <p>Username: <?php echo $user[1]; ?></p>
                        <p>Email: <?php echo $user[2]; ?></p>
                        <p>Status: <?php echo ($user[4] == 1) ? "Activated" : "Not Activated"; ?></p>
                        <?php if ($user[4] != 1) {
                            echo "<button type='submit' class='btn btn-primary' name='activate-email'>Activate</button>";
                        } ?>
                    </div>
                </form>
                <hr>
                <form method="POST" action="account.php">
                    <div class="col-lg-6">
                        <div class="row my-2">
                            <div class="col-md-4 text-md-end">
                                <label for="old-pass">Old password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="old-pass">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-4 text-md-end">
                                <label for="new-pass">New password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new-pass">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-4 text-md-end">
                                <label for="retype-npass">Retype</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="retype-npass">
                                <button type="submit" class="btn btn-primary mt-2" name="change-pass">Change</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>