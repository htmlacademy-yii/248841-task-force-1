<?php


namespace frontend\helpers;


class LastTime
{
    public static function getLastTime(int $sec): string
    {
        $sec = strtotime('now') - $sec;
        if ($sec / 60 < 1) {
            return 'now';
        } elseif ($sec / (60 * 60) < 1) {
            return self::getTime(floor($sec / 60),['минута', 'минуты', 'минут']);
        } elseif ($sec / (60 * 60 * 24) < 1) {
            return self::getTime(floor($sec / (60 * 60)), ['час', 'часа', 'часов']);
        } elseif ($sec / (60 * 60 * 24) >= 1) {
            return self::getTime(floor($sec / (60 * 60 * 24)), ['день', 'дня', 'дней']);
        }

    }


}