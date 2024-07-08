<?php
# memulakan fungsi session
session_start();

# memanggil connection.php, admincontrol.php
include('connection.php');
include('admincontrol.php');

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register aktiviti brader</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/activityList1.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/print.css"
    <?php include("connection.php"); ?>


</head>

<body>
    <!-- set header -->
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

    <h3 align='center'>Senarai aktiviti</h3>

    <!-- Header bagi jadual untuk memaparkan senarai aktiviti -->

    <body>
        <div class="search-form">
            <form action="" method="POST">
                <input type="text" name="activity_name" placeholder="Carian aktiviti">
                <input type="submit" value="Cari">
            </form>
        </div>
        <td colspan='2' align='right'>
            | <a href='activityregisterForm.php' class='button-link'>Daftar Aktiviti / Perjumpaan Baru</a>
        </td>
        <table class="table table-bordered">
        <thead>
          <tr bgcolor="#00244D">
            <td style="color: #ffffff; width: 30%;">Bil</td>
            <td style="color: #ffffff; width: 30%;">Tarikh | Masa</td>
            <td style="color: #ffffff; width: 30%;">Tindakan</td>
          </tr>
          <button onclick="window.print()" class="print-button"><span class="print-icon"></span></button>
            <?php

            # syarat tambahan yang akan dimasukkan dalam arahan(query) senarai aktiviti
            $add = "";
            if (!empty($_POST['activity_name'])) {
                $add = "where activity_name like '%" . $_POST['activity_name'] . "%'";
            }
            # arahan query untuk mencari senarai Aktiviti 
            $instruct_show = "select* from activity $add ";

            # laksanakan arahan mencari data aktiviti 
            $implement = mysqli_query($condb, $instruct_show);

            # Mengambil data yang ditemui 
            while ($m = mysqli_fetch_array($implement)) {
                # memaparkan senarai nama dalam jadual 
                echo "<tr> 
        <td>" . $m['activity_name'] . "</td> 
        <td>" . $m['activity_date'] . " | " . $m['start_time'] . " </td> ";

                # memaparkan navigasi untuk kemaskini dan hapus data aktiviti
                echo "<td align='right'>
        | <a href='updateactivityForm.php?activity_id=" . $m['activity_id'] . "'>
        Kemaskini</a>

        | <a href='activitydeleteProcess.php?activity_id=" . $m['activity_id'] . "' 
        onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">
        Hapus</a>

        | <a href='attendanceForm.php?activity_id=" . $m['activity_id'] . "'>
        Pengesahan Kehadiran</a> |
    

        </td>
        </tr>";
            }

            ?>
        </table>
    </body>
    <br><br><br>
    <br><br><br>
    <br><br><br>

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

        .body {
    min-height: 100vh;
        }
    </style>