
<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="root";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email'];
  $password = $_POST ['password'];
  $password =Md5($password );
  $response = $conn->query("SELECT * FROM clients  WHERE email= '$email' AND  password='$password'" );
if($response){
  header('location: index.php');
}else{
  echo "Unable to login";

}

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
    <title>Document</title>
</head>
<body class=".bg-info-subtle">
    <form method="post" action="">
        <div class="container my-6">
            <h2 class="text-center">Login</h2>  
            
                <div class="mb-3">
                  <label >Email:</label>
                  <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off">
                </div>
    
                <div class="mb-3">
                  <label >Password:</label>
                  <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off">
                </div>
                
                 <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
</body>
</html>