<?php
$server = "localhost";
$dbname="users_db";
$username="root";
$password="";

//create connection
$conn = new mysqli($server,$username,$password,$dbname);

$id="";
$name="";
$email="";
$phone="";
$address="";

$errorMessage = "";
$successMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
   //GET METHOD: Show the data of the client
   if( !isset($_GET["id"]) )  {
      header("location: index.php");
      exit;

      $id = $_GET["id"];

      //read the row of selected client from databse table
      $sql = "SELECT * FROM clients WHERE id=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      if(!$row){
         header("location: index.php");
         exit;
      }

      $name = $row["name"];
      $email = $row["email"];
      $phone = $row["phone"];
      $address = $row["address"];

      
}else{
   //POST Method: update the data of the client
   $id = $_POST['id'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];

   do{
      if( empty($name) || empty($email) || empty($phone) || empty($address) ){
         $errorMessage = "Please fill all the fields!";
         break;
     }

   $sqli = "UPDATE clients"  .
             "SET name = '$name', email = '$email', phone = '$phone', address= '$address' "  . 
             "WHERE id = $id";

   $result = $conn->query($sqli);

   if(!$result){
      $errorMessage = "Invalid query: " . $conn->error;
      break;
   }

   $successMessage = "User updated successfully!";

   header("location: index.php");
   exit;

   }while (true);
 }

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
         <input type="hidden" name="id" value="<?php echo $id; ?>">
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