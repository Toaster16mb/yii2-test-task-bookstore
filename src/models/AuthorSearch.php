<?php
namespace app\models;

use yii\data\ActiveDataProvider;

class AuthorSearch extends Author
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['full_name'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Uncomment the following line if you do not want any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'full_name', $this->full_name]);

        return $dataProvider;
    }
}
