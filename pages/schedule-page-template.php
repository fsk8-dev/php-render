<?php
require 'connect/schedule-api-connections.php';
$ICE_RINK_ARENA_TYPE_ID = 1;
$SKATING_TYPE_SCHEDULE_ID = 1;

$uri = $_SERVER['REQUEST_URI'];
$uri_list = explode('/', $uri);
$location_index = $uri_list[count($uri_list) - 1];

$location_schedule = getLocationSchedule($location_index);

$arena_schedule_list = array_filter($location_schedule->arenas, function ($arena) use ($ICE_RINK_ARENA_TYPE_ID) {
  return $arena->arenaTypeId == $ICE_RINK_ARENA_TYPE_ID;
});

$schedule_list = $arena_schedule_list[0]->schedules;

$schedule_list = array_filter($schedule_list, function ($schedule) use ($SKATING_TYPE_SCHEDULE_ID) {
  return $schedule->scheduleTypeId == $SKATING_TYPE_SCHEDULE_ID;
});
$schedule = $schedule_list[0];
var_dump($schedule);
?>

<?php #   include rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/include/schedule-list-template.php'; ?>



