<?php
 require "check-login.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <title>Login</title>
</head>
<body>
<div class="form">
        <form action="" method="post">
        <div class="form_container">  
            <h1 class="form_title">Login</h1>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="user">Username:</label>
                </div>
                <div>
                    <input required type="text" name="user" class="form_input">
                </div>
            </div>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="pass">Password:</label>
                </div>
                <div>
                    <input required type="password" name="pass" class="form_input">
                </div>
            </div>
            <button class="form_button" type="submit" name="login" value="LOGIN">Log in</button>
            <a href="register.php" class="link"> You don't have an account? Sign up here</a>
        </div>  
        </form>
</div>
</body>
</html>