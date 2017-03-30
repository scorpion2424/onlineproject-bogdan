<head>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<?php
if((isset($_SESSION['user'])) && (isset($_SESSION['pass'])) && ($_SESSION['user']==='admin') && $_SESSION['pass']==='admin'){
    ?>
    <div id="loginWrapper">
    <button id="adminLoginButton" onclick="window.location.href='http://localhost:90/project-bogdan/adminPage.php'">Admin's page</button>
    </div>
<?php
        }
        else {
            ?>
            <div id="loginWrapper">
                <button id="adminLoginButton">Admin's corner</button>
                <form id="loginData" method="post" action="http://localhost:90/project-bogdan/adminPage.php"
                      onsubmit=" return checkscript()">
                    Username: <input type="username" name="user" placeholder="your username..."><br>
                    Password: <input type="password" name="pass" placeholder="your password..."><br>
                    <button id="submitButton" type="submit">Login</button>
                </form>
                <div id="loginError">
                    <p>Your data is invalid.Please try again.</p>
                </div>
            </div>
            <div class="freeSpace"></div>
            <script>
                $(document).ready(function () {
                    $("#adminLoginButton").click(function () {
                        $("#loginData").show();
                        $("#adminLoginButton").hide();
                    });
                });
                function checkscript() {
                    var username = document.forms["loginData"]["user"].value;
                    var password = document.forms["loginData"]["pass"].value;
                    if (username === "admin" && password === "admin") {
                        return true;
                    }
                    $("#loginError").show();
                    return false;
                }
            </script>
            <?php
        }
        ?>