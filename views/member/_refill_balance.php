<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model billing\forms\RefillBalanceForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal fade" id="modalRefillBalance" tabindex="-1" role="dialog" aria-labelledby="modalRefillBalanceLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalRefillBalanceLabel">Refill Balance</h4>
            </div>

            <?php $form = ActiveForm::begin(); ?>

            <div class="modal-body">
                <div class="member-form box box-primary">
                    <div class="box-body table-responsive">
                        <?= $form->field($model, 'sum')->textInput(['maxlength' => true, 'class' => 'form-control decimal', 'placeholder' => '9999.99']) ?>

                        <?= $form->field($model, 'id')
                            ->textInput(['maxlength' => true, 'class' => 'form-control number', 'placeholder' => '9999'])
                            ->label('Member ID')
                        ?>

                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '9999999999',
                        ]) ?>

                        <div class="form-group field-refillbalanceform-error">
                            <input type="hidden" id="refillbalanceform-error" />
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close_modal" data-dismiss="modal">Close</button>
                <?= Html::button('Save', ['class' => 'btn btn-success btn-flat', 'data-action' => 'REFILL-BALANCE']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
