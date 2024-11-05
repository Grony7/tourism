<?php
use yii\helpers\Html;

$this->title = "Информация о туристе: {$name}, Дата рождения: {$birth_date}";
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Информация о туристе: <?= Html::encode("$surname $name $patronymic") ?>, Дата рождения: <?= Html::encode($birth_date) ?></h1>

<?php foreach ($countryVisits as $countryData): ?>
  <h2>Страна: <?= Html::encode($countryData['country']) ?></h2>
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
      <th>Количество посещений</th>
      <th>Дата прибытия</th>
      <th>Дата отбытия</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $arrivalDates = explode(',', $countryData['arrival_dates']);
    $departureDates = explode(',', $countryData['departure_dates']);
    ?>
    <?php for ($i = 0; $i < count($arrivalDates); $i++): ?>
      <tr>
          <?php if ($i === 0): ?>
            <td rowspan="<?= count($arrivalDates) ?>"><?= Html::encode($countryData['visit_count']) ?></td>
          <?php endif; ?>
        <td><?= Html::encode($arrivalDates[$i]) ?></td>
        <td><?= Html::encode($departureDates[$i] ?? '-') ?></td>
      </tr>
    <?php endfor; ?>
    </tbody>
  </table>

  <h3>Гостиницы</h3>
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
      <th>Название</th>
      <th>Дата заселения</th>
      <th>Дата выселения</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($hotels as $hotel): ?>
        <?php if ($hotel['country'] === $countryData['country']): ?>
        <tr>
          <td><?= Html::encode($hotel['hotel_name'] ?: '-') ?></td>
          <td><?= Html::encode($hotel['check_in_dates'] ?: '-') ?></td>
          <td><?= Html::encode($hotel['check_out_dates'] ?: '-') ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Экскурсии</h3>
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
      <th>Название</th>
      <th>Агентство</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($excursions as $excursion): ?>
        <?php if ($excursion['country'] === $countryData['country']): ?>
        <tr>
          <td><?= Html::encode($excursion['excursion_name'] ?: '-') ?></td>
          <td><?= Html::encode($excursion['excursion_agency'] ?: '-') ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Груз</h3>
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
      <th>Маркировка</th>
      <th>Количество мест</th>
      <th>Вес (кг)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cargo as $item): ?>
        <?php if ($item['country'] === $countryData['country']): ?>
        <tr>
          <td><?= Html::encode($item['cargo_markings'] ?: '-') ?></td>
          <td><?= Html::encode($item['cargo_pieces'] ?: '-') ?></td>
          <td><?= Html::encode($item['cargo_weight'] ?: '-') ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
  </table>

  <hr>
<?php endforeach; ?>
