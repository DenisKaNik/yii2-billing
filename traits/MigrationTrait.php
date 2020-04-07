<?php

namespace traits;

use Yii;

trait MigrationTrait
{
    private function _mySqlTableOptions()
    {
        if (isset(Yii::$app->params['mysqlTableOptions'])) {
            return Yii::$app->params['mysqlTableOptions'];
        }

        return false;
    }

    public function getTableOptions()
    {
        switch ($this->db->driverName) {
            case 'mysql':
                $options = $this->_mySqlTableOptions();
                break;
        }

        return $options ?? '';
    }
}
