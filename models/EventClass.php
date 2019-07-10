<?php

namespace app\models;

use Yii;
use \app\models\base\EventClass as BaseEventClass;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "eventclass".
 */
class EventClass extends BaseEventClass
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
