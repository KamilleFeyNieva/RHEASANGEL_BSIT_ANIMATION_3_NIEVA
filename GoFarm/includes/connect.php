<?php

$con = new mysqli('localhost','root','','guofarm');
if(!$con){
    die(mysqli_error($con));
}
?>