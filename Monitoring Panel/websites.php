<?php
header("Access-Control-Allow-Origin: *");
include "conn.php";
if(isset($_POST["uname"])){
    $uname=$_POST["uname"];

    $sql = "SELECT * FROM users WHERE uname='$uname'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
$cid=$row["cid"];

$sql1="SELECT * FROM websites WHERE cid='$cid'";
$result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)) {
//HEre we have details
                    echo $row1["link"].",";
                }
            }else{
                echo 0;
            }
        }

    }else{

    }


}