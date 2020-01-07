<?php

namespace app\models;

use Yii;
use \app\models\base\ServiceTicket as BaseServiceTicket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "service_ticket".
 */
class ServiceTicket extends BaseServiceTicket
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