<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Занятость гостиниц';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/hotel-occupancy'],
    ]); ?>
  <div class="row">
    <div class="col-md-3">
        <?= Html::label('Дата начала', 'startDate', ['class' => 'control-label']) ?>
        <?= Html::input('date', 'startDate', $startDate, ['class' => 'form-control']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::label('Дата конца', 'endDate', ['class' => 'control-label']) ?>
        <?= Html::input('date', 'endDate', $endDate, ['class' => 'form-control']) ?>
    </div>
    <div class="col-12 d-flex gap-2 mt-2">
        <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить фильтры', ['tables/hotel-occupancy'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
  </div>
    <?php ActiveForm::end(); ?>
</div>


<table class="table table-bordered table-hover">
  <thead>
  <tr>
    <th>Гостиница</th>
    <th>Количество занятых номеров</th>
    <th>Количество туристов</th>
  </tr>
  </thead>
  <tbody>
  <?php if (!empty($occupancyData)): ?>
      <?php foreach ($occupancyData as $data): ?>
      <tr>
        <td><?= Html::encode($data['hotel_name']) ?></td>
        <td><?= Html::encode($data['occupied_rooms']) ?></td>
        <td><?= Html::encode($data['tourists_count']) ?></td>
      </tr>
      <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="3" class="text-center">Нет данных за выбранный период</td>
    </tr>
  <?php endif; ?>
  </tbody>
</table>
