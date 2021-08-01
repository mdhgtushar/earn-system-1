<?php
include "Classes/Userlogin.php";
$ul = new Userlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uniqueUserName = $_POST['uniqueUserName'];
    $userPass = md5($_POST['userPass']);
    
    $loginChk = $ul->userLogin($userPass, $uniqueUserName);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
</head>
<body>
    <p>
         <?php  if (isset($loginChk)) { echo $loginChk; } ?>
    </p>
    <form action="" method="post">
        <input type="text"  name="uniqueUserName" placeholder="Username..">
        <input type="password" name="userPass" name="">
        <input type="submit" value="Login">
    </form>
</body>
</html>