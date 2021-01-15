<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>My Curriculum Vitae - View</title>
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/view.css">
</head>

<body>
    <?php
    include("connection.php");
    $user_id = $_GET["id"];
    $result = mysqli_fetch_row(mysqli_query($conn, "SELECT `cv_id` FROM `table_cv` WHERE `user_id` = $user_id;"));
    if (isset($result[0])) {
        $cv_id = $result[0];
        $avatar = mysqli_fetch_row(mysqli_query($conn, "SELECT `avatar` FROM `users` WHERE `user_id` = $user_id;"));
        $info = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `informations` WHERE `cv_id` = $cv_id;"));
        $cont = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `contacts` WHERE `cv_id` = $cv_id;"));
        $eduList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `educations` WHERE `cv_id` = $cv_id;"));
        $expList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `experiences` WHERE `cv_id` = $cv_id;"));
        $skillList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `skills` WHERE `cv_id` = $cv_id;"));
    ?>
        <div class="container shadow-lg my-md-5 mb-1">
            <div class="row">
                <div class="col-md-5 col-xl-5" style="background-color: #97bbc7;">
                    <div id="avatar">
                        <img src="img/avatar/<?php echo $avatar[0]; ?>" alt="avatar" class="d-block mx-auto my-5 shadow" width="80%" height="auto">
                    </div>
                    <div id="about">
                        <div id="title" class="text-uppercase fs-1 text-center mt-5 mb-3">A b o u t</div>
                        <p class="mx-3 text-center fs-5"><?php echo $info[4]; ?></p>
                    </div>
                    <div class="text-uppercase fs-2 text-center mt-5"><?php echo $info[1]; ?></div>
                    <div id="info" class="mx-3 my-2 mx-lg-5 mb-5">
                        <div id="gender">
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <?php echo ($info[3] == "male") ? "<i class='fas fa-mars fa-stack-1x fa-inverse'></i>" : "<i class='fas fa-venus fa-stack-1x fa-inverse'></i>"; ?>
                            </span>
                            <span class="text-capitalize fs-5 align-middle"><?php echo (1 == 1) ? "male" : "female"; ?></span>
                        </div>
                        <div id="bỉthday" class="my-2">
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-calendar-alt fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fs-5 align-middle"><?php echo $info[2]; ?></span>
                        </div>
                        <div id="address" class="my-2">
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-location-arrow fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="text-capitalize fs-5 align-middle"><?php echo "$cont[6], $cont[5], $cont[4], $cont[3]"; ?></span>
                        </div>
                        <div id="phone" class="my-2">
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-phone fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fs-5 align-middle"><?php echo $cont[2]; ?></span>
                        </div>
                        <div id="email" class="my-2">
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="text-lowercase fw-bold fs-5 align-middle"><?php echo $cont[1]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-7" style="background-color: #fdfdfd;">
                    <div class="mt-5">
                        <div class="my-3">
                            <span class="fa-stack fa-2x" style="color: #287e95;">
                                <i class="far fa-circle fa-stack-2x"></i>
                                <i class="fas fa-graduation-cap fa-stack-1x"></i>
                            </span>
                            <span class="text-uppercase fs-1 align-middle">Education</span>
                        </div>
                        <?php
                        foreach ($eduList as $edu) {
                            echo "<div id='edu$edu[0]' class='my-3'>";
                            echo "<div class='text-capitalize ms-5 fs-3'>$edu[3]</div>";
                            echo "<div class='text-capitalize ms-5 fs-4'><strong>$edu[1]</strong> | $edu[2] | $edu[4] - $edu[5]</div>";
                            echo "<div style='width: 100px; background-color: #287e95; border: 5px solid #287e95; border-radius: 3px;' class='ms-5 mt-3'></div>";
                            echo "</div>";
                        } ?>
                        <hr>
                    </div>
                    <div>
                        <div class="my-3">
                            <span class="fa-stack fa-2x" style="color: #287e95;">
                                <i class="far fa-circle fa-stack-2x"></i>
                                <i class="fas fa-briefcase fa-stack-1x"></i>
                            </span>
                            <span class="text-uppercase fs-1 align-middle">Experience</span>
                        </div>
                        <?php
                        foreach ($expList as $exp) {
                            echo "<div id='exp$exp[0]' class='my-3'>";
                            echo "<div class='text-capitalize ms-5 fs-3'>$exp[1]</div>";
                            echo "<div class='text-capitalize ms-5 fs-4'><strong>$exp[2]</strong> | $exp[3] - $exp[4]</div>";
                            echo "<div style='width: 100px; background-color: #287e95; border: 5px solid #287e95; border-radius: 3px;' class='ms-5 mt-3'></div>";
                            echo "</div>";
                        }
                        ?>
                        <hr>
                    </div>
                    <div class="mb-5">
                        <div class="my-3">
                            <span class="fa-stack fa-2x" style="color: #287e95;">
                                <i class="far fa-circle fa-stack-2x"></i>
                                <i class="fas fa-lightbulb fa-stack-1x"></i>
                            </span>
                            <span class="text-uppercase fs-1 align-middle">Skills</span>
                        </div>
                        <?php
                        foreach ($skillList as $skill) {
                            echo "<div id='skill$skill[0]' class='my-3'>";
                            echo "<div class='ms-5 fs-3'>$skill[1]</div>";
                            echo "<div class='progress mx-5'>";
                            echo "<div class='progress-bar' role='progressbar' style='width: $skill[2]%;  background-color: #287e95;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="bg-light rounded mx-auto my-5" style="width: 50%; height: auto;">
            <img src="img/error404.png" alt="trangloi404" width="60%" height="auto" class="d-block mx-auto">
            <p class="fs-3 text-center fw-bold">This Curriculum Vitae does not exist</p>
            <p class="fs-4 text-center fw-bold">If the page doesn't redirect itself, go back to <a href="index.php">the home page here</a>!!</p>
        </div>
    <?php header("refresh: 10; url='index.php");
    }
    mysqli_close($conn);
    ?>
    <?php include("footer.php"); ?>
</body>

</html>