<?php
# memulakan fungsi session
session_start();

#memanggil fail header.php, connection.php dan guard-aktiviti.php
include('connection.php');
include('admincontrol.php');

?>

<!-- header -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report Aktiviti Brader</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/activityList1.css">
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
    <!-- end header  -->

    <h3>Laporan Kehadiran aktiviti
        <style>
            h3 {
                text-align: center;
            }
        </style>
    </h3>

    <!-- Boarang carian Aktiviti -->
    <h3 align='center'>
    <form action='' method='GET'>
        Aktiviti <select name='activity_id'>
            <option selected disabled value <style h3 align='center'></style>Sila Pilih Aktiviti yang ingin anda semak</option>

            <?php
            # Proses memaparkan senarai aktiviti dalam bentuk drop down list
            $instruct_sql_choose = "select* from activity";
            $implement_instruct_choose = mysqli_query($condb, $instruct_sql_choose);
            while ($n = mysqli_fetch_array($implement_instruct_choose)) {
                echo "<option value='" . $n['activity_id'] . "'>
                " . $n['activity_id'] . " | " . $n['activity_name'] . "
                </option>";
            }
            ?>
        </select>
        <input type='submit' value='Cari'>
    </form>

    <?php
    # syarat tambahan yang akan dimasukkan dalam arahan(query) senarai aktiviti
    $add = "";
    if (!empty($_GET['activity_id'])) {
        # Mengambil nilai data GET di URL
        $activity_id = $_GET['activity_id'];

        # proses mendapatkan maklumat aktiviti
        $sql_activity = "select* from activity where activity_id = '$activity_id'";
        $implement_activity = mysqli_query($condb, $sql_activity);
        $ma = mysqli_fetch_array($implement_activity);

        # Mendapatkan Analisis Kehadiran (bil hadir & bil ahli)
        $instructSQL = " SELECT 
    ( SELECT COUNT(*) FROM attendance 
where activity_id = '" . $ma['activity_id'] . "' ) AS bil_hadir,
    ( SELECT COUNT(*) FROM member ) AS bil_ahli ";
        $instructSQL = mysqli_query($condb, $instructSQL);
        $da = mysqli_fetch_array($instructSQL);
        ?>

        <!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
        <h3>
            <?= $ma['activity_name'] ?><br>
            <?= $ma['start_time'] ?><br>
            Kehadiran :
            <?= $da['bil_hadir'] . " / " . $da['bil_ahli'] ?> <br>
            Peratus :
            <?php echo number_format(($da['bil_hadir'] / $da['bil_ahli'] * 100), 2); ?> %
            <style>
                h3 {
                    text-align: center;
                }
            </style>

        </h3>
        <tr class="bg-white">
            <td colspan='3'>
                <div class="search-form">
                    <form action='attendanceReport.php?activity_id=<?= $activity_id; ?>' method='POST'><input type='text'
                            name='name' placeholder='Carian Nama Ahli'><input type='submit' value='Cari'></form>
                </div>
            </td>
        </tr>
        <table class="table table-bordered">
        <thead>
          <tr bgcolor="#00244D">
            <td style="color: #ffffff; width: 10%;">Bil</td>
            <td style="color: #ffffff; width: 30%;">Nama</td>
            <td style="color: #ffffff; width: 10%;">No Kad Pengenalan</td>
            <td style="color: #ffffff; width: 10%;">Kelas</td>
            <td style="color: #ffffff; width: 10%;">Kehadiran</td>
          </tr>
            <?PHP

            # syarat tambahan yang akan dimasukkan dalam arahan(query) senarai ahli
            $add = "";
            if (!empty($_POST['name'])) {
                $add = " where member.name like '%" . $_POST['name'] . "%'";
            }

            # arahan query untuk mencari senarai Aktiviti 
            $instruct_show = "
SELECT *,  member.nokp
 FROM member
 LEFT JOIN class
 ON member.class_id = class.class_id
 LEFT JOIN attendance
 ON member.nokp = attendance.nokp 
 and activity_id like '%$activity_id%'
 $add
 ORDER BY member.name ";

            # laksanakan arahan mencari data aktiviti 
            $implement = mysqli_query($condb, $instruct_show);
            $attend = $notattend = $bil = 0;
            # Mengambil data yang ditemui 
            while ($m = mysqli_fetch_array($implement)) {

                # memaparkan senarai nama dalam jadual 
                echo "<tr> 
        <td>" . ++$bil . "</td>
        <td>" . $m['name'] . "</td> 
        <td>" . $m['nokp'] . "</td> 
        <td>" . $m['Form'] . "  " . $m['class_name'] . " </td> 
        <td align='center'>";

                if (strlen($m['activity_id']) >= 1) {
                    echo "&#9989;";
                } else {
                    echo "&#10060;";
                }

                echo "</td> 
        
        </tr>";
            }
            echo "</table>";
    }
    ?>
    </table>

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