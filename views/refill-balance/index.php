<?php

use app\helpers\RefillBalanceHelper;
use billing\entities\RefillBalance;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Refill Balances';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="refill-balance-index box box-primary">
    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'dd.MM.YYYY HH:mm:ss'],
                ],
                'member.fullName',
                'sum',
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function (RefillBalance $model) {
                        return RefillBalanceHelper::statusLabel($model->status);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
