<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Agent]].
 *
 * @see \app\models\Agent
 */
class AgentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Agent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Agent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}