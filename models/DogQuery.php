<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Dog]].
 *
 * @see Dog
 */
class DogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Dog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Dog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
