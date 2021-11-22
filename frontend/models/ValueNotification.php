<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "value_notification".
 *
 * @property int $id
 * @property string $name
 *
 * @property SelectedNotification[] $selectedNotifications
 */
class ValueNotification extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'value_notification';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[SelectedNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedNotifications()
    {
        return $this->hasMany(SelectedNotification::class, ['value_name_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getNotifList()
    {

        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
