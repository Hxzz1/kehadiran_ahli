<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header dan fail kawalan-admin.php
include('admincontrol.php');
include('connection.php');

# Menyemak kewujudan data GET. Jika data GET empty, buka fail senarai-ahli
if (empty($_GET)) {
    die("<script>window.location.href='senarai-ahli.php';</script>");
}
?>


<!-- header -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>apdet profile brader</title>
    <link rel="stylesheet" href="css/memberform.css">
    <link rel="stylesheet" href="css/header.css">

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

    <h3 style="text-align: center;">kemaskini ahli Baru</h3>
    <form action='updatememberProcess.php?old_nokp=<?= $_GET['nokp'] ?>' method='POST'>
        nama
        <input type='text' name='name' value='<?= $_GET['name'] ?>' required><br>

        nokp
        <input type='text' name='nokp' value='<?= $_GET['nokp'] ?>' required><br>

        katalaluan
        <input type='text' name='password' value='<?= $_GET['password'] ?>' required><br>

        Tahap
        <select name='level'><br>
            <option value='<?= $_GET['level'] ?>'>
                <?= $_GET['level'] ?>
                <script src="js/dropdown.js"></script>
            </option>
            <?php
            # Proses memaparkan senarai tahap dalam bentuk drop down list
            $instruct_sql_level = "select level from member group by level order by level";
            $implement_instruct_level = mysqli_query($condb, $instruct_sql_level);
            while ($n = mysqli_fetch_array($implement_instruct_level)) {
                if ($n['level'] != $_GET['level']) {
                    echo "<option value='" . $n['level'] . "'>
       " . $n['level'] . "
       </option>";
                }
            }
            ?>
        </select> <br>

        Tingkatan
        <select name='class_id'><br>
            <option value='<?= $_GET['class_id'] ?>'>
                <?= $_GET['Form'] . " " . $_GET['class_name'] ?>
            </option>
            <?php
            # Proses memaparkan senarai kelas dalam bentuk drop down 1ist
            $instruct_sql_choose = "select* from class";
            $implement_instruct_choose = mysqli_query($condb, $instruct_sql_choose);
            while ($m = mysqli_fetch_array($implement_instruct_choose)) {
                if ($m['class_id'] != $_GET['class_id']) {
                    echo "<option value='" . $m['class_id'] . "'>
           " . $m['Form'] . " " . $m['class_name'] . "
         </option>";
                }
            }
            ?>
        </select> <br>

        <input type='submit' value='Kemas kini'>
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