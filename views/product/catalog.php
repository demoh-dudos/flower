<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
echo "<h1>Каталог товаров</h1>
<!--Поместите здесь элементы управления каталогом в соответсвии с заданием-->
";
$products=$dataProvider->getModels();
echo "<div class='d-flex flex-row flex-wrap justify-content-start border
border-1 border-info align-items-end'>";
foreach ($products as $product){
    if ($product->count>0) {
        echo "<div class='card m-1' style='width: 22%; min-width: 300px;'>
 <a href='/product/view?id={$product->id}'><img src='{$product->image}'
class='card-img-top' style='max-height: 300px;' alt='image'></a>
 <div class='card-body'>
 <h5 class='card-title'>{$product->name}</h5>
 <p class='text-danger'>{$product->price} руб</p>";
        echo (Yii::$app->user->isGuest ? "<a href='/product/view?
id={$product->id}' class='btn btn-primary'>Просмотр товара</a>": "<p
onclick='add_product({$product->id})' class='btn btn-primary'>Добавить в корзину</p>");
        echo "</div>
</div>";}
}
echo "</div>";
?>
