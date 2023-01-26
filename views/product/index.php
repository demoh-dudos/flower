<?php

use yii\helpers\Html; 
use yii\helpers\Url;
use yii\grid\ActionColumn; 
use yii\grid\GridView;
use app\models\Product; 
use app\models\Category;


/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'price',
            'country',
            'image',
            //'color:ntext',
            //'category_id',
            ['attribute'=>'Категория', 'value'=> function($data){return
                $data->getCategory()->One()->category;}],
                 'name',
                 ['attribute'=>'Фото', 'format'=>'html',
                'value'=>function($data){return"<img src='{$data->image}' alt='photo'
                style='width: 70px;'>";}],
            //'count',
            //'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
