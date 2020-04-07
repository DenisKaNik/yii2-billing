<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model billing\forms\MemberForm */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

    <div class="modal-body">
        <div class="member-form box box-primary">
            <div class="box-body table-responsive">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::class, [
                    'mask' => '9999999999',
                ]) ?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?= Html::button('Save', ['class' => 'btn btn-success btn-flat', 'data-action' => 'MEMBER-SAVE']) ?>
    </div>

<?php ActiveForm::end(); ?>

