<?php 

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $fileName;

    public function rules()
    {   
        return [
            [['fileName'], 'file', 'skipOnEmpty' => false],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->fileName->saveAs('csv/' . $this->fileName->baseName . '.' . $this->fileName->extension);
            return true;
        } else {
            return false;
        }
    }
}