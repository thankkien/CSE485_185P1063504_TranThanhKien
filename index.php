<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>My Curriculum Vitae - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <header>
        <p class="display-1 fw-bold text-center mt-5">Have a good resume <br> have a good job</p>
        <div class="d-grid gap-2 col-6 col-md-3 col-xl-2 mx-auto my-5">
            <a class="h1 fw-bold btn btn-lg btn-danger shadow" href="<?php if (isset($_SESSION["logined"])) {
                                                                            echo "page-create-cv.php";
                                                                        } else {
                                                                            echo "page-register.php";
                                                                        } ?>" role="button">Create Your CV</a>
        </div>
    </header>
    <?php include("footer.php"); ?>
</body>

</html>