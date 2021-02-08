<?php

use frontend\helpers\TimeAgo;

/** @var \DateInterval $diffTime */
if ($diffTime->y) {
   echo TimeAgo::getTime($diffTime->y, ['год', 'года', 'лет']);
} elseif ($diffTime->m) {
    echo TimeAgo::getTime($diffTime->m, ['месяц', 'месяца', 'месяцев']);
} elseif ($diffTime->d) {
    echo TimeAgo::getTime($diffTime->d, ['день', 'дня', 'дней']);
} elseif ($diffTime->h) {
    echo TimeAgo::getTime($diffTime->h, ['час', 'часа', 'часов']);
} elseif ($diffTime->i) {
    echo TimeAgo::getTime($diffTime->i, ['минту', 'минуты', 'минут']);
} elseif ($diffTime->s) {
    echo 'now';
} else {
    echo '0';
}
