<?php

namespace traits;

use yii\grid\GridView;

trait ColumnTrait
{
    /** @var GridView $grid */
    public $grid;

    /** @var bool vendor/yiisoft/yii2/grid/DataColumn.php $enableSorting */
    public $enableSorting = true;

    /** @var array vendor/yiisoft/yii2/grid/DataColumn.php $sortLinkOptions */
    public $sortLinkOptions = [];

    protected function renderHeaderCellContent()
    {
        if ($this->attribute !== null && $this->enableSorting &&
            ($sort = $this->grid->dataProvider->getSort()) !== false && $sort->hasAttribute($this->attribute)) {
            return $sort->link(
                $this->attribute,
                array_merge(
                    $this->sortLinkOptions,
                    ['label' => ucfirst($this->attribute)]
                )
            );
        } else {
            return ucfirst($this->attribute);
        }
    }
}
