<?php


namespace frontend\widgets;


use yii\base\Widget;

class TimeWidget extends Widget
{
    /** @var string */
    public $lastTime;

    public function run()
    {
        $diffTime = (new \DateTime())->diff(new \DateTime($this->lastTime));

        return $this->render('lastTime', ['diffTime' => $diffTime]);
    }

}