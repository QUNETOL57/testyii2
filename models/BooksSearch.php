<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_manuf' ], 'integer'],
            [['author'], 'safe'],
            [['authorName'], 'string'],
            [['name', 'desc_book', 'date_create', 'date_change', 'authorName'], 'safe'],
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
        $query = Books::find();

        // add conditions that should always apply here
        $query->joinWith(['author0']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',   
                'authorName' => [
                    'asc' => ['avtor.name' => SORT_ASC],
                    'desc' => ['avtor.name' => SORT_DESC],
                    'label' => 'Автор'
                ],
                'date_create' => [
                    'asc' => ['date_create' => SORT_ASC],
                    'desc' => ['date_create' => SORT_DESC],
                    'label' => 'Дата создания'
                ],
            ]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');\
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_manuf' => $this->date_manuf,
            'date_create' => $this->date_create,
            'date_change' => $this->date_change,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc_book', $this->desc_book])
            // ->andFilterWhere(['like', 'date_create', $this->authorName])
            ->andFilterWhere(['like', 'avtor.name', $this->authorName]);

        return $dataProvider;
    }
}
