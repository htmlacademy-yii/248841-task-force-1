<?php

use frontend\helpers\WordHelper;
use frontend\widgets\TimeWidget;
use yii\bootstrap\Html;

/**
 * @var $user \frontend\models\Users
 */

 ?>
<section class="content-view">
    <div class="user__card-wrapper">
        <div class="user__card">
            <?= Html::img('@web/uploads/' . $user->avatar_url, ['width' => 120, 'height' => 120, 'alt' => 'Аватар пользователя']); ?>
            <div class="content-view__headline">
                <h1><?= $user->name ?></h1>
                <p>Россия, <?= $user->city->name?>, <?= WordHelper::getPluralWord((new \DateTime())->diff(new \DateTime($user->birthday))->y, ['год', 'года', 'лет']);?></p>
                <div class="profile-mini__name five-stars__rate">
                    <? for ($i = 0; $i < 5; $i++):
                        if (floor($user->averageRate) > $i) { ?>
                            <span></span>
                        <? } else { ?>
                            <span class="star-disabled"></span>
                        <? }
                    endfor; ?>
                    <b><?= $user->averageRate; ?></b>
                </div>

                <b class="done-task">Выполнил <?= WordHelper::getPluralWord($user->completedTasksCount,['заказ', 'заказа', 'заказов'])?></b><b class="done-review">Получил <?= WordHelper::getPluralWord(count($user->responses),['отзыв', 'отзыва', 'отзывов'])?></b>
            </div>
            <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                <span>Был на сайте <?= TimeWidget::widget(['lastTime' => $user->last_visit, 'lastWord' => 'назад'])?></span>
                <a href="#"><b></b></a>
            </div>
        </div>
        <div class="content-view__description">
            <p><?= $user->description; ?></p>
        </div>
        <div class="user__card-general-information">
            <div class="user__card-info">
                <h3 class="content-view__h3">Специализации</h3>
                <div class="link-specialization">
                    <? foreach ($user->category as $category) :?>
                        <a href="/users/<?= $category->id; ?>" class="link-regular"><?= $category->name;?></a>
                    <? endforeach;?>
                </div>
                <h3 class="content-view__h3">Контакты</h3>
                <div class="user__card-link">
                    <a class="user__card-link--tel link-regular" href="#"><?= $user->phone;?></a>
                    <a class="user__card-link--email link-regular" href="#"><?= $user->email;?></a>
                    <a class="user__card-link--skype link-regular" href="#"><?= $user->skype;?></a>
                </div>
            </div>
            <div class="user__card-photo">
                <h3 class="content-view__h3">Фото работ</h3>
                <? foreach ($user->photoWorks as $photoWorks) :?>
                <a href="<?=Yii::getAlias('@web/uploads/') . $photoWorks->url_photo?>"><?= Html::img('@web/uploads/' . $photoWorks->url_photo, ['width' => 85, 'height' => 86, 'alt' => 'Фото работы']); ?></a>
                <? endforeach;?>
            </div>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отзывы<span>(<?=count($user->responses)?>)</span></h2>
        <div class="content-view__feedback-wrapper reviews-wrapper">
            <? foreach ($user->responses as $response) :?>
            <div class="feedback-card__reviews">
                <p class="link-task link">Задание <a href="/tasks/view/<?= $response->task->id?>" class="link-regular">«<?= $response->task->title?>»</a></p>
                <div class="card__review">
                    <a href="<?=Yii::getAlias('@web/uploads/') . $response->task->employer->avatar_url?>"><?= Html::img('@web/uploads/' . $response->task->employer->avatar_url, ['width' => 55, 'height' => 54]); ?></a>
                    <div class="feedback-card__reviews-content">
                        <p class="link-name link"><a href="/users/<?= $response->task->employer->id?>" class="link-regular"><?= $response->task->employer->name?></a></p>
                        <p class="review-text">
                            <?=$response->description?>
                        </p>
                    </div>
                    <div class="card__review-rate">
                        <p class="<?= \frontend\models\Response::getStringRate($response->rate)?>-rate big-rate"><?=$response->rate?><span></span></p>
                    </div>
                </div>
            </div>
            <? endforeach;?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__chat">

    </div>
</section>
