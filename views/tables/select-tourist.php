<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Выбор туриста';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы', 'url' => ['tables/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="tourist-select-form">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['tables/tourist-details'],
    ]); ?>

  <div class="form-group">
      <?= Html::label('Выберите туриста', 'tourist-select', ['class' => 'control-label']) ?>
      <?= Html::dropDownList('tourist', null,
          \yii\helpers\ArrayHelper::map($tourists, function($tourist) {
              // Формируем value для option с параметрами, разделенными |
              return $tourist['name'] . '|' . $tourist['surname'] . '|' . $tourist['patronymic'] . '|' . $tourist['birth_date'];
          }, 'full_name'),
          [
              'class' => 'form-control',
              'prompt' => 'Выберите туриста',
              'onchange' => '
                    const selectedOption = this.options[this.selectedIndex].value;
                    if (selectedOption) {
                        const [name, surname, patronymic, birth_date] = selectedOption.split("|");
                        document.getElementById("tourist-name").value = name;
                        document.getElementById("tourist-surname").value = surname;
                        document.getElementById("tourist-patronymic").value = patronymic;
                        document.getElementById("tourist-birth_date").value = birth_date;
                    } else {
                        document.getElementById("tourist-name").value = "";
                        document.getElementById("tourist-surname").value = "";
                        document.getElementById("tourist-patronymic").value = "";
                        document.getElementById("tourist-birth_date").value = "";
                    }
                '
          ])
      ?>
  </div>

    <?= Html::hiddenInput('name', '', ['id' => 'tourist-name']) ?>
    <?= Html::hiddenInput('surname', '', ['id' => 'tourist-surname']) ?>
    <?= Html::hiddenInput('patronymic', '', ['id' => 'tourist-patronymic']) ?>
    <?= Html::hiddenInput('birth_date', '', ['id' => 'tourist-birth_date']) ?>

  <div class="form-group">
      <?= Html::submitButton('Показать сведения', ['class' => 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>
</div>
