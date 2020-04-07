<?php

namespace billing\entities;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\{
    ActiveQuery,
    ActiveRecord
};

/**
 * This is the model class for table "{{%members}}".
 *
 * @property int $id
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property float $balance
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property RefillBalance[] $refillBalance
 */
class Member extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public static function create(string $phone, string $first_name, string $last_name, string $middle_name): self
    {
        $member = new static();
        $member->phone = $phone;
        $member->first_name = $first_name;
        $member->last_name = $last_name;
        $member->middle_name = $middle_name;
        $member->status = self::STATUS_INACTIVE;
        return $member;
    }

    public function getRefillBalance(): ActiveQuery
    {
        return $this->hasMany(RefillBalance::class, ['member_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%members}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['refillBalance'],
            ],
        ];
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('phone', str_replace(['+7', '(', ')', '-', ' '], '', $this->phone));

        return parent::beforeSave($insert);
    }

    public function getFullName()
    {
        return implode(' ', [
            $this->first_name,
            $this->last_name,
            $this->middle_name,
        ]);
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Member is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function inActivate(): void
    {
        if ($this->isInActive()) {
            throw new \DomainException('Member is already inactive.');
        }
        $this->status = self::STATUS_INACTIVE;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInActive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function refillBalance($sum): void
    {
        $refillBalance = $this->refillBalance;
        $refillBalance[] = RefillBalance::create($sum);
        $this->refillBalance = $refillBalance;

        $this->updateBalance($this->refillBalance);
    }

    private function updateBalance(array $refillBalance): void
    {
        $this->setBalance(
            array_sum(
                array_map(
                    function (RefillBalance $refillBalance) {
                        return
                            $refillBalance->status == RefillBalance::STATUS_SUCCESS
                                ? $refillBalance->sum
                                : 0;
                    },
                    $refillBalance
                )
            )
        );
    }

    private function setBalance($balance): void
    {
        $this->balance = $balance;
    }
}
