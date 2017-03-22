<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_url
 * @property integer $tree_id
 * @property integer $is_hidden
 *
 * @property ProductTags[] $productTags
 * @property Tree $tree
 */
class Products extends \yii\db\ActiveRecord
{
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
            [['image_url'], 'string', 'max' => 100],
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
            'image_url' => 'Изображение',
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
        if ($this->image_url != NULL){
            return [$this->image_url];
        }
        return [];
    }

    public function upload()
    {
        $path = '/var/www/work/test-store/frontend/web/img/products/' . $this->image_url[0]->baseName . '.' . $this->image_url[0]->extension;
        $web_path = '/img/products/' . $this->image_url[0]->baseName . '.' . $this->image_url[0]->extension;
        $this->image_url[0]->saveAs($path);
        $this->image_url = $web_path;
        return true;
    }

}
