<?php

namespace app\models;

use Yii;
use \app\models\base\Transaction as BaseTransaction;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "transaction".
 */
class Transaction extends BaseTransaction
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
