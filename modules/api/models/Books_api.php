<?php


namespace app\modules\api\models;

use app\models\Authors;
use app\models\Books;
use app\models\Heroes;

class Books_api extends Books{
    public function fields()
    {
        return [
            'id',
            'name',
            'author' => function(){
                return $this->author0->name;
            },
            'hero' => function(){
                return $this->hero->name;
            },
            'date_create',
        ];
    }
}