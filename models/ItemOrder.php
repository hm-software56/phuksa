<?php

namespace app\models;

use Yii;
use \app\models\base\ItemOrder as BaseItemOrder;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item_order".
 */
class ItemOrder extends BaseItemOrder
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
