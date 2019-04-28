<?php
include "conn.php";

$message="";

if (isset($_POST)) {
    
    $user=$_POST['id'];
    $user_name=$_POST['name'];
    $user_phone=$_POST['phone'];
    $user_email=$_POST['email'];
    $pass=$_POST['password'];
    $user_role=$_POST['role'];
    $user_image=$_POST['img_source'];
    $target_file = $_FILES["image"]["name"];
    echo $user;
    $sql="SELECT password FROM user WHERE id='$user'";
    $result=mysqli_query($conn,$sql) or die (mysqli_error($conn));
    $row= mysqli_fetch_assoc($result);
    
    if($row['password']!=$pass){
        $user_pass=crypt($pass, '$2y$10$fdsfdsfsdgdfhtreyrtyfghgfhdhfdgh$');
    } else
        $user_pass=$pass;
    
    if($target_file) {
        
        $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }else {
        $target_file = $user_image;
    } 
    
    $sql1="SELECT * FROM user";
    $res=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
    while($row1=mysqli_fetch_assoc($res)) {
        if ($user_phone==$row1['phone'] && $user!=$row1['id'])
            $message="phone";
        if ($user_email==$row1['mail'] && $user!=$row1['id'])
            $message="email";
        if ($user_pass==$row1['password'] && $user!=$row1['id'])
            $message="password";
    }
    
    
    if (!$message) {

        $edit="UPDATE user SET name='$user_name',mail='$user_email',phone='$user_phone',password='$user_pass',role='$user_role',image='$target_file' WHERE id='$user'";
        $result_update=mysqli_query($conn,$edit) or die (mysqli_error($conn));

//        header("Location:administration.php");
    }else
//        header("Location:administration.php?con=".$message);
        setcookie('edit',$user_name.",".$user_phone.",".$user_email.",".$user_role.",".$user_pass.",".$target_file.",".$message, time()+3600);

    
    header("Location:administration.php?edit=true");

}


?>
