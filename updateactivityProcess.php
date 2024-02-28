<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php
include('admincontrol.php');

# menyemak kewujudan data POST
if(!empty($_POST))
{
    # memanggil fail connection.php
    include('connection.php');

    # arahan SQL (query) untuk kemaskini maklumat aktiviti
    $instruct             =   "update activity set
    activity_name       =   '".$_POST['activity_name']."',
    activity_date     =   '".$_POST['activity_date']."',
    start_time           =   '".$_POST['start_time']."'
    where       
    activity_id         =   '".$_GET['activity_id']."' ";

    # melaksana dan menyemak proses kemaskini
    if(mysqli_query($condb,$instruct))
    { 
        # kemaskini berjaya
        echo "<script>alert('Kemaskini Berjaya');
        window.location.href='activityList.php';</script>";
        
    }
    else
    {
        # kemaskini gagal
        echo "<script>alert('kemaskini Gagal');
        window.history.back();</script>";
    }
}
else
{
    # jika data GET tidak wujud. kembali ke fail senarai-aktiviti.php
    die("<script>alert('sila lengkapkan data');
    window.location.href='activityList.php';</script>");
}
?>