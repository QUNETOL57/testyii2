<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $date_birth
 * @property string $biography
 * @property string $date_create
 * @property string $date_change
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $books_count;

    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'biography'], 'required'],
            [['date_birth', 'date_create', 'date_change'], 'safe'],
            [['biography'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'date_birth' => 'Дата Рождения',
            'biography' => 'Биография',
            'books_count' => 'Количество книг',
            'date_create' => 'Дата создания',
            'date_change' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks(){
        return $this->hasMany(Books::className(), ['author' => 'id']);
    }


    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_change'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_change'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
