<?php
require 'connect/schedule-api-connections.php';
require 'classes/day-schedule-list.php';
$ICE_RINK_ARENA_TYPE_ID = 1;
$SKATING_TYPE_SCHEDULE_ID = 1;

$uri = $_SERVER['REQUEST_URI'];
$uri_list = explode('/', $uri);
$location_index = $uri_list[count($uri_list) - 1];

$location_schedule = getLocationSchedule($location_index);
$session_list = getSessionList($location_schedule);
$dayScheduleList = getDayScheduleList($session_list);

function getSessionList($location_schedule) {
  global $ICE_RINK_ARENA_TYPE_ID;
  global $SKATING_TYPE_SCHEDULE_ID;

  $arena_schedule_list = array_filter($location_schedule->arenas, function ($arena) use ($ICE_RINK_ARENA_TYPE_ID) {
    return $arena->arenaTypeId == $ICE_RINK_ARENA_TYPE_ID;
  });

  $schedule_list = $arena_schedule_list[0]->schedules;

  $schedule_list = array_filter($schedule_list, function ($schedule) use ($SKATING_TYPE_SCHEDULE_ID) {
    return $schedule->scheduleTypeId == $SKATING_TYPE_SCHEDULE_ID;
  });
  $session_list = $schedule_list[0]->session;

  return $session_list;
}

// NOTE попробовал сделать поиск по алгоритму "разделяй и властвуй"
$data = array(); // Инициализация как пустой массив
function getDayScheduleList($session_list) {
    global $location_schedule;
    global $data;

    if (count($session_list) == 0) {
        return $data;
    } else {
        $day_date = new DateTime($session_list[0]->startDate);
        $timestamp = getTimeStamp($day_date);
        $key = $timestamp;

        if(!is_array($data) || !array_key_exists($key, $data)) {
            $daySchedule = new DaySchedule($location_schedule->name, $day_date);
            $data[$key] = $daySchedule;
        }

        $iStart = count($session_list);

        $iCurrent = $iStart;
        $nextTimeStamp = getTimeStamp(new DateTime($session_list[floor($iStart / 2)]->startDate));

        while ($timestamp != $nextTimeStamp) {
            $iCurrent = floor($iCurrent / 2);
            $nextTimeStamp = getTimeStamp(new DateTime($session_list[$iCurrent]->startDate));
        }

        if ($iCurrent == 0) {
            $iCurrent = 1;
        }

        addSession($key, $iCurrent, $session_list);


        $newList = array_slice($session_list, $iCurrent);
        getDayScheduleList($newList);
    }
    return $data;
}

function addSession($key, $iCurrent, $originalList ) {
    global $data;

    $pushList = array_slice($originalList, 0, $iCurrent);
    if (count($data[$key]->session_list) == 0) {
        $mergeList = $pushList;
    } else {
        $mergeList = array_merge($data[$key]->session_list, $pushList);
    }

    $data[$key]->session_list = $mergeList;
}

function getTimeStamp($date) {
  $timestamp = new DateTime($date->format('Y-m-d'));
  $timestamp = $timestamp->getTimestamp();
  return $timestamp;
};

?>

<?php  include rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/include/schedule-list-template.php'; ?>



