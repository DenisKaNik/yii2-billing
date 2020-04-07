<?php

namespace app\controllers;

use billing\entities\RefillBalance;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * RefillBalanceController implements the CRUD actions for RefillBalance model.
 */
class RefillBalanceController extends Controller
{
    /**
     * Lists all RefillBalance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RefillBalance::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
