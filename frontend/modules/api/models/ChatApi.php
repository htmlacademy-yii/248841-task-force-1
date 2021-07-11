<?php
namespace frontend\modules\api\models;

use frontend\models\Chat;

class ChatApi extends Chat
{
 public function fields()
 {
     return [
         'id' => 'id',
         "message" => 'text',
         'published_at' => 'last_time',
         'is_mine' => function(){
         return (int)\Yii::$app->user->getId() === (int) $this->user_id;
         }
         ];
 }
}