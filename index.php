<?php 

session_start();
if(!isset ($_SESSION['login'])){
    header('Location: admin/login.php');
    exit;
}
    require 'functions.php';
    $mahasiswa = query("SELECT * FROM nilai");

    // pagination
    $jumlahDataPerHalaman = 3;
    $jumlahData = count($mahasiswa);
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $mahasiswa = query("SELECT * FROM nilai LIMIT $awalData, $jumlahDataPerHalaman");

  
    // Tombol Cari di klik
    if(isset ($_POST["cari"])){
        $keyword = $_POST['keyword'];
      // jika keyword kosong, kembali ke halaman 1
      if (empty($keyword)){
        header("Location: ?halaman=1");
        exit;
      }

      header("Location: ?keyword=" . urlencode($keyword)); // Redirect untuk menyertakan keyword di URL
    exit;
    }

    if ($keyword){
      $mahasiswa = cari($keyword);
      $jumlahData = count($mahasiswa);
      $jumlaHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
      $mahasiswa = array_slice($mahasiswa, $awalData, $jumlahDataPerHalaman);
    }else{
      $mahasiswa = query("SELECT * FROM nilai LIMIT $awalData, $jumlahDataPerHalaman");
      $jumlahData = count(query("SELECT * FROM nilai"));
      $jumlaHalaman = ceil($jumlahData / $jumlahDataPerHalaman); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .halamanAktif{
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <div class="tittle">
        <h1>Tabel Nilai Mahasiswa</h1>
    </div>

    <div class="button">

      <div class="tambah">
      <button><a href="CRUD/tambah.php">Tambah Mahasiswa </a></button>
      </div>

      <div class="logout">
      <button><a href="admin/logout.php">logout</a></button>
      </div>

    </div>
   
<!-- Search -->
    <div class="form-search">
    <form action="" method="post">

        <input type="text" name="keyword" size="40" autofocus placeholder="Search" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="btn-cari">Cari!</button>

    </form>
    </div>

    <div id="tabel" class="tabel">
    <table>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama</th>
        <th rowspan="2">NIM</th>
        <th colspan="4">Nilai</th>
        <th rowspan="2">Jumlah</th>
        <th rowspan="2">Aksi</th>
      </tr>
      <tr>
        <th>Matkul 1</th>
        <th>Matkul 2</th>
        <th>Matkul 3</th>
        <th>Matkul 4</th>
      </tr>
    <?php $i = 1;
    ?>
    <?php foreach($mahasiswa as $mhs): ?>
      <tr>
        <td><?php echo $i + $awalData?></td>
        <td><?php echo $mhs['nama']; ?></td>
        <td><?php echo $mhs['nim']; ?></td>
        <td><?php echo $mhs['matkul1']; ?></td>
        <td><?php echo $mhs['matkul2']; ?></td>
        <td><?php echo $mhs['matkul3']; ?></td>
        <td><?php echo $mhs['matkul4']; ?></td>
   
        <?php 
            $jumlah = $mhs['matkul1'] + $mhs['matkul2'] + $mhs['matkul3'] + $mhs['matkul4']; 
            // Determine the color based on the total score
            $color = ($jumlah < 350) ? 'red' : 'rgb(23, 193, 23)'; 
        ?>
        <td style="color: <?php echo $color; ?>;"><?php echo $jumlah; ?></td>

        <td class="aksi">
            <a href="CRUD/update.php?id=<?php echo $mhs['id']; ?>" class="ubah">Ubah</a> |
            <a href="CRUD/hapus.php?id=<?php echo $mhs['id']; ?>" class="hapus">Hapus</a>
        </td>
 
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </table>
    </div>

    <!-- navigasi -->
     <div class="nav">

      <?php if ($halamanAktif > 1): ?>
          <a href="?halaman=<?php echo $halamanAktif - 1; ?>
          <?php if ($keyword) echo '&keyword=' . urlencode($keyword); ?>">&laquo;</a>
        <?php endif; ?>
    
      <?php for ($i = 1; $i <= $jumlaHalaman; $i++): ?>
        <?php if ($i == $halamanAktif): ?>
          
          <a href="?halaman=<?php echo $i; ?>
          <?php if($keyword) echo '&keyword=' > urlencode($keyword);  ?> " class="halamanAktif">
          <?php echo $i; ?></a> 

          <?php else:?>

          <a href="?halaman=<?php echo $i; ?>
          <?php if ($keyword) echo '&keyword=' . urlencode($keyword); ?>">
          <?php echo $i; ?></a> 

          <?php endif; ?>
        <?php endfor;?>

        <?php if ($halamanAktif <= 1): ?>
          <a href="?halaman=<?php echo $halamanAktif + 1; ?>
          <?php if ($keyword) echo '&keyword=' . urlencode($keyword); ?>">&raquo;</a>
      
        <?php endif; ?>
     </div>

     <script src="js/main.js"></script>
</body>
</html>