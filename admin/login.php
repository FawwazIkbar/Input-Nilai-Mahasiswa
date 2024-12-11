<?php

session_start();
require '../functions.php';

// cek cookie
if(isset($_COOKIE['qwert']) && isset($_COOKIE['key'])){
   $id = $_COOKIE['qwert'];
   $key = $_COOKIE['key'];

// ambil username berdasarkan id
$result = mysqli_query($conn, "SELECT username FROM user WHERE id= $id");
$row = mysqli_fetch_assoc($result);

// cek cokkie dan username
if($key === hash('sha256', $row['username'])){
    $_SESSION['login'] = true;
}
}

if(isset ($_SESSION['login'])){
    header('Location: ../index.php');
    exit;
}
 

    if(isset($_POST['login'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

       
        if(mysqli_num_rows($result)===1){
            // cek password 
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])){
                // set session
                $_SESSION['login'] = true;
                // cek remember me
                if(isset($_POST['remember'])){
                    // buat cookie
                    setcookie('qwert',$row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['username']),time()+60);
                }
                header("Location: ../index.php");
                exit;
            }
        }
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<style>
form .remember {
  display: flex;
  flex-direction: row   ;

  justify-content: start;
  align-items: center;
  margin-top: 1rem;
}
form .remember input{
    margin: 0 0.7rem 0 0;
    width:5%;
}
form .remember label{
    margin: 0;
}
form .register{
    text-align: center;
    margin-top: 1rem;
}
</style>
<body>
<div class="container">
        <h1>Login</h1>

        <?php if (isset($error)): ?>
                <p>Username / Password Salah</p>
            <?php endif ?>

        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">
         
            <div class="remember">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" class="remember">Remember me</label>
            </div>
            

            <div class="submit">
            <button type="submit" name="login">Login</button>
        </div>

        <div class="register">
        <p>Belum Punya Akun? <a href="registrasi.php">Buat Akun</a></p>
        </form>
        
    </div>
    </div>
    
    
</body>
</html>