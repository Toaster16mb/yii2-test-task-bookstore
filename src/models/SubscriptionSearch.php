<?php
namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class SubscriptionSearch extends Subscription
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_phone'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Subscription::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'user_phone', $this->user_phone]);

        return $dataProvider;
    }
}
