<?php

use frontend\models\Category;
use frontend\widgets\{TimeWidget,StarsReviews};
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var object $provider ActiveDataProvider
 * @var object $formFilter TaskFilter
 * @var object $form ActiveForm
 */
?>
<section class="user__search">
    <?php
    foreach ($provider->getModels() as $user) : ?>
    <div class="content-view__feedback-card user__search-wrapper">
        <div class="feedback-card__top">
            <div class="user__search-icon">
                <a href="/users/view/<?=$user->id?>"><?= Html::img('@web/uploads/' . $user->avatar_url, ['width' => 65, 'height' => 65, 'alt' => 'Аватар пользователя']); ?></a>
                <span><?= $user->completedTasksCount;?> заданий</span>
                <span><?= count($user->responses);?> отзывов</span>
            </div>
            <div class="feedback-card__top--name user__search-card">
                <p class="link-name"><a href="/users/view/<?=$user->id?>" class="link-regular"><?= $user->name; ?></a></p>
                <?= StarsReviews::widget(['rating' => $user->averageRate]) ?>
                <p class="user__search-content">
                    <?= $user->description; ?>
                </p>
            </div>
            <span class="new-task__time">Был на сайте <?= TimeWidget::widget(['lastTime' => $user->last_visit, 'lastWord' => 'назад'])?></span>
        </div>
        <div class="link-specialization user__search-link--bottom">
            <? foreach ($user->category as $category) :?>
                <a href="?UsersFilter[category][]=<?= $category->id; ?>" class="link-regular"><?= $category->name;?></a>
            <? endforeach;?>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'search-task__form']
        ]); ?>
        <?= $form->field($formFilter, 'category', [
            "template" => Html::tag('legend',"{labelTitle}") . "\n{input}",
            'options' => [
                'tag' => 'fieldset',
                'class' => 'search-task__categories',
            ]
        ])->checkboxList(Category::getCategorisList(), [
            'unselect' => null,
            'tag' => false,
            'item' => function ($index, $label, $name, $checked, $value) {
                return Html::beginTag('label',['class' =>'checkbox__legend']) .
                    Html::checkbox($name, $checked, [
                        'class' => 'visually-hidden checkbox__input',
                        'value' => $value
                    ]) . Html::tag('span',$label) . Html::endTag('label');
            }
        ]);?>
        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>
            <?= $form->field($formFilter, 'available', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
            <?= $form->field($formFilter, 'online', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
            <?= $form->field($formFilter, 'isFeedback', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
            <?= $form->field($formFilter, 'favorites', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
        </fieldset>
        <?= $form->field($formFilter, 'name', [
            'options' => [
                'class' => 'field-container',
            ],
            'labelOptions' => ['class' => 'search-task__name'],
            'template' => "{label}\n{input}"
        ])->textInput(['class' => 'input-middle input']); ?>
        <?= Html::submitButton('Искать', ['class' => 'button']); ?>

        <?php ActiveForm::end(); ?>
    </div>
</section>

