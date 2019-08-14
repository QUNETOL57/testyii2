<?php


namespace app\modules\api\forms;


use yii\base\Model;

class BooksForm extends Model {
    public $name;
    public $author;
    public $date_create;
    public $authorName;
    public $heroName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author', 'authorName','heroName'], 'string'],
            [['name', 'author','date_create','authorName','heroName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'author' => 'Автор',
        ];
    }
}