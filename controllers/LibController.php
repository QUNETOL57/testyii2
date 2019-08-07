<?php 


namespace app\controllers;

use yii\web\Controller;
use app\models\Authors; 

class LibController extends Controller{

    public function actionIndex(){
        $authors = Authors::find()->with('books')->all();
        return $this->render('index',compact('authors'));
    }   
}