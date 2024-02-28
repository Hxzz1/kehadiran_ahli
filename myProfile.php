<?php
session_start();
# memanggil fail connection dan kawalan-biasa
include('connection.php');

$masa=date("H:i:s");

# Menyemak kewujudan data GET id_aktiviti
if(!empty($_GET['activity_id']) and !empty($_SESSION['nokp']))
{
  # Arahan Simpan data kehadiran
  $sql = "insert into attendance (activity_id,nokp,attendance_time)
  values ('".$_GET['activity_id']."', '".$_SESSION['nokp']."','$time') ";
  
  # Laksana arahan Simpan
  $savedata=mysqli_query($condb,$sql);
  
  # menguji proses simpan
  if($savedata){
    echo "<script>
         alert('Kehadiran Telah Disahkan');
         window.location.href='profile.php';
    </script>";
  }
   else {
     echo "<script>
         alert('Kehadiran GAGAL Disahkan. Sila Ke Meja Urusetia');
         window.location.href='profile.php';
     </script>";
   }
}
else
{
     echo "<script>
       alert('Akses secara terus');
       window.location.href='logout.php';
   </script>";
}
?>
