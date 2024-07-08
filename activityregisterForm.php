<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('admincontrol.php');
?>
<!-- set header -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>register aktiviti brader</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/activityregisterForm.css">
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

    <h3 style="text-align: center;">Daftar aktiviti Baru</h3>
    <!-- borang untuk menerima data dari pengguna -->
    <form action='activityregisterProcess.php' method='POST'>

        nama aktiviti
        <input type='text' name='activity_name' required><br>

        Tarikh aktiviti
        <input type='date' name='activity_date' min='<?= date("d-m-Y") ?>' required><br>

        masa mula
        <input type='text' name='start_time' required><br>

        <input type='submit' value='daftar'>

    </form>
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
    </style>