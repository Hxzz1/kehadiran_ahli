<?php
session_start();

# memanggil fail header, kawalan-admin
include('admincontrol.php');
?>

<!-- header -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aplod skuy</title>
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

    <!-- Tajuk laman -->

    <!-- Borang untuk memuat naik fail -->
    <div class="container">
        <div class="card">
            <h3>Upload Files</h3>
            <div class="drop_box">
                <header>
                    <h4>Select File here</h4>
                </header>
                <p>Files Supported: TEXT</p>
                <input type="file" name="member_data" hidden accept=".txt" id="fileID" style="display:none;">
                <button class="btn">Choose File</button>
            </div>
            <link rel="stylesheet" href="css/upload.css">
            <script src="js/upload.js"></script>
        </div>
    </div>


    <!-- Bahagian Memproses Data yang dimuat naik -->
    <?PHP
    # data validation : menyemak kewujudan data dari borang
    if (isset($_POST['btn-upload'])) {
        # memanggil fail connection
        include('connection.php');

        # mengambil nama sementara fail
        $tempnamefile = $_FILES["member_data"]["tmp_name"];

        # mengambil nama fail
        $filename = $_FILES['member_data']['name'];

        # mengambil jenis fail
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        # menguji jenis fail dan sail fail
        if ($_FILES["member_data"]["size"] > 0 and $filetype == "txt") {
            # membuka fail yang diambil
            $file_member_data = fopen($tempnamefile, "r");

            # mendapatkan data dari fail baris demi baris
            while (!feof($file_member_data)) {
                # mengambil data sebaris sahaja bg setiap pusingan
                $takelinedata = fgets($file_member_data);

                # memecahkan baris data mengikut tanda pipe
                $breakline = explode("|", $takelinedata);

                # selepas pecahan tadi akan diumpukan kepada 5
                list($nokp, $name, $class_id, $password, $level) = $breakline;

                # arahan SQL untuk menyimpan data
                $instruct_sql_save = "insert into member
            (nokp,name,class_id,password,level) values
            ('$nokp','$name','$class_id','$password','$level')";

                # memasukkan data kedalam jadual ahli
                $implement_instruct_save = mysqli_query($condb, $instruct_sql_save);
                echo "<script>alert('import fail Data Selesai');
            window.location.href='senarai-ahli.php';
            </script>";
            }
            # menutup fail txt yang dibuka
            fclose($file_member_data);
        } else {
            # jika fail yang dimuat naik kosong atau tersalah format.
            echo "<script>alert('hanya fail berformat txt sahaja dibenarkan');</script>";
        }
    }
?>
<!-- footer -->
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