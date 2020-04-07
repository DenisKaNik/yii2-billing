<?php
namespace billing\forms;

use billing\entities\Member;
use yii\base\Model;

/**
 * Member form
 */
class MemberForm extends Model
{
    public $phone;
    public $first_name;
    public $last_name;
    public $middle_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'first_name', 'last_name', 'middle_name'], 'trim'],
            [['phone', 'first_name', 'last_name', 'middle_name'], 'required'],
            ['phone', 'string', 'max' => 10],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            ['phone', 'unique', 'targetClass' => Member::class, 'message' => 'Phone number already exists.'],
        ];
    }
}
