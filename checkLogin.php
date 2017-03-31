<?php
if (( isset($_POST['user'])) && ($_POST['user'])=='admin' && ( isset($_POST['pass'])) && ($_POST['pass'])=='admin')
{
    $_SESSION['user']=$_POST['user'];

}

if (!isset($_SESSION['user']) || ($_SESSION['user']!="admin"))
{
    header('Location: http://localhost:90/project-bogdan/index.php');
    exit();
}
?>