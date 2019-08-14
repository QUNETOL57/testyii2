<?php

namespace  app\modules\api\models;

use app\modules\api\models\Books_api;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;


class BooksSearchApi extends Books
{
    public $authorName;
    public $heroName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_manuf','id_hero'], 'integer'],
            [['author'], 'safe'],
            [['name','authorName','heroName'], 'string'],
            [['name', 'desc_book', 'date_create', 'date_change', 'authorName','heroName'], 'safe'],
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
        $query = Books::find()->alias('t');

        // add conditions that should always apply here
        $query->joinWith(['author0']);
        $query->joinWith(['hero']);
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
                'heroName' => [
                    'asc' => ['heroes.name' => SORT_ASC],
                    'desc' => ['heroes.name' => SORT_DESC],
                    'label' => 'Главный герой'
                ],
                'date_create' => [
                    'asc' => ['date_create' => SORT_ASC],
                    'desc' => ['date_create' => SORT_DESC],
                    'label' => 'Дата создания'
                ],
            ]
        ]);

        $this->load($params,'');
////
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');\
//            return $dataProvider;
//        }
//
        // grid filtering conditions
        $query->andFilterWhere([
            't.id' => $this->id,
//            't.id_hero' => $this->id_hero,
            't.date_manuf' => $this->date_manuf,
            't.date_create' => $this->date_create,
            't.date_change' => $this->date_change,
        ]);

        $query->andFilterWhere(['like', 't.name', $this->name])
            ->andFilterWhere(['like', 't.desc_book', $this->desc_book])
            ->andFilterWhere(['like', 'heroes.name', $this->heroName])

            // ->andFilterWhere(['like', 'date_create', $this->authorName])
            ->andFilterWhere(['like', 'avtor.name', $this->authorName]);

        return $dataProvider;
    }
}