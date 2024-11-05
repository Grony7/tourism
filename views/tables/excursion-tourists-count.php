<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Туристы, заказавшие экскурсии';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form mb-4">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/excursion-tourists-count'],
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
        <?= Html::a('Сбросить фильтры', ['tables/excursion-tourists-count'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
  </div>
    <?php ActiveForm::end(); ?>
</div>

<?php if (!empty($touristData)): ?>
  <table class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>ФИО</th>
      <th>Экскурсия</th>
      <th>Дата бронирования</th>
      <th>Агентство</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($touristData as $tourist): ?>
      <tr>
        <td><?= Html::encode("{$tourist['surname']} {$tourist['name']} {$tourist['patronymic']}") ?></td>
        <td><?= Html::encode($tourist['excursion_name']) ?></td>
        <td><?= Html::encode(Yii::$app->formatter->asDate($tourist['booking_date'], 'php:d.m.Y')) ?></td>
        <td><?= Html::encode($tourist['agency']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Нет данных за выбранный период.</p>
<?php endif; ?>
