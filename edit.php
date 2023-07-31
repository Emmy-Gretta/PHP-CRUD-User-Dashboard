<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="root";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

$id = $_GET['id'];
$sql = "select * from clients where id=$id";
$response = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($response);

// $name = $row['name'];
// $email = $row['email'];
// $phone = $row['phone'];
// $address = $row['address'];
// $password = $row['password'];

$name="";
$email="";
$phone="";
$address="";
$password="";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $password =Md5($password );


    $sql = "update clients set  name='$name', email='$email', phone='$phone',address='$address' ,password='$password' where id='$id'";
    $response = mysqli_query($con,$sql);
    if ($response){
       header('location:index.php');
    // echo "update successfull";
    }else{
        echo "Updating  failed";
    }
    $con->close();

$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['address'];
$password = $row['password'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Crud operation</title>
</head>
<body>
  <form method="post" action="">
    <div class="container my-6">
        <h2 class="text-center">Registration form</h2>  
        
            <div class="mb-3">
              <label >Name:</label>
              <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php
              echo $name; ?>">
            </div>

            <div class="mb-3">
              <label >Email:</label>
              <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
              <label >Phone number:</label>
              <input type="text" class="form-control" placeholder="Enter your phone number" name="phone_number" autocomplete="off" value="<?php echo $phoneNumber; ?>">
            </div>

            <div class="mb-3">
              <label ><Address></Address></label>
              <input type="text" class="form-control" placeholder="Enter your phone number" name="phone_number" autocomplete="off" value="<?php echo $add; ?>">
            </div>

            <div class="mb-3">
              <label >Password:</label>
              <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off" value="<?php echo $pword; ?>">
            </div>
            
             <button type="submit" class="btn btn-danger" name="submit">Update</button>
    </div>
  </form>
</body>
</html>