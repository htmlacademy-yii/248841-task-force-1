<?php

use frontend\assets\CreateAsset;
use frontend\models\Category;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var object $model CreateTask
 */

CreateAsset::register($this);
?>

<section class="create__task">
    <h1>Публикация нового задания</h1>
    <div class="create__task-main">
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'create__task-form form-create'
            ],
            'enableAjaxValidation' => true,
            'id' => 'createForm',
            'validateOnBlur' => false,
            'validateOnChange' => false,
        ]); ?>
        <?= $form->field($model, 'title', [
            'options' => [
                'class' => 'field-container',
            ],
            'template' => "{label}\n{input}\n" . Html::tag('span', 'Кратко опишите суть работы')
        ])->textInput([
            'class' => 'input textarea',
            'placeholder' => 'Повесить полку'
        ]); ?>
        <?= $form->field($model, 'description', [
            'options' => [
                'class' => 'field-container',
            ],
            'template' => "{label}\n{input}\n" . Html::tag('span', 'Укажите все пожелания и детали, чтобы исполнителям было проще соориентироваться')
        ])->textArea([
            'rows' => '7',
            'class' => 'input textarea',
            'placeholder' => 'Place your text'
        ]) ?>
        <?= $form->field($model, 'category', [
            'options' => [
                'class' => 'field-container',
            ],
            'template' => "{label}\n{input}\n" . Html::tag('span', 'Выберите категорию')
        ])->dropDownList(Category::getCategorisList(), ['class' => 'multiple-select input multiple-select-big']); ?>
        <div class="field-container">
            <label>Файлы</label>
            <span>Загрузите файлы, которые помогут исполнителю лучше выполнить или оценить работу (не&nbsp;больше&nbsp;5&nbsp;шт., максимальный&nbsp;размер&nbsp;файла&nbsp;10MB)</span>
            <div class="create__file dropzone-custom">
            </div>
        </div>
        <?= $form->field($model, 'location')->label(false)->hiddenInput(); ?>
        <?= $form->field($model, 'address', [
            'options' => [
                'class' => 'field-container',
            ],
            'template' => "{label}\n{input}\n" . Html::tag('span', 'Укажите адрес исполнения, если задание требует присутствия')
        ])->textInput([
            'class' => 'input-navigation input-middle input',
            'placeholder' => 'Санкт-Петербург, Калининский район',
            'id'=> 'address'
        ]); ?>

        <div class="create__price-time">
            <?= $form->field($model, 'price', [
                'options' => [
                    'class' => 'field-container create__price-time--wrapper',
                ],
                'template' => "{label}\n{input}\n" . Html::tag('span', 'Не заполняйте для оценки исполнителем')
            ])->textInput([
                'class' => 'input textarea input-money',
                'placeholder' => '1000'
            ]); ?>
            <?= $form->field($model, 'deadline', [
                'options' => [
                    'class' => 'field-container create__price-time--wrapper',
                ],
                'template' => "{label}\n{input}\n" . Html::tag('span', 'Укажите крайний срок исполнения')
            ])->widget(DatePicker::classname(), [
                'language' => 'ru',
                'options' => [
                    'class' => 'input-middle input input-date',
                    'placeholder' => '25.03.2021',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]) ?>
        </div>
        <?= Html::submitButton('Опубликовать', ['class' => 'button']); ?>

        <?php ActiveForm::end(); ?>

        <div class="create__warnings">
            <div class="warning-item warning-item--advice">
                <h2>Правила хорошего описания</h2>
                <h3>Подробности</h3>
                <p>Друзья, не используйте случайный<br>
                    контент – ни наш, ни чей-либо еще. Заполняйте свои
                    макеты, вайрфреймы, мокапы и прототипы реальным
                    содержимым.</p>
                <h3>Файлы</h3>
                <p>Если загружаете фотографии объекта, то убедитесь,
                    что всё в фокусе, а фото показывает объект со всех
                    ракурсов.</p>
            </div>
            <div class="warning-item warning-item--error" style="display: none;">
                <h2>Ошибки заполнения формы</h2>
            </div>
        </div>
    </div>
</section>


