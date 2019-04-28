<?php
include "conn.php";


if (isset($_POST)) {
  
    $name=$_POST['name'];
    $description=$_POST['description'];
    $course_id=$_POST['course_id'];
    
    
    $target_dir = "courses_pic/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    $add="INSERT INTO courses (name,description,course_id,image) VALUES ('$name','$description','$course_id','$target_file')";
    $result=mysqli_query($conn,$add) or die (mysqli_error($conn));
            
    header("Location:school.php");
        
    }

?>

