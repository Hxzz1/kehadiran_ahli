<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Sistem Merekod Kehadiran Murid</title>
   <link rel="stylesheet" href="./style.css">
   <?php
   if (file_exists("header.php")) {
      include("header.php");
   } else {
      echo "Error: The header.php file does not exist.";
   }
   ?>

</head>


<!-- set header -->

<body>

   <header class="mainHeading">
      <div class="mainHeading__content">
         <article class="mainHeading__text">
            <p class="mainHeading__preTitle">Selamat Datang ke Kelab</p>
            <h2 class="mainHeading__title">Bahasa Melayu</h2>
            <a class="cta" href="signupForm.php">Belum mendaftar? klik sini</a>
         </article>

         <figure class="mainHeading__image">
            <img src="src/DBP.jpg" alt="" />
         </figure>
      </div>
   </header>
   <!-- partial -->
   <script src='https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js'></script>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.js'></script>
   <script src="./script.js"></script>

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