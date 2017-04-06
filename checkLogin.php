<?php

if (!isset($_SESSION['user']) || ($_SESSION['user']!="admin")) {
    header('Location: http://localhost:90/project-bogdan/index.php');
    exit();
}
?>