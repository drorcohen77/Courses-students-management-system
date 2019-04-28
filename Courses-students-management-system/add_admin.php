<?php
include "conn.php";


if (isset($_POST)) {
  
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $pass=$_POST['password'];
    
    $password=crypt($pass, '$2y$10$fdsfdsfsdgdfhtreyrtyfghgfhdhfdgh$');
    
    $target_dir = "pictures/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    $sql="SELECT * FROM user";
    $res=mysqli_query($conn,$sql) or die (mysqli_error($conn));
    while($row=mysqli_fetch_assoc($res)) {
        if ($phone==$row['phone'])
            $message="phone";
        if ($email==$row['mail'])
            $message="email";
        if ($password==$row['password'])
            $message="password";
    }
    
    if (!$message) {

        $add="INSERT INTO user (name,mail,phone,role,password,image) VALUES ('$name','$email','$phone','$role','$password','$target_file')";
        $result=mysqli_query($conn,$add) or die (mysqli_error($conn));
        
//        header("Location:administration.php");
    }else
        setcookie('data',$name.",".$phone.",".$email.",".$role.",".$pass.",".$target_file.",".$message, time()+3600);

    
    header("Location:administration.php");
        
}

?>