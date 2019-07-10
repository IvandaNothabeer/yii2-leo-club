<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EventClass]].
 *
 * @see EventClass
 */
class EventClassQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EventClass[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EventClass|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
