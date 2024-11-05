<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Статистика грузооборота склада';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['warehouse-statistics']]); ?>
  <div class="row">
    <div class="col-md-3">
        <?= Html::label('Дата начала', 'start_date', ['class' => 'control-label']) ?>
        <?= Html::input('date', 'start_date', $startDate, ['class' => 'form-control']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::label('Дата конца', 'end_date', ['class' => 'control-label']) ?>
        <?= Html::input('date', 'end_date', $endDate, ['class' => 'form-control']) ?>
    </div>
    <div class="col-md-3 mt-4">
        <?= Html::submitButton('Применить фильтр', ['class' => 'btn btn-primary']) ?>
    </div>
  </div>
    <?php ActiveForm::end(); ?>
</div>

<?php if ($query): ?>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Общее количество мест</th>
      <th>Общий вес груза</th>
      <th>Количество рейсов</th>
      <th>Грузовые рейсы</th>
      <th>Грузопассажирские рейсы</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?= Html::encode($query['total_pieces']) ?></td>
      <td><?= Html::encode($query['total_weight']) ?> кг</td>
      <td><?= Html::encode($query['total_flights']) ?></td>
      <td><?= Html::encode($query['cargo_flights']) ?></td>
      <td><?= Html::encode($query['cargo_passenger_flights']) ?></td>
    </tr>
    </tbody>
  </table>
<?php else: ?>
  <p>Нет данных за выбранный период.</p>
<?php endif; ?>
