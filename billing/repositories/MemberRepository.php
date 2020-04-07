<?php

namespace billing\repositories;

use billing\entities\Member;

class MemberRepository
{
    public function get($id): Member
    {
        if (!$member = Member::findOne($id)) {
            throw new NotFoundException('Member is not found.');
        }
        return $member;
    }

    public function getByPhone($phone): Member
    {
        if (!$member = Member::findOne(['phone' => $phone])) {
            throw new NotFoundException('Member is not found.');
        }
        return $member;
    }

    public function save(Member $member): void
    {
        if (!$member->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Member $member
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Member $member): void
    {
        if (!$member->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
