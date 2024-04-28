<?php
#memulakan fungsi SEESION 
session_start();

#menyemak kewujudan data post
if (!empty($_POST)) {
  #Memanggal fail Connection.php
  include('connection.php');

  #Mengambil data yang dihantar dari fail signup-borang.php
  $name = $_POST['name'];
  $nokp = $_POST['nokp'];
  $class_id = $_POST['class_id'];
  $password = $_POST['pass'];

  # data validation 
  if (strlen($nokp) != 12 or !is_numeric($nokp)) {
    die("<script>alert ('Sila masukkan No Kad Pengenalan Yang Sah');
    window.location.href='signupForm.php';</script>");
  }

  #menyemak adakah nokp yang dimasukkan telah wujud dalam pangkalan data
  $instruct_sql = "select* from member where nokp='$nokp' limit 1";
  $implement_sql = mysqli_query($condb, $instruct_sql);
  if (mysqli_num_rows($implement_sql) == 1) {
    #jika nokp yang dimasukkan telah wujud. aturcara akan dihentikan.
    die("<script>alert('No kad Pengenalan telah Berdaftar');
    window.location.href='signupForm.php';</script>");
  }
  # arahan SQL (query) untuk menyimpan data ahli baru 
  $instruct_sql_save = "insert into member
  (nokp,name,class_id,password,level)
  values
  ('$nokp','$name','$class_id','$password','USER')";

  #Melaksanakan arahan SQL menyimpan data ahli baru
  $implement_sql_save = mysqli_query($condb, $instruct_sql_save);

  #menguji jika proses menyimpan data berjaya atau tidak 
  if ($implement_sql_save)

    #jika data berjaya disimpan.papar popup dan buka fail ahli-login-borang
    echo "<script>alert('Terima kasih kerana mendaftar');
    window.location.href='loggedindex.php';</script>";
} else {
  #jika data tidak berjaya disimpan.papar popup dan buka fail signup-borang
  #papar popup dan buka fail signup-borang.php
  echo "<script>alert('Maklumat tidak lengkap');
    window.location.href='signupForm.php';<script>";
}
?>