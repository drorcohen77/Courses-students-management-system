<?php
include "conn.php";


if (isset($_POST)) {
    
    $std_id=$_POST['id'];
    $std_name=$_POST['name'];
    $std_phone=$_POST['phone'];
    $std_email=$_POST['email'];
    $std_course=$_POST['course_id'];
    $std_image=$_POST['img_source'];
    $target_file = basename($_FILES["image"]["name"]);
//    print_r ($std_course);
    if($target_file) {
        
        $target_dir = "std_pic/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }else {
        $target_file = $std_image;
    } 

    
    $del="DELETE FROM courses_students WHERE student_id='$std_id'";
    $del_res=mysqli_query($conn,$del) or die (mysqli_error($conn));
    
    for($i=0;$i<count($std_course);$i++) {
    
        $update="INSERT INTO courses_students (course_id,student_id) VALUES ('$std_course[$i]','$std_id')";
        $res_update=mysqli_query($conn,$update) or die (mysqli_error($conn));
    }
    


    $edit="UPDATE students SET name='$std_name',mail='$std_email',phone='$std_phone',image='$target_file' WHERE id='$std_id'";
    $result_update=mysqli_query($conn,$edit) or die (mysqli_error($conn));
    

    header("Location:school.php");
    
    
    //    $std="SELECT * FROM courses_students WHERE student_id='$std_id'";
//    $std_res=mysqli_query($conn,$std) or die (mysqli_error($conn));
//
//    
//    for($i=0;$i<count($std_course);$i++) {
//        while($row=mysqli_fetch_assoc($std_res)) {
//            if($std_course[$i]==$row[course_id])
//                $confirm=1;
//        }
//        $sql="UPDATE courses_students SET course_id='$std_course[$i],student_id='$std_id' ";
//        $res=mysqli_query($conn,$sql) or die (mysqli_error($conn));
//    }   
    
//    for($i=0;$i<count($std_course);$i++) {
//    
//        $sql="UPDATE courses_students SET course_id='$std_course[$i],student_id='$std_id' ";
//        $res=mysqli_query($conn,$sql) or die (mysqli_error($conn));
//    }

}


?>
