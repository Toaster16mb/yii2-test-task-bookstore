<?php

namespace app\models;

use yii\db\ActiveRecord;

class Sms extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_SENT = 1;
    const STATUS_FAILED = 2;

    public static function tableName()
    {
        return 'sms';
    }

    public function rules()
    {
        return [
            [['phone_number', 'message'], 'required'],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['phone_number'], 'string', 'max' => 15],
            [['message'], 'string', 'max' => 160],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_number' => 'Номер телефона',
            'message' => 'Текст сообщения',
            'created_at' => 'Время добавления',
            'status' => 'Статус',
        ];
    }
}
