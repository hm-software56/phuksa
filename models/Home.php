<?php

namespace app\models;

use Yii;
use \app\models\base\Home as BaseHome;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "home".
 */
class Home extends BaseHome
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
