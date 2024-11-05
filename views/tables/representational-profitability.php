<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Рентабельность представительства';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/representational-profitability'],
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
        <th>Общий доход</th>
        <th>Общий расход</th>
        <th>Рентабельность (%)</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= Html::encode($totalIncome) ?> руб.</td>
        <td><?= Html::encode($totalExpense) ?> руб.</td>
        <td><?= Html::encode($profitability !== null ? $profitability . '%' : 'Неопределена') ?></td>
    </tr>
    </tbody>
</table>
