<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `common\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tree_id', 'is_hidden'], 'integer'],
            [['name', 'image_url'], 'safe'],
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
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tree_id' => $this->tree_id,
            'is_hidden' => $this->is_hidden,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image_url', $this->image_url]);

        return $dataProvider;
    }
}
