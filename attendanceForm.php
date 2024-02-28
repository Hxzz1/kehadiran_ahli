<?php
# memulakan fungsi session
session_start();

#memanggil fail header.php, connection.php dan guard-admin.php
include('connection.php');
include('admincontrol.php');


# Mendapatkan maklumat aktiviti dari pangkalan data
$instruct_sql_activity = "select * from activity where activity_id ='" . $_GET['activity_id'] . "' ";
$implement_activity = mysqli_query($condb, $instruct_sql_activity);
$n = mysqli_fetch_array($implement_activity);

?>
<!-- set header -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Masuk Ahli Baru</title>
    <link rel="stylesheet" href="css/header.css">

    <?php include("connection.php"); ?>

</head>

<body>
    <!-- ser header -->
    <?PHP if (!empty($_SESSION['level']) and $_SESSION['level'] == "ADMIN") { ?>
        <nav class="mainNav">
            <div href="loggedindex.php" class="mainNav__logo">
                <img src="src/KsahLogo.png" alt="Logo" height="50" width="50">
            </div>
            <div class="mainNav__links">
                <a href="loggedindex.php" class="mainNav__link">Laman Utama</a>
                <a href="profile.php" class="mainNav__link">Profil</a>
                <a href="attendanceRecord.php" class="mainNav__link">Kaunter Kehadiran</a>
                <a href="memberList.php" class="mainNav__link">Senarai Ahli</a>
                <a href="activityList.php" class="mainNav__link">Senarai Aktiviti</a>
                <a href="attendanceReport.php" class="mainNav__link">Laporan Kehadiran</a>
                <a href="logout.php" class="mainNav__link">Log Keluar</a>
            </div>
            <div class="mainNav__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g data-name="Layer 2" fill="#9197AE">
                        <g data-name="menu-2">
                            <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                            <circle cx="4" cy="12" r="1" />
                            <rect x="7" y="11" width="14" height="2" rx=".94" ry=".94" />
                            <rect x="3" y="16" width="18" height="2" rx=".94" ry=".94" />
                            <rect x="3" y="6" width="18" height="2" rx=".94" ry=".94" />
                        </g>
                    </g>
                </svg>
            </div>
        </nav>
        <!-- user biasa -->
    <?php } else if (!empty($_SESSION['level']) and $_SESSION['level'] == "USER") { ?>
            <nav class="mainNav">
                <div href="loggedindex.php" class="mainNav__logo">
                    <img src="src/KsahLogo.png" alt="Logo" height="50" width="50">
                </div>
                <div class="mainNav__links">
                    <a href="loggedindex.php" class="mainNav__link">Laman Utama</a>
                    <a href="Profile.php" class="mainNav__link">Profil</a>
                    <a href="logout.php" class="mainNav__link">Log Keluar</a>
                </div>
                <div class="mainNav__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g data-name="Layer 2" fill="#9197AE">
                            <g data-name="menu-2">
                                <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                                <circle cx="4" cy="12" r="1" />
                                <rect x="7" y="11" width="14" height="2" rx=".94" ry=".94" />
                                <rect x="3" y="16" width="18" height="2" rx=".94" ry=".94" />
                                <rect x="3" y="6" width="18" height="2" rx=".94" ry=".94" />
                            </g>
                        </g>
                    </svg>
                </div>
            </nav>
    <?php } else { ?>
            <!-- taklogin -->
            <nav class="mainNav">
                <div href="index.php" class="mainNav__logo">
                    <img src="src/KsahLogo.png" alt="Logo" height="50" width="50">
                </div>
                <div class="mainNav__links">
                    <a href="index.php" class="mainNav__link">Laman Utama</a>
                    <a href="loginForm.php" class="mainNav__link">Log Masuk</a>
                </div>
                <div class="mainNav__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g data-name="Layer 2" fill="#9197AE">
                            <g data-name="menu-2">
                                <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                                <circle cx="4" cy="12" r="1" />
                                <rect x="7" y="11" width="14" height="2" rx=".94" ry=".94" />
                                <rect x="3" y="16" width="18" height="2" rx=".94" ry=".94" />
                                <rect x="3" y="6" width="18" height="2" rx=".94" ry=".94" />
                            </g>
                        </g>
                    </svg>
                </div>
            </nav>
    <?php } ?>

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
    </head>
    <br><br><br>

    <!-- end header -->
    <h3>Pengesahan Kehadiran Ahli</h3>

    Nama Aktiviti :
    <?= $n['activity_name'] ?> <br>
    Tarikh | Masa :
    <?= $n['activity_date'] . " | " . $n['start_time'] ?><br>
    <br><br>

    <head>

    </head>
    <form action='attendanceProcess.php?activity_id=<?= $_GET['activity_id'] ?>' method='POST'>
<table border='1' id='saiz' width='100%'>
    <tr>
        <td>Bil</td>
        <td>Nama</td>
        <td>Nokp</td>
        <td>Kelas</td>
        <td>Kehadiran</td>
    </tr>

<?php

# Arahan untuk mendapatkan data kehadiran setiap ahli
$instruct_sql_attendance = "SELECT  
member.nokp, member.name,
class.Form, class.class_name,
attendance.activity_id
FROM member
LEFT JOIN class
ON member.class_id 	= 	class.class_id
LEFT JOIN attendance
ON member.nokp 		= 	attendance.nokp 
AND attendance.activity_id='".$_GET['activity_id']."'
ORDER BY member.name";

# Laksanakan arahan untuk memproses data
$implement_attendance 	= 	mysqli_query($condb,$instruct_sql_attendance);
$bil=0;

# Mengambil dan memaparkan semua data kehadiran yang ditemui
while($m=mysqli_fetch_array($implement_attendance)){  ?>
    <tr>
        <td><?= ++$bil; ?></td>
        <td><?= $m['name'] ?></td>
        <td><?= $m['nokp'] ?></td>
        <td><?= $m['Form']." ".$m['class_name'] ?> </td>
        <td><?php 
        
        if($m['activity_id'] != null)
        {
            $tanda='checked';
        } else 
        $tanda="";
        ?>

        <input <?= $tanda ?>  type='checkbox' name='attendance[]' 
        value='<?= $m['nokp'] ?> ' style='width:30px; height:30px;'>
        </td>
    </tr>
    <?PHP
}
?>
<tr>
    <td colspan='4'></td>
    <td><input type='submit' value='Simpan'></td>
</tr>
</table>
</form>

<!-- footer section -->
<section id="copy-right">
      <div class="copy-right-sec"><i class="fa-solid fa-copyright"></i>
         Copyright &copy 2023-2025 : <a href="https://www.facebook.com/sahc1908/">Sultan Abdul Hamid College</a>


      </div>

   </section>
   <style>
      .copy-right-sec {
         padding: 1.8rem;
         background: #ffffff;
         color: #ddd;
         text-align: bottom;
      }

      .copy-right-sec a {
         color: #ffbc05;
         font-weight: 500;
      }

      a {
         text-decoration: none;
      }
   </style>