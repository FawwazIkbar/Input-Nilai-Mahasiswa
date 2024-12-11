<?php

require "../functions.php";

if(isset ($_POST['register'])){
    // kalai nilai lebih besar dari 0, maka user baru di tambahkan
    if(register($_POST) > 0){
        echo  "<script>
        alert('User Baru Berhasil ditambahkan');
        document.location.href = 'login.php';
    </script>";
 
    }else{
        echo mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2">
    <div class="submit">
    <button type="submit" name="register">
                Register
        </div>

            </button>
        </form>
    </div>
</body>
</html>