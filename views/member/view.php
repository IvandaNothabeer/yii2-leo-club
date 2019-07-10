<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

use app\models\Membertype;
use yii\helpers\ArrayHelper;

/**
* @var yii\web\View $this
* @var app\models\Member $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud member-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('models', 'Member') ?>
        <small>
            <?= Html::encode($model->id) ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit',
                [ 'update', 'id' => $model->id],
                ['class' => 'btn btn-info']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-copy"></span> ' . 'Copy',
                ['create', 'id' => $model->id, 'Member'=>$copyParams],
                ['class' => 'btn btn-success']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . 'New',
                ['create'],
                ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . 'Full list', ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('app\models\Member'); ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'lastname',
            'address:ntext',
            'city',
            [
                'label'  => 'membership',
                'value'  => (ArrayHelper::map(Membertype::find()->all(), 'id', 'type'))[$model->membership],
            ],
            'joined',
            'active',
            'telephone',
            'mobile',
            'email:email',
        ],
    ]); ?>


    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Delete', ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
            'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('Dogs'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Dogs',
                ['dog/index'],
                ['class'=>'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Dog',
                ['dog/create', 'Dog' => ['member_id' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            ); ?>
        </div>
    </div>
    <?php Pjax::begin(['id'=>'pjax-Dogs', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Dogs ul.pagination a, th a']) ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getDogs(),
            'pagination' => [
                'pageSize' => 20,
                'pageParam'=>'page-dogs',
            ]
        ]),
        'pager'        => [
            'class'          => yii\widgets\LinkPager::className(),
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            [
                'class'      => 'yii\grid\ActionColumn',
                'template'   => '{view} {update}',
                'contentOptions' => ['nowrap'=>'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'dog' . '/' . $action;
                    $params['Dog'] = ['member_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons'    => [

                ],
                'controller' => 'dog'
            ],
            'id',
            'name:ntext',
            'pedigreeName:ntext',
            'breeder:ntext',
            'dob',
            'sex',
            'link:ntext',
            'created_at',
            'updated_at',
        ]
    ])
    . '</div>' 
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('Transactions'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Transactions',
                ['transaction/index'],
                ['class'=>'btn text-muted btn-xs']
            ) ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Transaction',
                ['transaction/create', 'Transaction' => ['member_id' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            ); ?>
        </div>
    </div>
    <?php Pjax::begin(['id'=>'pjax-Transactions', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Transactions ul.pagination a, th a']) ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getTransactions(),
            'pagination' => [
                'pageSize' => 20,
                'pageParam'=>'page-transactions',
            ]
        ]),
        'pager'        => [
            'class'          => yii\widgets\LinkPager::className(),
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            [
                'class'      => 'yii\grid\ActionColumn',
                'template'   => '{view} {update}',
                'contentOptions' => ['nowrap'=>'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'transaction' . '/' . $action;
                    $params['Transaction'] = ['member_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons'    => [

                ],
                'controller' => 'transaction'
            ],
            'id',
            'date',
            'type',
            'description',
            'amount',
            'payment_method',
            'reference',
            'account',
            'created_at',
        ]
    ])
    . '</div>' 
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?= Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label'   => '<b class=""># '.Html::encode($model->id).'</b>',
                    'content' => $this->blocks['app\models\Member'],
                    'active'  => true,
                ],
                [
                    'content' => $this->blocks['Dogs'],
                    'label'   => '<small>Dogs <span class="badge badge-default">'. $model->getDogs()->count() . '</span></small>',
                    'active'  => false,
                ],
                [
                    'content' => $this->blocks['Transactions'],
                    'label'   => '<small>Transactions <span class="badge badge-default">'. $model->getTransactions()->count() . '</span></small>',
                    'active'  => false,
                ],
            ]
        ]
    );
    ?>
</div>
