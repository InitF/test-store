<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_name
 * @property integer $tree_id
 * @property integer $is_hidden
 *
 * @property ProductTags[] $productTags
 * @property Tree $tree
 */
class Products extends \yii\db\ActiveRecord
{
    const FRONTEND_URL = 'http://f.test-store.test';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['tree_id', 'is_hidden'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['image_name'], 'image'],
            [['tree_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tree::className(), 'targetAttribute' => ['tree_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'image_name' => 'Изображение',
            'tree_id' => 'Категория',
            'is_hidden' => 'Скрыть',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTags::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTree()
    {
        return $this->hasOne(Tree::className(), ['id' => 'tree_id']);
    }

    public function getImageUrlForBack()
    {
        if ($this->image_name != NULL){
            return [self::FRONTEND_URL . Yii::getAlias('@productsImageWebPath'). '/' .  $this->image_name];
        }
        return [];
    }

    public function upload()
    {
        $path = Yii::getAlias('@productsImageDir') . '/' . $this->image_name[0]->baseName  . '.' . $this->image_name[0]->extension;
        $web_path = $this->image_name[0]->baseName . '.' . $this->image_name[0]->extension;
        $this->image_name[0]->saveAs($path);
        $this->image_name = $web_path;
        return true;
    }

    public function getFileInfoForBack()
    {
        $fileName = explode('/', $this->image_name);
        $fileName = $fileName[count($fileName) - 1];
        $fileSize = filesize(Yii::getAlias('@productsImageDir') . '/' . $fileName);
        return ['size' => $fileSize, 'caption' => $fileName, 'showDrag' => false];
    }

}
