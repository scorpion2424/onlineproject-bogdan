<?php
if ((  isset($_POST['user'])) && ($_POST['user'])=='admin' && (  isset($_POST['pass'])) && ($_POST['pass'])=='admin')
{
$_SESSION['user']=$_POST['user'];
$_SESSION['pass']=$_POST['pass'];
}
if (( ! isset($_SESSION['user'])) ||  ( ! isset($_SESSION['pass'])))
{
header('Location: http://localhost:90/project-bogdan/index.php');
}
if (( $_SESSION['user']!="admin")  || ($_SESSION['pass']!="admin"))
{
header('Location: http://localhost:90/project-bogdan/index.php');
}
?>