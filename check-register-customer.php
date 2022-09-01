<?php

global $error_message_finduser;
global $message_check_username;
global $message_check_password;
global $message_customer_name;
global $message_customer_address;
global $success_message;

if(isset($_POST["user"]) && isset($_POST["pass"])&& isset($_POST["customer_name"])&& isset($_POST["customer_address"]))
{
    // check if user exist.
    $file=fopen("datanew.txt","r");
    $finduser = false;
    while(!feof($file))
    {
        $line = fgets($file);
        $array = explode(";",$line);
        if(trim($array[0]) == $_POST['user'])
        {
            $finduser=true;
        }
    }
    fclose($file);

// Check input
    $username = $_POST["user"];
    $check_username = false;
    $specialChars_username = preg_match('@[^\w]@', $username);
    if(strlen($username)<8 || strlen($username)>15 || $specialChars_username  ){
        $check_username = true;
        $message_check_username ='Contains only letters and digits, has a length from 8 to 15 characters';
    }
    
    $password = $_POST["pass"];
    $check_password = false;
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars_password = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars_password || strlen($password) < 8) {
      
        $check_password = true;
        $message_check_password = 'Contains at least one upper case letter, at least one lower case letter, at least one digit, at least one special letter in the set !@#$%^&*, has a length from 8 to 20 characters';
    }else{
        $check_password = false;
    }

    $check_customer_name = false;
    if(strlen($_POST["customer_name"])<5){
        $check_customer_name = true;
        $message_customer_name ='Must have at least 5 characters';
    }

    $check_customer_address = false;
    if(strlen($_POST["customer_address"])<5){
        $check_customer_address = true;
        $message_customer_address ='Must have at least 5 characters';
    }

    $eror = false;
    if( $finduser )
    {   
        $eror = true;
        $error_message_finduser='username existed!';
    }

    // register user 
    
    if( !$eror && !$check_password && !$check_username && !$check_customer_name && !$check_customer_address)
        {       
            $password = $_POST["pass"];
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $avatar = $_FILES["avatar"]["name"];
            $tmp_img_name=$_FILES['avatar']['tmp_name'];
            $folder='D:\CODING\LOGIN\img\ ';
            move_uploaded_file($tmp_img_name,$folder.$avatar);
            $file = fopen("datanew.txt", "a+");
            fputs($file,($_POST["user"].";".$encrypted_password.";".$avatar.";"."no".";"."no".";".$_POST["customer_name"].";".$_POST["customer_address"].";"."customer"."\r\n"));
            fclose($file);
            $file2 = fopen("datanew_customer_name.txt", "a+");
            fputs($file2,($_POST["customer_name"]."\r\n"));
            fclose($file2);
            $file3 = fopen("datanew_customer_address.txt", "a+");
            fputs($file3,($_POST["customer_address"]."\r\n"));
            fclose($file3);
            $success_message ='Registered successfully!';
        }
}
?>