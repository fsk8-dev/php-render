<h1>Список катков</h1>
<script>
  document.title = "Список катков";
</script>


<ul class="list-reset list">
  <?php foreach ($location_list as $location): ?>
    <li>
      <a class="link-reset btn-card" href="<?= '/ice-rink-schedule' . '/' . $location->id ?>"><?= $location->name ?></a>
    </li>
  <?php endforeach ?>
</ul>
