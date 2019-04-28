<?php
include "conn.php";


if (isset($_POST)) {
  
    $std_name=$_POST['name'];
    $std_phone=$_POST['phone'];
    $std_mail=$_POST['email'];
    $std_course=$_POST['course_id'];
    
    
    $target_dir = "std_pic/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    $add="INSERT INTO students (name,phone,mail,image) VALUES ('$std_name','$std_phone','$std_mail','$target_file')";
    $result=mysqli_query($conn,$add) or die (mysqli_error($conn));
    
    $std="SELECT id FROM students WHERE mail='$std_mail'";
    $std_res=mysqli_query($conn,$std) or die (mysqli_error($conn));
    $row=mysqli_fetch_assoc($std_res);
    $std_id=$row['id'];
   
    
    for($i=0;$i<count($std_course);$i++) {
    
        $sql="INSERT INTO courses_students (course_id,student_id) VALUES ('$std_course[$i]','$std_id')";
        $res=mysqli_query($conn,$sql) or die (mysqli_error($conn));
    }
            
    header("Location:school.php");
        
    }

?>

