<?php 


include "conn.php";

    $sql_course_list="SELECT * FROM courses";
    $result_list = mysqli_query($conn,$sql_course_list) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result_list)) {

        $sql_st_ad_list = " SELECT students.id,students.name,students.mail,students.phone,students.image 
                            FROM students JOIN courses_students 
                            ON students.id=courses_students.student_id
                            WHERE courses_students.course_id='$row[course_id]'";
        $result_list1 = mysqli_query($conn,$sql_st_ad_list) or die(mysqli_error($conn));
        $students=[];
        
        while($row2 = mysqli_fetch_assoc($result_list1)) {
//                $students[]=$row2;
            $courses=" SELECT courses.id,courses.name,courses.course_id,courses.image,courses_students.student_id
                        FROM courses JOIN courses_students 
                        ON courses.course_id=courses_students.course_id
                        WHERE courses_students.student_id='$row2[id]'";
            $result_list2 = mysqli_query($conn,$courses) or die("Unable to Connect, sorry :D");
            $courses_arr=[];

            while($row3 = mysqli_fetch_assoc($result_list2)) {
                $courses_arr[]=$row3;
            }
//            print_r($courses_arr) ;
            $row2['courses_arr'] = $courses_arr;
            $students[]=$row2;
        }
        
        $row['students'] = $students;
    
        $courses_Arr[]= $row;
//        print_r($courses_Arr) ;
    }
    
    $list=json_encode($courses_Arr);

//    echo $list;
    
?>





        
    


