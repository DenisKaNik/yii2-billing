<?php

namespace billing\repositories;

use billing\entities\RefillBalance;

class RefillBalanceRepository
{
    public function get($id): RefillBalance
    {
        if (!$refillBalance = RefillBalance::findOne($id)) {
            throw new NotFoundException('Refill balance is not found.');
        }
        return $refillBalance;
    }

    /**
     * @param $memberId
     */
    public function getByMemberId($memberId): void
    {
        if (!RefillBalance::find()->where(['member_id' => $memberId])->count()) {
            throw new NotFoundException('Member refill balance not found.');
        }
    }

    /**
     * @param RefillBalance $refillBalance
     */
    public function save(RefillBalance $refillBalance): void
    {
        if (!$refillBalance->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param RefillBalance $refillBalance
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(RefillBalance $refillBalance): void
    {
        if (!$refillBalance->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
