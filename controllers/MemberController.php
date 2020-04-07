<?php

namespace app\controllers;

use billing\entities\Member;
use billing\forms\{
    MemberForm,
    RefillBalanceForm
};
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
{
    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Member::find(),
            ]),
            'model' => new MemberForm(),
            'modelRefillBalance' => new RefillBalanceForm(),
        ]);
    }
}
