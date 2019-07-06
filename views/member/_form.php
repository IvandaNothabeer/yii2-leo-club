<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var app\models\Member $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="member-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Member',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-danger',
    'fieldConfig' => [
             'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
             'horizontalCssClasses' => [
                 'label' => 'col-sm-2',
                 #'offset' => 'col-sm-offset-4',
                 'wrapper' => 'col-sm-8',
                 'error' => '',
                 'hint' => '',
             ],
         ],
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            

<!-- attribute firstname -->
			<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

<!-- attribute lastname -->
			<?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

<!-- attribute address -->
			<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

<!-- attribute city -->
			<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

<!-- attribute membership -->
			<?= $form->field($model, 'membership')->dropDownList(['Single','Family','Life','Expired']) ?>

<!-- attribute joined -->
			<?= $form->field($model, 'joined')->widget(\yii\jui\DatePicker::class, ['dateFormat'=>'yyyy-MM-dd',]) ?>

<!-- attribute active -->
			<?= $form->field($model, 'active')->dropDownList(['No','Yes']) ?>

<!-- attribute telephone -->
			<?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

<!-- attribute mobile -->
			<?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

<!-- attribute email -->
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                    'encodeLabels' => false,
                    'items' => [ 
                        [
    'label'   => Yii::t('models', 'Member'),
    'content' => $this->blocks['main'],
    'active'  => true,
],
                    ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? 'Create' : 'Save'),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

