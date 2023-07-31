<?php
if( isset($_GET["id"]) ) {
   $id = $_GET["id"];

$server = "localhost";
$dbname="users_db";
$username="root";
$password="root";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

$sql = "DELETE FROM clients WHERE id =$id";
$conn->query($sql);
}
header("location: index.php");
exit;
?>