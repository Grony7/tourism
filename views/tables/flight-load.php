<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Загрузка рейса';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="flight-load-form">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['tables/flight-load']]); ?>

  <div class="form-group">
      <?= Html::label('Выберите рейс', 'flight-select', ['class' => 'control-label']) ?>
      <?= Html::dropDownList('flight_id', $flightId,
          \yii\helpers\ArrayHelper::map($flights, 'id', 'flight_number'),
          [
              'class' => 'form-control',
              'prompt' => 'Выберите рейс',
          ]
      ) ?>
  </div>

  <div class="form-group">
      <?= Html::label('Дата рейса', 'flight-date', ['class' => 'control-label']) ?>
      <?= Html::input('date', 'flight_date', $flightDate, [
          'class' => 'form-control',
      ]) ?>
  </div>

  <div class="form-group">
      <?= Html::submitButton('Применить фильтр', ['class' => 'btn btn-primary']) ?>
      <?= Html::a('Сбросить фильтры', ['tables/flight-load'], ['class' => 'btn btn-outline-secondary']) ?>
  </div>

    <?php ActiveForm::end(); ?>
</div>

<?php if ($data): ?>
  <h2>Информация о загрузке рейсов</h2>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Номер рейса</th>
      <th>Дата рейса</th>
      <th>Количество мест туристов</th>
      <th>Общий вес груза</th>
      <th>Общий объем груза</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= Html::encode($row['flight_number']) ?></td>
        <td><?= Html::encode(Yii::$app->formatter->asDate($row['flight_date'], 'php:d.m.Y')) ?></td>
        <td><?= Html::encode($row['total_seats']) ?></td> <!-- Количество занятых мест туристами -->
        <td><?= Html::encode($row['total_weight']) ?> кг</td>
        <td><?= Html::encode($row['total_volume_weight']) ?> м³</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Нет данных для выбранных фильтров или рейсов за все время.</p>
<?php endif; ?>
