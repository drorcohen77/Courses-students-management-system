<?php
session_start();

if(isset($_SESSION['id'])) {

    include "conn.php";
    include "students_courses_list.php";
    include "navbar_data.php";
    include "students_list.php";


    $courses_list="";
    $std_list="";

}else{
    session_destroy();
    header("Location:login_page.php");
}
   
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Patua+One|Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="school.css">
    <link rel="stylesheet" href="navbar_data.css">
    <title>main_page</title>

    <style>


    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header nav_logo">
                <span class="navbar-brand logo1">CODING</span> <span class="navbar-brand logo2">.Collage</span>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <a href="school.php">School</a>
                </li>
                <?php if ($role!=2) echo 
                    "<li>
                        <a href='administration.php'>Administration</a>
                    </li>";
                    ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav_img">
                    <img src="<?php echo $image ?>" style='width: 45px; height: 45px;'>
                    <?php ?>
                </li>
                <li class="nav_name"><a><span class="name">
                            <?php echo $name.', '.$user ?></span></a>
                </li>
                <li>
                    <a href="login_page.php?logout=0">
                        <span class="glyphicon glyphicon-log-out icon"></span>
                        <span class="logout">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row main_p">
        <div class="col-lg-3 courses">
            <div class="well well-sm header">
                <div class="title">Courses</div>
                <div type="button" class="glyphicon glyphicon-plus-sign" <?php if ($role!=0) echo "style='visibility: hidden;'" ; ?> onclick="add_course()"></div>
            </div>
            <div id="courses_list_div" class="scroll">


            </div>

        </div>

        <div class="col-lg-3 students">
            <div class="well well-sm header">
                <div class="title">Students</div>
                <div type="button" class="glyphicon glyphicon-plus-sign" onclick="add_student()"></div>
            </div>
            <div id="students_list_div" class="scroll">


            </div>


        </div>

        <div class="col-lg-6" id="main" class="scroll">

        </div>


    </div>

    <!--DELETE_course/student Modal -->
    <div class="modal fade" id="Modal-delete" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">You Are About To Delete One Record !</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="del_course"></strong></p>
                </div>
                <div class="modal-footer">
                    <a id="c_id" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        var course_arr = '<?php echo $list; ?>';
        var courses = JSON.parse(course_arr);
        var role_admin = '<?php echo $role; ?>';
        
        var students_arr = '<?php echo $students_list; ?>';
        var students = JSON.parse(students_arr);

        console.log(role_admin);
        console.log(courses);

        var new_course = "";
        var course_list = "";

        crs_list();
        num_crs_std();

        function crs_list() {

            for (i = 0; i < courses.length; i++) {

                course_list += "<div class='row  item'>";
                course_list += "<div type='button' class='col-lg-12 btn btn-link' onclick='students_list(" + i + ")'>";
                course_list += "<div class='col-lg-4'><img src='" + courses[i].image + "' style='width: 50px; height: 50px;'></div>";
                course_list += "<div class='col-lg-8 course_info'>Name: " + courses[i].name + "</div>";

                course_list += "</div>";
                course_list += "</div><br>";
            }
            courses_list_div.innerHTML = course_list;

            students_list(0);
        }

        function students_list(std) {

            var std_list = "";

            for (i = 0; i < courses[std].students.length; i++) {

                std_list += "<div class='row item'>";
                std_list += "<div type='button' class='col-lg-12 btn btn-link' onclick='student_details(" + i + "," + std + ")'>";
                std_list += "<div class='col-lg-4'><img src='" + courses[std].students[i].image + "' style='width: 50px; height: 50px;'></div>";
                std_list += "<div class='col-lg-8 student_info'>";
                std_list += "<span>Name: " + courses[std].students[i].name + "</span><br>";
                std_list += "<span>Phone: " + courses[std].students[i].phone + "</span><br>";
                std_list += "<span>Email: " + courses[std].students[i].mail + "</span>";
                std_list += "</div>";
                std_list += "</div>";
                std_list += "</div><br>";
            }

            document.getElementById('students_list_div').innerHTML = std_list;

            course_details(std, std_list, courses[std].students.length)
        }

        function course_details(crs, std_list, num_std) {

            var course_prv = "";

            course_prv += "<div class='well well-sm header'>";
            course_prv += "<span class='title'>" + courses[crs].name + "</span>";

            if (role_admin != 2)
                course_prv += "<button type='button' class='btn btn-primary edit' onclick='edit_course(" + crs + ")'>Edit</button>";
            course_prv += "</div>";

            course_prv += "<div class='col-lg-12 course_preview'>";

            course_prv += "<div class='col-lg-3 course_image'>";
            course_prv += "<img src=" + courses[crs].image + " style='width: 150px; height:150px;' />";
            course_prv += "</div>";

            course_prv += "<div class='col-lg-9 course_desc'>";
            course_prv += "<h3>" + courses[crs].name + ", " + num_std + " Students</h3>";
            course_prv += "<p class='p_desc scroll'>" + courses[crs].description + "</p>";
            course_prv += "</div>";

            course_prv += "</div>";
            course_prv += "<div class='col-lg-12 list'>Students Listed To This Course:</div>";
            //            course_prv += "<div class='col-lg-12'>";
            course_prv += "<div class='col-lg-6 lower_div scroll'>" + std_list + "</div>";
            course_prv += "</div>";

            course_prv += "</div>";

            main.innerHTML = course_prv;
        }

        function add_course() {

            var add_crs = "";

            add_crs += "<div class='well well-sm header'>";
            add_crs += "<div class='title'>Add Course</div>";
            add_crs += "</div>";
            add_crs += "<div class='col-lg-12 form scroll'>";
            add_crs += "<form method='post' action='add_course.php' id='submit_form' enctype='multipart/form-data' onsubmit='add_crs_validation(event)'>";
            add_crs += "<div class='form-group'>";
            add_crs += "<label for='name'>Name:</label>";
            add_crs += "<input type='text' name='name' class='form-control' id='name' placeholder='Enter Course name'>";
            add_crs += "<span class='massage' id='name_massage'></span>";
            add_crs += "</div>";
            add_crs += "<div class='form-group'>";
            add_crs += "<label for='description'>Course Description:</label>";
            add_crs += "<textarea class='form-control scroll' name='description' rows='5' id='description'></textarea>";
            add_crs += "</div>";
            add_crs += "<div class='form-group'>";
            add_crs += "<label for='course_id'>Course ID:</label>";
            add_crs += "<input type='text' name='course_id' class='form-control' id='courseid' placeholder='Enter Course ID'>";
            add_crs += "<span class='massage' id='id_massage'></span>";
            add_crs += "</div><br>";
            add_crs += "<div class='form-group'>";
            add_crs += "<div class='row'>";
            add_crs += "<div class='col-lg-6'>";
            add_crs += "<label for='image file'>Select image to upload:</label>";
            add_crs += "<input type='file' name='image' id='fupload'>";
            add_crs += "<span class='massage' id='fupload_massage'></span>";
            add_crs += "</div>";
            add_crs += "<div class='col-lg-6'>";
            add_crs += "<img id='profile_image' src='' style='max-width: 120px; height:auto;' />";
            add_crs += "</div>";
            add_crs += "</div>";
            add_crs += "</div><br>";
            add_crs += "<div class='buttons'>";
            add_crs += "<button type='submit' name='save' value='save' class='btn btn-success save'>Save</button>";
            add_crs += "</div><br><br>";
            add_crs += "</form>";
            add_crs += "</div>";

            main.innerHTML = add_crs;

            preview_image();
        }

        function edit_course(crs) {

            var del_crs = courses[crs].name + ' course';
            del_course.innerHTML = del_crs;

            var edit_crs = "";

            edit_crs += "<div class='well well-sm header'>";
            edit_crs += "<div class='title'>Edit Course - " + courses[crs].name + "</div>";
            edit_crs += "</div>";
            edit_crs += "<div class='col-lg-12 form scroll'>";
            if (courses[crs].students.length == 0) {
                edit_crs += "<div class='col-lg-12 buttons'>";
                edit_crs += "<button name='delete' class='btn btn-danger save' data-target='#Modal-delete' data-toggle='modal'>Delete</button>";
                edit_crs += "</div><br>";
            }
            edit_crs += "<h3>Total " + courses[crs].students.length + " students taking this course</h3><br>";

            edit_crs += "<form method='post' action='edit_course.php' id='submit_form' enctype='multipart/form-data' onsubmit='edit_crs_validation(event);'>";

            edit_crs += "<div class='form-group'>";
            edit_crs += "<label for='name'>Name:</label>";
            edit_crs += "<input type='text' name='name' class='form-control' id='name' value='" + courses[crs].name + "'>";
            edit_crs += "<span class='massage' id='name_massage'></span>";
            edit_crs += "</div>";
            edit_crs += "<div class='form-group'>";
            edit_crs += "<label for='description'>Course Description:</label>";
            edit_crs += "<textarea class='form-control scroll' name='description' id='description' rows='5'>" + courses[crs].description + "</textarea>";
            edit_crs += "</div>";
            //            edit_crs += "<div class='form-group'>";
            //            edit_crs += "<label for='course_id'>Course ID:</label>";
            edit_crs += "<input type='text' name='course_id' class='form-control' id='course_id' value='" + courses[crs].course_id + "' style='visibility: hidden;'>";
            //            edit_crs += "<input type='text' name='id' class='form-control' id='id' style='visibility: visible;' value='" + courses[crs].id + "'>";
            //            edit_crs += "</div><br>";

            edit_crs += "<div class='form-group'>";
            edit_crs += "<div class='row'>";
            edit_crs += "<div class='col-lg-6'>";
            edit_crs += "<label for='image file'>Select image to upload:</label>";
            edit_crs += "<input type='file' name='image' id='fupload' >" + courses[crs].image;
            edit_crs += "<span class='massage' id='fupload_massage'></span>";
            edit_crs += "</div>";
            edit_crs += "<div class='col-lg-6'>";
            edit_crs += "<img id='profile_image' src='" + courses[crs].image + "' style='max-width: 120px; height:auto;' />";
            edit_crs += "</div>";

            edit_crs += "<input type='text' name='img_source' value='" + courses[crs].image + "' style='visibility: hidden;'>";

            edit_crs += "</div>";
            edit_crs += "</div><br>";
            edit_crs += "<div class='col-lg-12 buttons'>";
            edit_crs += "<button type='submit' name='save' class='btn btn-success save'>Save</button>";

            edit_crs += "</div><br>";

            edit_crs += "</form>";

            edit_crs += "</div>";

            main.innerHTML = edit_crs;
            document.getElementById("c_id").setAttribute("href", "delete_course.php?id=" + courses[crs].course_id);

            preview_image();
        }

        function student_details(j, course) {

            var std_details = "";

            std_details += "<div class='well well-sm header'>";
            std_details += "<span class='title'>" + courses[course].students[j].name + "</span>";
            std_details += "<button type='button' class='btn btn-primary edit' onclick='edit_student(" + j + "," + course + ")'>Edit</button>";
            std_details += "</div>";

            std_details += "<div class='col-lg-12 student_preview'>";
            std_details += "<div class='col-lg-3 student_image'>";
            std_details += "<img src=" + courses[course].students[j].image + " style='width: 150px; height:150px;' />";
            std_details += "</div>";
            std_details += "<div class='col-lg-9 student_details'>";
            std_details += "<span>Name:</span><span class='T'>  " + courses[course].students[j].name + "</span><br><br>";
            std_details += "<span>Phone:</span><span class='T'>  " + courses[course].students[j].phone + "</span><br><br>";
            std_details += "<span>Email:</span><span class='T'>  " + courses[course].students[j].mail + "</span><br><br>";
            std_details += "</div>";
            std_details += "</div><br><br>";
            std_details += "<div class='col-lg-12 list'>Course Takened:</div>";

            std_details += "<div class='col-lg-8 lower_div_std scroll'>";
            //            std_details += "<div class='col-lg-2 crs_image'>";
            //            std_details += "<img src=" + courses[course].image + " style='width: 50px; height:50px;' />";
            //            std_details += "</div>";
            //            std_details += "<div class='col-lg-10 crs_details'>";
            //            std_details += "<span>" + courses[course].name + "</span><br>";
            //            std_details += "</div>";

            for (i = 0; i < courses[course].students[j].courses_arr.length; i++) {

                std_details += "<div class='col-lg-12  item_list'>";
                std_details += "<div class='col-lg-2 crs_image'><img src='" + courses[course].students[j].courses_arr[i].image + "' style='width: 50px; height: 50px;'></div>";
                std_details += "<div class='col-lg-10 course_detail'>" + courses[course].students[j].courses_arr[i].name + "</div>";
                std_details += "</div>";
            }

            std_details += "</div>";
            //            std_details += "</div>";

            main.innerHTML = std_details;
        }

        function add_student() {

            var add_std = "";

            add_std += "<div class='well well-sm header'>";
            add_std += "<div class='title'>Add Student</div>";
            add_std += "</div>";
            add_std += "<div class='col-lg-12 form scroll'>";
            add_std += "<form method='post' action='add_students.php' id='submit_form' enctype='multipart/form-data' onsubmit='add_std_validation(event);'>";
            add_std += "<div class='form-group'>";
            add_std += "<label for='name'>Name:</label>";
            add_std += "<input type='text' name='name' class='form-control' id='name' placeholder='Enter Student Name '>";
            add_std += "<span class='massage' id='name_massage'></span>";
            add_std += "</div>";
            add_std += "<div class='form-group'>";
            add_std += "<label for='phone'>Phone:</label>";
            add_std += "<input type='text' name='phone' class='form-control' id='phone' placeholder='Enter Student Phone '>";
            add_std += "<span class='massage' id='phone_massage'></span>";
            add_std += "</div>";
            add_std += "<div class='form-group'>";
            add_std += "<label for='email'>Email:</label>";
            add_std += "<input type='text' name='email' class='form-control' id='email' placeholder='Enter Student Email'>";
            add_std += "<span class='massage' id='email_massage'></span>";
            add_std += "</div><br>";
            add_std += "<div class='form-group'>";
            add_std += "<label for='courses'>Courses: </label>";

            //            for (i = 0; i < courses.length; i++) {
            //
            //                add_std += "<label class='radio-inline'><input type='radio' name='course_id' value='" + courses[i].course_id + "'>" + courses[i].name + "</label>";
            //            }

            for (i = 0; i < courses.length; i++) {

                add_std += "<label class='checkbox-inline'><input type='checkbox' name='course_id[]' id='" + i + "' value='" + courses[i].course_id + "'>" + courses[i].name + "</label>";
            }
            add_std += "<span class='massage' id='crs_massage'></span>";
            add_std += "</div><br>";
            add_std += "<div class='form-group'>";
            add_std += "<div class='row'>";
            add_std += "<div class='col-lg-6'>";
            add_std += "<label for='image file'>Select image to upload:</label>";
            add_std += "<input type='file' name='image' id='fupload'>";
            add_std += "<span class='massage' id='fupload_massage'></span>";
            add_std += "</div>";
            add_std += "<div class='col-lg-6'></div>";
            add_std += "<img id='profile_image' src='' style='max-width: 120px; height:auto;' />";
            add_std += "</div>";
            add_std += "</div><br>";
            add_std += "<div class='buttons'>";
            add_std += "<button type='submit' name='save' class='btn btn-success save'>Save</button>";
            add_std += "</div><br><br>";
            add_std += "</form>";

            add_std += "</div>";

            main.innerHTML = add_std;

            preview_image();
        }

        function edit_student(s, crs_id) {

            var del_std = 'student named ' + courses[crs_id].students[s].name;
            del_course.innerHTML = del_std + '?';

            var edit_std = "";

            edit_std += "<div class='well well-sm header'>";
            edit_std += "<div class='title'>Edit Student - " + courses[crs_id].students[s].name + "</div>";
            edit_std += "</div>";
            edit_std += "<div class='col-lg-12 form scroll'>";

            edit_std += "<div class='col-lg-12 buttons'>";
            edit_std += "<button name='delete' class='btn btn-danger save' data-target='#Modal-delete' data-toggle='modal'>Delete</button>";
            edit_std += "</div><br><br>";

            edit_std += "<form method='post' action='edit_student.php' id='submit_form' enctype='multipart/form-data' onsubmit='edit_std_validation(event);'>";
            edit_std += "<div class='form-group'>";
            edit_std += "<label for='name'>Name:</label>";
            edit_std += "<input type='text' name='name' class='form-control' id='name' placeholder='Enter Student Name' value='" + courses[crs_id].students[s].name + "'>";
            edit_std += "<span class='massage' id='name_massage'></span>";
            edit_std += "</div>";
            edit_std += "<div class='form-group'>";
            edit_std += "<label for='phone'>Phone:</label>";
            edit_std += "<input type='text' name='phone' class='form-control' id='phone' placeholder='Enter Student Phone ' value='" + courses[crs_id].students[s].phone + "'>";
            edit_std += "<span class='massage' id='phone_massage'></span>";
            edit_std += "</div>";
            edit_std += "<div class='form-group'>";
            edit_std += "<label for='email'>Email:</label>";
            edit_std += "<input type='text' name='email' class='form-control' id='email' placeholder='Enter Student Email' value='" + courses[crs_id].students[s].mail + "'>";
            edit_std += "<span class='massage' id='email_massage'></span>";
            edit_std += "</div><br>";
            edit_std += "<div class='form-group'>";
            edit_std += "<label for='courses'>Courses: </label>";

            //            for (i = 0; i < courses.length; i++) {
            //
            //                edit_std += "<label class='radio-inline'><input type='radio' name='course_id' value='" + courses[crs_id].students[s].course_id + "'>" + courses[i].name + "</label>";
            //            }

            for (i = 0; i < courses.length; i++) {

                edit_std += "<label class='checkbox-inline'><input type='checkbox' name='course_id[]' value='"+courses[i].course_id+"' id='" + i + "'>" + courses[i].name + "</label>";
            }

            edit_std += "</div><br>";

            edit_std += "<input type='text' name='id' class='form-control' id='id' value='" + courses[crs_id].students[s].id + "' style='visibility:hidden'>";

            edit_std += "<div class='form-group'>";
            edit_std += "<div class='row'>";
            edit_std += "<div class='col-lg-6'>";
            edit_std += "<label for='image file'>Select image to upload:</label>";
            edit_std += "<input type='file' name='image' id='fupload' value='" + courses[crs_id].students[s].image + "'>";
            edit_std += "<span class='massage' id='fupload_massage'></span>";
            edit_std += "</div>";
            edit_std += "<div class='col-lg-6'>";
            edit_std += "<img id='profile_image' src='" + courses[crs_id].students[s].image + "' style='max-width: 120px; height:auto;' />";
            edit_std += "</div>";

            edit_std += "<input type='text' name='img_source' value='" + courses[crs_id].students[s].image + "' style='visibility: hidden;'>";

            edit_std += "</div>";
            edit_std += "</div><br>";
            edit_std += "<div class='buttons'>";
            edit_std += "<button type='submit' name='save' class='btn btn-success save'>Save</button>";
            edit_std += "</div><br><br>";
            edit_std += "</form>";

            edit_std += "</div>";

            main.innerHTML = edit_std;
 
            
        for (a = 0; a < courses.length; a++) {

                for (r = 0; r < courses[crs_id].students[s].courses_arr.length; r++) {
                    if (courses[crs_id].students[s].courses_arr[r].course_id == courses[a].course_id) {
                        document.getElementById(a).checked = true;
                        break;
                    }
                }
        }

        document.getElementById("c_id").setAttribute("href", "delete_student.php?id=" + courses[crs_id].students[s].id);

        preview_image();
        }

        function num_crs_std() {
           
            var nusers = "";

            nusers += "<div class='well well-sm header'>";
            nusers += "<div class='title'>Course & Students</div>";
            nusers += "</div>";
            nusers += "<div class='col-lg-12 container'>";
            nusers += "<div class='courses_num'>";
            nusers += "<div class='well well-sm crs_num_title'><span class='_title'>Number of Current Courses:</span></div>";
            nusers += "<div class='crs_num'>" + courses.length + "</div>";
            nusers += "</div><br>";

            nusers += "<div class='students_num'>";
            nusers += "<div class='well well-sm std_num_title'><span class='_title'>Number of Current students:</span></div>";
            nusers += "<div class='std_num'>" + students.length + "</div>";
            nusers += "</div><br>";

            nusers += "</div>";
            nusers += "</div>";

            main.innerHTML = nusers;
        }

        function preview_image() {

            var fileInput = document.getElementById('fupload');
            fileInput.onchange = function(event) {
                var file = fileInput.files[0];
                var imageType = /image.*/;
                var profile_image = document.getElementById('profile_image');

                if (file.type.match(imageType)) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        profile_image.src = reader.result;
                    }

                    reader.readAsDataURL(file);
                }
            };
        }

    </script>

    <script type="text/javascript" src="courses_validation.js"></script>
    <script type="text/javascript" src="students_validation.js"></script>
</body>

</html>
