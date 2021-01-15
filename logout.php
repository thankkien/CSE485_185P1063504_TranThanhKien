<?php
    session_start();
    unset($_SESSION['logined']);
    header("location: index.php");
