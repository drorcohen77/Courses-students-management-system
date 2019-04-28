<?php
session_start();

if(isset($_SESSION['id'])) {
    
    include "conn.php";
    include "navbar_data.php";
    include "admin_list.php";
    include "students_courses_list.php";
    include "students_list.php";

}else {
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
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="school.css">
    <link rel="stylesheet" href="navbar_data.css">
    <link rel="stylesheet" href="main.css">
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
                <li class="nav_logout">
                    <a href="login_page.php?logout=0">
                        <span class="glyphicon glyphicon-log-out icon"></span>
                        <span class="logout">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 main">
                <h1> Welcome
                    <span class="role_name">
                        <?php echo $name ?>,</span>
                </h1>
                <h1>To The Coding Collage Administration System</h1>
            </div>
            <div class="col-lg-12 ">

                <div class="col-lg-4" id="admin">
                </div>
                <div class="col-lg-4" id="course">
                </div>
                <div class="col-lg-4" id="student">
                </div>
            </div>
        </div>
    </div>


    <script>
        var admin_arr = '<?php echo $admin_list; ?>';
        var admins = JSON.parse(admin_arr);

        var course_arr = '<?php echo $list; ?>';
        var courses = JSON.parse(course_arr);
        
        var students_arr = '<?php echo $students_list; ?>';
        var students = JSON.parse(students_arr);
        

        num_admins();
        num_courses();
        num_std();


        function num_admins() {

            var nadmins = "";

            nadmins += "<div class='well well-sm admin_num_title'><span class='_title'>Administrators</span></div>";
            nadmins += "<div class='admin_num'>" + admins.length + "</div>";

            admin.innerHTML = nadmins;
        }


        function num_courses() {

            var num_courses = "";

            num_courses += "<div class='well well-sm crs_num_title'><span class='_title1'>Courses</span></div>";
            num_courses += "<div class='crs_num'>" + courses.length + "</div>";
            
            course.innerHTML = num_courses;
        }
        
        
        function num_std() {
        
            var num_students = "";
            
            num_students += "<div class='well well-sm std_num_title'><span class='_title2'>students</span></div>";
            num_students += "<div class='std_num'>" + students.length + "</div>";
console.log(num_students);
            student.innerHTML = num_students;
            
        }
        
    </script>


</body>

</html>
