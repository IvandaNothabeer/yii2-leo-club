<?php

namespace app\models;

use Yii;
use \app\models\base\Dog as BaseDog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dog".
 */
class Dog extends BaseDog
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
