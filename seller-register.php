<?php 
    session_start();

    @require "database.php";
?>

<?php

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Check email validation
    $count_of_email_query = "select count(email) as count_of_email from seller where email = '$email'";
    $result = mysqli_query($con,$count_of_email_query);
    $row = $result->fetch_object();

    if($row->count_of_email!="0"){
        $cookie_name = "error_msg";
        $cookie_value = "This email address is already in use";
        setcookie($cookie_name,$cookie_value,time()+60);
        mysqli_close($con);
        header('Location:error.php');
    }else{

        // Creating Propic Directory
        if(!file_exists("resources/uploads/propics/sellers/")){
            mkdir("resources/uploads/propics/sellers/",0777,true);
            exec("sudo chmod -R 777 resources/uploads/propics/sellers/");
        }else{
            exec("sudo chmod -R 777 resources/uploads/propics/sellers/");
        }

        $target_dir = "resources/uploads/propics/sellers/";
        $file = $_FILES['propic'];
        $file_name = rand(1,100000000000).$file['name'];
        $target_file = $target_dir.basename($file_name);

        if(!file_exists($target_file)){
            move_uploaded_file($file['tmp_name'],$target_file);
        }

        // Encrypting the password
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

        // Inserting to the database
        $query = "insert into seller (fname,lname,email,password,mobile,propic) values ('$fname','$lname','$email','$encrypted_password','$mobile','$file_name')";
        mysqli_query($con,$query);
        
        // Set seller id as session
        $result = mysqli_query($con,"select seller_id from seller where email = '$email'");
        $row = $result->fetch_object();
        $_SESSION["seller-logged"]=$row->seller_id;
        
        // Create Other Essential Directories
        if(!file_exists("resources/uploads/sellers")){
            mkdir("resources/uploads/sellers",0777,true);
            mkdir("resources/uploads/sellers/ebooks/coverpic",0777,true);
            mkdir("resources/uploads/sellers/ebooks/pdf",0777,true);
            exec("sudo chmod -R 777 resources/uploads/sellers");
            exec("sudo chmod -R 777 resources/uploads/sellers/ebooks/coverpic");
            exec("sudo chmod -R 777 resources/uploads/sellers/ebooks/pdf");
        }else{
            exec("sudo chmod -R 777 resources/uploads/sellers");
            exec("sudo chmod -R 777 resources/uploads/sellers/ebooks/coverpic");
            exec("sudo chmod -R 777 resources/uploads/sellers/ebooks/pdf");
        }

        header('Location:dashboard.php');
    }   
?>