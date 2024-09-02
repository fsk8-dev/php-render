<h1>Список катков</h1>
<script>
  document.title = "Список катков";
</script>

<?php
  $SCHEDULE_BASE_URL = 'https://schedule-api.fsk8.ru/api/locations';
  $json = file_get_contents($SCHEDULE_BASE_URL);
  $location_list = json_decode($json);
?>

<ul class="list-reset list">
  <?php foreach ($location_list as $location): ?>
    <li>
      <a class="link-reset btn-card" href="<?= '/ice-rink' . '/' . $location->id ?>"><?= $location->name ?></a>
    </li>
  <?php endforeach ?>
</ul>
