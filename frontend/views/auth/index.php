<?php

use frontend\models\City;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var object $model ActiveRecord
 * @var object $form ActiveForm
 */
?>
<section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php $form = ActiveForm::begin([
            'successCssClass' => null,
            'options' => ['class' => 'registration__user-form form-create']
        ]);
        ?>
        <?= $form->field($model, 'email', [
            'options' => [
                'class' => 'field-container field-container--registration',
            ],
            'inputOptions' => ['class' => 'input textarea', 'type' => 'email'],
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ])->textInput(['placeholder' => 'example@mail.ru']) ; ?>
        <?= $form->field($model, 'name', [
            'options' => [
                'class' => 'field-container field-container--registration',
            ],
            'inputOptions' => ['class' => 'input textarea'],
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ])->textInput(['placeholder' => 'Иван Иванов']) ; ?>
        <?= $form->field($model, 'city_id', [
            'options' => [
                'class' => 'field-container field-container--registration',
            ],
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ])->dropDownList(City::getCityList(), ['class' => 'multiple-select input town-select registration-town', 'size' => 1]); ?>
        <?= $form->field($model, 'password', [
            'options' => [
                'class' => 'field-container field-container--registration',
            ],
            'labelOptions' => ['class' => 'input-danger'],
            'inputOptions' => ['class' => 'input textarea', 'type' => 'password'],
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ]); ?>

        <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']); ?>

        <?php ActiveForm::end(); ?>
    </div>
</section>
