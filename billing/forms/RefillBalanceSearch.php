<?php

namespace billing\forms;

use billing\entities\RefillBalance;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RefillBalanceSearch extends Model
{
    public $date;
    public $member_id;
    public $phone;

    public function rules(): array
    {
        return [
            ['date', 'require'],
            ['member_id', 'integer'],
            ['date', 'each', 'rule' => 'string'],
            ['phone', 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = RefillBalance::find()->innerjoinWith('member');

        if (isset($params['member_id'])) {
            $query->andWhere(['members.id' => $params['member_id']]);
        }

        if (isset($params['phone'])) {
            $query->andWhere(['members.phone' => $params['phone']]);
        }

        $query->andWhere([
            'between',
            'refill_balance.created_at',
            strtotime($params['date']['from']),
            strtotime($params['date']['to'])
        ]);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => false,
        ]);
    }
}
