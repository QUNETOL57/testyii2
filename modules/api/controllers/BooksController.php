<?php

namespace app\modules\api\controllers;

use app\models\Authors;
use app\models\Books;
use app\models\BooksSearch;
use app\modules\api\models\BooksSearchApi;
use app\modules\api\forms\BooksForm;
use app\modules\api\models\Books_api;
use Yii;
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
    public $modelClass = 'app\modules\api\models\Books_api';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],$actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }


//    public function actionIndex(){
//        return $this->render('default\index');
//    }

    public function actionView($id){
        return Books_api::findOne($id);
    }

    public function actionCreate(){
        $form = new BooksForm();
        $form->load(Yii::$app->request->post(), '');
        if ($form->validate()) {
            $model = new Books();
            $model->setAttributes($form->getAttributes());
            $model->author = Authors::IdAuthor($model->author);
            if (!$model->save()) {
                throw new \Exception(implode(';', $model->getFirstErrors()));
            }
            return $model;
        } else {
            throw new \Exception(implode(';', $form->getFirstErrors()));
//            return null;
        }
    }

    public function prepareDataProvider(){
        $form = new BooksForm();
        $form->load(Yii::$app->request->queryParams, '');
        if ($form->validate()){
            $search = new BooksSearchApi();
            return $search->search($form->getAttributes());
        }
        throw new \Exception(implode(';', $form->getFirstErrors()));

    }
}
