<?php

use frontend\assets\AccountAsset;
use frontend\models\Account;
use frontend\models\Category;
use frontend\models\City;
use frontend\models\Events;
use frontend\models\Notification;
use frontend\models\ValueNotification;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var $form ActiveForm
 * @var $model Account
 */

AccountAsset::register($this);
?>
<section class="account__redaction-wrapper">
    <h1>Редактирование настроек профиля</h1>

    <?php $form = ActiveForm::begin([
//        'action' => ['/'],
        'method' => 'post',
        'id' => 'account',
    ]); ?>
    <div class="account__redaction-section">
        <h3 class="div-line">Настройки аккаунта</h3>
        <div class="account__redaction-section-wrapper">

            <?=
            $form->field($model, 'avatarUrl', [
                'options' => [
                    'class' => 'account__redaction-avatar',
                ],
                'labelOptions' => ['class' => 'link-regular'],
                'template' => Html::img($model->avatarUrl ? '@web/uploads/' . $model->avatarUrl : '#', ['width' => 156]) . "{label}\n{input}\n{error}"
            ])->fileInput(['id' => 'upload-avatar'])
            ?>

            <div class="account__redaction">
                <?=
                $form->field($model, 'name', [
                    'options' => [
                        'class' => 'field-container account__input account__input--name',
                    ],
                ])->textInput(['class' => 'input textarea', 'placeholder' => 'Титов Денис']);
                ?>
                <?=
                $form->field($model, 'email', [
                    'options' => [
                        'class' => 'field-container account__input account__input--email',
                    ],
                ])->textInput(['class' => 'input textarea', 'placeholder' => 'DenisT@bk.ru']);
                ?>

                <?= $form->field($model, 'cityId', [
                    'options' => [
                        'class' => 'field-container account__input account__input--address',
                    ],
                    'labelOptions' => [
                        'label' => 'Адрес',
                        'class' => 'control-label'
                    ],
                ])->dropDownList(City::getCityList(), [
                    'prompt' => 'Выберите город...',
                    'class' => 'input textarea'
                ]); ?>
                <?= $form->field($model, 'birthday', [
                    'options' => [
                        'class' => 'field-container account__input account__input--date',
                    ],
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
                <?= $form->field($model, 'description', [
                    'options' => [
                        'class' => 'field-container account__input account__input--info',
                    ],
                    'labelOptions' => [
                        'label' => 'Информация о себе',
                        'class' => 'control-label'
                    ]
                ])->textArea([
                    'rows' => '7',
                    'class' => 'input textarea',
                    'placeholder' => 'Place your text'
                ]) ?>
            </div>
        </div>
        <h3 class="div-line">Выберите свои специализации</h3>
        <div class="account__redaction-section-wrapper">
            <?= $form->field($model, 'category', [
                "template" => "{input}",
                'options' => [
                    'class' => 'search-task__categories account_checkbox--bottom',
                ]
            ])->checkboxList(Category::getCategorisList(), [
                'tag' => false,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return Html::beginTag('label', ['class' => 'checkbox__legend']) .
                        Html::checkbox($name, $checked, [
                            'class' => 'visually-hidden checkbox__input',
                            'value' => $value
                        ]) . Html::tag('span', $label) . Html::endTag('label');
                }
            ]); ?>
        </div>
        <h3 class="div-line">Безопасность</h3>
        <div class="account__redaction-section-wrapper account__redaction">
            <?= $form->field($model, 'password1', [
                'options' => [
                    'class' => 'field-container account__input',
                ],
                'labelOptions' => ['class' => ''],
                'errorOptions' => [
                    'class' => 'registration__text-error',
                    'tag' => 'span'
                ]
            ])->passwordInput(['class' => 'input textarea']); ?>
            <?= $form->field($model, 'password2', [
                'options' => [
                    'class' => 'field-container account__input',
                ],
                'labelOptions' => ['class' => ''],
                'errorOptions' => [
                    'class' => 'registration__text-error',
                    'tag' => 'span'
                ]
            ])->passwordInput(['class' => 'input textarea']); ?>
        </div>

        <h3 class="div-line">Фото работ</h3>
        <div class="photo-var">Выбрать фотографии</div>
        <div class="account__redaction-section-wrapper account__redaction">
            <div class="create__file dropzone-custom"></div>
        </div>

        <h3 class="div-line">Контакты</h3>
        <div class="account__redaction-section-wrapper account__redaction">
            <?=
            $form->field($model, 'phone', [
                'options' => [
                    'class' => 'field-container account__input account__input',
                ],
            ])->textInput(['class' => 'input textarea', 'placeholder' => '8 (917) 187 44 87', 'type' => 'tel']);
            ?>
            <?=
            $form->field($model, 'skype', [
                'options' => [
                    'class' => 'field-container account__input account__input',
                ],
            ])->textInput(['class' => 'input textarea', 'placeholder' => 'DenisT']);
            ?>
            <?=
            $form->field($model, 'telegram', [
                'options' => [
                    'class' => 'field-container account__input account__input',
                ],
            ])->textInput(['class' => 'input textarea', 'placeholder' => '@DenisT']);
            ?>
        </div>
        <h3 class="div-line">Настройки сайта</h3>
        <h4>Уведомления</h4>
        <div class="account__redaction-section-wrapper account_section--bottom">
            <?= $form->field($model, 'notification', [
                "template" => "{input}",
                'options' => [
                    'class' => 'search-task__categories account_checkbox--bottom',
                ]
            ])->checkboxList(ValueNotification::getNotifList(), [
                'tag' => false,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return Html::beginTag('label', ['class' => 'checkbox__legend']) .
                        Html::checkbox($name, $checked, [
                            'class' => 'visually-hidden checkbox__input',
                            'value' => $value
                        ]) . Html::tag('span', $label) . Html::endTag('label');
                }
            ]); ?>
            <div class="search-task__categories account_checkbox account_checkbox--secrecy">
                <?= $form->field($model, 'showContacts', [
                    'options' => [
                        'tag' => false,
                    ],
                    'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
                ])->checkbox([
                    'uncheck' => null,
                    'class' => 'visually-hidden checkbox__input',
                ]); ?>
                <?= $form->field($model, 'notShowProfile', [
                    'options' => [
                        'tag' => false,
                    ],
                    'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
                ])->checkbox([
                    'uncheck' => null,
                    'class' => 'visually-hidden checkbox__input',
                ]); ?>
                </label>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Сохранить изменения', ['class' => 'button']); ?>

    <?php ActiveForm::end(); ?>
</section>
