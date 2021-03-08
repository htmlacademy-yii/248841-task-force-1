<?php


namespace frontend\models;


use yii\base\Model;

class AuthUser extends Model
{
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $city;

    /**
     * @var string
     */
    public $password;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'city', 'password'], 'required'],
            [['email', 'name', 'city', 'password'], 'safe'],
            ['email', 'email'],
            ['email', 'unique']
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'city' => 'Город проживания',
            'password' => 'Пароль',
        ];
    }

}