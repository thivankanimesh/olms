<?php 
    session_start();

    @require "database.php";
?>

<?php

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['ugender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Check email validation
    $count_of_email_query = "select count(email) as count_of_email from user where email = '$email'";
    $result = mysqli_query($con,$count_of_email_query);
    $row = $result->fetch_object();

    if($row->count_of_email!="0"){
        $cookie_name = "error_msg";
        $cookie_value = "This email address is already in use";
        setcookie($cookie_name,$cookie_value,time()+60);
        mysqli_close($con);
        header('Location:error.php');
    }else{

        // Creating directories
        if(!file_exists("resources/uploads/propics/users/")){
            mkdir("resources/uploads/propics/users/",0777,true);
            exec("sudo chmod -R 777 resources/uploads/propics/users/");
        }else{
            exec("sudo chmod -R 777 resources/uploads/propics/users/");
        }

        $target_dir = "resources/uploads/propics/users/";
        $file = $_FILES['propic'];
        $file_name = rand(1,100000000000).$file['name'];
        $target_file = $target_dir.basename($file_name);

        if(!file_exists($target_file)){
            move_uploaded_file($file['tmp_name'],$target_file);
        }

        // Encrypting the password
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

        // Inserting to the database
        $query = "insert into user (fname,lname,birthday,gender,email,password,mobile,propic) values ('$fname','$lname','$birthday','$gender','$email','$encrypted_password','$mobile','$file_name')";
        mysqli_query($con,$query);
        
        // Set user id as session
        $result = mysqli_query($con,"select user_id from user where email = '$email'");
        $row = $result->fetch_object();
        $_SESSION["user-logged"]=$row->user_id;
        mysqli_close($con);

        header('Location:account.php');
    }   
?>