<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

# nama host. localhost merupakan default
$host_name  =   "localhost";

# username bagi SQL. root merupakan default
$sql_name   =   "root";

# password bagi SQL. masukkan password anda.
$sql_pass   =   "";

# nama pangkalan data yang anda telah bangunkan sebelum ini.
$db_name    =   "kehadiran_ahli";

# membuka hubungan antara pangkalan data dan sistem.
$condb      =   mysqli_connect($host_name, $sql_name, $sql_pass, $db_name);

# menguji adakah hubungan berjaya dibuka
if (!$condb) 
{
    die("Sambungan ke pangkalan data gagal");
}
else
{
    #echo "Sambungan ke pangkalan data berjaya";
}
?>