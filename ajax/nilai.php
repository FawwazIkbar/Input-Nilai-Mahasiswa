<?php

    require '../functions.php';
    // ambil 'keyword' dari file ajax menggunakan variabel global get
    $keyword = $_GET['keyword'];
    $halamanAktif = $_GET['halamanAktif'];
    $awalData = $_GET['awalData'];
    $jumlahDataPerHalaman = 3;

    $query =  "SELECT * FROM nilai
    WHERE
        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%'
    
    ";

    $mahasiswa = query($query);
    // hitung jumlah data
    $jumlahData = count($mahasiswa);
    $jumlaHalaman = ceil($jumlahData / 
    $jumlahDataPerHalaman);
    $mahasiswa = array_slice($mahasiswa, $awalData, $jumlahDataPerHalaman);
?>


<div class="tabel">
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
        <td><?php echo $i?></td>
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
