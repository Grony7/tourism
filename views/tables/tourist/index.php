<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\models\Tourist;
use app\models\TouristGroup;

$touristModel = new Tourist;
$touristGroupModel = new TouristGroup;

$this->params['breadcrumbs'][] = [
    'label' => 'Таблицы',
    'url' => ['tables/index']
];
$this->params['breadcrumbs'][] = 'Туристы';

function formatPassportData($passportData)
{
    return preg_replace('/(\d{4})(\d{4})/', '$1 $2', $passportData);
}
?>

  <h1 class="mb-4">Туристы</h1>

  <div class="mb-4 d-flex align-items-center gap-2">
      <?= Html::a('Добавить туриста', ['tables/create', 'table' => 'tourist'], ['class' => 'btn btn-success mr-2']) ?>
      <?= Html::button('Применить фильтры', ['class' => 'btn btn-primary mr-2', 'id' => 'apply-filters-btn']) ?>
      <?= Html::a('Сбросить', ['tables/tourist'], ['class' => 'btn btn-outline-secondary']) ?>
  </div>

  <div class="filter-form mb-4">
      <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['tables/tourist'], 'id' => 'filter-form']); ?>
    <div class="row">
      <div class="col-md-3">
          <?= $form->field($searchModel, 'gender')->dropDownList([
              '' => 'Пол',
              'Мужской' => 'Мужской',
              'Женский' => 'Женский',
          ], ['class' => 'form-control'])->label(false) ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'trip_purpose')->dropDownList([
              '' => 'Категория',
              'Отдых' => 'Отдых',
              'Шопинг' => 'Шопинг',
          ], ['class' => 'form-control'])->label(false) ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'has_children')->dropDownList([
              '' => 'Дети',
              '1' => 'Да',
              '0' => 'Нет',
          ], ['class' => 'form-control'])->label(false) ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'group_id')->dropDownList($groups, ['prompt' => 'Группа', 'class' => 'form-control'])->label(false) ?>
      </div>
    </div>
      <?php ActiveForm::end(); ?>
  </div>

  <table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
    <tr>
      <th>ФИО</th>
      <th>Паспортные Данные</th>
      <th>Пол</th>
      <th>Дата Рождения</th>
      <th>Категория</th>
      <th>Наличие Детей</th>
      <th>Название Группы</th>
      <th>Дата Прибытия</th>
      <th>Дата Отъезда</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tourists as $tourist): ?>
      <tr class="<?= $tourist->has_children ? 'table-success' : '' ?>">
        <td><strong><?= Html::encode($tourist->surname . ' ' . $tourist->name . ' ' . $tourist->patronymic) ?></strong></td>
        <td><?= Html::encode(formatPassportData($tourist->passport_data)) ?></td>
        <td><?= Html::encode($tourist->gender) ?></td>
        <td><?= Html::encode(Yii::$app->formatter->asDate($tourist->birth_date, 'php:d.m.Y')) ?></td>
        <td><?= Html::encode($tourist->trip_purpose) ?></td>
        <td><?= $tourist->has_children ? '<span class="badge bg-primary">Да</span>' : '<span class="badge bg-secondary">Нет' ?></td>
        <td><?= Html::encode($tourist->group ? $tourist->group->group_name : '-') ?></td>
        <td><?= Html::encode($tourist->group ? Yii::$app->formatter->asDate($tourist->group->arrival_date, 'php:d.m.Y') : '-') ?></td>
        <td><?= Html::encode($tourist->group ? Yii::$app->formatter->asDate($tourist->group->departure_date, 'php:d.m.Y') : '-') ?></td>
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

<?php
// JavaScript для применения фильтров
$this->registerJs(" 
    $(document).ready(function() {
        $('#apply-filters-btn').on('click', function() {
            $('#filter-form').submit();
        });
    });
");
