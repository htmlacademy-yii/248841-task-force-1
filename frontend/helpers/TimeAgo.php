<?php


namespace frontend\helpers;


class TimeAgo
{
    static function getTime(int $num, array $nameTime): string
    {
        if ($num % 10 === 1 && $num % 100 !== 11) {
            $string = $num . " {$nameTime[0]}";
        } elseif ($num % 10 >= 2 && $num % 10 <= 4 && ($num % 100 < 12 || $num % 100 > 14)) {
            $string = $num . " {$nameTime[1]}";
        } else {
            $string = $num . " {$nameTime[2]}";
        }
        return $string;
    }

}