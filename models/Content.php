<?php

namespace app\models;

use Yii;
use \app\models\base\Content as BaseContent;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "content".
 */
class Content extends BaseContent
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
