<?php

use frontend\helpers\WordHelper;

/** @var \DateInterval $diffTime */
/** @var  string $lastWord */
if ($diffTime->y) {
    echo WordHelper::getPluralWord($diffTime->y, ['год', 'года', 'лет']) , ' ' , $lastWord;
} elseif ($diffTime->m) {
    echo WordHelper::getPluralWord($diffTime->m, ['месяц', 'месяца', 'месяцев']) , ' ' , $lastWord;
} elseif ($diffTime->d) {
    echo WordHelper::getPluralWord($diffTime->d, ['день', 'дня', 'дней']) , ' ' , $lastWord;
} elseif ($diffTime->h) {
    echo WordHelper::getPluralWord($diffTime->h, ['час', 'часа', 'часов']) , ' ' , $lastWord;
} elseif ($diffTime->i) {
    echo WordHelper::getPluralWord($diffTime->i, ['минту', 'минуты', 'минут']) , ' ' , $lastWord;
} else {
    echo 'только что';
}