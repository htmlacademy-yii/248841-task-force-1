<?php


namespace frontend\widgets;
use yii\base\Widget;

class TimeWidget extends Widget
{
    /** @var string */
    public $lastTime;
    /** @var string */
    public $lastWord;

    public function run()
    {
        $diffTime = (new \DateTime())->diff(new \DateTime($this->lastTime));

        return $this->render('lastTime', ['diffTime' => $diffTime, 'lastWord' => $this->lastWord]);
    }

}