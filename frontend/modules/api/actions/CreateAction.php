<?php
namespace frontend\modules\api\actions;

use yii\web\BadRequestHttpException;

class CreateAction extends \yii\rest\CreateAction
{
 public function run()
 {
     throw new BadRequestHttpException();
 }
}