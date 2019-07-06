<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dog;

/**
* DogSearch represents the model behind the search form about `app\models\Dog`.
*/
class DogSearch extends Dog
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'member_id', 'sex', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'pedigreeName', 'breeder', 'dob', 'link'], 'safe'],
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
$query = Dog::find();

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
            'dob' => $this->dob,
            'sex' => $this->sex,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pedigreeName', $this->pedigreeName])
            ->andFilterWhere(['like', 'breeder', $this->breeder])
            ->andFilterWhere(['like', 'link', $this->link]);

return $dataProvider;
}
}