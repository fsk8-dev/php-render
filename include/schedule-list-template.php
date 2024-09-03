<?php
  $weekDays = ['', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс']
?>

<?php if(!is_null($location_schedule) && count($location_schedule->scheduleList) > 0): ?>

  <h1><?= $location_schedule->name ?></h1>

  <?php foreach ($schedule->session as $session): ?>
    <?php
      $dayDate = new DateTime($session->startDate);
      $dayOfWeekNumeric = $dayDate->format('N');
      $weekDay = $weekDays[$dayOfWeekNumeric];
      if(in_array($dayOfWeekNumeric, [6, 7])) {
        $weekEndClass = 'red';
      } else {
        $weekEndClass = '';
      }
    ?>

    <h2 class="date-title <?php echo $weekEndClass ?>" >
      <?= $weekDay ?>
      <?= $dayDate->format('d.m') ?>
    </h2>
    <ul class="time-list list-reset">
      <?php foreach ($session->day_time_list as $day_time): ?>
        <?php $dayTime = new DateTime($day_time) ?>
        <li class="time-list__item"><?= $dayTime->format('H:i') ?></li>
      <?php endforeach ?>
    </ul>
  <?php endforeach ?>
<?php else: ?>
  <h1><?= $searchArenaName?></h1>
  <div>Расписание не найдено или каток на этой неделе не работает</div>
<?php endif ?>
