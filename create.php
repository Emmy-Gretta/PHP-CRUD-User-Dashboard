<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="root";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

$name="";
$email="";
$phone="";
$address="";
$password="";

$errorMessage = "";
$successMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $password = $_POST['password'];
   $password =Md5($password );

   do{
      if( empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) ){
          $errorMessage = "Please fill all the fields!";
          break;
      }

      //add new client to the database
      $sql = "INSERT INTO clients (name, email, phone, address,password)" . 
                "VALUES ('$name','$email','$phone','$address','$password')";
      $result = $conn->query($sql);
      if(!$result){
         $errorMessage = "Invalid query: " . $conn->error;
         break;
      }

      $name="";
      $email="";
      $phone="";
      $address="";
      $password="";

      $successMessage = "User added successfully!";
      
      header("Location: login.php");
      exit;

   }while(false);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
   <title>User-Dashboard</title>
</head>
<body>
   <div class="container my-5">
      <h2>New User</h2>
      <?php
      if( !empty($errorMessage)){
         echo "
         <div class='alert alert-warning alert-dismissable fade show' role='alert'>
         <strong>$errorMessage</strong>
         <button class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
         ";
      }

      ?>
      <form action="" method="post">
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="name">Name</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="name">Email</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="name">Phone</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="name">Address</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="name">Password</label>
            <div class="col-sm-6">
               <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
            </div>
         </div>

      <?php
         if( !empty($successMessage)){
            echo "
          <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-3 d-grid'>
               <div class='alert alert-warning alert-dismissable fade show' role='alert'>
                     <strong>$successMessage</strong>
                     <button class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>
             </div>
          </div>
            ";
         }
      ?>

         <div class="row mb-3">
             <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
             </div>
            <div class="col-sm-3 d-grid">
              <a class="btn btn-outline-primary" href="./index.php" role="button">Cancel</a>
              </div>
         </div>
      </form>
   </div>
</body>
</html>