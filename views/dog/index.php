<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use kartik\builder\Form;
use kartik\builder\FormGrid;


/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\DogSearch $searchModel
*/



/**
* create action column template depending acces rights
*/
$actionColumnTemplates = [];

if (\Yii::$app->user->can('app_dog_view')) { 
    $actionColumnTemplates[] = '{view}';
}

if (\Yii::$app->user->can('app_dog_update')) {
    $actionColumnTemplates[] = '{update}';
}

if (\Yii::$app->user->can('app_dog_delete')) {
    $actionColumnTemplates[] = '{delete}';
}
if (isset($actionColumnTemplates)) {
    $actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
    Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "{view} {update} {delete}";
}
?>
<div class="giiant-crud dog-index">

    <?php //             echo $this->render('_search', ['model' =>$searchModel]);
    ?>


    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= Yii::t('cruds', 'Dogs') ?>        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <?php
        if(\Yii::$app->user->can('app_dog_create')){
        ?>
            <div class="pull-left">
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        <?php
        }
        ?>
        <div class="pull-right">


            <?= 
            \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id' => 'giiant-relations',
                    'encodeLabel' => false,
                    'label' => '<span class="glyphicon glyphicon-paperclip"></span> ' . 'Relations',
                    'dropdown' => [
                        'options' => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items' => [            [
                            'url' => ['member/index'],
                            'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . 'Member' . '</i>',
                            ],]
                    ],
                    'options' => [
                        'class' => 'btn-default'
                    ]
                ]
            );
        ?>        </div>
    </div>

    <hr />

    <div class="table-responsive">
        <?= GridView::widget([
            'layout' => '{summary}{pager}{items}{pager}',
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last'        ],
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class'=>'x'],
            'columns' => [

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $actionColumnTemplateString,
                    'urlCreator' => function($action, $model, $key, $index) {
                        // using the column name as key, not mapping to 'id' like the standard generator
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                        return Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap'=>'nowrap']
                ],
                // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
                [
                    'class' => yii\grid\DataColumn::className(),
                    'attribute' => 'member_id',
                    'value' => function ($model) {
                        if ($rel = $model->member) {
                            return Html::a($rel->firstname.' '.$rel->lastname, ['member/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                        } else {
                            return '';
                        }
                    },
                    'format' => 'raw',
                ],
                'name:ntext',
                'pedigreeName:ntext',
                'sex',
                'breeder:ntext',
                'link:url',
                'dob',
            ],
        ]); ?>
    </div>


</div>


<?php \yii\widgets\Pjax::end() ?>


