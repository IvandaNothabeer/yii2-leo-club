<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Membertype]].
 *
 * @see Membertype
 */
class MembertypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Membertype[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Membertype|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
