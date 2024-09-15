<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  require 'connect/schedule-api-connections.php';

  $request_uri = $_SERVER['REQUEST_URI'];
  if ($request_uri == '/') {
    $request_uri = '/pages/main';
  } elseif (strpos($request_uri, 'ice-rink-schedule') != false) {
    $request_uri = '/pages-template/schedule-page-template';
  } else {
    $request_uri = '/pages' . $request_uri;
  }
  $requested_file = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $request_uri . '.' . 'php';
  $location_list = getLocationList();

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
    <meta property="og:url" content="https://schedule.fsk8.ru/" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="/styles/styles.css?<?= time() ?>">

    <script defer src="/js/navigation.js"></script>

    <title>Расписание катков</title>
  </head>
  <body id="body">
    <div class="container">
      <div class="overlay" id="overlay"></div>
      <?php include 'include/header/header.php';?>
      <?php include 'include/navigation/navigation.php';?>
      <div class="grid">
        <main class="main">
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
