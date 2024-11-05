<?php

use yii\helpers\Html;

$this->title = 'Статистика по видам груза';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<h2>Общая информация</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Общий вес груза</th>
        <th>Общий объемный вес груза</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= Html::encode($totalWeight) ?> кг</td>
        <td><?= Html::encode($totalVolumeWeight) ?> м³</td>
    </tr>
    </tbody>
</table>

<h2>Детальная статистика по видам груза</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Тип груза</th>
        <th>Общий вес</th>
        <th>Объемный вес</th>
        <th>Доля по весу (%)</th>
        <th>Доля по объему (%)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cargoStatistics as $cargo): ?>
        <tr>
            <td><?= Html::encode($cargo['type']) ?></td>
            <td><?= Html::encode($cargo['total_weight']) ?> кг</td>
            <td><?= Html::encode($cargo['total_volume_weight']) ?> м³</td>
            <td><?= Html::encode($cargo['weight_percentage']) ?> %</td>
            <td><?= Html::encode($cargo['volume_percentage']) ?> %</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
