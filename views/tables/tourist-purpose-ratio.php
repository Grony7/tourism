<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Процентное отношение целей поездки туристов';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/tourist-purpose-ratio'],
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
        <div class="col-md-3 mt-4">
            <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<h2>Результаты</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Цель поездки</th>
        <th>Количество туристов</th>
        <th>Процент</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= Html::encode($row['trip_purpose']) ?></td>
            <td><?= Html::encode($row['total_tourists']) ?></td>
            <td><?= Html::encode(number_format($row['percentage'], 2)) ?>%</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
