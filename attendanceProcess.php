<?php
# Memanggil fail connection.php
include('connection.php');

# Memadam data kehadiran lama agar dapat memasukkan data kehadiran baru
$sqldelete=mysqli_query($condb,"delete from attendance where activity_id='".$_GET['activity_id']."'");

$time=date("H:i:s");
foreach ($_POST['attendance'] as $nokp) 
{
    # Menyimpan semula data kehadiran yang baru
    $savedata=mysqli_query($condb,"insert into attendance
    (nokp,activity_id,attendance_time) values
    ('$nokp','".$_GET['activity_id']."','$time') ");
}

echo"<script>alert('Kemaskini Kehadiran Selesai');
window.location.href='activityList.php';
</script>";
?>