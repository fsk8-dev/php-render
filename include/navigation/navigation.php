<nav class="nav nav--close" id="nav">
<div class="nav__body box-shadow">
    <h3 class="nav__title">Меню</h3>
    <ul class="nav__list list-reset">
    <?php foreach ($location_list as $location): ?>
      <li class="nav__item">
        <a class="nav__link link-reset" href="<?= '/ice-rink-schedule' . '/' . $location->id ?>"><?= $location->name ?></a>
      </li>
        <?php endforeach ?>
    </ul> <!-- nav__items -->
   </div>
</nav>
