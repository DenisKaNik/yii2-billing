<?php

namespace app\controllers\ajax;

use billing\forms\{
    MemberForm,
    RefillBalanceForm
};
use billing\useCases\MemberService;
use Yii;
use yii\web\BadRequestHttpException;

class MemberController extends BaseAjaxController
{
    private $service;

    public function __construct($id, $module, MemberService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionPost()
    {
        $form = new MemberForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->add($form);

                return [
                    'success' => 'true',
                ];
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);

                return [
                    'status' => 'error',
                    'errors' => [
                        'error' => [$e->getMessage()],
                    ],
                ];
            }
        } else {
            return [
                'status' => 'error',
                'errors' => $form->errors ?: [
                    'error' => ['Failed to verify the transferred data.'],
                ],
            ];
        }
    }

    /**
     * @param $id
     */
    public function actionActive($id)
    {
        try {
            $this->service->activate($id);
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    /**
     * @param $id
     */
    public function actionInactive($id)
    {
        try {
            $this->service->inActivate($id);
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    public function actionRefillBalance()
    {
        $form = new RefillBalanceForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $member = $this->service->refillBalance($form);

                return [
                    'success' => 'true',
                    'id' => $member->id,
                    'balance' => $member->balance,
                ];
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);

                return [
                    'status' => 'error',
                    'errors' => [
                        'error' => [$e->getMessage()],
                    ],
                ];
            }
        } else {
            return [
                'status' => 'error',
                'errors' => $form->errors ?: [
                    'error' => ['Failed to verify the transferred data.'],
                ],
            ];
        }
    }
}
