<?php

global $error_message_finduser;
global $error_message_find_business_name;
global $error_message_find_business_address;
global $message_check_username;
global $message_check_password;
global $message_check_business_name;
global $message_check_business_address;
global $success_message;

if(isset($_POST["user"]) && isset($_POST["pass"])&& isset($_POST["business_name"])&& isset($_POST["business_address"]))
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

    $file2=fopen("datanew_business_name.txt","r");
    $find_business_name=false;
    while(!feof($file2))
    {
        $line2 = fgets($file2);
        $array2 = explode(";",$line2);
        if(trim($array2[0]) == $_POST["business_name"])
        {
            $find_business_name=true;
        }
    }
    fclose($file2);

    $file3=fopen("datanew_business_address.txt","r");
    $find_business_address=false;
    while(!feof($file3))
    {
        $line3 = fgets($file3);
        $array3 = explode(";",$line3);
        if(trim($array3[0]) == $_POST["business_address"])
        {
            $find_business_address=true;
        }
    }
    fclose($file3);

    $eror = false;
    if( $finduser )
    {   
        $eror = true;
        $error_message_finduser='username existed!';
    }

    if( $find_business_name )
    {   
        $eror = true;
        $error_message_find_business_name='Business name existed!';
    }
    if(  $find_business_address )
    {   
        $eror = true;
        $error_message_find_business_address='Business address existed!';
    }

    //Check input
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

    $check_business_name = false;
    if(strlen($_POST["business_name"])<5){
        $check_business_name = true;
        $message_check_business_name ='Must have at least 5 characters';
    }

    $check_business_address = false;
    if(strlen($_POST["business_address"])<5){
        $check_business_address = true;
        $message_check_business_address ='Must have at least 5 characters';
    }



    
    if( !$eror && !$check_password && !$check_username && !$check_business_name  && !$check_business_address)
        {       
            $password = $_POST["pass"];
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $avatar = $_FILES["avatar"]["name"];
            $tmp_img_name=$_FILES['avatar']['tmp_name'];
            $folder='D:\CODING\LOGIN\img\ ';
            move_uploaded_file($tmp_img_name,$folder.$avatar);
            $file = fopen("datanew.txt", "a+");
            fputs($file,($_POST["user"].";".$encrypted_password.";".$avatar.";".$_POST["business_name"].";".$_POST["business_address"].";"."no".";"."no".";"."vendor"."\r\n"));
            fclose($file);
            $file2 = fopen("datanew_business_name.txt", "a+");
            fputs($file2,($_POST["business_name"]."\r\n"));
            fclose($file2);
            $file3 = fopen("datanew_business_address.txt", "a+");
            fputs($file3,($_POST["business_address"]."\r\n"));
            fclose($file3);
            $success_message ='Registered successfully!';
        }
}
?>