<?php

namespace app\models;

use Yii;
use \app\models\base\OrderTicketHasCar as BaseOrderTicketHasCar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order_ticket_has_car".
 */
class OrderTicketHasCar extends BaseOrderTicketHasCar
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
