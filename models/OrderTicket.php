<?php

namespace app\models;

use Yii;
use \app\models\base\OrderTicket as BaseOrderTicket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order_ticket".
 */
class OrderTicket extends BaseOrderTicket
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
