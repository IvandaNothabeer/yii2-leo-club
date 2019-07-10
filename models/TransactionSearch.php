<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
* TransactionSearch represents the model behind the search form about `app\models\Transaction`.
*/
class TransactionSearch extends Transaction
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'member_id', 'type', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['date', 'description', 'payment_method', 'reference', 'account'], 'safe'],
            [['amount'], 'number'],
];
}

/**
* @inheritdoc
*/
public function scenarios()
{
// bypass scenarios() implementation in the parent class
return Model::scenarios();
}

/**
* Creates data provider instance with search query applied
*
* @param array $params
*
* @return ActiveDataProvider
*/
public function search($params)
{
$query = Transaction::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'member_id' => $this->member_id,
            'date' => $this->date,
            'type' => $this->type,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'account', $this->account]);

return $dataProvider;
}
}