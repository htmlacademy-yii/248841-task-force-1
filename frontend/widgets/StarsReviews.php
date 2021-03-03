<?php


namespace frontend\widgets;


use yii\base\Widget;

class StarsReviews extends Widget
{
    /** @var float */
    public $rating;

    public function run()
    {
        return $this->render('stars', ['rating' => $this->rating]);
    }
}