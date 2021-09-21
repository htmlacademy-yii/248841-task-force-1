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
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'value_notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
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
        return $this->hasMany(SelectedNotification::className(), ['value_name_id' => 'id']);
    }

    public static function getNotifList()
    {

        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
