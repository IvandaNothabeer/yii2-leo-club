<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Entry $model
*/

$this->title = Yii::t('models', 'Entry');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud entry-create">

    <h1>
        <?= Yii::t('models', 'Entry') ?>
        <small>
                        <?= Html::encode($model->id) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
