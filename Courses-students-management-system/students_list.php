<?php
include "conn.php";

                                                       
$students="SELECT * FROM students";
$res_students=mysqli_query($conn,$students) or die (mysqli_error($conn));
    
while($row = mysqli_fetch_assoc($res_students)) {
    
    $students_Arr[]=$row;
}
    
$students_list=json_encode($students_Arr);
    
?>