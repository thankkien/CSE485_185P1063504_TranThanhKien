<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9a1e49c746.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>My Curriculum Vitae - Create Your CV</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/iconlogo.png" type="image/x-icon">
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <?php if (!isset($_SESSION["logined"])) {
        header("location: index.php");
    }
    include("connection.php");
    $query = mysqli_fetch_row(mysqli_query($conn, "SELECT count(*) FROM `table_cv` WHERE `user_id` = " . $_SESSION["logined"] . ";"));
    mysqli_close($conn);
    if ($query[0] = 0) {
        header("location: page-create-cv.php");
    } ?>

    <?php
    include("connection.php");
    $user_id = $_SESSION["logined"];
    $result = mysqli_fetch_row(mysqli_query($conn, "SELECT `cv_id` FROM `table_cv` WHERE `user_id` = $user_id;"));
    $cv_id = $result[0];

    $info = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `informations` WHERE `cv_id` = $cv_id;"));
    $cont = mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `contacts` WHERE `cv_id` = $cv_id;"));
    $eduList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `educations` WHERE `cv_id` = $cv_id;"));
    $expList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `experiences` WHERE `cv_id` = $cv_id;"));
    $skillList = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `skills` WHERE `cv_id` = $cv_id;"));
    mysqli_close($conn);
    ?>

    <?php
    if (isset($_POST['update'])) {
        include "connection.php";
        $user_id = $_SESSION["logined"];

        $fullname = $_POST["fullname-input"];
        $birthday = $_POST["birthday-input"];
        $gender = $_POST["gender-radio"];
        $about = $_POST["about-txarea"];

        $email = $_POST["email-input"];
        $phone = $_POST["phone-input"];
        $city = $_POST["city-input"];
        $district = $_POST["district-input"];
        $address1 = $_POST["address-input1"];
        $address2 = $_POST["address-input2"];


        $sqlAdd = "";
        foreach ($eduList as $edu) {
            $ele = "edu-input" . $edu[0];
            if (isset($_POST[$ele])) {
                $type = $_POST["type-edu-select" . $edu[0]];
                $name = $_POST["edu-input" . $edu[0]];
                $spec = $_POST["spec-input" . $edu[0]];
                $from = $_POST["edu-from-input" . $edu[0]];
                $to = $_POST["edu-to-input" . $edu[0]];
                $sql = "UPDATE `educations` SET `type_edu` = '$type', `name` = '$name', `spec` = '$spec', `y_from` = $from, `y_to` = $to WHERE `cv_id` = @cv_id AND `edu_id` = $edu[0]; ";
                $sqlAdd .= $sql;
                $ele = "edu-input" . $edu[0];
            }
        }

        foreach ($expList as $exp) {
            $ele = "company-input" . $exp[0];
            if (isset($_POST[$ele])) {
                $name = $_POST["company-input" . $exp[0]];
                $pos = $_POST["position-input" . $exp[0]];
                $from = $_POST["exp-from-input" . $exp[0]];
                $to = $_POST["exp-to-input" . $exp[0]];
                $sql = "UPDATE `experiences` SET `name` = '$name', `pos` = '$pos', `y_from` = $from, `y_to` = $to WHERE `cv_id` = @cv_id AND `exp_id` = $edu[0]; ";
                $sqlAdd .= $sql;
                $ele = "company-input" . $exp[0];
            }
        }
        foreach ($skillList as $skill) {
            $ele = "skill-input" . $skill[0];
            if (isset($_POST[$ele])) {
                $name = $_POST["skill-input" . $skill[0]];
                $score = $_POST["skill-score" . $skill[0]];
                $sql = "UPDATE `skills` SET `name` = '$name', `score` = '$score' WHERE `cv_id` = @cv_id AND `skill_id` = $edu[0]; ";
                $sqlAdd .= $sql;
                $ele = "skill-input" . $skill[0];
            }
        }

        $sql = "START TRANSACTION; " .
            "SELECT @cv_id := `cv_id` FROM `table_cv` WHERE `user_id` = $user_id; " .
            "UPDATE `informations` SET `fullname` = '$fullname', `birthday` = '$birthday', `gender` = '$gender', `about` = '$about' WHERE `cv_id` = @cv_id; " .
            "UPDATE `contacts` SET `email` = '$email', `phone` = $phone, `city` = '$city', `district` = '$district', `address1` = '$address1', `address2`='$address2' WHERE `cv_id` = @cv_id; " .
            $sqlAdd .
            "COMMIT;";
        $query = mysqli_multi_query($conn, $sql);
        if ($query) {
            header("refresh: 0, url=page-edit-cv.php");
        } else {
            echo "$sql $conn->error";
        }
        mysqli_close($conn);
    } ?>

    <div class="container bg-light mx-auto rounded my-5 p-4">
        <h2>Your Curriculum Vitae</h2>
        <p>Please fill this form to edit your CV.</p>
        <hr>
        <form method="POST" action="page-edit-cv.php">
            <div class="row gx-4">
                <div class="col-xl-6">
                    <h3>Information</h3>
                    <div class="my-2">
                        <label for="fullname-input" class="form-label">Fullname*</label>
                        <input type="text" class="form-control" name="fullname-input" value="<?php echo $info[1]; ?>">
                    </div>
                    <div class="my-2">
                        <label for="birthday-input" class="form-label">Birthday*</label>
                        <input type="date" class="form-control" name="birthday-input" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $info[2]; ?>">
                    </div>
                    <div class="my-2">
                        <span class="col-auto">Gender</span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender-radio" value="male" <?php if ($info[3] == "male") echo "checked"; ?>>
                            <label class="form-check-label" for="gender-radio">
                                Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender-radio" value="female" <?php if ($info[3] == "female") echo "checked"; ?>>
                            <label class="form-check-label" for="gender-radio">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="about-txarea" class="form-label">About</label>
                        <textarea class="form-control" name="about-txarea" rows="4"><?php echo $info[4]; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-6">
                    <h3>Contact</h3>
                    <div class="row">
                        <div class="my-2 col-xl-6">
                            <label for="email-input" class="form-label">Email*</label>
                            <input type="email" class="form-control" name="email-input" value="<?php echo $cont[1]; ?>">
                        </div>
                        <div class="my-2 col-xl-6">
                            <label for="phone-input" class="form-label">Phone*</label>
                            <input type="text" class="form-control" name="phone-input" value="<?php echo $cont[2]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-xl-6">
                            <label for="city-select" class="form-label">City*</label>
                            <input type="text" class="form-control" name="city-input" value="<?php echo $cont[3]; ?>">
                        </div>
                        <div class="my-2 col-xl-6">
                            <label for="district-select" class="form-label">District*</label>
                            <input type="text" class="form-control" name="district-input" value="<?php echo $cont[4]; ?>">
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="address-input1" class="form-label">Address 1*</label>
                        <input type="text" class="form-control" name="address-input1" value="<?php echo $cont[5]; ?>">
                    </div>
                    <div class="my-2">
                        <label for="address-input1" class="form-label">Address 2</label>
                        <input type="text" class="form-control" name="address-input2" value="<?php echo $cont[6]; ?>">
                    </div>
                </div>
            </div>
            <div class="row gx-4">
                <div class="col-xl-6">
                    <div>
                        <h3>Education</h3>
                        <?php
                        foreach ($eduList as $edu) {
                            echo "<div class='my-2'>";
                            echo "<label for='edu-input' class='fw-bold'>Education $edu[0]</label>";
                            echo "<div class='input-group my-2'>";
                            echo "<select class='form-select' name='type-edu-select$edu[0]' value='$edu[1]'>";
                            echo "<option value='university'>University</option>";
                            echo "<option value='academy'>Academy</option>";
                            echo "<option value='college'>College</option>";
                            echo "</select>";
                            echo "<input type='text' class='form-control' name='edu-input$edu[0]' placeholder='Type name...' value='$edu[2]'>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='my-2'>";
                            echo "<label for='spec-input'>Specialize</label>";
                            echo "<input type='text' class='form-control' name='spec-input$edu[0]' value='$edu[3]'>";
                            echo "</div>";
                            echo "<div class='my-2'>";
                            echo "<span>Time to study</span>";
                            echo "<div class='input-group mb-3'>";
                            echo "<input type='number' class='form-control' name='edu-from-input$edu[0]' placeholder='From..' value='$edu[4]' min='1' max='" . date('Y') . "'>";
                            echo "<input type='number' class='form-control' name='edu-to-input$edu[0]' placeholder='To..' value='$edu[5]' min='1' max='" . date('Y') . "'>";
                            echo "</div>";
                            echo "</div>";
                        } ?>
                    </div>
                    <div>
                        <h3>Skill</h3>
                        <?php
                        foreach ($skillList as $skill) {
                            echo "<div class='my-2'>";
                            echo "<input type='text' class='form-control-plaintext' name='skill-input$skill[0]' placeholder='Type a skill name..' value='$skill[1]'>";
                            echo "<input type='range' class='form-range' value='$skill[2]'  min='0' max='100' step='5' name='skill-score$skill[0]'>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xl-6">
                    <h3>Experience</h3>
                    <?php
                    foreach ($expList as $exp) {
                        echo "<div class='my-2'>";
                        echo "<label for='company-input' class='fw-bold'>Company $exp[0]</label>";
                        echo "<input type='text' class='form-control' name='company-input$exp[0]' placeholder='Type name...' value='$exp[1]'>";
                        echo "</div>";
                        echo "<div class='my-2'>";
                        echo "<label for='position-input'>Position</label>";
                        echo "<input type='text' class='form-control' name='position-input$exp[0]' value='$exp[2]'>";
                        echo "</div>";
                        echo "<div class='my-2'>";
                        echo "<span>Time to work</span>";
                        echo "<div class='input-group mb-3'>";
                        echo "<input type='number' class='form-control' name='exp-from-input$exp[0]' placeholder='From..' value='$exp[3]' min='1' max='" . date('Y') . "'>";
                        echo "<input type='number' class='form-control' name='exp-to-input$exp[0]' placeholder='To..' value='$exp[4]' min='1' max='" . date('Y') . "'>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="mt-3 d-md-flex justify-content-md-end">
                <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
            </div>
        </form>
    </div>
    <?php include("footer.php");?>
</body>

</html>