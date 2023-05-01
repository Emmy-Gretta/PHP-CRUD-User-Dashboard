<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

$name="";
$email="";
$phone="";
$address="";

$errorMessage = "";
$successMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];

   // Check if all fields are filled out
   if( empty($name) || empty($email) || empty($phone) || empty($address) ){
          $errorMessage = "Please fill all the fields!";
          break;
      }

   // Validate the email
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = "Please enter a valid email address.";
      break;
   }

   // Validate the phone number
   if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $errorMessage = "Please enter a valid phone number.";
      break;
   }

   // Add new client to the database
   $sql = "INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssss", $name, $email, $phone, $address);
   $stmt->execute();

   // Check if the query was successful
   if ($stmt->affected_rows == 0) {
      $errorMessage = "The client was not added to the database.";
      break;
   }

   // Reset the form fields
   $name="";
   $email="";
   $phone="";
   $address="";

   // Redirect to the index page
   header("Location: index.php");
   exit;
}

?>