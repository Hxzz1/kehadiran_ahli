<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('admincontrol.php');

# menyemak kewujudan data GET id_aktiviti aktiviti
if(!empty($_GET))
{
    # memanggil fail connection
    include('connection.php');

    # arahan SQL untuk memadam data aktiviti berdasarkan id_aktiviti yang dihantar
    $instruct     =   "delete from activity where   
                     activity_id   	=	'".$_GET['activity_id']."'";

    # melaksanakan arahan SQL padam data dan menguji proses padam data
    if(mysqli_query($condb,$instruct))
    {
        # jika data berjaya dipadam
        echo "<script>alert('Padam data Berjaya');
        window.location.href='activityList.php';</script>";
    }
    else
    {
        # jika data gagal dipadam
        echo "<script>alert('Padam data gagal');
        window.location.href='activityList.php';</script>";
    }
}
else
{
    # jika data GET tidak wujud (empty)
    die("<script>alert('Ralat! akses secara terus');
    window.location.href='activityList.php';</script>");
}
?>