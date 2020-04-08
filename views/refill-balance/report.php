<?php

use billing\entities\RefillBalance;
use app\helpers\{
    MemberHelper,
    RefillBalanceHelper
};

$this->title = 'Report';

/* @var $request yii\web\Request */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?= $this->render('_search', ['request' => $request]); ?>

<div class="row">

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Report Table</h3>
            </div>

            <?php if ($dataProvider->getCount()): ?>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Created At</th>
                                <th>Member</th>
                                <th>Sum</th>
                                <th>Status</th>
                                <th width="100px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $i => $model): ?>

                                <tr data-key="<?=$model->id?>">
                                    <td><?=($i+1);?></td>
                                    <td><?=date('d.m.Y H:i:s', $model->created_at);?></td>
                                    <td>
                                        <?=$model->member->fullName;?><br />
                                        <?=MemberHelper::formatterPhone($model->member->phone);?>
                                    </td>
                                    <td class="cell-sum">
                                        <?php if ($model->status === RefillBalance::STATUS_SUCCESS): ?>
                                            <?=$sum[] = $model->sum;?>
                                        <?php else: ?>
                                            <s><?=$model->sum;?></s>
                                        <?php endif; ?>
                                    </td>
                                    <td class="cell-status"><?=RefillBalanceHelper::statusLabel($model->status);?></td>
                                    <td class="cell-btn_cancel">
                                        <?php if ($model->status === RefillBalance::STATUS_SUCCESS): ?>
                                            <button type="button" class="btn btn-block btn-danger" data-action="REFILL_BALANCE-CANCEL" data-value="<?=$model->id?>">Cancel</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="box-footer clearfix">
                    <div class="no-margin pull-right">
                        <b>Total success sum:</b> <span class="totalSum"><?=array_sum($sum);?></span>
                    </div>
                </div>

            <?php else: ?>

                <div class="callout callout-warning">
                    <p>Not found records.</p>
                </div>

            <?php endif; ?>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</div>
