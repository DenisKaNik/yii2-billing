<?php

namespace app\helpers;

use billing\entities\RefillBalance;
use yii\helpers\{
    ArrayHelper,
    Html
};

class RefillBalanceHelper
{
    public static function statusList(): array
    {
        return [
            RefillBalance::STATUS_SUCCESS => 'Success',
            RefillBalance::STATUS_CANCEL => 'Cancel',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status) ?: 'Not defined';
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case RefillBalance::STATUS_SUCCESS:
                $class = 'label label-success';
                break;
            case RefillBalance::STATUS_CANCEL:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
                break;
        }

        return Html::tag('span', self::statusName($status), ['class' => $class]);
    }
}
