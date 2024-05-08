<?php
$host = 'localhost';
$dbname = 'postgres';
$username = 'postgres';
$password = 'dbpassword';


try {
  $dataRow = fetchData($host, $dbname, $username, $password);
  $arenaScheduleList = transformDataToObject($dataRow);

} catch(PDOException $e) {
  echo $e->getMessage();
}

function fetchData($host, $dbname, $username, $password) {
  $pdo = new PDO("pgsql:host=$host;dbname=$dbname;", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "
    select distinct on(c.arena_id) l.name, c.json_schedule
    from currentschedule c
      join Arena a on c.arena_id = a.arena_id
      join Location l on a.location_id = l.location_id
    where c.sporttype_id = 1
    order by c.arena_id, c.currentschedule_id desc;
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



