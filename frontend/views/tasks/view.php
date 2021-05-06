<?php

use frontend\helpers\WordHelper;
use frontend\models\Task;
use frontend\widgets\{TimeWidget, StarsReviews};
use yii\bootstrap\Html;

/**
 * @var $task Task
 */
?>
<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?= $task->title; ?></h1>
                    <span>Размещено в категории
                                    <a href="/tasks/?TaskFilter[category][]=<?= $task->category->id; ?>" class="link-regular"><?= $task->category->name; ?></a>
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
                    <a href="/tasks/file/<?= $file->url_file ?>"><?= $file->name_file ?></a>
                <?php endforeach; ?>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town">Москва</span><br>
                        <span>Новый арбат, 23 к. 1</span>
                        <p>Вход под арку, код домофона 1122</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button open-modal"
                    type="button" data-for="response-form">Откликнуться
            </button>
            <button class="button button__big-color refusal-button open-modal"
                    type="button" data-for="refuse-form">Отказаться
            </button>
            <button class="button button__big-color request-button open-modal"
                    type="button" data-for="complete-form">Завершить
            </button>
        </div>
    </div>
    <?

    if(($task->employer_id == \Yii::$app->user->identity->getId() || in_array(\Yii::$app->user->identity->getId(),array_map(function ($v){
        return $v->user_id;
    },$task->answers)) ) && count($task->answers) > 0):?>
    <div class="content-view__feedback">
        <h2>Отклики <span>(<?= count($task->answers) ?>)</span></h2>
        <div class="content-view__feedback-wrapper">
            <?
            /**
             * @var array
             */
            $answers = $task->answers;
            if($task->employer_id != \Yii::$app->user->identity->getId()){
                $answers = array_filter($answers, function ($v){
                    return \Yii::$app->user->identity->getId() == $v->user_id;
                });
            }
            foreach ($answers as $answer) :?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="/users/view/<?= $answer->user->id ?>"><?= $answer->user->avatar_url ? Html::img('@web/uploads/' . $answer->user->avatar_url, ['width' => 55, 'height' => 55, 'alt' => 'Аватар']) : ''; ?></a>
                        <div class="feedback-card__top--name">
                            <p><a href="/users/view/<?= $answer->user->id ?>" class="link-regular"><?= $answer->user->name; ?></a></p>
                            <?= StarsReviews::widget(['rating' => $answer->user->averageRate]) ?>
                        </div>
                        <span class="new-task__time"><?= TimeWidget::widget(['lastTime' => $answer->user->last_visit, 'lastWord' => 'назад']) ?></span>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            <?= $answer->comment ?>
                        </p>
                        <span><?= $answer->price ?> ₽</span>
                    </div>
                    <? if ($task->employer_id == \Yii::$app->user->identity->getId()):?>
                    <div class="feedback-card__actions">
                        <a class="button__small-color response-button button"
                           type="button">Подтвердить</a>
                        <a class="button__small-color refusal-button button"
                           type="button">Отказать</a>
                    </div>
                    <? endif;?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
    <? endif; ?>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <?= $task->employer->avatar_url ? Html::img('@web/uploads/' . $task->employer->avatar_url, ['width' => 62, 'height' => 62, 'alt' => 'Аватар заказчика']): '' ?>
                <div class="profile-mini__name five-stars__rate">
                    <p><?= $task->employer->name ?></p>
                </div>
            </div>
            <p class="info-customer"><span><?= WordHelper::getPluralWord(count($task->employer->tasks), ['задание', 'задания', 'заданий']); ?></span><span
                        class="last-"><?= TimeWidget::widget(['lastTime' => $task->employer->date_create, 'lastWord' => '']) ?> на сайте</span></p>
            <a href="#" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
<!--    <div id="chat-container">-->
<!---->
        <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
<!--        <chat class="connect-desk__chat" task="68"></chat>-->
<!--    </div>-->
</section>
<section class="response-form form-modal" id="response-form">
    <h2>Отклик на задание</h2>
    <form action="#" method="post">
        <p>
            <label class="form-modal-description" for="response-payment">Ваша цена</label>
            <input class="response-form-payment input input-middle input-money" type="text" name="response-payment"
                   id="response-payment">
        </p>
        <p>
            <label class="form-modal-description" for="response-comment">Комментарий</label>
            <textarea class="input textarea" rows="4" id="response-comment" name="response-comment"
                      placeholder="Place your text"></textarea>
        </p>
        <button class="button modal-button" type="submit">Отправить</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
<section class="completion-form form-modal" id="complete-form">
    <h2>Завершение задания</h2>
    <p class="form-modal-description">Задание выполнено?</p>
    <form action="#" method="post">
        <input class="visually-hidden completion-input completion-input--yes" type="radio" id="completion-radio--yes"
               name="completion" value="yes">
        <label class="completion-label completion-label--yes" for="completion-radio--yes">Да</label>
        <input class="visually-hidden completion-input completion-input--difficult" type="radio"
               id="completion-radio--yet" name="completion" value="difficulties">
        <label class="completion-label completion-label--difficult" for="completion-radio--yet">Возникли проблемы</label>
        <p>
            <label class="form-modal-description" for="completion-comment">Комментарий</label>
            <textarea class="input textarea" rows="4" id="completion-comment" name="completion-comment"
                      placeholder="Place your text"></textarea>
        </p>
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
        <input type="hidden" name="rating" id="rating">
        <button class="button modal-button" type="submit">Отправить</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
<section class="form-modal refusal-form" id="refuse-form">
    <h2>Отказ от задания</h2>
    <p>
        Вы собираетесь отказаться от выполнения задания.
        Это действие приведёт к снижению вашего рейтинга.
        Вы уверены?
    </p>
    <button class="button__form-modal button" id="close-modal"
            type="button">Отмена
    </button>
    <button class="button__form-modal refusal-button button"
            type="button">Отказаться
    </button>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
<div class="overlay"></div>
