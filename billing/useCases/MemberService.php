<?php

namespace billing\useCases;

use billing\entities\Member;
use billing\forms\MemberForm;
use billing\forms\RefillBalanceForm;
use billing\repositories\MemberRepository;

class MemberService
{
    private $members;

    /**
     * MemberService constructor.
     * @param MemberRepository $members
     */
    public function __construct(MemberRepository $members)
    {
        $this->members = $members;
    }

    /**
     * @param MemberForm $form
     */
    public function add(MemberForm $form): void
    {
        $member = Member::create(
            $form->phone,
            $form->first_name,
            $form->last_name,
            $form->middle_name,
        );

        $this->members->save($member);
    }

    public function activate($id): void
    {
        $member = $this->members->get($id);
        $member->activate();
        $this->members->save($member);
    }

    public function inActivate($id): void
    {
        $member = $this->members->get($id);
        $member->inActivate();
        $this->members->save($member);
    }

    /**
     * @param RefillBalanceForm $form
     * @return Member
     */
    public function refillBalance(RefillBalanceForm $form): Member
    {
        if ($form->id) {
            $member = $this->members->get($form->id);
        } elseif ($form->phone) {
            $member = $this->members->getByPhone($form->phone);
        } else {
            $member = null;
        }

        if (!$member) {
            throw new \DomainException('Enter Member ID or phone number.');
        } elseif ($member->status != Member::STATUS_ACTIVE) {
            throw new \DomainException('Refill balance is not available, member is inactive.');
        }

        $member->refillBalance($form->sum);
        $this->members->save($member);

        return $member;
    }
}
