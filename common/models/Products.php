<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $is_hidden
 * @property integer $image_url
 *
 * @property ProductTags[] $productTags
 * @property Categories $category
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
            [['category_id', 'is_hidden'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['image_url'], 'image', 'extensions' => 'png, jpg'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'category_id' => 'Категория',
            'is_hidden' => 'Скрыть',
            'image_url' => 'Изображение'
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
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
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
