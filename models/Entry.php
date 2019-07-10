<?php

namespace app\models;

use Yii;
use \app\models\base\Entry as BaseEntry;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "entry".
 */
class Entry extends BaseEntry
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
