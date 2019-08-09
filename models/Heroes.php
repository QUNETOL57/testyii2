<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "heroes".
 *
 * @property int $id
 * @property string $name
 * @property string $about
 * @property string $image
 * @property string $date_create
 * @property string $date_change
 *
 * @property Books[] $books
 */
class Heroes extends \yii\db\ActiveRecord
{
    public $fileImage;

    public static function tableName()
    {
        return 'heroes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'about'], 'required'],
            [['date_create', 'date_change', 'image'], 'safe'],
            [['name', 'about'], 'string', 'max' => 255],
            [['fileImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->fileImage->saveAs('img/' . $this->fileImage->baseName . '.' . $this->fileImage->extension);
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert){
        if(!$this->isNewRecord && self::getOldAttribute('image') != ''){
                $this->image = self::getOldAttribute('image');
        }
        return parent::beforeSave($insert); 
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'about' => 'Описание',
            'image' => 'Изображение',
            'date_create' => 'Дата создания',
            'date_change' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['id_hero' => 'id']);
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
