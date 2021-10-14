<?php

use frontend\models\City;
use rmrevin\yii\ulogin\ULogin;
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
        ])->textInput(['placeholder' => 'example@mail.ru']); ?>
        <?= $form->field($model, 'name', [
            'options' => [
                'class' => 'field-container field-container--registration',
            ],
            'inputOptions' => ['class' => 'input textarea'],
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ])->textInput(['placeholder' => 'Иван Иванов']); ?>
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
            'errorOptions' => [
                'class' => 'registration__text-error',
                'tag' => 'span'
            ]
        ])->passwordInput(['class' => 'input textarea']); ?>
        <div class="auth-buttons">
            <?= Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration']); ?>
            <span>Регистрация<br>через:</span>
            <?= ULogin::widget([
                // widget look'n'feel
                'display' => ULogin::D_PANEL,

                // required fields
                'fields' => [ULogin::F_FIRST_NAME, ULogin::F_LAST_NAME, ULogin::F_EMAIL, ULogin::F_CITY],

                // optional fields
                'optional' => [ULogin::F_BDATE],

                // login providers
                'providers' => [ULogin::P_VKONTAKTE],

                // login providers that are shown when user clicks on additonal providers button
                'hidden' => [],

                // where to should ULogin redirect users after successful login
                'redirectUri' => ['auth/ulogin-auth'],

                // force use https in redirect uri
                'forceRedirectUrlScheme' => 'http',

                // optional params (can be ommited)
                // force widget language (autodetect by default)
                'language' => ULogin::L_RU,

                // providers sorting ('relevant' by default)
                'sortProviders' => ULogin::S_RELEVANT,

                // verify users' email (disabled by default)
                'verifyEmail' => '0',

                // mobile buttons style (enabled by default)
                'mobileButtons' => '1',
            ]); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
