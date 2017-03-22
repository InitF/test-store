<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 20.03.17
 * Time: 22:36
 */

namespace common\models;


class Tree extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    /**
     * Override isDisabled method if you need as shown in the
     * example below. You can override similarly other methods
     * like isActive, isMovable etc.
     */
    /*public function isDisabled()
    {
        if (\Yii::$app->user->username !== 'admin') {
            return true;
        }
        return parent::isDisabled();
    }*/
}