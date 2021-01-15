<?php
session_start();
if (!isset($_SESSION['logined']) and isset($user)){
    $_SESSION['logined'] = $user;
}