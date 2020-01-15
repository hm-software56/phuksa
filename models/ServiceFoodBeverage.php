<?php

namespace app\models;

use Yii;
use \app\models\base\ServiceFoodBeverage as BaseServiceFoodBeverage;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "service_food_beverage".
 */
class ServiceFoodBeverage extends BaseServiceFoodBeverage
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
