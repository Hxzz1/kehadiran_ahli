<html lang="en">

<head>
      <meta charset="UTF-8">
      <title>Daftar Masuk Ahli Baru</title>
      <link rel="stylesheet" href="css/header.css">
      <script src="js/bsound.js"></script>
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
                  <!--taklogin -->
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