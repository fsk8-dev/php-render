<?php
include 'secret/config.php';
$host = $SCHEDULE_HOST;
$dbname = $SCHEDULE_DBNAME;
$username = $SCHEDULE_USERNAME;
$password = $SCHEDULE_PASSWORD;


try {
  $dataRow = fetchData($host, $dbname, $username, $password);
  $arenaScheduleList = transformDataToObject($dataRow);

} catch(PDOException $e) {
  echo $e->getMessage();
}

function fetchData($host, $dbname, $username, $password) {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "
    SELECT
      arena_id,
      name,
      json_schedule
    FROM
      (
      SELECT
          c.arena_id,
          l.name,
          c.json_schedule,
          ROW_NUMBER() OVER (PARTITION BY c.arena_id
      ORDER BY
          c.currentschedule_id DESC) AS ROW_NUMBER
      FROM
          CurrentSchedule c
      JOIN Arena a ON
          c.arena_id = a.arena_id
      JOIN Location l ON
          a.location_id = l.location_id
      WHERE
          c.sporttype_id = 1
      ORDER BY
          c.arena_id
    ) subquery
    WHERE
      ROW_NUMBER = 1;
  ";

  $statement = $pdo->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function transformDataToObject($dataRow) {
  $jsonString = json_encode($dataRow);
  $tempListObject = json_decode($jsonString);
  $result = [];

  foreach($tempListObject as $tempObject) {
    $arenaName = $tempObject->name;
    $scheduleList = json_decode($tempObject->json_schedule);
    $arenaSchedule = new ArenaSchedule($arenaName, $scheduleList);
    array_push($result, $arenaSchedule);
  }
  return $result;
}

class ArenaSchedule {
  public $arenaName;
  public $scheduleList;

  public function __construct($arenaName, $scheduleList) {
    $this->arenaName = $arenaName;
    $this->scheduleList = $scheduleList;
  }

}

?>



