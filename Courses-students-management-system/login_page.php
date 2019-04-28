<?php
session_start();

    include "conn.php";


    $admin=0;
    $emailErr="";
    $passwordErr="";
    $email="";
    $userarr=[];

    if (isset($_GET['logout'])) {
        setcookie( 'id', '',time() -3600); 
    //    session_destroy();
    }
    //else {
    //    if (isset($_COOKIE['id'] )) {
    //        header("Location:main.php"); 
    //    }
    //}



    if(isset($_POST['submit'])) {

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "** Invalid email format"; 
        }


        $password = crypt($_POST['password'], '$2y$10$fdsfdsfsdgdfhtreyrtyfghgfhdhfdgh$');


        $sql="SELECT * FROM user WHERE mail='$email'";
        $result=mysqli_query($conn,$sql) or die (mysqli_error($conn));
        $row= mysqli_fetch_assoc($result);
        $resultLen = mysqli_num_rows($result);


    //    if($resultLen>0) {
            if ($row['mail']!==$email ){
                $emailErr="** You entered inccorect email";
            }

            if ($row['mail']===$email && $row['password']!==$password) {
                $passwordErr= "** You entered inccorect password";
            }

            if ($row['mail']===$email && $row['password']===$password) {
    //            if ($row['role']==0 || $row['role']==1) 
                    $id=$row['id'];
    //                $role=$row['role'];
    //            
    //            array_push($userarr,$id,$role,$row['name'],$row['image']);
    //            setcookie('user',serialize($userarr),time()+(3600*5));
    //            header ("Location:main.php"); 

                $_SESSION['id']=$id;
                setcookie('id',$id,time()+(3600*5));
                header ("Location:main.php");
            }
    //    }else
    //        $emailErr="** This email is not registered! Please check your email";
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
    <link rel="stylesheet" href="login_page.css">
    <title>login_page</title>

    <style>


    </style>
</head>

<body>
<div class="row">
    <div class="col-lg-7 left">
      <div class="col-lg-12 logo">
            <span class="l1">CODING</span> 
            <span class="l2">.Collage</span>
        </div>
        <div class="col-lg-12 sys">Administration  System</div>
       <div class="logo_pic">
           <img src="courses_pic/g.jpg" style="width: 200px; height: 150px;"/>
       </div>
       
        <div class="col-lg-12 login">
            <div>
                <div class="well well-sm">
                    <span>Please Enter Your Email & Password</span>
                </div>
                <div class="inputs">
                    <form method="post">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="email" type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
                        </div>
                        <div class="massage">
                            <span>
                                <?php if($emailErr) echo $emailErr;?></span>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="pwd" type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="massage">
                            <span>
                                <?php echo $passwordErr;?></span>
                        </div><br>

                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Log In</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
    <div class="col-lg-5 right">
    <div>
<!--        <div style="background:url('courses_pic/logo.jpg') no-repeat center top;background-size:cover;height:100%;" >-->
            <img src="courses_pic/logo.jpg" style="max-width: 100%; height: 690px;"/>
        </div>
    </div>
</div>
    <!-- Navigation -->
<!--
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header nav_logo">
                <span class="navbar-brand logo1">CODING</span> <span class="navbar-brand logo2">.Collage</span>
            </div>
        </div>
    </nav>


    <div class="row login_box">
        <div class="col-lg-4">
        </div>

        <div class="col-lg-4 login">
            <div>
                <div class="well well-sm">
                    <span>Please Enter Your Email & Password</span>
                </div>
                <div class="inputs">
                    <form method="post">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="email" type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
                        </div>
                        <div class="massage">
                            <span>
                                <?php if($emailErr) echo $emailErr;?></span>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="pwd" type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="massage">
                            <span>
                                <?php echo $passwordErr;?></span>
                        </div><br>

                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Log In</button>
                    </form>
                </div>
            </div>

        </div>


        <div class="col-lg-4">
        </div>
    </div>
-->


</body>

</html>
