<?php

namespace app\models;

use Yii;
use \app\models\base\ServiceElectricCar as BaseServiceElectricCar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "service_electric_car".
 */
class ServiceElectricCar extends BaseServiceElectricCar
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
