<?php
session_start();
if(!isset ($_SESSION['login'])){
    header('Location: ../admin/login.php');
    exit;
}
    require '../functions.php';

    // ambil data di url
    $id = $_GET['id'];
    // query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM nilai WHERE id = $id")[0];
    // var_dump($mhs['nama']);

    // cek apakah tombol submit sudah di klik
    if(isset ($_POST["submit"])){
        // cek data berhasil di ubah
         if(ubah($_POST) > 0){
            echo "
                <script>
                    alert ('Data Berhasil diubah');
                    document.location.href = '../index.php';
                </script>
            ";
            
        }else{
            echo "
            <script>
                alert ('Data Gagal diubah');
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
    <title>Ubah Page</title>
    <link rel="stylesheet" href="../css/tambah.css">
</head>
<body>
    <div class="container">

    <div class="title">
    <h1>Ubah Data</h1>
    </div>

    <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $mhs["id"];?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo $mhs['nama']; ?>" required>
        
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" value="<?php echo $mhs['nim']; ?>" required>
    
        <div class="matkul">
        <div class="matkul-item">    
        <label for="matkul1">Matkul1</label>
        <input type="number" id="matkul1" name="matkul1" value="<?php echo $mhs['matkul1']; ?>"  required>
        </div>

        <div class="matkul-item">
        <label for="matkul2">Matkul2</label>
        <input type="number" id="matkul2" name="matkul2" value="<?php echo $mhs['matkul2']; ?>"  required>
        </div>

        <div class="matkul-item">
        <label for="matkul3">Matkul3</label>
        <input type="number" id="matkul3" name="matkul3"value="<?php echo $mhs['matkul3']; ?>"  required>
        </div>

        <div class="matkul-item">
        <label for="matkul4">Matkul4</label>
        <input type="number" id="matkul4" name="matkul4" value="<?php echo $mhs['matkul4']; ?>"  required>
        </div>
        </div>

        <div class="submit">
        <button type="submit" name="submit">Ubah Data!</button>
    </form>
    </div>
    </div>
    </div>
</body>
</html>