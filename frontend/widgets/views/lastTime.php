<?php

use frontend\helpers\WordHelper;

/** @var \DateInterval $diffTime */
if ($diffTime->y) {
   echo WordHelper::getPluralWord($diffTime->y, ['год', 'года', 'лет']);
} elseif ($diffTime->m) {
    echo WordHelper::getPluralWord($diffTime->m, ['месяц', 'месяца', 'месяцев']);
} elseif ($diffTime->d) {
    echo WordHelper::getPluralWord($diffTime->d, ['день', 'дня', 'дней']);
} elseif ($diffTime->h) {
    echo WordHelper::getPluralWord($diffTime->h, ['час', 'часа', 'часов']);
} elseif ($diffTime->i) {
    echo WordHelper::getPluralWord($diffTime->i, ['минту', 'минуты', 'минут']);
} else {
    echo 'now';
}