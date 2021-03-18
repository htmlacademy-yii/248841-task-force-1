<?php
/**
 * @var $loginForm LoginForm
 */

use frontend\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->registerJsFile('js/loginForm.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

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
//        'enableClientValidation'=>true,
    ]); ?>
    <?= $form->field($loginForm, 'email',[
        'options' => [
            'tag' => 'p',
            ],
        'labelOptions' => ['class' => 'form-modal-description'],
    ])->textInput([
        'autofocus' => true,
        'class' => 'enter-form-email input input-middle',
        'type' => 'email'
    ]) ?>

    <?= $form->field($loginForm, 'password',[
        'options' => [
            'tag' => 'p',
        ],
        'labelOptions' => ['class' => 'form-modal-description'],
    ])->passwordInput(['class' => 'enter-form-email input input-middle']) ?>
    <?= Html::submitButton('Войти', ['class' => 'button']) ?>
    <?php ActiveForm::end(); ?>
    <?= Html::button('Закрыть',['class' => 'form-modal-close', 'id' => 'close-modal'])?>
</section>


