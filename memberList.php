<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <title>Daftar Masuk Ahli Baru</title>
  <link rel="stylesheet" href="./style.css" />
  <?php include("connection.php");
  $condb = mysqli_connect("localhost", "root", "", "kehadiran_ahli");
  $instruct_show = "select * from member, class where member.class_id = class.class_id"; ?>
</head>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Daftar Masuk Ahli Baru</title>
  <link rel="stylesheet" href="css/header.css">
  <?php include("connection.php"); ?>
  <?php session_start(); ?>

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

  <!-- Content -->
  <div class="container">
    <h3 class="text-center" align="center">Senarai ahli</h3>
    <table class="table table-bordered">
      <tr bgcolor="#ffffff">
        <td colspan="3">
          <form action="" method="POST" style="margin:0; padding:0; color: #000000;">
            <input type="text" name="search" placeholder="Carian" />
            <input type="submit" value="Cari" />
      </form>
        </td>
        <td colspan="3" align="center">
          | <a href="upload.php">Muat Naik ahli</a> |
        </td>
      </tr>
      <tr bgcolor="#00244D">
        <td style="color: #ffffff; width: 30%;">Nama</td>
        <td style="color: #ffffff; width: 20%;">nokp</td>
        <td style="color: #ffffff; width: 10%;">kelas</td>
        <td style="color: #ffffff; width: 15%;">Katalaluan</td>
        <td style="color: #ffffff; width: 15%;">Tahap</td>
        <td style="color: #ffffff; width: %;">Tindakan</td>
      </tr>

      <?php

      #syarat tambahan yang akan dimasukkan dalam arahan(query) senarai ahli
      $tambahan = "";
      if (!empty($_POST['name'])) {
        $tambahan = "and member.name like '%" . $_POST['name'] . "%'";
      }

      # arahan query untuk mencari senarai nama ahli 
      if (isset($_POST['search']) && !empty($_POST['search'])) {
        $searchTerm = $_POST['search'];
      
        $instruct_show = "select * from member, class 
          where member.class_id = class.class_id 
          and (member.name LIKE '%$searchTerm%' OR member.nokp LIKE '%$searchTerm%' OR class.class_name LIKE '%$searchTerm%')";
      
        $result = mysqli_query($condb, $instruct_show);
      } else {
        $instruct_show = "select * from member, class 
          where member.class_id = class.class_id";
      
        $result = mysqli_query($condb, $instruct_show);
      }

      #laksanakan arahan mencari data ahli
      $implement = mysqli_query($condb, $instruct_show);

      #Mengambil data yang ditemui
      while ($m = mysqli_fetch_array($implement)) {
        #umpukkan data kepada tatasusunan bagi tujuan kemaskini ahli 
        $data_get = array(
          'name' => $m['name'],
          'nokp' => $m['nokp'],
          'password' => $m['password'],
          'level' => $m['level'],
          'class_id' => $m['class_id'],
          'Form' => $m['Form'],
          'class_name' => $m['class_name']

        );

        #memaparkan senarai nama dalam jadual
        echo "<tr>
          <td>" . $m['name'] . "</td>
          <td>" . $m['nokp'] . "</td>
          <td>" . $m['Form'] . " " . $m['class_name'] . "</td>
          <td>" . $m['password'] . "</td>
          <td>" . $m['level'] . "</td> ";

        # memaparkan navigasi untuk kemaskini dan hapus data ahli
        echo "<td>
          |<a href='updatememberForm.php?" . http_build_query($data_get) . "'>
          Kemaskini</a>

          |<a href='deletememberProcess.php?nokp=" . $m['nokp'] . "
          onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\">
          Hapus</a>|

          </td>
          </tr>";
      }

      ?>
    </table>
  </div>

  <!-- Footer -->
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

</html>