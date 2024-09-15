<?php
  $weekDays = ['', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

  if (!is_null($location_schedule)) {
    $arenaName = $location_schedule->name;
  } else {
    $arenaName = '';
  }

?>


<h1><?= $arenaName ?></h1>


<?php if (count($dayScheduleList) > 0) :?>
  <?php foreach ($dayScheduleList as $daySchedule): ?>
    <?php
      $dayDate = $daySchedule->schedule_date;
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
      <?php foreach ($daySchedule->session_list as $session): ?>
        <?php $dayTime = new DateTime($session->startDate) ?>
        <li class="time-list__item"><?= $dayTime->format('H:i') ?></li>
      <?php endforeach ?>
    </ul>
  <?php endforeach ?>
<?php else: ?>
  <div>Расписание не найдено или каток на этой неделе не работает</div>
<?php endif ?>
