<?php
include "conn.php";

                                                       
$admin="SELECT * FROM user";
$res_admin=mysqli_query($conn,$admin) or die (mysqli_error($conn));
    
while($row = mysqli_fetch_assoc($res_admin)) {
    
    $admin_Arr[]=$row;
}
    
$admin_list=json_encode($admin_Arr);

//echo $admin_list;
    
?>
                            
                            