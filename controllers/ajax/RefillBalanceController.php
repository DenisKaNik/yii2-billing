<?php

namespace app\controllers\ajax;

use app\helpers\RefillBalanceHelper;
use billing\forms\ReportForm;
use billing\useCases\RefillBalanceService;
use yii\helpers\Url;
use Yii;
use yii\web\BadRequestHttpException;

class RefillBalanceController extends BaseAjaxController
{
    private $service;

    public function __construct($id, $module, RefillBalanceService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionReport()
    {
        $form = new ReportForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->report($form);

                return [
                    'success' => 'true',
                    'redirect_url' => Url::toRoute(
                        array_filter([
                            'refill-balance/report',
                            'date' => RefillBalanceHelper::formatterDate($form->date),
                            'member_id' => $form->id ?? false,
                            'phone' => $form->phone ?? false,
                        ]),
                        true
                    )
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

    public function actionCancel($id)
    {
        try {
            $this->service->cancel($id, $refillBalance);

            return [
                'success' => 'true',
                'sum' => $refillBalance->sum,
                'statusLabel' => RefillBalanceHelper::statusLabel($refillBalance->status),
            ];

        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }
}
