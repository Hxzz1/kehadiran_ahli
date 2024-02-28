<?php
# Memulakan fungsi session

# Memanggil fail header.php dan fail connection.php
include('connection.php');
session_start();

# Menyemak kewujudan nilai pembolehubah session['nokp']
if (empty($_SESSION['nokp'])) {

  # jika nilai session nokp tidak wujud/kosong. aturcara akan dihentikan
  die("<script>alert('sila login');
   window.location.href='logout.php';</script>");
}
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

  <table height='80%' width='100%' bgcolor='#4292dc' border='1'>
    <tr>
      <td width='70%' align='center' valign='top'>
        <h3>Rekod Kehadiran</h3>

        <!-- Header bagi jadual untuk memaparkan senarai aktiviti -->
        <table align='center' width='100%' border='1' id='saiz' bgcolor='white'>
          <caption>
            Pengesahan Kendiri hanya boleh dilakukan pada tarikh aktiviti dilaksana sahaja
          </caption>
          <tr align='center' bgcolor='#00244D'>
            <td style="color: #ffffff;">Nama Aktiviti</td>
            <td style="color: #ffffff;">Masa</td>
            <td style="color: #ffffff;">Kehadiran</td>
          </tr>
          <?php
          # arahan query untuk mencari senarai Aktiviti
          $instruct_show = "select* from activity";

          # laksanakan arahan mencari data aktiviti
          $implement = mysqli_query($condb, $instruct_show);

          # Mengambil data yang ditemui
          while ($m = mysqli_fetch_array($implement)) {
            # memaparkan senarai nama dalam jadual
            echo "<tr >
             <td>" . $m['activity_name'] . "</td>
             <td>" . $m['activity_date'] . " | " . $m['start_time'] . " </td>
             <td align='center'>";

            # Arahan mendapatkan data kehadiran ahli bagi setiap aktiviti
            $instruct_sql_attendance = "select * from attendance where 
 nokp ='" . $_SESSION['nokp'] . "' and activity_id ='" . $m['activity_id'] . "' ";

            # melaksanakan arahan sql mendapatkan data
            $implement_attendance = mysqli_query($condb, $instruct_sql_attendance);

            if (mysqli_num_rows($implement_attendance) == 1) {
              echo "&#9989;";
            } else {
              echo "&#10060; <br>";

              if (date("Y-m-d") == $m['activity_date']) {
                # Pengesahan Kehadiran Kendiri
                echo "<a href='profile-selfvalidation.php?id_aktiviti=" . $m['activity_id'] . "'>
  [ PENGESAHAN KENDIRI ] </a>";
              }
            }
            echo "</td></tr>";
          } ?>
        </table>

      </td>
      <td align='center' valign='middle '>
        <h3>IMBAS CODE UNTUK SAH KEHADIRAN</h3>
        <p>
          Nama :
          <?= $_SESSION['name'] ?><br>
          Nokp :
          <?= $_SESSION['nokp'] ?><br>
        </p>
        <?PHP

        # mengambil data untuk di jadikan QR code atau bar code
        $data = $_SESSION['nokp'];
        $saiz = "200x200";

        # set umpukkan data API untuk memaparkan QR kod
        $qr_api = "https://chart.googleapis.com/chart?chs=$saiz&cht=qr&chl=" . $data;
        echo "<div align='center'><img width='50%' src='" . $qr_api . "'></div>";
        ?>
        <br>
      </td>
    </tr>
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
</body>