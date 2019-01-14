<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property double $price
 * @property string $condition
 * @property string $brand
 * @property string $content
 * @property string $top
 * @property string $new
 * @property string $sale
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['condition', 'content', 'top', 'new', 'sale'], 'string'],
            [['name', 'brand'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'price' => 'Price',
            'condition' => 'Condition',
            'brand' => 'Brand',
            'content' => 'Content',
            'top' => 'Top',
            'new' => 'New',
            'sale' => 'Sale',
        ];
    }
}
