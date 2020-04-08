<?php

namespace fixtures;

use yii\test\ActiveFixture;

class RefillBalanceFixture extends ActiveFixture
{
    public $modelClass = 'billing\entities\RefillBalance';
    public $dataFile = '@fixtures/data/refill-balance.php';
}