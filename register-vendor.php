<?php
 require "check-register-vendor.php";
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <title>Register</title>
</head>
<body>

<div class="form">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form_container">  
            <h1 class="form_title">Sign up</h1>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="user">Username:</label>
                </div>
                <div>
                    <input required type="text" name="user" class="form_input"><br>
                    <span class="message"><?php echo $error_message_finduser; ?></span><br>
                    <br>
                    <span class="message"><?php echo $message_check_username;?></span>
                </div>
            </div>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="pass">Password:</label>
                </div>
                <div>
                    <input required type="password" id="password" name="pass" class="form_input"><br>
                    <span class="message"><?php echo $message_check_password; ?></span><br>
                    <br>
                </div>
            </div>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="business_name">Business Name:</label>
                </div>
                <div>
                    <input required type="text" name="business_name" class="form_input"><br>
                    <span class="message"><?php echo $error_message_find_business_name; ?></span><br>
                    <br>
                    <span class="message"><?php echo $message_check_business_name?></span>
                </div>
            </div>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="business_address">Business Address:</label>
                </div>
                <div>
                    <input required type="text" name="business_address" class="form_input"><br>
                    <span class="message"><?php echo $error_message_find_business_address; ?></span><br>
                    <br>
                    <span class="message"><?php echo $message_check_business_address;?></span>
                </div>
            </div>
            <div class="form_input_group">
                <div class="form-label">
                    <label for="avatar">Profile image:</label>
                </div>
                <div>
                    <input required type="file" name="avatar" class="form__input">
                </div>
            </div>
            <button class="form_button" type="submit" name="reg" value="REG">Submit</button><br>
            <span class="message-success"><?php echo $success_message ?></span> <br>
            <br>
            <input type="hidden" name="vendor">
            <a href="login.php" class="link">Do you already have an account ? Login here</a>
        </div>  
        </form>
</div>
</body>
</html>