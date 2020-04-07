<?php

namespace app\controllers\ajax;

use app\filters\AjaxAccess;
use Yii;
use yii\web\{
    BadRequestHttpException,
    Controller,
    Response
};
use yii\filters\VerbFilter;

class BaseAjaxController extends Controller
{
    /**
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        if (@$result['status'] == 'error') {
            Yii::$app->response->statusCode = 400;
        }

        return $result;
    }

    public function behaviors(): array
    {
        return [
            'ajax' => [
                'class' => AjaxAccess::class,
                'actions' => [
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                ],
            ],
        ];
    }
}
