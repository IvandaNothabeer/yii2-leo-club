<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\MemberSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'firstname') ?>

		<?= $form->field($model, 'lastname') ?>

		<?= $form->field($model, 'address') ?>

		<?= $form->field($model, 'city') ?>

		<?php // echo $form->field($model, 'telephone') ?>

		<?php // echo $form->field($model, 'mobile') ?>

		<?php // echo $form->field($model, 'joined') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'active') ?>

		<?php // echo $form->field($model, 'membership') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
