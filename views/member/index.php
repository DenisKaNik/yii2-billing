<?php

use billing\entities\Member;
use components\StatusColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model billing\forms\MemberForm */
/* @var $modelRefillBalance billing\forms\RefillBalanceForm */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index box box-primary">
    <?php Pjax::begin(); ?>

    <div class="box-header with-border">
        <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalCreateMember">
            Create Member
        </button>
        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalRefillBalance">
            Refill Balance
        </button>
    </div>

    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'phone',
                'fullName',
                [
                    'attribute' => 'balance',
                    'format' => 'html',
                    'value' => function(Member $model) {
                        return Html::tag('span', $model->balance, ['class' => 'cell-balance']);
                    },
                ],
                ['class' => StatusColumn::class],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<!-- Modal -->
<?= $this->render('create', [
    'model' => $model,
]) ?>

<?= $this->render('_refill_balance', [
    'model' => $modelRefillBalance,
]) ?>
