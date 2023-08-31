<?php
$userFound = 0;
$userNotFound = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    if($result){
        $num = mysqli_num_rows($result);
        if($num > 0){
            // echo "Login Successful !";
            $row = mysqli_fetch_assoc($result);
            $storedHashPassword = $row["password"];
        
            if(password_verify($password, $storedHashPassword)){
                $userFound = 1 ;
                session_start();
                $_SESSION['username'] = $username ;
                header('location:home.php');
            }

        }else{
            // echo "Invalid credentials !";
            $userNotFound = 1;
        }
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>

  <?php
    if($userFound){
        echo '<div class="alert alert-success" role="alert">
        Welcome '.$username.'. Login Success !
      </div>';
     }
     if($userNotFound){
        echo '<div class="alert alert-danger" role="alert">
        Invalid credentials !
      </div>';
     }
 ?>


    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
            </div>
        
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-5 text-center">New User ? , <a href="sign.php">Register</a></p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>