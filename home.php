<?php 

    session_start();
    if(!isset($_SESSION['user'])){
		header("location: login.php");	exit();
	}
/*if(isset($_POST['img_submit'])){
    $img_name=$_FILES['img_upload']['name'];
    $tmp_img_name=$_FILES['img_upload']['tmp_name'];
    $folder='D:\CODING\logintext\img\ ';
    move_uploaded_file($tmp_img_name,$folder.$img_name);
}*/
    global $avatar;
    global $role;
    global $business_name;
    global $business_address;
    $user = $_SESSION['user'];
    $file = fopen('datanew.txt', 'r');
    while(!feof($file)){
        $line = fgets($file);
        $array = explode(";",$line);
    if(trim($array[0]) == $user){
            $role = trim($array[7]);
            $avatar = trim($array[2]);
            $business_name = trim($array[3]);
            $business_address = trim($array[4]);
            $customer_name = trim($array[5]);
            $customer_address = trim($array[6]);
            break;
        }}
    
    if(isset($_POST['change_avatar'])){
        $new_avatar = $_FILES["new_avatar"]["name"];
        $tmp_img_name=$_FILES['new_avatar']['tmp_name'];
        $folder='D:\CODING\logintext\new_img\ ';
        move_uploaded_file($tmp_img_name,$folder.$new_avatar);
        /*$files = "data.txt"; 
        $file = fopen('data.txt', 'a+');
        $lines = file($files);
        while(!feof($file)){
            $line = fgets($file);
            $array = explode(";",$line);
            $count += 1;
        if(trim($array[0]) == $user){
            $new ="$array[0];$array[1];$new_avatar";
            $lines[$count] = $new;
            file_put_contents($files, implode("\n", $lines));
            break;
            }}*/
    }


	if(isset($_POST['logout'])){
		unset($_SESSION['user']);
		header("location: login.php");	exit();
	}
	/*global $email;
    $json_data = file_get_contents("data.json");
    $data = json_decode($json_data,true);

    foreach($data as $user){
       if($user['username']==$_SESSION['user']){
        $email = $user['email'];exit();
       }
    }

	echo $_SESSION['email'];
	echo $_SESSION['user'];
	
  echo $role;
  echo $avatar;
  echo $_SESSION['role'];*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <title>Document</title>
</head>

<body>
    <div class="myaccount">
    <div class="myaccount_container">
        <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
             <div class="profile-image">
                <?php echo '<img src="img/ '.$avatar.'" alt="logo">'; ?>
            </div>
            <div class="info">
                <p>Username:   <?php echo $user?> </p>
            </div>
            <?php
                if($role == 'vendor'){echo'
                    <div class="info">
                        <p>Business name: '.$business_name.'</p>
                    </div>
                    <div class="info">
                        <p>Business address: '.$business_address.'</p>
                    </div>
                    ';
                }
            ?>
            <?php
             if($role == 'customer'){echo'
                    <div class="info">
                        <p>Name: '.$customer_name.'</p>
                    </div>
                    <div class="info">
                        <p>Address: '.$customer_address.'</p>
                    </div>
                    ';
                }
            ?>
            <div>
                <div class="form-label">
                    <label for="new_avatar">Change profile image:</label>
                </div>
                <div class="form-field">
                    <input required type="file" name="new_avatar" class="form__input">
                </div>
            </div>
            <button class="button" type="submit" name="change_avatar" value="REG">Submit</button>
        </form>
        <form action="" method="post">
             <button class="button_logout" type="submit" name="logout" >Log out</button>
        </form>
        </div>
    </div>
    </div>
</body>
</html>
