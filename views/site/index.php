<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Главная';
?>


<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
      <h1 class="display-4">Юпитер - вариант 13</h1>
      <p>Представительства туристической фирмы в зарубежной стране</p>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        <?= Html::img('@web/images/arbuzik.webp', [
            'alt' => 'Описание изображения',
            'class' => 'img-fluid',
            'style' => 'max-width: 300px; height: auto;'
        ]) ?>
    </div>
</div>
