<?php

use frontend\models\Category;
use frontend\models\TaskFilter;
use frontend\widgets\TimeWidget;
use yii\data\ActiveDataProvider;
use yii\bootstrap\{ActiveForm,Html};


/** @var $provider ActiveDataProvider
 * @var $formFilter TaskFilter
 * @var $form ActiveForm
 */

?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php
        foreach ($provider->getModels() as $task) : ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="view/<?= $task->id; ?>" class="link-regular"><h2><?= $task->title; ?></h2></a>
                    <a class="new-task__type link-regular" href="<?= $task->category->id; ?>"><p><?= $task->category->name; ?></p></a>
                </div>
                <div class="new-task__icon new-task__icon--<?= $task->category->icon; ?>"></div>
                <p class="new-task_description">
                    <?= $task->description; ?>
                </p>
                <b class="new-task__price new-task__price--<?= $task->category->icon ?>"><?= $task->price ?><b> ₽</b></b>
                <p class="new-task__place"><?= $task->location ?></p>
                <span class="new-task__time"><?= TimeWidget::widget(['lastTime' => $task->date_create, 'lastWord' => 'назад']) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
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
            <?= $form->field($formFilter, 'withoutImplementer', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
            <?= $form->field($formFilter, 'remoteWork', [
                'options' => [],
                'checkboxTemplate' => Html::beginTag('label',['class' =>'checkbox__legend']) ."{input}".Html::tag('span',"{labelTitle}"). Html::endTag('label'),
            ])->checkbox([
                'uncheck' => null,
                'class' => 'visually-hidden checkbox__input',
            ]); ?>
        </fieldset>
        <?= $form->field($formFilter, 'timePeriod', [
            'options' => [
                'class' => 'field-container',
            ],
            'labelOptions' => ['class' => 'search-task__name'],
            'template' => "{label}\n{input}"
        ])->dropDownList($formFilter->getTimePeriodMap(), ['class' => 'multiple-select input']); ?>
        <?= $form->field($formFilter, 'title', [
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

