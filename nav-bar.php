<?php include("logined.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="img/iconlogo.png" width="30" height="30" alt=""> <strong>MyCV</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ms-auto">
                <?php
                if (!isset($_SESSION['logined'])) { ?>
                    <li class='nav-item'>
                        <a class='nav-link' href="page-login.php">Sign In</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="page-register.php">Sign Up</a>
                    </li>
                <?php } else {
                    include("connection.php");
                    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = " . $_SESSION['logined']);
                    $user = mysqli_fetch_row($result);
                    $query = mysqli_query($conn, "SELECT * FROM `table_cv` WHERE `user_id` = " . $_SESSION['logined']);
                    $row = mysqli_fetch_array($query);
                    $count = count($row);
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/avatar/<?php echo $user[7]; ?>" alt="" width="30" height="30" class="rounded-circle">
                            <?php echo $user[1]; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="account.php">Account</a></li>
                            <li><a class="dropdown-item" href="<?php echo "view.php?id=$user[0]";?>">View Your CV</a></li>

                            <li><a class="dropdown-item" href="<?php echo ($count>0)?"page-edit-cv.php":"page-create-cv.php";?>"><?php echo ($count>0)?"Edit Your CV":"Create Your CV";?></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class='dropdown-item' href='logout.php'>Log Out</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div id="notify" class="container position-absolute top-0 start-50 translate-middle mt-5"></div>