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

    <link rel="stylesheet" href="./styles/var.css" />
    <link rel="stylesheet" href="./styles/reset.css" />
    <link rel="stylesheet" href="./styles/bootstrap-reboot.css"/>
    <link rel="stylesheet" href="./styles/common.css?version=63" />
    <link rel="stylesheet" href="./styles/btn.css" />
    <link rel="stylesheet" href="./styles/burger.css" />
    <link rel="stylesheet" href="./styles/navigation.css?version=4" />
    <link rel="stylesheet" href="./styles/time-list.css" />

    <script defer src="./js/navigation.js" ></script>

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
