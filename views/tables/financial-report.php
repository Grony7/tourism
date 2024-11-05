<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Финансовый отчет';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/financial-report'],
    ]); ?>

  <div class="row">
    <div class="col-md-3">
        <?= Html::label('Группа', 'group_id', ['class' => 'control-label']) ?>
        <?= Html::dropDownList('group_id', $group_id, ArrayHelper::map($groups, 'id', 'group_name'), [
            'class' => 'form-control',
            'prompt' => 'Выберите группу',
        ]) ?>
    </div>

    <div class="col-md-3 mt-4">
        <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
    </div>
  </div>

    <?php ActiveForm::end(); ?>
</div>

<h2>Финансовый отчет по группе</h2>

<table class="table table-bordered">
  <thead>
  <tr>
    <th>Дата отчета</th>
    <th>Категория</th>
    <th>Сумма</th>
    <th>Тип</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($financialReport as $report): ?>
    <tr>
      <td><?= Html::encode($report['report_date']) ?></td>
      <td><?= Html::encode($report['category']) ?></td>
      <td><?= Html::encode($report['amount']) ?> руб.</td>
      <td><?= Html::encode($report['item_type']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<h3>Итоговые суммы</h3>
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
