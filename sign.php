<?php
$user = 0;
$success = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12 ]);

    $sql = "SELECT * FROM `registration` WHERE username='$username'";

    $result = mysqli_query($conn, $sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num > 0){
            // echo "User already exist";
            $user = 1;
        }else{
            $sql = "INSERT INTO `registration`(`username`, `password`) VALUES ('$username','$hashPassword')";

            $result = mysqli_query($conn, $sql);
        
            if($result){
                // echo "Data inserted succesfully";
                $success = 1;
            }else{
                die(mysqli_error($conn));
            }
        }
    }
}

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>

     <?php
     if($user){
        echo '<div class="alert alert-danger" role="alert">
        User '.$username.' already exist!
      </div>';
     }
     if($success){
        echo '<div class="alert alert-success" role="alert">
        '.$username.' ,You are sccessfully registered !
      </div>';
     }
     ?>


    <div class="container mt-5">
        <h1 class="text-center">Register</h1>
        <form action="sign.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
            </div>
        
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <p class="mt-5 text-center">Already registered ? , <a href="login.php">Login</a></p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>