<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('admincontrol.php');

# menyemak kewujudan data GET nokp ahli
if(!empty($_GET))
{
    # memanggil fail connection
    include('connection.php');

    # arahan SQL untuk memadam data ahli berdasarkan nokp yang dihantar
    $instruct     =   "delete from member where nokp='".$_GET['nokp']."'";

    # melaksanakan arahan SQL padam data dan menguji proses padam data
    if(mysqli_query($condb,$instruct))
    {
        # jika data berjaya dipadam
        echo "<script>alert('Berjaya!');
        window.location.href='memberList.php';</script>";
    }
    else
    {
        # jika data gagal dipadam
        echo "<script>alert('Padam data gagal');
        window.location.href='memberList.php';</script>";
    }
}
else
{
    # jika data GET tidak wujud (empty)
    die("<script>alert('Sila cuba lagi');
    window.location.href='memberList.php';</script>");
}
?>