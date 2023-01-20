<?php
session_start();
$_SESSION['login'] = false;

header("location:index_login.php");
