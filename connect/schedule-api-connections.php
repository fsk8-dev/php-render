<?php
$SCHEDULE_BASE_URL = 'https://schedule-api.fsk8.ru/api/';

function getLocationList() {
  global $SCHEDULE_BASE_URL;
  $json = file_get_contents($SCHEDULE_BASE_URL . 'locations');
  $location_list = json_decode($json);
  return $location_list;
}

function getLocation($location_id) {
  global $SCHEDULE_BASE_URL;
  $json = file_get_contents($SCHEDULE_BASE_URL . 'locations/' . $location_id);
  $location = json_decode($json);
  return $location;
}

function getLocationSchedule($location_id) {
  global $SCHEDULE_BASE_URL;
  $json = file_get_contents($SCHEDULE_BASE_URL . 'location-schedules/' . $location_id);
  $location_schedule = json_decode($json);
  return $location_schedule;
}
?>
