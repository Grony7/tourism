<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Финансовый отчет за период';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/financial-period-report'],
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

<h2>Финансовый отчет за указанный период</h2>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Категория</th>
        <th>Тип</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($financialItems as $item): ?>
        <tr>
            <td><?= Html::encode($item['report_date']) ?></td>
            <td><?= Html::encode($item['category']) ?></td>
            <td><?= Html::encode($item['item_type']) ?></td>
            <td><?= Html::encode($item['amount']) ?> руб.</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Итоговые суммы по категориям</h3>

<h4>Доходы по категориям</h4>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Категория</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($incomeByCategory as $category => $amount): ?>
        <tr>
            <td><?= Html::encode($category) ?></td>
            <td><?= Html::encode($amount) ?> руб.</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h4>Расходы по категориям</h4>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Категория</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($expenseByCategory as $category => $amount): ?>
        <tr>
            <td><?= Html::encode($category) ?></td>
            <td><?= Html::encode($amount) ?> руб.</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Итоговые суммы за период</h3>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Общий доход</th>
        <th>Общий расход</th>
        <th>Общая прибыль</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= Html::encode($totalIncome) ?> руб.</td>
        <td><?= Html::encode($totalExpense) ?> руб.</td>
        <td><?= Html::encode($totalProfit) ?> руб.</td>
    </tr>
    </tbody>
</table>
