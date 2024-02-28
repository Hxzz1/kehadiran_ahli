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

    # pengesahan data (validation) nokp ahli
    if(strlen($_POST['nokp']) != 12 or !is_numeric($_POST['nokp']))
    {
        die("<script>alert('No Kad Pengenalan Tidak Sah');
        window.history.back();</script>");
    }

    # arahan SQL (query) untuk kemaskini maklumat ahli
    $instruct         =   "update member set
    name            =   '".$_POST['name']."',
    nokp            =   '".$_POST['nokp']."',
    password      =   '".$_POST['password']."',
    class_id        =   '".$_POST['class_id']."',
    level           =   '".$_POST['level']."'
    where       
    nokp            =   '".$_GET['old_nokp']."' ";

    # melaksana dan menyemak proses kemaskini
    if(mysqli_query($condb,$instruct))
    { 
        # kemaskini berjaya
        echo "<script>alert('Kemaskini Berjaya');
        window.location.href='memberList.php';</script>";
        
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
    # jika data GET tidak wujud. kembali ke fail senarai-ahli.php
    die("<script>alert('sila lengkapkan data');
    window.location.href='memberList.php';</script>");
}
?>