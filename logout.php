<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';
session_unset();
session_destroy();
header('Location: http://localhost:90/project-bogdan/index.php');
?>