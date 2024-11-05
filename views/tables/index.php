<?php

use yii\helpers\Html;

$tables = [
    ['label' => '1. Список туристов', 'url' => ['tables/tourist']],
    ['label' => '2. Размещение туристов', 'url' => ['tables/accommodation']],
    ['label' => '3. Статистика по странам и туристам', 'url' => ['tables/country-visitors']],
    ['label' => '4. Выбор туриста', 'url' => ['tables/select-tourist']],
    ['label' => '5. Заполняемость гостиниц', 'url' => ['tables/hotel-occupancy']],
    ['label' => '6. Количество туристов на экскурсиях', 'url' => ['tables/excursion-tourists-count']],
    ['label' => '7. Популярные экскурсии и агентства', 'url' => ['tables/top-excursions-and-agencies']],
    ['label' => '8. Загрузка рейсов', 'url' => ['tables/flight-load']],
    ['label' => '9. Статистика склада', 'url' => ['tables/warehouse-statistics']],
    ['label' => '10. Финансовый отчет', 'url' => ['tables/financial-report']],
    ['label' => '11. Отчет за период', 'url' => ['tables/financial-period-report']],
    ['label' => '12. Статистика по грузам', 'url' => ['tables/cargo-statistics']],
    ['label' => '13. Рентабельность представительства', 'url' => ['tables/representational-profitability']],
    ['label' => '14. Соотношение целей поездок туристов', 'url' => ['tables/tourist-purpose-ratio']],
    ['label' => '15. Детали туристов рейса', 'url' => ['tables/flight-tourist-details']],
];

$this->title = 'Запросы и отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="mb-4 text-center"><?= Html::encode($this->title) ?></h1>

<div class="table-buttons d-flex flex-wrap justify-content-center">
    <?php foreach ($tables as $table): ?>
      <div class="m-2">
          <?= Html::a($table['label'], $table['url'], ['class' => 'btn btn-info btn-lg shadow-sm text-white']) ?>
      </div>
    <?php endforeach; ?>
</div>
