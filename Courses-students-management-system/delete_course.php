<?php
include "conn.php";

if (isset($_GET['id'])) {
        $id=$_GET['id'];
   
        $delete="DELETE FROM courses WHERE course_id='$id'";
        $result_delete=mysqli_query($conn,$delete) or die (mysqli_error($conn));

        header("Location:school.php");
    }

?>