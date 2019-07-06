<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\DogSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="dog-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'member_id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'pedigreeName') ?>

		<?= $form->field($model, 'breeder') ?>

		<?php // echo $form->field($model, 'dob') ?>

		<?php // echo $form->field($model, 'sex') ?>

		<?php // echo $form->field($model, 'link') ?>

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
