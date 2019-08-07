<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use app\models\BookChangeDesc;
/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property string $desc_book
 * @property int $date_manuf
 * @property int $author
 * @property string $date_create
 * @property string $date_change
 *
 * @property BookChangeDesc[] $bookChangeDescs
 * @property Authors $author0
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author'], 'required'],
            [['desc_book'], 'string'],
            [['date_manuf', 'author'], 'integer'],
            [['date_create', 'date_change'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author' => 'id']],
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
            'desc_book' => 'Описание',
            'date_manuf' => 'Год выпуска',
            'author' => 'Автор',
            'date_create' => 'Дата создания',
            'date_change' => 'Дата изменения',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $model = new BookChangeDesc;
            $model['id_book'] = $this->id;
            $model['old_desc_book'] = $this->getOldAttribute('desc_book');
            // echo $model['old_desc_book'];
            $model->save();
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookChangeDescs()
    {
        return $this->hasMany(BookChangeDesc::className(), ['id_book' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author']);
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