<?php
/**
 * @var $loginForm LoginForm
 */

use frontend\models\LoginForm;
use rmrevin\yii\ulogin\ULogin;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use frontend\assets\LoginFormAsset;

LoginFormAsset::register($this);

?>

<section class="enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin([
        'options' => [
            'tag' => false,
        ],
        'enableAjaxValidation' => true,
        'id' => 'loginForm',
        'validateOnBlur' => false,
        'validateOnChange' => false,
    ]); ?>
    <?= $form->field($loginForm, 'email', [
        'options' => [
            'tag' => 'p',
        ],
        'labelOptions' => ['class' => 'form-modal-description']
    ])->textInput([
        'autofocus' => true,
        'class' => 'enter-form-email input input-middle',
        'type' => 'email'
    ]) ?>

    <?= $form->field($loginForm, 'password', [
        'options' => [
            'tag' => 'p',
        ],
        'labelOptions' => ['class' => 'form-modal-description'],
    ])->passwordInput(['class' => 'enter-form-email input input-middle']) ?>
    <div class="landing-buttons">
    <?= Html::submitButton('Войти', ['class' => 'button']) ?>
    <?php ActiveForm::end(); ?>
    <?= Html::button('Закрыть', ['class' => 'form-modal-close', 'id' => 'close-modal']) ?>
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
    ]);?>
        <span>Войти через:</span>
    </div>
</section>
<div class="landing-bottom">
    <div class="landing-bottom-container">
        <h2>Последние задания на сайте</h2>
        <div class="landing-task">
            <div class="landing-task-top task-courier"></div>
            <div class="landing-task-description">
                <h3><a href="#" class="link-regular">Подключить принтер</a></h3>
                <p>Необходимо подключить старый матричный принтер, у него еще LPT порт…</p>
            </div>
            <div class="landing-task-info">
                <div class="task-info-left">
                    <p><a href="#" class="link-regular">Курьерские услуги</a></p>
                    <p>25 минут назад</p>
                </div>
                <span>700 <b>₽</b></span>
            </div>
        </div>
        <div class="landing-task">
            <div class="landing-task-top task-cargo"></div>
            <div class="landing-task-description">
                <h3><a href="#" class="link-regular">Офисный переезд</a></h3>
                <p>Требуется перевезти офисную мебель
                    и технику из расчета 5 сотрудников</p>
            </div>
            <div class="landing-task-info">
                <div class="task-info-left">
                    <p><a href="#" class="link-regular">Грузоперевозки</a></p>
                    <p>25 минут назад</p>
                </div>
                <span>1 800 <b>₽</b></span>
            </div>
        </div>
        <div class="landing-task">
            <div class="landing-task-top task-neo"></div>
            <div class="landing-task-description">
                <h3><a href="#" class="link-regular">Убраться в квартире</a></h3>
                <p>Моей хате давно нужна генеральная уборка.
                    В наличии есть только пылесос. </p>
            </div>
            <div class="landing-task-info">
                <div class="task-info-left">
                    <p><a href="#" class="link-regular">Уборка</a></p>
                    <p>1 час назад</p>
                </div>
                <span>2000 <b>₽</b></span>
            </div>
        </div>
        <div class="landing-task">
            <div class="landing-task-top task-flat"></div>
            <div class="landing-task-description">
                <h3><a href="#" class="link-regular">Празднование ДР</a></h3>
                <p>Моему другу нужно
                    устроить день рождения,
                    который он никогда не
                    забудет</p>
            </div>
            <div class="landing-task-info">
                <div class="task-info-left">
                    <p><a href="#" class="link-regular">Мероприятия</a></p>
                    <p>1 час назад</p>
                </div>
                <span>2000 <b>₽</b></span>
            </div>
        </div>
    </div>
    <div class="landing-bottom-container">
        <button type="button" class="button red-button">смотреть все задания</button>
    </div>
</div>



