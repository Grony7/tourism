<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Расселение по гостиницам';
$this->params['breadcrumbs'][] = [
    'label' => 'Таблицы',
    'url' => ['tables/index']
];
$this->params['breadcrumbs'][] = 'Расселение';

?>

<h1 class="mb-4">Расселение по гостиницам</h1>

<div class="mb-4 d-flex align-items-center gap-2">
    <?= Html::a('Добавить запись', ['tables/create', 'table' => 'accommodation'], ['class' => 'btn btn-success mr-2']) ?>
    <?= Html::a('Сбросить фильтры', ['tables/accommodation'], ['class' => 'btn btn-outline-secondary']) ?>
</div>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['tables/accommodation']]); ?>
  <div class="row">
    <div class="col-md-3">
        <?= $form->field($searchModel, 'hotel_id')->dropDownList($hotels, ['prompt' => 'Выберите гостиницу'])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($searchModel, 'trip_purpose')->dropDownList([
            '' => 'Категория',
            'Отдых' => 'Отдых',
            'Шопинг' => 'Шопинг',
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
    </div>
  </div>
    <?php ActiveForm::end(); ?>
</div>

<table class="table table-bordered table-hover table-striped">
  <thead class="thead-dark">
  <tr>
    <th>ФИО</th>
    <th>Категория</th>
    <th>Дата заселения</th>
    <th>Дата выселения</th>
    <th>Гостиница</th>
    <th>Номер комнаты</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($accommodations as $accommodation): ?>
    <tr>
      <td><?= Html::encode($accommodation['full_name'] ?? '-') ?></td>
      <td><?= Html::encode($accommodation['trip_purpose'] ?? '-') ?></td>
      <td><?= Html::encode(!empty($accommodation['check_in_date']) ? Yii::$app->formatter->asDate($accommodation['check_in_date'], 'php:d.m.Y') : '-') ?></td>
      <td><?= Html::encode(!empty($accommodation['check_out_date']) ? Yii::$app->formatter->asDate($accommodation['check_out_date'], 'php:d.m.Y') : '-') ?></td>
      <td><?= Html::encode($accommodation['hotel_name'] ?? '-') ?></td>
      <td><?= Html::encode($accommodation['room_number'] ?? '-') ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<div class="pagination-container mt-4">
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'options' => ['class' => 'pagination justify-content-center'],
        'linkContainerOptions' => ['class' => 'page-item'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledPageCssClass' => 'disabled',
        'activePageCssClass' => 'active',
        'prevPageLabel' => '«',
        'nextPageLabel' => '»',
    ]) ?>
</div>
