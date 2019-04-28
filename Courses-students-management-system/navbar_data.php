<?php
include "conn.php";

//$user="";
//$name="";

//if(isset($_SESSION['id'])) {
if(isset($_COOKIE['id'])) {
//    $id=$_SESSION['id'];
    $id=$_COOKIE['id'];
    
    $sql="SELECT * FROM user WHERE id='$id'";
    $result=mysqli_query($conn,$sql) or die (mysqli_error($conn));
    $row=mysqli_fetch_assoc($result);
    
    $name=$row['name'];
    $image=$row['image'];
    $role=$row['role'];
    
    switch ($role) {
                
            case '0':
                $user="Owner";
                break;
            case '1':
                $user="Manager";
                break;
            case '2':
                $user="Sales";
                break;
        }
    
//    while($row=mysqli_fetch_assoc($result)) {
//    
//    
//    }
}

?>