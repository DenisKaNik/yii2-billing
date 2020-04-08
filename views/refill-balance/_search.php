<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $request yii\web\Request */

$this->registerJs(
    "$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})"
);
?>

<div class="row">
    <div class="col-md-4">

        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Search</h3>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group field-reportform-date">
                    <label>Date range:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="reservationtime" name="ReportForm[date]" value="<?= isset($request['date']) ? implode(' - ', $request['date']) : ''; ?>" />
                    </div>
                    <span class="help-block"></span>
                </div>

                <div class="form-group field-reportform-id">
                    <label>Member ID:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control number" placeholder="9999" name="ReportForm[id]" value="<?= $request['member_id'] ?? ''; ?>" />
                    </div>
                    <span class="help-block"></span>
                </div>

                <div class="form-group field-reportform-phone">
                    <label>Phone:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control phone" name="ReportForm[phone]" value="<?= $request['phone'] ?? ''; ?>" />
                    </div>
                    <span class="help-block"></span>
                </div>

                <div class="form-group field-reportform-error">
                    <div class="help-block"></div>
                </div>

                <div class="box-footer">
                    <?= Html::button('Submit', ['class' => 'btn btn-warning', 'data-action' => 'GENERATE-REPORT']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>