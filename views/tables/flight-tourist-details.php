<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Информация о туристах рейса';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/flight-tourist-details'],
    ]); ?>

  <div class="row">
    <div class="col-md-4">
        <?= Html::label('Рейс', 'flight_id', ['class' => 'control-label']) ?>
        <?= Html::dropDownList('flight_id', $flight_id, ArrayHelper::map($flights, 'id', 'flight_number'), [
            'class' => 'form-control',
            'prompt' => 'Выберите рейс',
        ]) ?>
    </div>
    <div class="col-md-4 mt-4">
        <?= Html::submitButton('Показать информацию', ['class' => 'btn btn-primary']) ?>
    </div>
  </div>

    <?php ActiveForm::end(); ?>
</div>

<?php if ($touristDetails): ?>
  <h2>Детали туристов рейса</h2>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Полное имя туриста</th>
      <th>Группа</th>
      <th>Гостиница</th>
      <th>Общее количество мест груза</th>
      <th>Общий вес груза</th>
      <th>Общий объемный вес груза</th>
      <th>Маркировка груза</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($touristDetails as $detail): ?>
      <tr>
        <td><?= Html::encode($detail['full_name']) ?></td>
        <td><?= Html::encode($detail['group_name']) ?></td>
        <td><?= Html::encode($detail['hotel_name']) ?></td>
        <td><?= Html::encode($detail['total_cargo_pieces']) ?></td>
        <td><?= Html::encode($detail['total_cargo_weight']) ?> кг</td>
        <td><?= Html::encode($detail['total_cargo_volume_weight']) ?> м³</td>
        <td><?= Html::encode($detail['cargo_markings']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Нет данных для отображения.</p>
<?php endif; ?>
