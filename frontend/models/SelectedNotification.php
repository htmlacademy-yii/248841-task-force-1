<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "selected_notification".
 *
 * @property int $id
 * @property int $value_name_id
 * @property int $user_id
 *
 * @property Users $user
 * @property ValueNotification $valueName
 */
class SelectedNotification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selected_notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value_name_id', 'user_id'], 'required'],
            [['value_name_id', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['value_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ValueNotification::className(), 'targetAttribute' => ['value_name_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value_name_id' => 'Value Name ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ValueName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValueName()
    {
        return $this->hasOne(ValueNotification::className(), ['id' => 'value_name_id']);
    }
}
