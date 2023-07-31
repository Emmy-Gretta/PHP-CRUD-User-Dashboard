<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="root";
$conn = new mysqli($server,$username,$password,$dbname);
if(!$conn){
   echo 'Connection failed!';
}else{
   echo 'Connected successfully!';
}
?>