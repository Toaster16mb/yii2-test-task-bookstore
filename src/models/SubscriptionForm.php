<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SubscriptionForm is the model behind the subscription form.
 */
class SubscriptionForm extends Model
{
    public $user_phone;
    public $author_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_phone', 'author_id'], 'required'],
            ['user_phone', 'integer'],
            ['user_phone', 'string', 'max' => 15], // Adjust max length according to your needs
            ['author_id', 'integer'],
            ['author_id', 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_phone' => 'User Phone',
            'author_id' => 'Author',
        ];
    }

    public function subscribe()
    {
        if ($this->validate()) {
            $subscription = new Subscription();
            $subscription->user_phone = $this->user_phone;
            $subscription->author_id = $this->author_id;
            $subscription->created_at = date('Y-m-d H:i:s'); // Set current time as created_at

            return $subscription->save();
        }

        return false;
    }
}
