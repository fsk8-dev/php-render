<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connection/get_schedule.php';

  $request_uri = $_SERVER['REQUEST_URI'];
  if ($request_uri == '/') {
    $request_uri = '/main';
  }
  $requested_file = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/pages' . $request_uri . '.' . 'php';
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">

    <meta property="og:title" content="ЛедоГраф" />
    <meta
      property="og:description"
      content="Расписание всех массовых катаний на одном сайте"
    />
    <meta
      property="og:image"
      content="/img/socials.png"
    />
    <meta name="og:site_name" content="ЛедоГраф - ваш проводник в мире ледовых приключений" />
    <meta property="og:url" content="https://lingvocards.space" />
    <meta name="twitter:card" content="summary_large_image" />

     <link rel="stylesheet" href="/styles/styles.css">

    <script defer src="./js/navigation.js" ></script>
    <script defer src="./js/schedule-connection.js" ></script>

    <title>Расписание катков</title>
  </head>
  <body id="body">
    <div class="container">
      <div class="overlay" id="overlay"></div>
      <div class="grid">
        <?php include 'include/header/header.php';?>
        <main>
          <?php
            if(file_exists($requested_file)) {
              include $requested_file;
            } else {
              include 'pages/not-found.php';
            }
          ?>
        </main>
        <?php include 'include/footer/footer.php';?>
      </div>
    </div>
  </body>
</html>
