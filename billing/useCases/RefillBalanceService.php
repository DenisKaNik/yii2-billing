<?php

namespace billing\useCases;

use billing\forms\ReportForm;
use billing\repositories\{
    MemberRepository,
    RefillBalanceRepository
};

class RefillBalanceService
{
    private $refillBalances;
    private $members;

    /**
     * RefillBalanceService constructor.
     * @param RefillBalanceRepository $refillBalances
     * @param MemberRepository $members
     */
    public function __construct(RefillBalanceRepository $refillBalances, MemberRepository $members)
    {
        $this->refillBalances = $refillBalances;
        $this->members = $members;
    }

    /**
     * @param ReportForm $form
     */
    public function report(ReportForm $form): void
    {
        if ($form->id) {
            $member = $this->members->get($form->id);
        } elseif ($form->phone) {
            $member = $this->members->getByPhone($form->phone);
        } else {
            $member = null;
        }

        if ($member) {
            $this->refillBalances->getByMemberId($member->id);
        }
    }

    public function cancel($id, &$refillBalance): void
    {
        $refillBalance = $this->refillBalances->get($id);
        $refillBalance->cancel();
        $this->refillBalances->save($refillBalance);
    }
}
