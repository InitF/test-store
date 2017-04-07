<?php

namespace backend\controllers;


use yii\web\Controller;

class LogController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->log->getLogger();
        var_dump(1111);
    }
}