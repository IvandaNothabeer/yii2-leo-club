<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\grid\EditableColumn;

/**
* @var yii\web\View $this
* @var app\models\Dog $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('cruds', 'Dog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Dogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud dog-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('cruds', 'Dog') ?>        <small>
        <?= $model->name ?>        </small>
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
                ['create', 'id' => $model->id, 'Dog'=>$copyParams],
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

    <hr />

    <?php $this->beginBlock('app\models\Dog'); ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'member_id',
            'name:ntext',
            'pedigreeName:ntext',
            'breeder:ntext',
            'dob',
            'sex',
            'link:url',
            ['label'=>'Created At', 'value'=>Yii::$app->formatter->asDatetime($model->created_at,'yyyy-MM-dd hh:mm')],
            ['label'=>'Updated At', 'value'=>Yii::$app->formatter->asDatetime($model->updated_at,'yyyy-MM-dd hh:mm')],
            'created_by',
            'updated_by',
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


    <div class="row">
        <div class="col-md-4">
            <?=$this->blocks['app\models\Dog']?>
        </div>
    </div>    
</div>
