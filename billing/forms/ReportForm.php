<?php
namespace billing\forms;

use billing\entities\Member;
use yii\base\Model;

/**
 * Refill Balance form
 */
class ReportForm extends Model
{
    public $id;
    public $phone;
    public $date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'date'], 'trim'],
            ['date', 'required'],
            ['id', 'integer'],
            ['phone', 'string', 'max' => 10],
            ['date', 'string'],
            ['id', 'exist', 'targetClass' => Member::class, 'message' => 'Member ID not found.'],
            ['phone', 'exist', 'targetClass' => Member::class, 'message' => 'Phone number not found.'],
        ];
    }
}
