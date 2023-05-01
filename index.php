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
      <h2>List of clients</h2>
      <a class="btn btn-primary" href="./create.php" role="button">New Client</a>
      <br>
      <table class="table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Address</th>
               <th>Created at</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
               <?php
               $server = "localhost";
               $dbname="users_db";
               $username="root";
               $password="";
               $conn = new mysqli($server,$username,$password,$dbname);
               if(!$conn){
                  echo 'Connection failed!';
               }else{
                  echo 'Connected successfully!';
               }

               //read all row from the table
               $sql = "SELECT * FROM clients";
               $result = $conn->query($sql);

               if(!$result){
                  die("Invalid query:" .$conn->error);
               }

               //read data of each row
               while($row = $result->fetch_assoc()){
                  echo "
                  <tr>
                  <td>$row[ID]</td>
                  <td>$row[Name]</td>
                  <td>$row[Email]</td>
                  <td>$row[Phone]</td>
                  <td>$row[Address]</td>
                  <td>$row[Created_at]</td>
                  <td>
                     <a class='btn btn-primary btn-sm' href='./edit.php?id=$row[ID]'>Edit</a>
                     <a class='btn btn-danger btn-sm' href='./delete.php?id=$row[ID]'>Delete</a>
                  </td>
               </tr>
                  ";
               }
               ?>

          
         </tbody>
      </table>
   </div>
</body>
</html>