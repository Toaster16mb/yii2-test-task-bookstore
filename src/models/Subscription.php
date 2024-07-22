<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\Json;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property int $user_phone
 * @property int $author_id
 * @property string $created_at
 */
class Subscription extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_phone', 'author_id'], 'required'],
            [['user_phone'], 'integer'],
            [['author_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_phone'], 'string', 'max' => 15], // Adjust max length according to your needs
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_phone' => 'User Phone',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function queueNotifications($authorIds, $bookName) {
        if (!empty($authorIds)) {
            $query = (new Query())
                ->select('user_phone')
                ->distinct()
                ->from('subscriptions')
                ->where(['author_id' => $authorIds]);
            $phoneNumbers = $query->column();
            foreach ($phoneNumbers as $phoneNumber) {
                self::queueSms($phoneNumber, "У автора вышла новая книга \"$bookName\"");
            }
        }
    }

    private static function queueSms($phoneNumber, $message) {
        $sms = new Sms();
        $sms->phone_number = $phoneNumber;
        $sms->message = $message;
        $sms->status = Sms::STATUS_PENDING;
        $sms->save();
    }
}
