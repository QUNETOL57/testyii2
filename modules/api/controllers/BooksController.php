<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Books controller for the `api` module
 */
class BooksController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $modelClass = 'app\models\Books';

    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }
}
