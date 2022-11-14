<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_type_id', 'page', 'status', 'district_id', 'province_id', 'ward_id', 'house_info_id'], 'integer'],
            [['code', 'title', 'slug', 'address', 'area_text', 'price_text', 'description', 'content', 'page_name', 'page_url', 'page_id', 'project_link', 'project_name', 'project_id', 'investor', 'detail', 'hdLat', 'hdLong', 'street', 'updated', 'created', 'post_date', 'expiry_date'], 'safe'],
            [['area', 'price', 'price_number'], 'number'],

        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['created'=>SORT_DESC]]
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
            'user_id' => $this->user_id,
            'category_type_id' => $this->category_type_id,
            'area' => $this->area,
            'price' => $this->price,
            'price_number' => $this->price_number,
            'page' => $this->page,
            'status' => $this->status,
            'district_id' => $this->district_id,
            'province_id' => $this->province_id,
            'ward_id' => $this->ward_id,
            'updated' => $this->updated,
            'created' => $this->created,
            'post_date' => $this->post_date,
            'expiry_date' => $this->expiry_date,
            'house_info_id' => $this->house_info_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'area_text', $this->area_text])
            ->andFilterWhere(['like', 'price_text', $this->price_text])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'page_name', $this->page_name])
            ->andFilterWhere(['like', 'page_url', $this->page_url])
            ->andFilterWhere(['like', 'page_id', $this->page_id])
            ->andFilterWhere(['like', 'project_link', $this->project_link])
            ->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'project_id', $this->project_id])
            ->andFilterWhere(['like', 'investor', $this->investor])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'street', $this->street]);

        return $dataProvider;
    }
}
