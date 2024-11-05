<?php
use yii\helpers\Html;

$this->title = 'Популярные экскурсии и качественные агентства';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => ['tables/top-excursions-and-agencies']]); ?>
  <div class="row">
    <div class="col-md-3">
        <?= Html::label('Фильтр', 'filter', ['class' => 'control-label']) ?>
        <?= Html::radioList('filter', $filter, [
            'popularity' => 'По популярности',
            'rating' => 'По рейтингу агентства',
        ]) ?>
    </div>
    <div class="col-md-3 mt-4">
        <?= Html::submitButton('Применить фильтр', ['class' => 'btn btn-primary']) ?>
    </div>
  </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

<table class="table table-bordered table-hover">
  <thead>
  <tr>
      <?php if ($filter === 'popularity'): ?>
        <th>Название экскурсии</th>
        <th>Агентство</th>
        <th>Рейтинг агентства</th>
        <th>Количество бронирований</th>
      <?php else: ?>
        <th>Агентство</th>
        <th>Рейтинг агентства</th>
        <th>Экскурсии</th>
      <?php endif; ?>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($data as $item): ?>
      <?php if ($filter === 'popularity'): ?>
      <tr>
        <td><?= Html::encode($item['excursion_name']) ?></td>
        <td><?= Html::encode($item['agency_name']) ?></td>
        <td><?= Html::encode($item['rating']) ?></td>
        <td><?= Html::encode($item['booking_count']) ?></td>
      </tr>
      <?php else: ?>
          <?php
          // Разбиваем экскурсии на массив, если они есть
          $excursions = explode(', ', $item['excursions']);
          $rowSpan = count($excursions); // Количество строк для агентства
          ?>
          <?php foreach ($excursions as $index => $excursion): ?>
        <tr>
            <?php if ($index === 0): // Первая строка, выводим агентство и рейтинг ?>
              <td rowspan="<?= $rowSpan ?>"><?= Html::encode($item['agency_name']) ?></td>
              <td rowspan="<?= $rowSpan ?>"><?= Html::encode($item['rating']) ?></td>
            <?php endif; ?>
          <td><?= Html::encode($excursion ?: '-') ?></td>
        </tr>
          <?php endforeach; ?>
      <?php endif; ?>
  <?php endforeach; ?>
  </tbody>
</table>
