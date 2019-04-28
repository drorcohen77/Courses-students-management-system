<?php
include "conn.php";


if(isset($_POST)) {
    
    $course_name=$_POST['name'];
    $course_id=$_POST['course_id'];
    $course_desc=$_POST['description'];
    $course_image=$_POST['img_source'];
    $target_file=$_FILES["image"]["name"];
    
    if($target_file) {
    
        $target_dir = "courses_pic/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }else {
        $target_file = $course_image; 
    }
    
    $edit="UPDATE courses SET name='$course_name',description='$course_desc',image='$target_file' WHERE course_id='$course_id'";
    $result_update=mysqli_query($conn,$edit) or die (mysqli_error($conn));

    header("Location:school.php");
    
}

?>
