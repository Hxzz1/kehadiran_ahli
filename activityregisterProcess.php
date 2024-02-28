<?php
# memulakan fungsi SESSION
session_start();

# menyemak kewujudan data post
if (!empty($_POST)) {
    include('connection.php');

    # arahan SQL (query) untuk menyimpan data aktiviti baru
    $instruct_sql_save = "insert into activity 
    ( activity_name, activity_date,  start_time)
    values
    ('" . $_POST['activity_name'] . "', '" . $_POST['activity_date'] . "', '" . $_POST['start_time'] . "') ";

    # Melaksanakan arahan SQL menyimpan data aktiviti baru
    $implement_instruct_save = mysqli_query($condb, $instruct_sql_save);

    # menguji jika proses menyimpan data berjaya atau tidak
    if ($implement_instruct_save) {
        # jika data berjaya disimpan. papar popup dan buka fail aktiviti-daftar-borang
        echo "<script>alert('Pendaftaran Aktiviti Berjaya.');
        window.location.href='activityList.php'; </script>";
    } else {
        # jika data tidak berjaya disimpan. papar popup dan buka fail aktiviti-daftar-borang
        echo "<script>alert('Pendaftaran Gagal');
        window.location.href='activityregisterForm.php'; </script>";
    }
} else {
    # jika pengguna buka fail ini tanpa mengisi data.
    # papar popup dan buka fail aktiviti-daftar-borang.php
    echo "<script>alert('Sila lengkapkan maklumat');
    window.location.href='activityregisterForm.php'; </script>";
}
?>