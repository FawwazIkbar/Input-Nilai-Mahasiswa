var keyword = document.getElementById("keyword");
var btnCari = document.getElementById("btnCari");
var tabel = document.getElementById("tabel");
var navigasi = document.querySelector(".nav");

keyword.addEventListener("keyup", function () {
  // buat objek ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      tabel.innerHTML = xhr.responseText;
      navigasi.style.display = "none";
    }
  };

  // dapatkan parameter pagination
  var halamanAktif = document.querySelector(".halamanAktif").textContent;
  var jumlahDataPerHalaman = 3;
  var awalData = jumlahDataPerHalaman * halamanAktif - jumlahDataPerHalaman;

  // eksekusi ajax
  xhr.open("GET", "ajax/nilai.php?keyword=" + keyword.value + "&halamanAktif=" + halamanAktif + "&awalData=" + awalData, true);
  xhr.send();
});
