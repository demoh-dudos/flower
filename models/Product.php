<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $country
 * @property string|null $image
 * @property string $color
 * @property int $category_id
 * @property int $count
 * @property string $date
 *
 * @property Cart[] $carts
 * @property Category $category
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'country', 'color', 'category_id', 'count'], 'required'],
            [['name', 'color'], 'string'],
            [['price'], 'number'],
            [['category_id', 'count'], 'integer'],
            [['date'], 'safe'],
            [['country'], 'string', 'max' => 500],
            [['image'], 'file',  'extensions' => ['png', 'jpg', 'gif'],'skipOnEmpty' => false ],
           [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
            'country' => 'Страна',
            'image' => 'Фото',
            'color' => 'Цвет',
            'category_id' => 'Category ID',
            'count' => 'Штук',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['product_id' => 'id']);
    }
}
