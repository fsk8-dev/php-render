<?php
  $arrayFiltered = array_filter($arenaScheduleList, function ($arena) use ($searchArenaName){
    return $arena->arenaName === $searchArenaName;
  });

  $result = array_values($arrayFiltered);

  if(count($arrayFiltered) > 0) {
    $arenaSchedule = $result[0];
  } else {
    $arenaSchedule = null;
  }

  $weekDays = ['', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс']
?>

<?php if(!is_null($arenaSchedule)): ?>

  <h1><?= $arenaSchedule->arenaName ?></h1>

  <?php foreach ($arenaSchedule->scheduleList as $schedule): ?>
    <?php
      $dayDate = new DateTime($schedule->day_date);
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
      <?php foreach ($schedule->day_time_list as $day_time): ?>
        <?php $dayTime = new DateTime($day_time) ?>
        <li class="time-list__item"><?= $dayTime->format('H:i') ?></li>
      <?php endforeach ?>
    </ul>
  <?php endforeach ?>
<?php else: ?>
  <h1><?php $searchArenaName ?></h1>
  <div>Расписание не найдено</div>
<?php endif ?>
