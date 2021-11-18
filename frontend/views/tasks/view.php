<?php

use frontend\assets\ApiYandexAsset;
use frontend\assets\ViewAsset;
use frontend\helpers\TaskPermission;
use frontend\helpers\WordHelper;
use frontend\models\Answers;
use frontend\models\Response;
use frontend\models\Task;
use frontend\widgets\{TimeWidget, StarsReviews};
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

ViewAsset::register($this);
ApiYandexAsset::register($this);
/**
 * @var $task Task
 */
/**
 * @var $answer Answers
 * @var $response Response
 */


?>
    <section class="content-view">
        <div class="content-view__card">
            <div class="content-view__card-wrapper">
                <div class="content-view__header">
                    <div class="content-view__headline">
                        <h1><?= $task->title; ?></h1>
                        <span>Размещено в категории
                                    <a href="<?= Url::to(['/tasks/', 'TaskFilter[category][]' => $task->category->id])?>" class="link-regular"><?= $task->category->name; ?></a>
                                    <?= TimeWidget::widget(['lastTime' => $task->date_create, 'lastWord' => 'назад']) ?></span>
                    </div>
                    <b class="new-task__price new-task__price--<?= $task->category->icon ?> content-view-price"><?= $task->price ?><b> ₽</b></b>
                    <div class="new-task__icon new-task__icon--<?= $task->category->icon; ?> content-view-icon"></div>
                </div>
                <div class="content-view__description">
                    <h3 class="content-view__h3">Общее описание</h3>
                    <p>
                        <?= $task->description; ?>
                    </p>
                </div>
                <div class="content-view__attach">
                    <h3 class="content-view__h3">Вложения</h3>
                    <? foreach ($task->filesTasks as $file): ?>
                        <a href="<?= Url::to(['/uploads/' . $file->url_file])?>"><?= $file->name_file ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="content-view__location">
                    <h3 class="content-view__h3">Расположение</h3>
                    <? if ($task->location): ?>
                        <div class="content-view__location-wrapper">
                            <div class="content-view__map" id="map" style="width: 378px; height: 378px"></div>
                            <div class="content-view__address">
                                <span class="address__town"><?= $task->address; ?></span>
                            </div>
                        </div>
                    <? else: ?>
                    <div class="content-view__location-wrapper">
                        <div class="content-view__map">
                            <a href="<?= Url::to([''])?>"><?= Html::img('/img/no_address.jpg', ['width' => 378, 'height' => 378, 'alt' => 'Без адреса'])?></a>
                        </div>
                        <div class="content-view__address">
                            <span class="address__town">Заказчик не указал адрес</span>
                        </div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
            <div class="content-view__action-buttons">
                <? foreach (\Lobochkin\TaskForce\Task::getNextAction($task->status, $task->implementer_id, $task->employer_id, \Yii::$app->user->identity->getId()) as $item) :
                    switch ($item::getInnerName()) {
                        case \Lobochkin\TaskForce\Task::ACTION_ANSWER:
                            if (!TaskPermission::canShowAnswer(\Yii::$app->user->identity->getId(), $task->id)) :?>
                                <button class=" button button__big-color response-button open-modal"
                                        type="button" data-for="response-form">Откликнуться
                                </button>
                            <? endif;
                            break;
                        case \Lobochkin\TaskForce\Task::ACTION_DECLINE: ?>
                            <button class="button button__big-color refusal-button open-modal"
                                    type="button" data-for="refuse-form">Отказаться
                            </button>
                            <? break;
                        case \Lobochkin\TaskForce\Task::ACTION_FINISHED: ?>
                            <button class="button button__big-color request-button open-modal"
                                    type="button" data-for="complete-form">Завершить
                            </button>
                            <? break;
                    }
                endforeach; ?>
            </div>
        </div>
        <?
        Pjax::begin(['id' => 'content-view__feedback']);
        if (((int)$task->employer_id === (int)\Yii::$app->user->identity->getId() || TaskPermission::canShowAnswer(\Yii::$app->user->identity->getId(), $task->id)) && count($task->answers) > 0):?>
            <div class="content-view__feedback">
                <h2>Отклики <span>(<?= count($task->answers) ?>)</span></h2>
                <div class="content-view__feedback-wrapper">
                    <?
                    /**
                     * @var array
                     */
                    $answers = $task->answers;
                    if ($task->employer_id != \Yii::$app->user->identity->getId()) {
                        $answers = array_filter($answers, function ($v) {
                            return (int)\Yii::$app->user->identity->getId() === (int)$v->user_id;
                        });
                    }
                    foreach ($answers as $answer) :?>
                        <div class="content-view__feedback-card">
                            <div class="feedback-card__top">
                                <a href="<?= Url::to(['/users/view/' . $answer->user->id])?>"><?= $answer->user->avatar_url ? Html::img('@web/uploads/' . $answer->user->avatar_url,
                                        ['width' => 55, 'height' => 55, 'alt' => 'Аватар']) : ''; ?></a>
                                <div class="feedback-card__top--name">
                                    <p><a href="<?= Url::to(['/users/view/' . $answer->user->id])?>" class="link-regular"><?= $answer->user->name; ?></a></p>
                                    <?= StarsReviews::widget(['rating' => $answer->user->averageRate]) ?>
                                </div>
                                <span class="new-task__time"><?= TimeWidget::widget(['lastTime' => $answer->date_create, 'lastWord' => 'назад']) ?></span>
                            </div>
                            <div class="feedback-card__content">
                                <p>
                                    <?= $answer->comment ?>
                                </p>
                                <span><?= $answer->price ?> ₽</span>
                            </div>
                            <? if ((int)$task->employer_id === (int)\Yii::$app->user->identity->getId() && !$answer->status && $task->status === \Lobochkin\TaskForce\Task::STATUS_NEW): ?>
                                <div class="feedback-card__actions">
                        <span class="button__small-color response-button button"
                              data-action="<?= \frontend\models\Answers::ACCEPT ?>" data-id="<?= $answer->id ?>">Подтвердить</span>
                                    <span class="button__small-color refusal-button button" data-action="<?= \frontend\models\Answers::CANCEL ?>" data-id="<?= $answer->id ?>"
                                    >Отказать</span>
                                </div>
                            <? endif; ?>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>

        <? endif;
        Pjax::end();
        ?>

    </section>
    <section class="connect-desk">
        <div class="connect-desk__profile-mini">
            <div class="profile-mini__wrapper">
                <h3>Заказчик</h3>
                <div class="profile-mini__top">
                    <?= $task->employer->avatar_url ? Html::img('@web/uploads/' . $task->employer->avatar_url, ['width' => 62, 'height' => 62, 'alt' => 'Аватар заказчика']) : '' ?>
                    <div class="profile-mini__name five-stars__rate">
                        <p><?= $task->employer->name ?></p>
                    </div>
                </div>
                <p class="info-customer"><span><?= WordHelper::getPluralWord(count($task->employer->tasks), ['задание', 'задания', 'заданий']); ?></span><span
                            class="last-"><?= TimeWidget::widget(['lastTime' => $task->employer->date_create, 'lastWord' => '']) ?> на сайте</span></p>
                <a href="<?= Url::to([''])?>" class="link-regular">Смотреть профиль</a>
            </div>
        </div>
            <div id="chat-container">
                <chat class="connect-desk__chat" task="<?=$task->id ?>"></chat>
            </div>
    </section>
    <section class="response-form form-modal" id="response-form">
        <h2>Отклик на задание</h2>

        <?php $form = ActiveForm::begin([
            'options' => [
                'tag' => false,
            ],
            'action' => '/tasks/add-answer',
            'enableAjaxValidation' => true,
            'id' => 'answerForm',
            'validateOnBlur' => false,
            'validateOnChange' => false,
        ]); ?>
        <?= $form->field($answer, 'price', [
            'options' => [
                'tag' => 'p',
            ],
            'template' => "{label}\n{input}\n{error}",
            'errorOptions' => [
                'tag' => 'span',
            ],
            'labelOptions' => ['class' => 'form-modal-description']
        ])->textInput([
            'autofocus' => true,
            'class' => 'response-form-payment input input-middle input-money',
        ]) ?>

        <?= $form->field($answer, 'comment', [
            'options' => [
                'tag' => 'p',
            ],
            'labelOptions' => ['class' => 'form-modal-description'],
        ])->textarea([
            'class' => 'input textarea',
            'rows' => "4",
            'placeholder' => 'Place your text'
        ]) ?>
        <?= $form->field($answer, 'user_id')->label(false)->hiddenInput(['value' => \Yii::$app->user->identity->getId()]); ?>
        <?= $form->field($answer, 'task_id')->label(false)->hiddenInput(['value' => $task->id]); ?>
        <?= Html::submitButton('Отправить', ['class' => 'button modal-button']) ?>
        <?php ActiveForm::end(); ?>
        <?= Html::button('Закрыть', ['class' => 'form-modal-close']) ?>

    </section>
    <section class="completion-form form-modal" id="complete-form">
        <h2>Завершение задания</h2>
        <?php $form = ActiveForm::begin([
            'options' => [
                'tag' => false,
            ],
            'action' => '/tasks/complete',
            'enableAjaxValidation' => true,
            'id' => 'completeForm',
            'validateOnBlur' => false,
            'validateOnChange' => false,
        ]); ?>
        <?= $form->field($response, 'ready', [
            'labelOptions' => ['class' => 'form-modal-description'],
        ])
            ->radioList([
                Response::YES => 'Да',
                Response::NO => 'Возникли проблемы'
            ],
                [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $class = $value === Response::YES ? 'yes' : 'difficult';

                        return
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'id' => $index,
                                'class' => 'visually-hidden completion-input completion-input--' . $class
                            ]) . Html::label($label, $index, ['class' => 'completion-label completion-label--' . $class]);
                    },
                    'value' => Response::YES
                ]); ?>
        <?= $form->field($response, 'description', [
            'options' => [
                'tag' => 'p',
            ],
            'labelOptions' => ['class' => 'form-modal-description'],
        ])->textarea([
            'class' => 'input textarea',
            'rows' => "4",
            'placeholder' => 'Place your text'
        ]) ?>
        <?= $form->field($response, 'user_id')->label(false)->hiddenInput(['value' => $task->implementer_id]); ?>
        <?= $form->field($response, 'task_id')->label(false)->hiddenInput(['value' => $task->id]); ?>
        <p class="form-modal-description">
            Оценка
        <div class="feedback-card__top--name completion-form-star">
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
            <span class="star-disabled"></span>
        </div>
        </p>
        <?= $form->field($response, 'rate')->label(false)->hiddenInput(['id' => 'rating']); ?>
        <?= Html::submitButton('Отправить', ['class' => 'button modal-button']) ?>
        <?php ActiveForm::end(); ?>
        <?= Html::button('Закрыть', ['class' => 'form-modal-close']) ?>

    </section>
    <section class="form-modal refusal-form" id="refuse-form">
        <h2>Отказ от задания</h2>
        <p>
            Вы собираетесь отказаться от выполнения задания.
            Это действие приведёт к снижению вашего рейтинга.
            Вы уверены?
        </p>
        <?php $form = ActiveForm::begin([
            'options' => [
                'tag' => false,
            ],
            'action' => '/tasks/complete',
            'enableAjaxValidation' => true,
            'id' => 'completeForm',
            'validateOnBlur' => false,
            'validateOnChange' => false,
        ]); ?>

        <?= $form->field($response, 'ready', [
            'options' => [
                'tag' => false,
            ],
            'errorOptions' => [
                'tag' => false
            ]
        ])->label(false)->hiddenInput(['value' => Response::NO]); ?>
        <?= $form->field($response, 'user_id', [
            'options' => [
                'tag' => false,
            ],
            'errorOptions' => [
                'tag' => false
            ]
        ])->label(false)->hiddenInput(['value' => $task->implementer_id]); ?>
        <?= $form->field($response, 'task_id', [
            'options' => [
                'tag' => false,
            ],
            'errorOptions' => [
                'tag' => false
            ]
        ])->label(false)->hiddenInput(['value' => $task->id]); ?>

        <?= $form->field($response, 'rate', [
            'options' => [
                'tag' => false,
            ],
            'errorOptions' => [
                'tag' => false
            ]
        ])->label(false)->hiddenInput(['value' => 1]); ?>

        <?= Html::submitButton('Отказаться', ['class' => 'button__form-modal refusal-button button']) ?>

        <?php ActiveForm::end(); ?>
        <?= Html::button('Отмена', [
            'class' => 'button__form-modal button',
            'id' => "close-modal",
            'type' => "button"
        ]) ?>
        <?= Html::button('Закрыть', ['class' => 'form-modal-close']) ?>


    </section>
    <div class="overlay"></div>
<?php
$this->registerJs(
    "ymaps.ready(function () {
    var myMap = new ymaps.Map(\"map\", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [$task->location],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 9
        }),
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: \"Point\",
                coordinates: [$task->location]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: '$task->title',
                hintContent: 'Место работы заказчика'
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: false
        });
        
         myMap.geoObjects
        .add(myGeoObject);
});",
    View::POS_END
);


