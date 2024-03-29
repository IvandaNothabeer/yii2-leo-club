<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var app\models\Transaction $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Transaction',
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
            

<!-- attribute member_id -->
			<?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'member_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\Member::find()->all(), 'id', 'id'),
    [
        'prompt' => 'Select',
        'disabled' => (isset($relAttributes) && isset($relAttributes['member_id'])),
    ]
); ?>

<!-- attribute date -->
			<?= $form->field($model, 'date')->textInput() ?>

<!-- attribute type -->
			<?= $form->field($model, 'type')->textInput() ?>

<!-- attribute amount -->
			<?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

<!-- attribute description -->
			<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!-- attribute payment_method -->
			<?= $form->field($model, 'payment_method')->textInput(['maxlength' => true]) ?>

<!-- attribute reference -->
			<?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

<!-- attribute account -->
			<?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                    'encodeLabels' => false,
                    'items' => [ 
                        [
    'label'   => Yii::t('models', 'Transaction'),
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

