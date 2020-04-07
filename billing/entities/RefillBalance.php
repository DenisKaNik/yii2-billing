<?php

namespace billing\entities;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%refill_balance}}".
 *
 * @property int $id
 * @property int $member_id
 * @property float $sum
 * @property int $status
 * @property int $created_at
 *
 * @property Member $member
 */
class RefillBalance extends ActiveRecord
{
    const STATUS_CANCEL = 0;
    const STATUS_SUCCESS = 1;

    public static function create(float $sum): self
    {
        $refillBalance = new static();
        $refillBalance->sum = $sum;
        $refillBalance->status = self::STATUS_SUCCESS;
        $refillBalance->created_at = time();
        return $refillBalance;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%refill_balance}}';
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::class, ['id' => 'member_id']);
    }
}
