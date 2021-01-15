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

    <style>
        .wrapper {
            background-color: white;
        }
    </style>
</head>

<body>
    <?php include('nav-bar.php'); ?>
    <?php if (!isset($_SESSION["logined"])) {
        header("location: index.php");
    }
    include("connection.php");
    $query = mysqli_fetch_row(mysqli_query($conn, "SELECT count(*) FROM `table_cv` WHERE `user_id` = " . $_SESSION["logined"] . ";"));
    mysqli_close($conn);
    if ($query[0] > 0) {
        header("location: page-edit-cv.php");
    } ?>

    <?php
    if (isset($_POST['create'])) {
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

        $count = 1;
        $ele = "edu-input" . $count;
        $sqlAdd = "";
        while (isset($_POST[$ele])) {
            $type = $_POST["type-edu-select" . $count];
            $name = $_POST["edu-input" . $count];
            $spec = $_POST["spec-input" . $count];
            $from = $_POST["edu-from-input" . $count];
            $to = $_POST["edu-to-input" . $count];
            $sql = "INSERT INTO `educations` (`type_edu`, `name`, `spec`, `y_from`, `y_to`, `cv_id`) VALUES ('$type', '$name', '$spec', $from, $to, @cv_id); ";
            $sqlAdd .= $sql;
            $count++;
            $ele = "edu-input" . $count;
        }
        $count = 1;
        $ele = "company-input" . $count;
        while (isset($_POST[$ele])) {
            $name = $_POST["company-input" . $count];
            $pos = $_POST["position-input" . $count];
            $from = $_POST["exp-from-input" . $count];
            $to = $_POST["exp-to-input" . $count];
            $sql = "INSERT INTO `experiences` (`name`, `pos`, `y_from`, `y_to`, `cv_id`) VALUES ('$name', '$pos', $from, $to, @cv_id); ";
            $sqlAdd .= $sql;
            $count++;
            $ele = "company-input" . $count;
        }
        $count = 1;
        $ele = "skill-input" . $count;
        while (isset($_POST[$ele])) {
            $name = $_POST["skill-input" . $count];
            $score = $_POST["skill-score" . $count];
            $sql = "INSERT INTO `skills` (`name`, `score`, `cv_id`) VALUES ('$name', '$score', @cv_id); ";
            $sqlAdd .= $sql;
            $count++;
            $ele = "skill-input" . $count;
        }

        $sql = "START TRANSACTION; " .
            "INSERT INTO `table_cv` (`user_id`) VALUES ($user_id); " .
            "SELECT @cv_id := `cv_id` FROM `table_cv` WHERE `user_id` = $user_id; " .
            "INSERT INTO `informations` (`fullname`,`birthday`,`gender`,`about`,`cv_id`) VALUES ('$fullname','$birthday','$gender','$about',@cv_id); " .
            "INSERT INTO `contacts` (`email`,`phone`,`city`,`district`,`address1`,`address2`,`cv_id`) VALUES ('$email',$phone,'$city','$district','$address1','$address2',@cv_id); " .
            $sqlAdd .
            "COMMIT;";
        $query = mysqli_multi_query($conn, $sql);
        if ($query) {
            echo "them xong";
        } else {
            echo "$sql $conn->error";
        }
        mysqli_close($conn);
    } ?>

    <div class="container wrapper mx-auto rounded mt-5 p-4">
        <h2>Your Curriculum Vitae</h2>
        <p>Please fill this form to create your CV.</p>
        <hr>
        <form method="POST" action="page-create-cv.php">
            <div class="row gx-4">
                <div class="col-xl-6">
                    <h3>Information</h3>
                    <div class="my-2">
                        <label for="fullname-input" class="form-label">Fullname*</label>
                        <input type="text" class="form-control" name="fullname-input">
                    </div>
                    <div class="my-2">
                        <label for="birthday-input" class="form-label">Birthday*</label>
                        <input type="date" class="form-control" name="birthday-input" max="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="my-2">
                        <span class="col-auto">Gender</span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender-radio" value="male" checked>
                            <label class="form-check-label" for="gender-radio">
                                Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender-radio" value="female">
                            <label class="form-check-label" for="gender-radio">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="about-txarea" class="form-label">About</label>
                        <textarea class="form-control" name="about-txarea" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-xl-6">
                    <h3>Contact</h3>
                    <div class="row">
                        <div class="my-2 col-xl-6">
                            <label for="email-input" class="form-label">Email*</label>
                            <input type="email" class="form-control" name="email-input">
                        </div>
                        <div class="my-2 col-xl-6">
                            <label for="phone-input" class="form-label">Phone*</label>
                            <input type="text" class="form-control" name="phone-input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-xl-6">
                            <label for="city-select" class="form-label">City*</label>
                            <input type="text" class="form-control" name="city-input">
                        </div>
                        <div class="my-2 col-xl-6">
                            <label for="district-select" class="form-label">District*</label>
                            <input type="text" class="form-control" name="district-input">
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="address-input1" class="form-label">Address 1*</label>
                        <input type="text" class="form-control" name="address-input1">
                    </div>
                    <div class="my-2">
                        <label for="address-input1" class="form-label">Address 2</label>
                        <input type="text" class="form-control" name="address-input2">
                    </div>
                </div>
            </div>
            <div class="row gx-4">
                <div class="col-xl-6">
                    <div id="education">
                        <h3>Education <i class="fas fa-plus-circle text-primary" onclick="addEdu()"></i></h3>
                    </div>
                    <div id="skill">
                        <h3>Skill <i class="fas fa-plus-circle text-primary" onclick="addSkill()"></i> <i class="fas fa-minus-circle text-danger" onclick="removeSkill()"></i></h3>
                    </div>
                </div>
                <div class="col-xl-6" id="experience">
                    <h3>Experience <i class="fas fa-plus-circle text-primary" onclick="addExp()"></i></h3>
                </div>
            </div>

            <div class="mt-3 d-md-flex justify-content-md-end">
                <input type="submit" class="btn btn-primary" name="create" value="Create"></input>
            </div>
        </form>
    </div>

    <script>
        var countEdu = 0;
        var countExp = 0;
        var countSkill = 0;

        function addEdu() {
            var eduForm = document.getElementById("education");
            var ele = document.createElement("div");
            var att = document.createAttribute("id");
            countEdu++;
            att.value = "edu" + countEdu;
            ele.setAttributeNode(att);
            ele.innerHTML = "<div class='my-2'>" +
                "<label for='edu-input' class='fw-bold'>Education</label> <i class='fas fa-backspace text-danger' onclick='removeEdu(\"" + att.value + "\")'></i>" +
                "<div class='input-group my-2'>" +
                "<select class='form-select' name='type-edu-select" + countEdu + "'>" +
                "<option value='university'>University</option>" +
                "<option value='academy'>Academy</option>" +
                "<option value='college'>College</option>" +
                "</select>" +
                "<input type='text' class='form-control' name='edu-input" + countEdu + "' placeholder='Type name...'>" +
                "</div>" +
                "</div>" +
                "<div class='my-2'>" +
                "<label for='spec-input'>Specialize</label>" +
                "<input type='text' class='form-control' name='spec-input" + countEdu + "'>" +
                "</div>" +
                "<div class='my-2'>" +
                "<span>Time to study</span>" +
                "<div class='input-group mb-3'>" +
                "<input type='number' class='form-control' name='edu-from-input" + countEdu + "' placeholder='From..' min='1' max='<?php echo date('Y'); ?>'>" +
                "<input type='number' class='form-control' name='edu-to-input" + countEdu + "' placeholder='To..' min='1' max='<?php echo date('Y'); ?>'>" +
                "</div>" +
                "</div>";
            eduForm.appendChild(ele);
        }

        function removeEdu(eduid) {
            var selDelEdu = document.getElementById(eduid);
            selDelEdu.remove();
            countEdu--;
        }

        function addExp() {
            var expForm = document.getElementById("experience");
            var ele = document.createElement("div");
            var att = document.createAttribute("id");
            countExp++;
            att.value = "exp" + countExp;
            ele.setAttributeNode(att);
            ele.innerHTML = "<div class='my-2'>" +
                "<label for='company-input' class='fw-bold'>Company</label> <i class='fas fa-backspace text-danger' onclick='removeExp(\"" + att.value + "\")'></i>" +
                "<input type='text' class='form-control' name='company-input" + countExp + "' placeholder='Type name...'>" +
                "</div>" +
                "<div class='my-2'>" +
                "<label for='position-input'>Position</label>" +
                "<input type='text' class='form-control' name='position-input" + countExp + "'>" +
                "</div>" +
                "<div class='my-2'>" +
                "<span>Time to work</span>" +
                "<div class='input-group mb-3'>" +
                "<input type='number' class='form-control' name='exp-from-input" + countExp + "' placeholder='From..' min='1' max='<?php echo date('Y'); ?>'>" +
                "<input type='number' class='form-control' name='exp-to-input" + countExp + "' placeholder='To..' min='1' max='<?php echo date('Y'); ?>'>" +
                "</div>" +
                "</div>";
            expForm.appendChild(ele);
        }

        function removeExp(expid) {
            var selDelExp = document.getElementById(expid);
            selDelExp.remove();
            countExp--;
        }

        function addSkill() {
            var skillForm = document.getElementById("skill");
            var ele = document.createElement("div");
            var att = document.createAttribute("id");
            countSkill++;
            att.value = "skill" + countSkill;
            ele.setAttributeNode(att);
            ele.innerHTML = "<div class='my-2'>" +
                "<input type='text' class='form-control-plaintext' name='skill-input" + countSkill + "' placeholder='Type a skill name..'>" +
                "<input type='range' class='form-range' min='0' max='100' step='5' name='skill-score" + countSkill + "'>" +
                "</div>";
            skillForm.appendChild(ele);
        }

        function removeSkill() {
            if (countSkill > 0) {
                var skillid = "skill" + countSkill;
                var selDelSkill = document.getElementById(skillid);
                selDelSkill.remove();
                countSkill--;
            }
        }
    </script>
    <?php include("footer.php"); ?>
</body>

</html>