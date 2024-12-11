<?php
session_start();
if(!isset ($_SESSION['login'])){
    header('Location: ../admin/login.php');
    exit;
}
    require '../functions.php';

    // cek apakah tombol submit sudah di klik
    if(isset ($_POST["submit"])){
         // cek data berhasil di tambah
         if(tambah($_POST) > 0){
            echo "
                <script>
                    alert ('Data Berhasil di Tambahkan');
                    document.location.href = '../index.php';
                </script>
            ";
            
        }else{
            echo "
            <script>
                alert ('Data Gagal Tambahkan');
                document.location.href = '../index.php';
            </script>
        ";
            
        }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Page</title>

    <link rel="stylesheet" href="../css/tambah.css">
</head>
<body>
    
<div class="container">
    
    <div class="title">
    <h1>Tambah Data</h1>
    </div>

    
    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
        
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" required>
        
        <div class="matkul">
    <div class="matkul-item">
        <label for="matkul1">Matkul 1</label>
        <input type="number" id="matkul1" name="matkul1" required>
    </div>
    <div class="matkul-item">
        <label for="matkul2">Matkul 2</label>
        <input type="number" id="matkul2" name="matkul2" required>
    </div>
    <div class="matkul-item">
        <label for="matkul3">Matkul 3</label>
        <input type="number" id="matkul3" name="matkul3" required>
    </div>
    <div class="matkul-item">
        <label for="matkul4">Matkul 4</label>
        <input type="number" id="matkul4" name="matkul4" required>
    </div>
</div>
    <div class="submit">
        <button type="submit" name="submit">Tambah Data!</button>
    </form>
    </div>
    </div>
</body>
</html>