<?php
class DaySchedule {
  public $arena_name;
  public $schedule_date;
  public $session_list = array();

  public function __construct($arena_name, $schedule_date) {
    $this->arena_name = $arena_name;
    $this->schedule_date = $schedule_date;
  }

  public function addSession($session) {
    array_push($this->session_list, $session);
  }
}

?>
