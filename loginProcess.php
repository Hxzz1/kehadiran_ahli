<?php
session_start();


if (!empty($_POST['nokp']) and !empty($_POST['password'])) {
  # memanggil fail connection.php
  include('connection.php');

  # Mengambil data yang di POST dari fail Borang
  $nokp = $_POST['nokp'];
  $password = $_POST['password'];

  # Arahan SQL (query) untuk membandingkan data yang dimasukkan
  # wujud di pangkalan data atau tidak
  $query_login = "select * from member
  where
           nokp = '$nokp'
   and password = '$password' LIMIT 1";

  # melaksanakan arahan membandingkan data
  $implement_query = mysqli_query($condb, $query_login);

  # jika terdapat 1 data yang sepadan, login berjaya
  if (mysqli_num_rows($implement_query) == 1) {
    # mengambil data yang ditemui
    $m = mysqli_fetch_array($implement_query);

    # mengumpukkan kepada pembolehubah session
    $_SESSION['nokp'] = $m['nokp'];
    $_SESSION['level'] = $m['level'];
    $_SESSION['name'] = $m['name'];

    # membukan laman index.php
    echo "<script>window.location.href='loggedindex.php';</script>";
  } else {
    # login gagal. kembali ke laman login-borang.php
    die("<script>alert('login Gagal');
     window.location.href='loginForm.php';</script>");
  }
} else {
  # data yang dihantar dari laman login-borang.php kosong
  die("<script>alert('sila masukkan nokp dan katalaluan yang sah');
  window.location.href='loginForm.php';</script>");
}
?>