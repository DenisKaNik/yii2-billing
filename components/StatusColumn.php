<?php

namespace components;

use traits\ColumnTrait;
use yii\grid\Column;
use yii\helpers\Html;

class StatusColumn extends Column
{
    use ColumnTrait;

    public $headerOptions = ['style' => 'width:110px;'];
    public $attribute = 'status';

    public function init()
    {
        if (!$this->enableSorting) {
            $this->headerOptions = ['style' => 'width:90px;'];
        }
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        return
            Html::tag(
                'div',
                '<i class="fa fa-fw fa-toggle-on"></i>&nbsp;On',
                [
                    'style' => 'color: green; cursor: pointer; font-weight: bold; display: ' . ($model->{$this->attribute} ? 'block': 'none'),
                    'data-action' => 'MEMBER-STATUS',
                    'data-value' => $model->id,
                    'data-status' => 'inactive',
                ]
            )
            .
            Html::tag(
                'div',
                '<i class="fa fa-fw fa-toggle-off"></i>&nbsp;Off',
                [
                    'style' => 'color: #F00; cursor: pointer; font-weight: bold;  display: ' . (!$model->{$this->attribute} ? 'block': 'none'),
                    'data-action' => 'MEMBER-STATUS',
                    'data-value' => $model->id,
                    'data-status' => 'active',
                ]
            );
    }
}
