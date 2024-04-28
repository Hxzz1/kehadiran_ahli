<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <title>Log Masuk ajh</title>
    <link rel="stylesheet" href="css/header.css">
    <?php include("connection.php");
    include("header.php") ?>

</head>

<body>

    <body>

        <div class="main">
            <!-- Sing in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="src/welkamBek.png" alt="sing up image"></figure>
                            <a href="signupForm.php" class="signup-image-link">Belum Menjadi Ahli?</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Log masuk</h2>
                            <form action='loginProcess.php' method='POST'>
                                <div class="form-group">
                                    <label for="nokp"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="nokp" placeholder="No Kad Pengenalan" />
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="password" placeholder="password" />
                                </div>>
                                <div class="form-group form-button">
                                    <input type="submit" name="signin" id="signin" class="form-submit"
                                        value="Log Masuk" />
                                </div>
                            </form>
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