<?php
include "conn.php";
if(isset($_POST["uname"])){
    $uname=$_POST["uname"];
    $password=$_POST["password"];
    $password=md5($password);
    $sql = "SELECT * FROM users WHERE uname='$uname' AND upass='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
echo "1";

    }else{
        echo "0";
    }


}