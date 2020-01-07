<?php

namespace app\models;

use Yii;
use \app\models\base\OrderElectricCar as BaseOrderElectricCar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order_electric_car".
 */
class OrderElectricCar extends BaseOrderElectricCar
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

    public function Getordercode()
    {
        $model =OrderElectricCar::find()->orderBy('id DESC')->one();
        if (!empty($model)) {
            $number = (int) $model->order_code + 1;
            $sys_number= sprintf('%05d', $number);
        } else {
            $sys_number  = sprintf('%05d', 1);
        }
        return $sys_number;
    }
}