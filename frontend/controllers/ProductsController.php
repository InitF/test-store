<?php

namespace frontend\controllers;


use yii\rest\ActiveController;

class ProductsController extends ActiveController
{
    public $modelClass = 'common\models\Products';
}