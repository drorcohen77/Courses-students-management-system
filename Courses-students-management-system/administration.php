<?php
session_start();

if(isset($_SESSION['id'])) {

    include "conn.php";
    include "admin_list.php";
    include "navbar_data.php";

    $data="";
    $data_con="";
    $edit="";

    if(isset($_GET['edit'])) {

        $edit=$_GET['edit'];
    }

    if(isset($_COOKIE['data'])) {
        $data= explode(",",$_COOKIE['data']);

        $data_con=json_encode($data);

        setcookie( 'data', '',time() -3600);
    }
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
    <title>administration</title>

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
                <li>
                    <a href="administration.php">Administration</a>
                </li>
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
                    <a href="login_page.php?logout=0"><span class="glyphicon glyphicon-log-out icon"></span><span class="logout">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row main_a">
        <div class="col-lg-4 admins">
            <div class="well well-sm header">
                <div class="title">Administrators</div>
                <div type="button" class="glyphicon glyphicon-plus-sign" onclick="add_administrator()"></div>
            </div>
            <div id="administrators_list_div" class="scroll">


            </div>
        </div>

        <div class="col-lg-8" id="main">

        </div>
    </div>

    <!--DELETE_ADMIN Modal -->
    <div class="modal fade" id="Modal-delete" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="del_course"></strong></p>
                </div>
                <div class="modal-footer">
                    <a id="del_admin" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <script>
        var admin_arr = '<?php echo $admin_list; ?>';
        var admins = JSON.parse(admin_arr);
        var role_admin = '<?php echo $role; ?>';
        var data_con = '<?php echo $data_con; ?>';
        var edit = '<?php echo $edit; ?>';
        if (data_con)
            var data = JSON.parse(data_con);

        console.log(edit);
        console.log(admins);

        var admin_list = "";
        var user_def = "";

        admins_list();
        num_admins();

        if (data) {
            add_administrator();
        }

        function admins_list() {

            for (i = 0; i < admins.length; i++) {

                switch (admins[i].role) {

                    case '0':
                        user_def = "Owner";
                        break;
                    case '1':
                        user_def = "Manager";
                        break;
                    case '2':
                        user_def = "Sales";
                        break;
                }

                if (role_admin == 0) {

                    admin_list += "<div class='row item'>";
                    admin_list += "<div type='button' class='col-lg-12 btn btn-link' onclick='edit_admin(" + i + ")'>";
                    admin_list += "<div class='col-lg-4'><img src='" + admins[i].image + "' style='width: 50px; height: 50px;'></div>";
                    admin_list += "<div class='col-lg-8 student_info'>";
                    admin_list += "<span>Name: " + admins[i].name + ", " + user_def + " </span><br>";
                    admin_list += "<span>Phone: " + admins[i].phone + "</span><br>";
                    admin_list += "<span>Email: " + admins[i].mail + "</span>";
                    admin_list += "</div>";
                    admin_list += "</div>";
                    admin_list += "</div><br>";

                } else {
                    if (admins[i].role != 0) {
                        admin_list += "<div class='row item'>";
                        admin_list += "<div type='button' class='col-lg-12 btn btn-link' onclick='edit_admin(" + i + ")'>";
                        admin_list += "<div class='col-lg-4'><img src='" + admins[i].image + "' style='width: 50px; height: 50px;'></div>";
                        admin_list += "<div class='col-lg-8 student_info'>";
                        admin_list += "<span>Name: " + admins[i].name + ", " + user_def + " </span><br>";
                        admin_list += "<span>Phone: " + admins[i].phone + "</span><br>";
                        admin_list += "<span>Email: " + admins[i].mail + "</span>";
                        admin_list += "</div>";
                        admin_list += "</div>";
                        admin_list += "</div><br>";
                    }
                }
            }

            administrators_list_div.innerHTML = admin_list;
        }

        function add_administrator() {

            var add_admin = "";

            add_admin += "<div class='well well-sm header' id='swap'>Add Administrator</div>";

            add_admin += "<div class='col-lg-12 form scroll'>";
            add_admin += "<form method='post' action='add_admin.php' id='submit_form' enctype='multipart/form-data' onsubmit='add_validation(event)'>";
            add_admin += "<div class='form-group'>";
            add_admin += "<label for='name'>Name:</label>";
            add_admin += "<input type='text' name='name' class='form-control' id='name' placeholder='Enter Admin Name '>";
            add_admin += "<span class='massage' id='name_massage'></span>";
            add_admin += "</div>";
            add_admin += "<div class='form-group'>";
            add_admin += "<label for='phone'>Phone:</label>";
            add_admin += "<input type='text' name='phone' class='form-control' id='phone' placeholder='Enter Admin Phone '>";
            add_admin += "<span class='massage' id='phone_massage'></span>";
            add_admin += "</div>";
            add_admin += "<div class='form-group'>";
            add_admin += "<label for='email'>Email:</label>";
            add_admin += "<input type='text' name='email' class='form-control' id='email' placeholder='Enter Admin Email'>";
            add_admin += "<span class='massage' id='email_massage'></span>";
            add_admin += "</div>";
            add_admin += "<div class='form-group'>";
            add_admin += "<label for='password'>Password:</label>";
            add_admin += "<input type='password' name='password' class='form-control' id='password' placeholder='Enter Admin Password'>";
            add_admin += "<span class='massage' id='password_massage'></span>";
            add_admin += "</div><br>";

            add_admin += "<div class='form-group'>";
            add_admin += "<label for='role'>Role: </label>";
            add_admin += "<label class='radio-inline' id='owner_lable'>";
            add_admin += "<input type='radio' name='role' id='owner' value='0' checked>Owner</label>";
            add_admin += "<label class='radio-inline'>";
            add_admin += "<input type='radio' name='role' id='manager' value='1'>Manager</label>";
            add_admin += "<label class='radio-inline'>";
            add_admin += "<input type='radio' name='role' id='sales' value='2'>Sales</label>";
            add_admin += "</div><br>";
            add_admin += "<span class='massage' id='role_massage'></span>";
            add_admin += "<div class='form-group'>";
            add_admin += "<div class='row'>";
            add_admin += "<div class='col-lg-6'>";
            add_admin += "<label for='image file'>Select image to upload:</label>";
            add_admin += "<input type='file' name='image' id='fupload'>";
            add_admin += "<span class='massage' id='fupload_massage'></span>";
            add_admin += "</div>";
            add_admin += "<div class='col-lg-6'>";
            add_admin += "<img id='user_profile_image'  style='max-width: 120px; height:auto;' />";
            add_admin += "</div>";
            add_admin += "</div>";
            add_admin += "</div><br>";
            add_admin += "<div class='buttons'>";
            add_admin += "<button type='submit' name='save' class='btn btn-success save'>Save</button>";
            add_admin += "</div><br><br>";
            add_admin += "</form>";

            add_admin += "</div>";

            main.innerHTML = add_admin;

            preview_image();

            for (rol = 0; rol < admins.length; rol++) {
                if (admins[rol].role == 0) {
                    document.getElementById("owner").style.visibility = "hidden";
                    document.getElementById("owner_lable").style.visibility = "hidden";
                    document.getElementById("manager").checked = true;
                }
            }

            if (role_admin != 0) {
                document.getElementById("owner").style.visibility = "hidden";
                document.getElementById("owner_lable").style.visibility = "hidden";
            }

            if (edit) {
                swap.innerHTML = "Edit Administrator";
                document.getElementById("submit_form").setAttribute("action", 'edit_admin.php');
            }

            if (data)
                error_message(data[0], data[1], data[2], data[3], data[4], data[5], data[6]);
        }

        function edit_admin(j) {

            var del_admin = 'admin named ' + admins[j].name;
            del_course.innerHTML = del_admin;

            var edit_admin = "";

            edit_admin += "<div class='well well-sm header'>Edit Administrator - " + admins[j].name + "</div>";

            edit_admin += "<div class='col-lg-12 form scroll'>";
            edit_admin += "<div class='col-lg-12 buttons'>";

            if (role_admin == 0) {
                edit_admin += "<button name='delete' class='btn btn-danger save' data-target='#Modal-delete' data-toggle='modal'>Delete</button>";
            }

            edit_admin += "</div><br><br>";
            edit_admin += "<form method='post' action='edit_admin.php' id='submit_form' enctype='multipart/form-data' onsubmit='edit_validation(event)'>";
            edit_admin += "<div class='form-group'>";
            edit_admin += "<label for='name'>Name:</label>";
            edit_admin += "<input type='text' name='name' class='form-control' id='name' placeholder='Enter Admin Name' value='" + admins[j].name + "'>";
            edit_admin += "<span class='massage' id='name_massage'></span>";
            edit_admin += "</div>";
            edit_admin += "<div class='form-group'>";
            edit_admin += "<label for='phone'>Phone:</label>";
            edit_admin += "<input type='text' name='phone' class='form-control' id='phone' placeholder='Enter Admin Phone' value='" + admins[j].phone + "'>";
            edit_admin += "<span class='massage' id='phone_massage'></span>";
            edit_admin += "</div>";
            edit_admin += "<div class='form-group'>";
            edit_admin += "<label for='email'>Email:</label>";
            edit_admin += "<input type='text' name='email' class='form-control' id='email' placeholder='Enter Admin Email' value='" + admins[j].mail + "'>";
            edit_admin += "<span class='massage' id='email_massage'></span>";
            edit_admin += "</div>";

            //            if (role_admin == 0) {
            edit_admin += "<div class='form-group' id='pass'>";
            edit_admin += "<label for='password'>Password:</label>";
            edit_admin += "<input type='password' name='password' class='form-control' id='password' placeholder='Enter Admin Password' value='" + admins[j].password + "'>";
            edit_admin += "<span class='massage' id='password_massage'></span>";
            edit_admin += "</div><br>";
            //            }

            edit_admin += "<div class='form-group' id='radio'>";
            edit_admin += "<label for='role'>Role: </label>";
            edit_admin += "<label class='radio-inline' id='owner_lable'>";
            edit_admin += "<input type='radio' name='role' value='0' id='owner'>Owner</label>";
            edit_admin += "<label class='radio-inline'>";
            edit_admin += "<input type='radio' name='role' value='1' id='manager'>Manager</label>";
            edit_admin += "<label class='radio-inline'>";
            edit_admin += "<input type='radio' name='role' value='2' id='sales'>Sales</label>";
            edit_admin += "</div>";

            edit_admin += "<input type='text' name='id' class='form-control' id='id' value='" + admins[j].id + "' style='visibility:hidden'>";
            edit_admin += "<div class='form-group'>";
            edit_admin += "<div class='row'>";
            edit_admin += "<div class='col-lg-6'>";
            edit_admin += "<label for='image file'>Select image to upload:</label>";
            edit_admin += "<input type='file' name='image' id='fupload'>" + admins[j].image;
            edit_admin += "<span class='massage' id='fupload_massage'></span>";
            edit_admin += "</div>";
            edit_admin += "<div class='col-lg-6'>";
            edit_admin += "<img id='user_profile_image' src='" + admins[j].image + "' style='max-width: 120px; height:auto;' />";
            edit_admin += "</div>";

            edit_admin += "<input type='text' name='img_source' value='" + admins[j].image + "' style='visibility: hidden;'>";

            edit_admin += "</div>";
            edit_admin += "</div><br>";
            edit_admin += "<div class='buttons'>";
            edit_admin += "<button type='submit' name='save' class='btn btn-success save'>Save</button>";
            edit_admin += "</div><br><br>";
            edit_admin += "</form>";

            edit_admin += "</div>";

            main.innerHTML = edit_admin;

            preview_image();


            if (role_admin != 0) {
                document.getElementById("pass").style.visibility = "hidden";
                document.getElementById("owner_lable").style.visibility = "hidden";
            }

            for (tag = 4; tag < 7; tag++) {

                if (admins[j].role == document.getElementsByTagName("INPUT")[tag].attributes[2].value)
                    document.getElementsByTagName("INPUT")[tag].checked = true;
            }

            if (role_admin != 0) {
                document.getElementById("owner").style.visibility = "hidden";
                document.getElementById("owner_lable").style.visibility = "hidden";
            } else {

                if (admins[j].role != 0) {
                    console.log(admins[0].role);
                    document.getElementById("owner").style.visibility = "hidden";
                    document.getElementById("owner_lable").style.visibility = "hidden";
                    document.getElementById("manager").checked = true;
                }
            }

                        if (role_admin != 0) {
//                            document.getElementById("manager").disabled = true;
                            document.getElementById("sales").disabled = true;
                        }

            document.getElementById("del_admin").setAttribute("href", "delete_admin.php?id=" + admins[j].id);
        }

        function num_admins() {

            var nadmins = "";

            nadmins += "<div class='well well-sm header'>Administrators</div>";

            nadmins += "<div class='col-lg-12 container_ad'>";
            nadmins += "<div class='courses_num'>";
            nadmins += "<div class='well well-sm admin_num_title'><span class='_title'>Number of Current Administrators:</span></div>";
            nadmins += "<div class='admin_num'>" + admins.length + "</div>";
            nadmins += "</div><br>";
            nadmins += "</div>";
            nadmins += "</div>";

            main.innerHTML = nadmins;
        }

        function preview_image() {

            var fileInput = document.getElementById('fupload');
            fileInput.onchange = function(event) {
                var file = fileInput.files[0];
                var imageType = /image.*/;
                var profile_image = document.getElementById('user_profile_image');

                if (file.type.match(imageType)) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        profile_image.src = reader.result;
                    }

                    reader.readAsDataURL(file);
                }
            };
        }

        function error_message(name, phone, email, role, password, image, message) {

            if (data) {
                document.getElementById("name").setAttribute("value", name);
                document.getElementById("phone").setAttribute("value", phone);
                document.getElementById("email").setAttribute("value", email);
                document.getElementById("password").setAttribute("value", password);

                switch (role) {

                    case '0':
                        document.getElementsByTagName("INPUT")[4].checked = true;
                        break;
                    case '1':
                        document.getElementsByTagName("INPUT")[5].checked = true;
                        break;
                    case '2':
                        document.getElementsByTagName("INPUT")[6].checked = true;
                        break;
                }

                document.getElementById("user_profile_image").setAttribute("src", image);

                phone_massage.innerHTML = "";
                email_massage.innerHTML = "";
                password_massage.innerHTML = "";

                switch (message) {

                    case 'phone':
                        phone_massage.innerHTML = "**The Phone You Entered Is Already Exists!";
                        break;
                    case 'email':
                        email_massage.innerHTML = "**The Email You Entered Is Already Exists!";
                        break;
                    case 'password':
                        password_massage.innerHTML = "**The Password You Entered Is Already Exists!";
                        break;
                }

                data = "";
            }
        }

    </script>

    <script type="text/javascript" src="admin_validation.js"></script>
</body>

</html>
