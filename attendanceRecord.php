<?php
# memulakan fungsi session 
session_start();

# memanggil fail luaran dan istihar pemboleh ubah. 
include('admincontrol.php');
include('connection.php');
$status = ""; # digunakan untuk memaparkan status kehadiran 
$warna = "";  # digunakan untuk warna latar belakang status 


# Menyemak kewujudan data GET['id_aktiviti']
if (!empty($_GET['activity_id'])) {
  # Proses mendapatkan data aktiviti
  $sql_activity = "select* from activity where activity_id = '" . $_GET['activity_id'] . "'";
  $implement_activity = mysqli_query($condb, $sql_activity);
  $ma = mysqli_fetch_array($implement_activity);
}
?>

<!-- set header -->
<html lang="en">
<div class="header">

  <head>
    <meta charset="UTF-8">
    <title>Rekod Kehadiran</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/activityList1.css">
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
</div>



<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/style.css">
</head>

<!-- overlap fix-->
<br><br><br>
<!-- end header -->

<h1 align='center'>Laman Rekod Kehadiran Kaunter Urusetia</h1>
<h3 align='center'>
  <!-- Boarang carian Aktiviti -->
  <form action='' method='GET'>
    Aktiviti <select name='activity_id'>
      <option selected disabled value>Sila Pilih Aktiviti</option>

      <?php
      # Proses memaparkan senarai aktiviti dalam bentuk drop down list
      $instruct_sql_choose = "select* from activity";
      $implement_instruct_do = mysqli_query($condb, $instruct_sql_choose);
      while ($n = mysqli_fetch_array($implement_instruct_do)) {
        echo "<option value='" . $n['activity_id'] . "'>
                  " . $n['activity_id'] . " | " . $n['activity_name'] . "
                  </option>";
      }
      ?>
    </select>

    <input type='submit' value='Cari'>
  </form>

  <?php if (!empty($_GET['activity_id'])) { ?>
    <!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
    <?= $ma['activity_name'] ?><br>
    <?= $ma['activity_date'] ?> |
    <?= $ma['start_time'] ?><br>
        Masukkan / Imbas Nokp / KOD anda di sini<br>
    <div class="search-form">
            <form action="" method="POST">
                <input type="text" name="activity_name" placeholder="Carian aktiviti">
                <input type="submit" value="Cari">
            </form>
        </div>

    <?php
    $time = date("H:i:s");
    # menyemak kewujudan data POST 
    if (!empty($_POST['nokp'])) {


      # menyemak adakah nokp yang dimasukkan telah wujud dalam pangkalan data 
      $instruct_sql_check = "select* from member where nokp = '" . $_POST['nokp'] . "'
  ";
      $implement_sql_check = mysqli_query($condb, $instruct_sql_check);
      if (mysqli_num_rows($implement_sql_check) != 1) {
        # jika nokp yang dimasukkan telah wujud. 
        echo "<div class='error-msg'>";
        echo "  <i class='fa fa-times-circle'></i>";
        echo "  No Kad Pengnalan tiada dalam sistem";
        echo "</div>";
      } else {
        # Proses Menyemak nokp yang dimasukan telah merekodkan kehadiran atau tidak 
        $instruct_check = "select* from attendance where nokp='" . $_POST['nokp'] . "' and activity_id ='" . $_GET['activity_id'] . "' limit 1";

        $implement_instruct = mysqli_query($condb, $instruct_check);
        if (mysqli_num_rows($implement_instruct) == 1) {
          echo "<div class='error-msg'>";
          echo "  <i class='fa fa-times-circle'></i>";
          echo "  Anda telah mengesahkan kehadiran";
          echo "</div>";

        } else {

          # Proses Menyimpan data kehadiran 
          $savedata = mysqli_query($condb, "insert into attendance 
      (nokp,activity_id,attendance_time) values 
      ('" . $_POST['nokp'] . "','" . $_GET['activity_id'] . "','$time') ");

          # menyemak adakah proses menyimpan data berjaya 
          if ($savedata) {
            echo "<div class='error-msg'>";
            echo "  <i class='fa fa-times-circle'></i>";
            echo "  Berjaya Direkod!";
            echo "</div>";
          } else {
            echo "<div class='error-msg'>";
            echo "  <i class='fa fa-times-circle'></i>";
            echo "  Kehadiran gagal direkod";
            echo "</div>";
          }
        }
      }
    } ?>

    <div class="container">
      <table class="table table-bordered">
        <thead>
          <tr bgcolor="#00244D">
            <td style="color: #ffffff; width: 10%;">Bil</td>
            <td style="color: #ffffff; width: 50%;">Nama</td>
            <td style="color: #ffffff; width: 5%;">Nokp</td>
            <td style="color: #ffffff; width: 20%;">Kelas</td>
            <td style="color: #ffffff; width: 20%;">Masa Hadir</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $bil = 0;

          # Proses untuk memaparkan data kehadiran dalam bentuk jadual
          $instruct_sql_attendance = "select* from member, activity, attendance, class
            where 
                member.nokp               =   attendance.nokp
            and member.class_id           =   class.class_id
            and activity.activity_id    =   attendance.activity_id
            and attendance.activity_id   =   '" . $_GET['activity_id'] . "' 
            order by attendance.attendance_time DESC";

          $implement_attendance = mysqli_query($condb, $instruct_sql_attendance);

          while ($m = mysqli_fetch_array($implement_attendance)) {
            echo "  <tr>
                        <td>" . ++$bil . "</td>
                        <td>" . $m['name'] . "</td>
                        <td>" . $m['nokp'] . "</td>
                        <td>" . $m['Form'] . " " . $m['class_name'] . "</td>
                        <td>" . $m['attendance_time'] . "</td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  <?php } ?>

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