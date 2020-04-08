<?php

namespace fixtures;

use yii\test\ActiveFixture;

class MemberFixture extends ActiveFixture
{
    public $modelClass = 'billing\entities\Member';
    public $dataFile = '@fixtures/data/member.php';
}