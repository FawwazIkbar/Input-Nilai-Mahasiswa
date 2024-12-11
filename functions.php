<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "mahasiswa");

// ambil data dari tabel nilai/query data
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    // fetch data nilai dari object result
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// funtion tambah data
function tambah ($data){
    global $conn;
    // ambil data dari tiap elemen form
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $matkul1 = htmlspecialchars($data["matkul1"]);
    $matkul2 = htmlspecialchars($data["matkul2"]);
    $matkul3 = htmlspecialchars($data["matkul3"]);
    $matkul4 = htmlspecialchars($data["matkul4"]);

    // insert data
    $query = "INSERT INTO nilai 
    VALUES
    ('', '$nama', '$nim', '$matkul1', '$matkul2', '$matkul3', '$matkul4');
    ";
    mysqli_query($conn, $query);
    // cek apakah data berhasil ditambahkan atau tidak
    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    $result = "DELETE FROM nilai WHERE id = $id";
    mysqli_query($conn,$result);
    return mysqli_affected_rows($conn);

}
function ubah($data){
    global $conn;
    // ambil data dari tiap elemen form
    $id = $data['id'];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $matkul1 = htmlspecialchars($data["matkul1"]);
    $matkul2 = htmlspecialchars($data["matkul2"]);
    $matkul3 = htmlspecialchars($data["matkul3"]);
    $matkul4 = htmlspecialchars($data["matkul4"]);

    // update data
    $query = "UPDATE nilai SET
        nama = '$nama',
        nim = '$nim',
        matkul1 = '$matkul1',
        matkul2 = '$matkul2',
        matkul3 = '$matkul3',
        matkul4 = '$matkul4'

    WHERE id = $id
    ";
    mysqli_query($conn, $query);
    // cek apakah data berhasil ditambahkan atau tidak
    return mysqli_affected_rows($conn);
}

// funtions cari
function cari($keyword){
    $query = "SELECT * FROM nilai 
        WHERE
        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%'
        
    ";
    return query($query);
}
    // fungction registrasi
    function register($data){
        global $conn;
        // ambil data
        $username = strtolower(stripslashes($data['username']));
        $password = mysqli_real_escape_string($conn, $data['password']);
        $password2 = mysqli_real_escape_string($conn, $data['password2']);

        // cek username sudah ada / belum
        $result= mysqli_query($conn, "SELECT username from user WHERE username = '$username'");
        if(mysqli_fetch_assoc($result)){
            echo "<script>alert('username sudah ada')</script>";
            return false;
        }
        // cek konfirmasi password
        if ($password !== $password2 ){
            echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
            return false;
        }
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // insert data baru
       mysqli_query($conn, "INSERT INTO user
       VALUES
       ('', '$username', '$password')
   ");
   return mysqli_affected_rows($conn);

        return mysqli_affected_rows($conn); 
    }

?>
