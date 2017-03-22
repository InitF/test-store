<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tree\TreeViewInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->widget(FileInput::className(), [
        'pluginOptions' => [
            'initialPreview'=>$model->getImageUrlForBack(),
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>false,
        ]
    ])?>

    <?= $form->field($model, 'tree_id')->widget(TreeViewInput::className(), [
        'value' => 'false',
        'query' => \common\models\Tree::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Categories'],
        'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
        'fontAwesome' => true,
        'asDropdown' => true,
        'multiple' => false,
        'options' => ['disabled' => false]
    ]) ?>

    <?= $form->field($model, 'is_hidden')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
