<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <title>Daftar Masuk Ahli Baru</title>
    <link rel="stylesheet" href="./style.css">
    <?php include("connection.php");
    include("header.php") ?>

</head>

<body>


    <body>

        <div class="main">

            <!-- Sign up form -->
            <section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Daftar Ahli Baru</h2>
                            <form action='signupProcess.php' method='POST'>
                                <div class="form-group">
                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="name" id="name" placeholder="Nama Ahli" />
                                </div>
                                <div class="form-group">
                                    <label for="nokp"><i class="zmdi zmdi--assignment-account"></i></label>
                                    <input type="text" name="nokp" id="nokp" placeholder="No Kad Pengenalan" />
                                </div>
                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="pass" id="password" placeholder="Katalaluan" />
                                </div>
                                <div class="form-group">
                                    <select name="class_id" id="id_kelas" class="form-control">
                                        <option value="" disabled selected>Sila Pilih Kelas</option>
                                        <?php
                                        $instruct_sql = "SELECT * FROM class";
                                        $implement_sql = mysqli_query($condb, $instruct_sql);
                                        while ($m = mysqli_fetch_array($implement_sql)) {
                                            echo "<option value='" . $m['class_id'] . "'>" . $m['Form'] . " " . $m['class_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Daftar" />
                                </div>
                            </form>
                        </div>
                        <div class="signup-image">
                            <figure><img src="src/signup.png" alt="sing up image" width="500"></figure>
                            <a href="loginForm.php" class="signup-image-link">Sudah Menjadi Ahli?</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
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

</html>