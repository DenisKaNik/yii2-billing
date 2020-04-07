<?php

namespace app\filters;

use Yii;
use yii\base\{
    Action,
    ActionFilter
};
use yii\web\{
    Controller,
    ForbiddenHttpException
};

class AjaxAccess extends ActionFilter
{
    public $actions = [];

    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param Action $event
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($event)
    {
        if ((!Yii::$app->request->isAjax
                || !array_key_exists($event->id, array_flip($this->actions))
                || !$this->_checkReferrer()
            ) && !YII_DEBUG
        ) {
            throw new ForbiddenHttpException('The requested page does not exist.');
        }

        return parent::beforeAction($event);
    }

    private function _checkReferrer()
    {
        return (bool)strpos(Yii::$app->request->referrer, env('HTTP_HOST', 'localhost'));
    }
}
