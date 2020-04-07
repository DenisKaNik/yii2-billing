<?php
namespace billing\forms;

use billing\entities\Member;
use yii\base\Model;

/**
 * Refill Balance form
 */
class RefillBalanceForm extends Model
{
    public $id;
    public $phone;
    public $sum;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'sum'], 'trim'],
            ['sum', 'required'],
            ['id', 'integer'],
            ['phone', 'string', 'max' => 10],
            ['sum', 'match', 'pattern' => '#[0-9\.]#'],
            ['sum', 'double'],
            ['id', 'exist', 'targetClass' => Member::class, 'message' => 'Member ID not found.'],
            ['phone', 'exist', 'targetClass' => Member::class, 'message' => 'Phone number not found.'],
        ];
    }
}
