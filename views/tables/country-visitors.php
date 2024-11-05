<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Количество туристов по странам';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['tables/country-visitors']]); ?>
  <div class="row">
    <div class="col-md-3">
        <?= $form->field($searchModel, 'country')->dropDownList($countries, ['prompt' => 'Выберите страну'])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($searchModel, 'trip_purpose')->dropDownList($tripPurposes, ['prompt' => 'Категория'])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($searchModel, 'start_date')->input('date')->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($searchModel, 'end_date')->input('date')->label(false) ?>
    </div>
    <div class="col-12 d-flex gap-2 mt-2"> <!-- Изменено на d-flex и gap-2 -->
        <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить фильтры', ['tables/country-visitors'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
  </div>
    <?php ActiveForm::end(); ?>
</div>

<p><strong>Общее количество туристов: <?= $totalVisitorsCount ?></strong></p>

<table class="table table-bordered table-hover">
  <thead>
  <tr>
    <th>Страна</th>
    <th>ФИО</th>
    <th>Категория поездки</th>
    <th>Дата прибытия</th>
    <th>Дата отбытия</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($visitors as $visitor): ?>
    <tr>
      <td><?= Html::encode($visitor['country']) ?></td>
      <td><?= Html::encode($visitor['full_name']) ?></td>
      <td><?= Html::encode($visitor['trip_purpose']) ?></td>
      <td><?= Html::encode(Yii::$app->formatter->asDate($visitor['arrival_date'], 'php:d.m.Y')) ?></td>
      <td><?= Html::encode(Yii::$app->formatter->asDate($visitor['departure_date'], 'php:d.m.Y')) ?></td>
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
    ]) ?>
</div>
